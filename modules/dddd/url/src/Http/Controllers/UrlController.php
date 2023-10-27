<?php

namespace DDDD\Url\Http\Controllers;

use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use DDDD\Url\Models\UrlModel as UrlModel;
use DDDD\Url\Services\UrlService;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Form;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Show;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class UrlController
 * @package DTV\Url\Http\Controllers
 */
class UrlController extends Controller
{
    use HasResourceActions;

    /**
     * @var UrlModel
     */
    private $model;

    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * UrlController constructor.
     * @param UrlModel $model
     * @param UrlService $urlService
     */
    public function __construct(
        UrlModel $model,
        UrlService $urlService) {
        $this->model = $model;
        $this->urlService = $urlService;
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        Permission::check('dtv.url');
        return $content
            ->title("Url Manage")
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        Permission::check('dtv.url.create');
        return $content
            ->title(__("New Url"))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column){
                    $column->append($this->form());
                });
            });
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content|RedirectResponse
     */
    public function edit($id, Content $content)
    {
        Permission::check('dddd.url.edit');
        $urlModel = $this->model->findOrFail($id);
        if ($urlModel->entity_type != UrlModel::ENTITY_TYPE_CUSTOM) {
            admin_toastr(__("Admin only is able to edit URL with Entity Type is Custom"), 'warning');
            return redirect()->route('url.show', ['url' => $id]);
        }

        return $content
            ->title('Url Item Edit')
            ->row($this->form()->edit($id)->disableViewCheck()->disableCreatingCheck());
    }

    /**
     * @param $id
     * @return JsonResponse|mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update($id)
    {
        $urlReq = request()->get(UrlModel::COL_REQUEST_PATH);
        $urlModel = $this->model->findOrFail($id);
        if ($urlModel->{UrlModel::COL_REQUEST_PATH} != $urlReq) {
            if ($this->urlService->isUrlExisted($urlReq)) {
                admin_toastr(__("Request path is exited!"), 'error');
                return redirect()->route('url.edit', ['url' => $id]);
            }
        }
        return $this->form()->update($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse|mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function store()
    {
        $urlReq = request()->get(UrlModel::COL_REQUEST_PATH);
        if ($this->urlService->isUrlExisted($urlReq)) {
            admin_toastr(__("Request path is exited!"), 'error');
            return redirect()->route('url.create');
        }
        return $this->form()->store();
    }

    /**
     * @param $id
     * @return JsonResponse|mixed
     */
    public function destroy($id)
    {
        $urlModel = $this->model->findOrFail($id);
        if ($urlModel->entity_type != UrlModel::ENTITY_TYPE_CUSTOM) {
            $response = [
                'status'  => false,
                'message' => trans("Admin only is able to delete URL with Entity Type is Custom !"),
            ];
            return response()->json($response);
        }
        return $this->form()->destroy($id);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form($this->model);

        $form->text("entity_type")->default(UrlModel::ENTITY_TYPE_CUSTOM)->readonly();
        $form->hidden("entity_id")->default(UrlModel::ENTITY_TYPE_CUSTOM_ID);
        $form->text('request_path');
        $form->text('target_path');
        $form->select('redirect_type')
            ->options([0 => "No", 301 => "Permanent (301)", 302 => "Temporary (302)"]);

        $form->disableReset();
        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dtv.url.delete')) {
                $tools->disableDelete();
            }
        });
        $form->setTitle("Url Information");
        return $form;
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {

        $grid = new Grid($this->model);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('entity_type', __('Entity Type'));
        $grid->column('entity_id', __('Entity Id'));
        $grid->column('request_path', __('Request Path'));
        $grid->column('target_path', __('Target Path'));
        $grid->column('redirect_type', __('Redirect Type'));
        $grid->column("created_at", __("Created At"))->display(function () {
            return date_format($this->updated_at,"Y/m/d H:i:s");
        });
        $grid->column("updated_at", __("Updated At"))->display(function () {
            return date_format($this->updated_at,"Y/m/d H:i:s");
        });

        $grid->actions(function ($actions) {
            if ($actions->row->entity_type != UrlModel::ENTITY_TYPE_CUSTOM) {
                $actions->disableDelete();
                $actions->disableEdit();
            }
        });

        $grid->filter(function($filter){
            $filter->like(UrlModel::COL_REQUEST_PATH, __("Request Path"));
            $filter->equal(UrlModel::COL_ENTITY_ID, __("Entity ID"));
            $filter->in(UrlModel::COL_ENTITY_TYPE, __("Entity Type"))
                ->multipleSelect(
                    [
                        UrlModel::ENTITY_TYPE_BLOG_CATEGORY => UrlModel::ENTITY_TYPE_BLOG_CATEGORY,
                        UrlModel::ENTITY_TYPE_BLOG_POST => UrlModel::ENTITY_TYPE_BLOG_POST,
                        UrlModel::ENTITY_TYPE_PAGES => UrlModel::ENTITY_TYPE_PAGES,
                        UrlModel::ENTITY_TYPE_BLOG_TAG => UrlModel::ENTITY_TYPE_BLOG_TAG,
                        UrlModel::ENTITY_TYPE_CATALOG_CATEGORY => UrlModel::ENTITY_TYPE_CATALOG_CATEGORY,
                        UrlModel::ENTITY_TYPE_CATALOG_PRODUCT => UrlModel::ENTITY_TYPE_CATALOG_PRODUCT,
                        UrlModel::ENTITY_TYPE_PRODUCT_TAG => UrlModel::ENTITY_TYPE_PRODUCT_TAG,
                        UrlModel::ENTITY_TYPE_CUSTOM => UrlModel::ENTITY_TYPE_CUSTOM
                    ]
                );
        });
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('dtv.url.delete')) {
                $actions->disableDelete();
            }
        });
        return $grid;
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        $urlModel = $this->model->findOrFail($id);
        $show = new Show($urlModel);

        $show->field('id', __('Id'));
        $show->field('entity_type', __('Entity Type'));
        $show->field('entity_id', __('Entity Id'));
        $show->field('request_path', __("Request Path"));
        $show->field("redirect_type", __("Redirect Type"));
        $show->field("created_at", __("Created At"));
        $show->field("updated_at", __("Updated At"));

        return $content
            ->title('Url Information')
            ->row($show);
    }
}
