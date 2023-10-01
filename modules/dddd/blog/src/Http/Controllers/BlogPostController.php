<?php

namespace DDDD\Blog\Http\Controllers;

use DDDD\Blog\Models\BlogPost;
use DDDD\Blog\Models\BlogCategory;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use DDDD\Blog\Admin\Selectable\BlogCategorySelectable;

class BlogPostController extends Controller
{
    use HasResourceActions;

    /**
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        // Permission::check('dtv.blog-post');
        return $content
            ->title("Blog Post")
            ->row(function (Row $row) {
                $row->column(12, $this->grid()->render());
            });
    }
    /**
     * @param $id
     * @param Content $content
     * @return mixed
     */
    public function show($id, Content $content)
    {
        return redirect()->route('blog-post.edit', ['blog_post' => $id]);
    }
        /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        // Permission::check('dtv.blog-post.create');
        return $content
            ->title(__("New Post"))
            ->row(function (Row $row) {
                $row->column(12, function (Column $column){
                    $column->append($this->form());
                });
            });
    }

        /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        // Permission::check('dtv.blog-post.edit');
        return $content
            ->title(__("Edit post"))
            ->row(function (Row $row) use ($id) {
                $row->column(12, function (Column $column) use ($id) {
                    $column->append($this->form()->edit($id));
                });
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new BlogPost);
        $grid->column(BlogPost::COL_ID, __("ID"))->sortable();
        $grid->column(BlogPost::COL_TITLE, __("Title"));
        $grid->column(BlogPost::COL_META_TITLE)->hide();

        $grid->column(BlogPost::COL_IS_ACTIVE)->bool();
        $grid->column(BlogPost::COL_META_KEYWORDS);
        $grid->column(BlogPost::COL_META_DESCRIPTION);
        $grid->column(BlogPost::COL_PUBLIC_DATE);
        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
//        /**
//         * @var BlogPost $aa
//         */
//        $aa = BlogPost::query()->findOrFail(1);
//        $cates = $aa->categories()->get();
//        foreach ($cates as $cate) {
//            /**
//             * @var BlogCategory $cate
//             *
//             */
//        }

        $form = new Form(new BlogPost);
        $form->tab(__("General Information"), function ($form) {
            $form->text(BlogPost::COL_TITLE, __("Title"))->rules("required");
            $form->image(BlogPost::COL_IMAGE_THUMBNAIL, __("Image Thumbnail"))->setWidth(4, 2)->uniqueName();
            //$form->multipleImage(BlogPost::COL_IMAGE_BANNER, __("Images"))->removable()->uniqueName();
            //$form->text(BlogPost::COL_URL, __("Url Key"))->rules("required");
            if ($form->isEditing()) {
                $form->text(BlogPost::COL_URL, __("Url Key"))->rules("required");
            }
            //$form->text("author_id");
            // $form->datetime(BlogPost::COL_PUBLIC_DATE)->rules("required");
        });
        $form->tab(__("Categories"), function ($form) {
            $form->belongsToMany('categories', BlogCategorySelectable::class, __("Categories"));
        });

        // $form->tab(__("Tags"), function ($form) {
        //     $form->belongsToMany('tags', BlogTagSelectable::class, __("Tags"));
        // });

        $form->tab(__("Content"), function ($form) {
            // $form->text(BlogPost::COL_ALT_THUMBNAIL)->rules("required");
            // $form->textarea(BlogPost::COL_CONTENT_HEADER, __("Content Header"));
            $form->textarea(BlogPost::COL_SHORT_DESCRIPTION, __("Short Description"));
            $form->tmeditor(BlogPost::COL_CONTENT);

        });
        $form->tab(__("Meta Data"), function ($form) {
            $form->text(BlogPost::COL_META_TITLE, __("Meta Title"))->rules("required");
            $form->textarea(BlogPost::COL_META_KEYWORDS, __("Meta Keywords"))->rules("required");
            $form->textarea(BlogPost::COL_META_DESCRIPTION, __("Meta Description"))->rules("required");
        });

        return $form;
    }
}
