<?php

namespace DDDD\TourEnquire\Services;

//use DDDD\Customer\Models\Customer;
use DDDD\TourEnquire\Tools\TourEnquireValidate;
use DDDD\TourEnquire\Models\TourEnquireModel;
use Illuminate\Http\Request;

class SubmitTourEnquireServiceService implements ISubmitTourEnquireService
{
    protected TourEnquireValidate $TourEnquireValidate;
    protected TourEnquireModel $TourEnquireModel;

    /**
     * @param TourEnquireValidate $TourEnquireValidate
     * @param TourEnquireModel $TourEnquireModel
     */
    public function __construct(
        TourEnquireValidate $TourEnquireValidate,
        TourEnquireModel $TourEnquireModel
    )
    {
        $this->TourEnquireValidate = $TourEnquireValidate;
        $this->TourEnquireModel = $TourEnquireModel;
    }

    /**
     * @throws \Exception
     */
    public function submitData(Request $request): void
    {
        try {
            $dataValidate = $this->TourEnquireValidate->make($request)->validateRequest();
        } catch (\Exception $exception) {
            /*echo $request->name;
            die();*/
            throw new \Exception($exception->getMessage());
        }

        try {
           // $customerId = $this->storeCustomer($dataValidate['customer']);
           // $Id = $dataValidate['']['_id'];
            $this->TourEnquireModel->newQuery()->create([
                TourEnquireModel::COL_CUSTOMER_NAME => $request->name,
                TourEnquireModel::COL_CUSTOMER_PHONE => $request->phone,
                TourEnquireModel::COL_CUSTOMER_EMAIL => $request->email,
                TourEnquireModel::COL_CUSTOMER_MESSAGE => $request->message,
                TourEnquireModel::COL_STATUS => TourEnquireModel::STATUS_PENDING,
                TourEnquireModel::COL_TOUR_ID => $request->tourId,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    // protected function storeCustomer(array $data)
    // {
    //     try {

    //         /**
    //          * @var Customer $customer
    //          */
    //         $customer = Customer::query()->updateOrCreate(
    //             [
    //                 Customer::COL_EMAIL => $data['email']
    //             ],
    //             [
    //                 Customer::COL_FULL_NAME =>  $data['full_name'],
    //                 Customer::COL_PHONE_NUMBER => $data['phone_number'],
    //                 Customer::COL_IS_ADMIN => true,
    //                 Customer::COL_PASSWORD  => ''
    //             ]
    //         );
    //     } catch (\Exception $exception) {
    //         throw new \Exception(sprintf("Comment: save customer error. %s", $exception->getMessage()));
    //     }

    //     return $customer->{Customer::COL_ENTITY_ID};
    // }
}
