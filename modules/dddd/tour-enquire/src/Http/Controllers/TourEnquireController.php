<?php

namespace DDDD\TourEnquire\Http\Controllers;

use App\Admin\Controllers\AdminDashboardController;
use DDDD\Tour\Models\TourModel;
use DDDD\TourEnquire\Models\TourEnquireModel;
use DDDD\Url\Models\UrlModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;


class TourEnquireController extends AdminController
{

    public function grid(): Grid
    {
        $grid = new Grid(new TourEnquireModel());
        $grid->column(TourEnquireModel::COL_ID)->sortable();
        $grid->column(TourEnquireModel::COL_STATUS)->label([
            1 => 'default',
            TourEnquireModel::STATUS_PENDING => 'danger',
            TourEnquireModel::STATUS_COMPLETE => 'success',
            4 => 'info',
        ]);
        $grid->created_at();

        $grid->filter(function ($filter) {
            $filter->equal(TourEnquireModel::COL_STATUS)
                ->select(
                    [
                        TourEnquireModel::STATUS_PENDING => TourEnquireModel::STATUS_PENDING,
                        TourEnquireModel::STATUS_COMPLETE => TourEnquireModel::STATUS_COMPLETE,
                    ]
                );

        });
        return $grid;
    }

    public function form(): Form
    {
        $form = new Form(new TourEnquireModel);
        $form->select(TourEnquireModel::COL_STATUS)->options([
                TourEnquireModel::STATUS_PENDING => TourEnquireModel::STATUS_PENDING,
                TourEnquireModel::STATUS_COMPLETE => TourEnquireModel::STATUS_COMPLETE,
            ]
        );
        $form->text(TourEnquireModel::COL_CUSTOMER_NAME, __("Customer Name"))->readonly();
        $form->text(TourEnquireModel::COL_CUSTOMER_EMAIL, __("Customer Email"))->readonly();
        $form->text(TourEnquireModel::COL_CUSTOMER_PHONE, __("Customer Phone"))->readonly();
        $form->textarea(TourEnquireModel::COL_CUSTOMER_MESSAGE, __("Customer Message"))->readonly();
       // $form->text(TourEnquireModel::tour(), __("Customer TourID"))->readonly();
        /*$form->tour('Tour',function ($tour){
            $tour->name;
        });*/
        $form->select('tour_id', 'Tour Name')
            ->options(TourModel::all()->pluck('name', 'id'))
            ->default(Request::capture()->query('tour_id'))
            ->readonly();
        $form->textarea(TourEnquireModel::COL_ADMIN_NOTE, __("Admin Note"));
      //  $form->textarea(TourEnquireModel::COL_RESPONSE_MESSAGE_TO_EMAIL, __("Response to email"));


        if (!$form->isCreating()) {
            // $form->text('customer.' . Customer::COL_EMAIL)->readonly();
            // $form->switch('customer.' . Customer::COL_IS_ADMIN)->readonly();
            // $form->text('customer.' . Customer::COL_PHONE_NUMBER)->readonly();
            // $form->text('customer.' . Customer::COL_FULL_NAME)->readonly();
            // $form->text('url.'. UrlModel::COL_REQUEST_PATH)->readonly();
            // $form->text('url.'. UrlModel::COL_ENTITY_ID)->readonly();
            // $form->text('url.'. UrlModel::COL_ENTITY_TYPE)->readonly();
        }

        return $form;
    }

    protected function getPermissionKey(): string
    {
        //return \DTV\Subscription\Subscription::SUBSCRIPTION_PERMISSION_SLUG;
    }
}
