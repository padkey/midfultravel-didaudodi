<?php

namespace DDDD\CatalogProduct\Http\Controllers;

use DDDD\Blog\Admin\Selectable\BlogPostSelectable;
use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogProduct\Admin\Actions\FilterDataSync;
use DDDD\CatalogProduct\Admin\Actions\GeneralDataSync;
use DDDD\CatalogProduct\Admin\Actions\ShowFilterDataSync;
use DDDD\CatalogProduct\Admin\Actions\ShowGeneralDataSync;
use DDDD\CatalogProduct\Admin\Actions\ShowSearchDataSync;
use DDDD\CatalogProduct\Admin\Actions\ShowSpecDataSync;
use DDDD\CatalogProduct\Admin\Actions\SpecDataSync;
use DDDD\CatalogProduct\Admin\Extensions\Tools\SelectAttributeSetProduct;
use DDDD\CatalogProduct\Admin\Extensions\Tools\SelectDuplicateProduct;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Models\ProductPrice;
use DDDD\CatalogProduct\Models\ProductStockShop;
use DDDD\CatalogProduct\Selectable\CategorySelectable;
use DDDD\CatalogProduct\Selectable\ProductSelectable;
use DDDD\CatalogProduct\Selectable\ProductSingleSelectable;
use DDDD\CatalogProduct\Selectable\ProductTag;
use DDDD\CatalogProduct\Services\ProductStoreDataService;
use DDDD\CatalogProduct\Services\ProductValueService;
use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use DDDD\EAVAttribute\Services\EavAttributeService;

use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;
use App\Admin\Controllers\AdminDashboardController;
use Encore\Admin\Controllers\AdminController;

class CatalogProductController extends AdminController
{

    protected $title = 'Catalog Products';

    /**
     * @var CatalogProduct
     */
    private $catalogProduct;

    /**
     * @var ProductValueService
     */
    public $catalogProductValueService;

    /**
     * @var ProductStoreDataService
     */
    private $productStoreDataService;

    /**
     * @var EavAttributeSet
     */
    private $eavAttributeSet;

    /**
     * @var EavAttributeService
     */
    protected $eavAttributeService;

    /**
     * CatalogProductController constructor.
     * @param CatalogProduct $catalogProduct
     * @param ProductValueService $catalogProductValueService
     */
    function __construct(
        CatalogProduct          $catalogProduct,
        ProductValueService     $catalogProductValueService,
        ProductStoreDataService $productStoreDataService,
        EavAttributeSet         $eavAttributeSet,
        EavAttributeService     $eavAttributeService
    ) {
        $this->catalogProduct = $catalogProduct;
        $this->catalogProductValueService = $catalogProductValueService;
        $this->productStoreDataService = $productStoreDataService;
        $this->eavAttributeSet = $eavAttributeSet;
        $this->eavAttributeService = $eavAttributeService;
    }

    /**
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid($this->catalogProduct);

        $grid->column(CatalogProduct::COL_ENTITY_ID)->sortable();
        $grid->column(CatalogProduct::COL_STATUS)->bool();
        $grid->column(CatalogProduct::COL_SKU);
        $grid->column(CatalogProduct::COL_PRODUCT_NAME)->sortable()->editable();
        $grid->column(CatalogProduct::COL_PRODUCT_URI);
        $grid->column(CatalogProduct::COL_APPEND_IS_PARENT)->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return count($this->parents()->get()->toArray()) == 0;
        })->bool();

        $grid->column('base_price')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getBasePrice();
        });

        $grid->column('special_price')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getSpecialPrice();
        });
        $grid->column('meta_index')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getCustomAttribute('meta_index');
        })->bool();
        $grid->column('meta_follow')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getCustomAttribute('meta_follow');
        })->bool();

        $grid->column('meta_title')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getCustomAttribute('meta_title');
        })->editable('textarea');

        $grid->column('meta_description')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getCustomAttribute('meta_description');
        })->editable('textarea');

        $grid->column('meta_keyword')->display(function () {
            /**
             * @var CatalogProduct $this
             */
            return $this->getCustomAttribute('meta_keyword');
        })->editable('textarea');

        $grid->column(CatalogProduct::COL_AUTHOR_UPDATE_NAME_EXT, __("Author Update"));
        $grid->column(CatalogProduct::COL_AUTHOR_NAME_EXT, __("Author Create"));
        $grid->column(CatalogProduct::COL_NUMBER_EXTERNAL_LINK, __("Ext link"));
        $grid->column(CatalogProduct::COL_NUMBER_INTERNAL_LINK, __("Int link"));

        // Column use for export.
        $grid->column('categories_export', __("Categories export"))->display(function () {
            /**
             * @var CatalogProduct $this
             */
            $names = $this->categories()->get()->toArray();
            $names = array_map(function ($names) {
                return $names[CatalogCategory::COL_CATEGORY_NAME];
            }, $names);
            return join(',', $names);

        })->hide();

        $grid->column('categories', __("Categories"))->display(function () {
            /**
             * @var CatalogProduct $this
             */
            $names = $this->categories()->get()->toArray();
            $names = array_map(function ($names) {
            $link = '/admin/catalog-category/' . $names[CatalogCategory::COL_ENTITY_ID];
            return "<a href='{$link}' class='label label-success'>{$names[CatalogCategory::COL_CATEGORY_NAME]}</a>";
            }, $names);
            return join('&nbsp;', $names);
        });


        $grid->filter(function ($filter) {
            $filter->scope(CatalogProduct::TYPE_PARENT, 'Parent Products')->where('product_type', CatalogProduct::TYPE_PARENT);
            $filter->scope(CatalogProduct::TYPE_SINGLE, 'Single Products')->where('product_type', CatalogProduct::TYPE_SINGLE);
            $filter->ilike(CatalogProduct::COL_SKU);
            $filter->ilike(CatalogProduct::COL_PRODUCT_NAME);
            $filter->like(CatalogProduct::COL_PRODUCT_URI);
            $filter->between("price.". ProductPrice::COL_PRICE, __("Price"));
            $filter->between("price.". ProductPrice::COL_SPECIAL_PRICE, __("Special Price"));
            $filter->between("stock.". ProductStockShop::COL_QUANTITY, __("Quantity"));
            $filter->equal(CatalogProduct::COL_STATUS)->select([ true => 'Active', false => 'Inactive']);
            $filter->equal("categories.". CatalogCategory::COL_ENTITY_ID, "Category")
                ->select(CatalogCategory::all()->pluck(CatalogCategory::COL_CATEGORY_NAME, CatalogCategory::COL_ENTITY_ID));
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (!Admin::user()->can('DDDD.catalog-product.delete') || $actions->row->is_system) {
                $actions->disableDelete();
            }
            $actions->add(new \App\Admin\Actions\QuickView);
            $actions->add(new ShowGeneralDataSync());
            $actions->add(new ShowSpecDataSync());
            $actions->add(new ShowFilterDataSync());
            $actions->add(new ShowSearchDataSync());

            if (Admin::user()->can('DDDD.catalog-product.sync-new')) {
                $actions->add(new GeneralDataSync());
                $actions->add(new SpecDataSync());
                $actions->add(new FilterDataSync());
            }
        });

        $grid->export(function ($export) {
            $export->originalValue([
                CatalogProduct::COL_ENTITY_ID,
                CatalogProduct::COL_PRODUCT_NAME,
                'categories_export',
            ]);
        });

        $grid->perPages([10,20,50,100,200,500,999]);

        return $grid;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        try {
            Permission::check('DDDD.catalog-product.create');
            $data = request()->all();
            try {
                $productId = $this->productStoreDataService->storeProduct($data);
                admin_toastr('Create succeeded!', 'success');
                if (isset($data['after-save']) && $data['after-save'] == 1) {
                    return redirect()->route('catalog-product.edit', ['catalog_product' => $productId]);
                } else {
                    return redirect()->route('catalog-product.index');
                }
            } catch (\Exception $exception) {
                admin_toastr($exception->getMessage(), 'error');
                return back()->withInput();
            }

        } catch (\Exception $exception) {
            admin_toastr($exception->getMessage(), 'error');
            Log::error("NEW PRODUCT:" . $exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            Permission::check('DDDD.catalog-product.edit');
            $data = request()->all();
            if (array_key_exists(Field::FILE_DELETE_FLAG, $data)) {
                $index = $data['key'];
                $flipped_array = array();
                foreach ($data as $key => $value) {
                    $flipped_array[$value] = $key;
                }
                $attrName = $flipped_array[Field::FILE_DELETE_FLAG];
                /**
                 * @var CatalogProduct $product
                 */
                $product = $this->catalogProduct->newQuery()->findOrFail($id);
                $attrValue = $product->getCustomAttribute($attrName);
                unset($attrValue[$index]);
                $newAttrValue = [];
                foreach ($attrValue as $item) {
                    $newAttrValue[] = $item;
                }
                $product->upsertCustomAttribute($attrName, json_encode($newAttrValue));
                return response()->json([
                    'status'    => false,
                    'message'   => "Update succeeded !",
                    'display'   => [],
                ]);
            } elseif (array_key_exists('_editable', $data)) {
                return $this->productStoreDataService->updateInline($data);
            } else {
                try {
                    $this->productStoreDataService->updateProduct($id, $data);
                    admin_toastr('Update succeeded!', 'success');
                    if (isset($data['after-save']) && $data['after-save'] == 1) {
                        return redirect()->route('catalog-product.edit', ['catalog_product' => $id]);
                    } else {
                        return redirect()->route('catalog-product.index');
                    }
                } catch (\Exception $exception) {
                    admin_toastr($exception->getMessage(), 'error');
                    return back()->withInput();
                }
            }

        } catch (\Exception $exception) {
            Log::error("UPDATE PRODUCT:" . $exception->getMessage());
            admin_toastr($exception->getMessage(), 'error');
            return back()->withInput();
        }
    }

    /**
     * @return Form
     */
    public function form($id = 0): Form
    {
        $form = new Form($this->catalogProduct);

        /**
         * @var EavAttributeSet $attrSet
         */
        if (request('attr_group')) {
            $attrSetId = request('attr_group');
            $attrSet = $this->eavAttributeSet->findOrFail($attrSetId);
        } else if ($id != 0) {
            $this->catalogProduct = CatalogProduct::query()->findOrFail($id);
            $attrSet = $this->eavAttributeSet->findOrFail($this->catalogProduct->getAttributeSetId());
        } else {
            $attrSet = $this->eavAttributeService->getAttributeSetProductDefault();
        }

        $form->tab('General', function (Form $form) {
            $form->text(CatalogProduct::COL_PRODUCT_NAME)->required()
                ->addElementClass("count-character")
                ->attribute('min-length', 50)
                ->attribute('max-length', 55);
            $form->text(CatalogProduct::COL_SKU)->required();
            $form->switch(CatalogProduct::COL_STATUS);
            if ($form->isEditing()) {
                $form->radio(CatalogProduct::COL_PRODUCT_TYPE, 'Product Type')->disable()
                    ->options(CatalogProduct::PRODUCT_TYPE)
                    ->when(CatalogProduct::TYPE_SINGLE, function (Form $form) {
                        // code
                    })
                    ->when(CatalogProduct::TYPE_PARENT, function (Form $form) {
                        $form->belongsToMany('children', ProductSingleSelectable::class, __('Child Product'));
                    })->default(CatalogProduct::TYPE_SINGLE);
            } else {
                $form->radio(CatalogProduct::COL_PRODUCT_TYPE, 'Product Type')
                    ->options(CatalogProduct::PRODUCT_TYPE)
                    ->when(CatalogProduct::TYPE_SINGLE, function (Form $form) {
                        // code
                    })
                    ->when(CatalogProduct::TYPE_PARENT, function (Form $form) {
                        $form->belongsToMany('children', ProductSingleSelectable::class, __('Child Product'));
                    })->default(CatalogProduct::TYPE_SINGLE);
            }
        });

        if ($form->isEditing()) {

            $form->tab('Product Uri', function (Form $form) {
                $form->text(CatalogProduct::COL_PRODUCT_URI)->required();
            });

            $form->tab('Stocks', function (Form $form) {
                $productStock = $this->catalogProduct->getProductStock();
                $content = "";
                foreach ($productStock as $stock) {
                    /**
                     * @var ProductStockShop $stock
                     */
                    $link = '/admin/shop/' . $stock->getShop()->{Shop::COL_ID};
                    $code = "<a href='{$link}'>{$stock->getShop()->{Shop::COL_CODE}}</a>";
                    $content = $content . "<p> {$code} : {$stock->{ProductStockShop::COL_QUANTITY}}</p>";
                }
                $form->html($content);
            });

            $form->tab("SEP price",  function (Form $form) {
                $productPrice = $this->catalogProduct->getProductPrice();
                $content = "";
                foreach ($productPrice as $price) {

                    /**
                     * @var ProductPrice $price
                     */
                    $content = $content . sprintf("<p> %s -- %s: %s; %s: %s </p>",
                            $price->getProvince()->{Province::COL_NAME},
                        "Price",
                            $price->{ProductPrice::COL_PRICE},
                        "Special price",
                            $price->{ProductPrice::COL_SPECIAL_PRICE},
                    );
                }
                $form->html($content);
            });

            $form->tools(function (Form\Tools $tools) use ($id) {
                $tools->append(new SelectDuplicateProduct($id));
                if ($id != 0) {
                    $tools->append(new \App\Admin\Tools\QuickView(CatalogProduct::query()->findOrFail($id)));
                }
            });
        }

        $form->tab('Category', function (Form $form) {
            $form->belongsToMany('categories', CategorySelectable::class, __('Choose'));
        });

//        $form->tab('Tag', function (Form $form) {
//            $form->belongsToMany('tags', ProductTag::class, __('Choose'));
//        });

        $form->tab('Cross sale', function (Form $form) {
            $form->belongsToMany('cross_sale', ProductSelectable::class, __('Choose'));
        });

//        $form->tab('Related Blog Post', function (Form $form) {
//            $form->belongsToMany('posts', BlogPostSelectable::class, __('Choose'));
//        });

        $form->hidden(CatalogProduct::COL_ATTRIBUTE_SET_ID)->default($attrSet->getAttributeSetId());

        // show group attribute
        foreach ($attrSet->groups()->get() as $attributeGroup) {
            /**
             * @var EavAttributeGroup $attributeGroup
             */
            $form->tab($attributeGroup->getAttributeGroupName(),
                function ($form) use ($attributeGroup) {
                    $this->catalogProductValueService->selectProductValueWithAttributeGroup(
                        $form, $attributeGroup, $this->catalogProduct);
                });
        }

        $form->tools(function (Form\Tools $tools) {
            $tools->append(new SelectAttributeSetProduct());
        });
        $form->setTitle('Attribute Set: '. $attrSet->getAttributeSetName());

        $form->disableReset();
        $form->disableViewCheck();
        $form->disableCreatingCheck();
        return $form;
    }

    protected function getPermissionKey(): string
    {
        return \DDDD\CatalogProduct\CatalogProduct::PRODUCT_PERMISSION_SLUG;
    }
}
