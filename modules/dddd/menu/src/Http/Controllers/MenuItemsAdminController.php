<?php

namespace DDDD\Menu\Http\Controllers;

use DDDD\Menu\Models\Menu;
use DDDD\Menu\Models\MenuItems;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Request;

class MenuItemsAdminController extends Controller
{
    use HasResourceActions;

    public function index()//: Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return $this->redirectToMainMenu();
    }

    protected function redirectToMainMenu()//: Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $request = Request::capture();
        $refererUrl = $request->headers->get('referer');

        $menuDetailUrl = admin_url('menu');
        $regexCheckMenuUrl = '/^(' . str_replace('/', '\/', $menuDetailUrl) . '\/)(\d+)$/';
        $itemDetailUrl = admin_url('menu-items');
        $regexCheckItemUrl = '/^(' . str_replace('/', '\/', $itemDetailUrl) . '\/)(\d+)(\/edit)?$/';


        if (preg_match($regexCheckMenuUrl, $refererUrl)) {
            return redirect($refererUrl);
        }

        if (preg_match($regexCheckItemUrl, $refererUrl)) {
            $itemId = preg_replace($regexCheckItemUrl, '$2', $refererUrl);
            $menuId = MenuItems::findOrFail($itemId)->menu_id;
            return redirect()->route('menu.show', ['menu' => $menuId]);
        }

        return redirect()->route('menu.index');
    }

    public function edit($id, Content $content): Content
    {
        Permission::check('dtv.menu.edit');
        return $content
            ->title('Menu Item Edit')
            ->row($this->form()->edit($id)->disableViewCheck()->disableCreatingCheck());
    }

    public function show()//: Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        return $this->redirectToMainMenu();
    }

    public function form(): Form
    {
        $form = new Form(new MenuItems);

        $form->display('id', 'ID');

        $form->select('parent_id', 'Parent ID')->options(MenuItems::selectOptions());
        $form->select('menu_id', 'Menu')->options(Menu::all()->pluck('name', 'id'))->rules('required');
        $form->text('name', 'Name')->rules('required');
        $form->url('url', 'URL')->rules('required');
        $form->select('target_attr', 'Target attribute')
            ->options([
                '_blank' => '_blank',
                '_self' => '_self',
                '_parent' => '_parent',
                '_top' => '_top',
                'framename' => 'framename'
            ]);

        $form->select('type', 'Type')
            ->options(['item' => 'Item', 'group' => 'Group'])
            ->when('=', 'item', function (Form $form) {
                $form->image('icon', 'Icon Image');
                $form->color('color', 'Color');
                $form->image('image', 'Image')->uniqueName()->downloadable();;
                $form->select('is_use_label_on_mobile', 'Is Use Label On Mobile')
                    ->options([true => 'Yes', false => 'No']);
            });

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        return $form;
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
        if (Admin::user()->can('dtv.menu.delete')) {
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
