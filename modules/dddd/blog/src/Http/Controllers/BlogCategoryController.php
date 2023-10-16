<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Admin\Selectable\BlogPostSelectable;
use DDDD\Blog\Models\Block;
use DDDD\Blog\Models\BlogCategory;
use DDDD\Blog\Models\Locale;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Encore\Admin\Layout\Column;
use Encore\Admin\Form;
use Encore\Admin\Controllers\HasResourceActions;

class BlogCategoryController extends Controller
{
    use HasResourceActions;

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        Permission::check('dddd.blog-category');
        return $content
            ->title("Blog Category")
            ->row(function (Row $row) {
                $row->column(12, $this->treeView()->render());
            });
    }

    /**
     * @param $id
     * @param Content $content
     * @return mixed
     */
    public function show($id, Content $content)
    {
        return redirect()->route('blog-category.edit', ['blog_category' => $id]);
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        Permission::check('dtv.blog-category.edit');
        return $content
            ->title(__("Edit category"))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $column->append($this->form()->edit($id));
                });
            });
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        Permission::check('dđdd.blog-category.create');
        return $content
            ->title(__("New Categories"))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column){
                    $column->append($this->form());
                });
            });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new BlogCategory);
        $locales = Locale::all();
        $arrayLocale = [];
        foreach ($locales as $locale) {
            $arrayLocale[$locale->code] = $locale->name;
        }
        $form->select(BlogCategory::COL_LOCALE_CODE,__("Language"))->options(
            $arrayLocale
        )->setWidth(4, 2);

        $form->tab(__("General Information"), function ($form) {
            $form->text(BlogCategory::COL_TITLE, __("Title"))->rules("required");
            //$form->image(BlogCategory::COL_IMAGE_BANNER, __("Image Banner"))->setWidth(4, 2)->uniqueName();
           // $form->image(BlogCategory::COL_IMAGE_THUMBNAIL, __("Image Thumbnail"))->setWidth(4, 2)->uniqueName();
            if ($form->isEditing()) {
                $form->text(BlogCategory::COL_URL, __("Url Key"))->rules("required");
            }
            //$form->text(BlogCategory::COL_URL, __("Url Key"));

            $form->text(BlogCategory::COL_POSITION,__("Position"))->default("1")->setWidth(2,2);
            $form->select(BlogCategory::COL_PARENT_ID, __("Parent Category"))->options(BlogCategory::selectOptions());
           // $form->select(BlogCategory::COL_IS_ACTIVE, "Status")->options([1 => "Active", 0 => "Inactive"]);
        });
        // $form->tab(__("Content"), function ($form) {
        //     $form->textarea(BlogCategory::COL_CONTENT_HEADER, __("Content Header"));
        //     $form->textarea(BlogCategory::COL_SHORT_DESCRIPTION, __("Short Description"));
        //     $form->tmeditor(BlogCategory::COL_CONTENT);

        // });
        // $form->tab(__("Post"), function ($form) {
        //     $form->belongsToMany('posts', BlogPostSelectable::class, __("Post"));
        // });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(BlogCategory::COL_META_TITLE, __("Meta Title"))->rules("required");
           // $form->image(BlogCategory::COL_META_THUMBNAIL, __("Meta Thumbnail"))->setWidth(4, 2)->uniqueName();
            $form->textarea(BlogCategory::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(BlogCategory::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });

        $form->disableReset();
        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->tools(function (Form\Tools $tools) {
            if (!Admin::user()->can('dtv.blog-category.delete')) {
                $tools->disableDelete();
            }
        });
        $form->setTitle("Category Information");
        return $form;
    }

    /**
     * Make a tree form builder.
     *
     * @return Tree
     */
    protected function treeView(): Tree
    {
        $tree = new Tree(new BlogCategory);
        $tree->branch(function ($branch) {
            return "{$branch[BlogCategory::COL_ID]} &nbsp; | &nbsp;&nbsp;<strong>{$branch[BlogCategory::COL_TITLE]}</strong>| &nbsp;&nbsp;<strong>{$branch[BlogCategory::COL_LOCALE_CODE]}</strong>";
        });
        if (!Admin::user()->can('dtv.blog-category.edit')) {
            $tree->disableSave();
        }
        if (!Admin::user()->can('dtv.blog-category.create')) {
            $tree->disableCreate();
        }
        return $tree;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        try {
            return $this->form()->store();
        } catch (\Exception $exception) {
            $content = new Content();
            $content->withError(_("Notification"), $exception->getMessage());
            return redirect()->route('blog-category.create', ['content' => $content]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return mixed|Response
     */
    public function update($id)
    {
        try {
            return $this->form()->update($id);
        } catch (\Exception $exception) {
            $content = new Content();
            $content->withError(_("Notification"), $exception->getMessage());
            return redirect()->route('blog-category.edit', ['blog_category'=> $id, 'content' => $content]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        if (Admin::user()->can('dtv.blog-category.delete')) {
            return $this->form()->destroy($id);
        }
        admin_toastr('Permission denied', 'error');
        $response = [
            'status'  => false,
            'message' => trans("Permission denied"),
        ];
        return response()->json($response);
    }
}
