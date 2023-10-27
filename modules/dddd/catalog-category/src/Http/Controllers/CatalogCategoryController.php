<?php

namespace DDDD\CatalogCategory\Http\Controllers;

use DDDD\CatalogCategory\Models\CatalogCategory;
use DDDD\CatalogCategory\Services\CatalogCategoryService;
use DDDD\CatalogCategory\Services\CatalogCategoryStoreDataService;
use DDDD\CatalogProduct\Models\CatalogProduct;
use DDDD\CatalogProduct\Selectable\ProductSelectable;
use DDDD\EAVAttribute\Models\EavAttributeGroup;
use DDDD\EAVAttribute\Models\EavAttributeSet;
use DDDD\EAVAttribute\Services\EavAttributeService;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class CatalogCategoryController extends Controller
{
    use HasResourceActions;

    /**
     * @var CatalogCategory
     */
    protected $catalogCategory;

    /**
     * @var CatalogCategoryService
     */
    protected $categoryService;

    /**
     * @var CatalogCategoryStoreDataService
     */
    protected $categoryStoreDataService;

    /**
     * @var EavAttributeSet
     */
    protected $eavAttributeSet;

    protected $eavAttributeService;

    /**
     * CatalogCategoryController constructor.
     * @param CatalogCategory $catalogCategory
     * @param CatalogCategoryService $categoryService
     * @param CatalogCategoryStoreDataService $categoryStoreDataService
     * @param EavAttributeSet $eavAttributeSet
     */
    function __construct(
        CatalogCategory $catalogCategory,
        CatalogCategoryService $categoryService,
        CatalogCategoryStoreDataService $categoryStoreDataService,
        EavAttributeSet $eavAttributeSet,
        EavAttributeService $eavAttributeService
    ) {
        $this->catalogCategory = $catalogCategory;
        $this->categoryService = $categoryService;
        $this->categoryStoreDataService = $categoryStoreDataService;
        $this->eavAttributeSet = $eavAttributeSet;
        $this->eavAttributeService = $eavAttributeService;
    }

    public function index(Content $content): Content
    {
        Permission::check('DDDD.catalog-category');

        $isGrid = \request()->get('grid');
        if ($isGrid != null) {
            return $content
                ->body($this->grid());
        } else {
            return $content
                ->title(__("Catalog Categories"))
                ->description(CatalogCategory::count() . ' entries')
                ->row(function (Row $row) {
                    $row->column(12, $this->treeView()->render());
                });
        }
    }

    public function grid(): Grid
    {
        $grid = new Grid($this->catalogCategory);
        $grid->column(CatalogCategory::COL_ENTITY_ID);
        $grid->column(CatalogCategory::COL_CATEGORY_NAME);
        $grid->column(CatalogCategory::COL_CATEGORY_URI);
        $grid->column(CatalogCategory::COL_ENTITY_ID);
        $grid->column(CatalogCategory::COL_NUMBER_EXTERNAL_LINK, __("Ext link"));
        $grid->column(CatalogCategory::COL_NUMBER_INTERNAL_LINK, __("Int link"));
        $grid->column(CatalogCategory::COL_AUTHOR_UPDATE_NAME_EXT, __("Author Update"));
        $grid->column(CatalogCategory::COL_AUTHOR_NAME_EXT, __("Author Create"));
        $grid->column('number_of_product')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return count($this->products()->get());
        });
        $grid->column('meta_index')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('meta_index');
        })->bool();
        $grid->column('meta_follow')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('meta_follow');
        })->bool();

        $grid->column('meta_title')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('meta_title');
        });

        $grid->column('meta_description')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('meta_description');
        });

        $grid->column('meta_keyword')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('meta_keyword');
        });

        $grid->column('category_description')->display(function () {
            /**
             * @var CatalogCategory $this
             */
            return $this->getCustomAttribute('category_description');
        });

        $grid->export(function ($export) {
            $export->originalValue([
                CatalogCategory::COL_CATEGORY_NAME,
            ]);
        });

        $grid->actions(function ($actions) {
            $actions->add(new \App\Admin\Actions\QuickView);
        });

        $grid->perPages([10,20,50,100,200,500,999]);

        return $grid;

    }

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content): Content
    {
        Permission::check('DDDD.catalog-category.create');
        return $content
            ->title('Catalog Category')
            ->description(__('Create'))
            ->body($this->form());
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content): Content
    {
        Permission::check('DDDD.catalog-category.edit');
        return $content
            ->title(__("Category Detail"))
            ->description('Edit')
            ->body($this->editForm($id)->edit($id));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (isset($request->all()['_order'])) {
            $dataReturnStore = $this->form()->store();
            $this->categoryService->injectLevelAndPathAllCategory();
            return $dataReturnStore;
        } else {
            try {
                $data = request()->all();
                $id = $this->categoryStoreDataService->storeCategory($data);
                admin_toastr('Create succeeded!', 'success');
                if (isset($data['after-save']) && $data['after-save'] == 3) {
                    return redirect()->route('catalog-category.edit', ['catalog_category' => $id]);
                } else {
                    return redirect()->route('catalog-category.index');
                }
                return redirect('/admin/catalog-category');
            } catch (\Exception $exception) {
                log::info("Error during create category " . $exception->getMessage());
                admin_toastr($exception->getMessage(), 'error');
                return back()->withInput();
            }
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $data = request()->all();
            $this->categoryStoreDataService->updateCategory($id, $data);
            admin_toastr('Update succeeded!');
            if (isset($data['after-save']) && $data['after-save'] == 3) {
                return redirect()->route('catalog-category.edit', ['catalog_category' => $id]);
            } else {
                return redirect()->route('catalog-category.index');
            }
        } catch (\Exception $exception) {
            log::info("Error during update category " . $exception->getMessage());
            admin_toastr($exception->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function show($id, Content $content)
    {
        Permission::check('DDDD.catalog-category');
        return $content
            ->title('Product Detail')
            ->body($this->showForm($id)->edit($id)
            );
    }

    public function showForm($id): Form
    {
        $form = $this->editForm($id);
        $form->tools(function (Form\Tools $tools) use ($form) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
            $tools->add('
                <a class="btn btn-sm btn-default" href="/admin/catalog-category">
                    <i class="fa fa-list"></i>&nbsp;&nbsp;List
                </a>'
            );
        });
        $form->disableSubmit()->disableViewCheck();
        return $form;
    }
    public function destroy($id)
    {
        try {
            Permission::check('DDDD.catalog-category.delete');
            return $this->form()->destroy($id);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    public function form(): Form
    {
        $form = new Form($this->catalogCategory);

        /**
         * @var EavAttributeSet $attrSet
         */
        $attrSet = $this->eavAttributeService->getAttributeSetCategoryDefault();

        $form->tab(__('General'), function (Form $form) {
            $form->select(CatalogCategory::COL_PARENT_ID, __('Parent'))->options(CatalogCategory::selectOptions());
            $form->text(CatalogCategory::COL_CATEGORY_NAME, __("Category Name"))->required();
            $form->belongsToMany('products', ProductSelectable::class, __('Choose product'));
        });
        $form->hidden(CatalogCategory::COL_ATTRIBUTE_SET_ID)->default($attrSet->getAttributeSetId());

        foreach ($attrSet->groups()->get() as $attributeGroup) {
            /**
             * @var EavAttributeGroup $attributeGroup
             */
            $form->tab($attributeGroup->getAttributeGroupName(), function ($form) use ($attributeGroup) {
                $this->eavAttributeService->selectAttributeFormById($form, $attributeGroup);
            });
        }

        $form->disableReset();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }

    public function editForm($id): Form
    {
        $form = new Form($this->catalogCategory);

        /**
         * @var CatalogCategory $catalogCategory
         */
        $catalogCategory = $this->catalogCategory->findOrFail($id);

        /**
         * @var EavAttributeSet $attrSet
         */
        $attrSet = $this->eavAttributeSet->findOrFail($catalogCategory->getAttributeSetId());

        $form->tab(__('General'), function (Form $form) {
            $form->text(CatalogCategory::COL_ENTITY_ID)->readonly();
            $form->select(CatalogCategory::COL_PARENT_ID, __('Parent'))->options(CatalogCategory::selectOptions());
            $form->text(CatalogCategory::COL_CATEGORY_NAME, __("Category Name"))->required();
            $form->belongsToMany('products', ProductSelectable::class, __('Choose product'));
        });

        $form->tab(__('URI'), function (Form $form) {
            $form->text(CatalogCategory::COL_CATEGORY_URI, __('Category URI'))->required();
        });
        $form->hidden(CatalogCategory::COL_ATTRIBUTE_SET_ID)->default($attrSet->getAttributeSetId());

        foreach ($attrSet->groups()->get() as $attrGroup) {
            /**
             * @var EavAttributeGroup $attrGroup
             */
            $form->tab($attrGroup->getAttributeGroupName(), function ($form) use ($attrGroup, $catalogCategory) {
                $this->categoryService->selectCategoryValueWithAttributeGroup($form, $attrGroup, $catalogCategory);
            });
        }

        $form->tools(function (Form\Tools $tools) use ($id) {
            if ($id != 0) {
                $tools->append(new \App\Admin\Tools\QuickView(CatalogCategory::query()->findOrFail($id)));
            }
        });

        $form->disableReset();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();

        return $form;
    }

    protected function treeView(): Tree
    {
        $tree = new Tree($this->catalogCategory);
        $tree->branch(function ($branch) {
            $payload = "{$branch['entity_id']} &nbsp; | &nbsp;<strong>{$branch['category_name']}</strong> | &nbsp; {$branch['category_uri']}";

            if (!isset($branch['children'])) {
                $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"#\" class=\"dd-nodrag\"></a>";
            }
            return $payload;
        });

        $tree->tools(function (\Encore\Admin\Tree\Tools $tools){
            $tools->add('
                <a class="btn btn-sm btn-default" href="/admin/catalog-category?grid=true">
                    <i class="fa fa-list"></i>&nbsp;&nbsp;List
                </a>'
            );
        });

        return $tree;
    }
}
