<?php

namespace DDDD\Subscription\Services;

use DDDD\Customer\Models\Customer;
use DDDD\Subscription\Tools\ProductSubscriptionValidate;
use DDDD\Subscription\Models\ProductSubscriptionModel;
use Illuminate\Http\Request;

class SubmitProductSubscriptionServiceService implements ISubmitProductSubscriptionService
{
    protected ProductSubscriptionValidate $subscriptionValidate;
    protected ProductSubscriptionModel $subscriptionModel;

    /**
     * @param ProductSubscriptionValidate $subscriptionValidate
     * @param ProductSubscriptionModel $subscriptionModel
     */
    public function __construct(
        ProductSubscriptionValidate $subscriptionValidate,
        ProductSubscriptionModel $subscriptionModel
    )
    {
        $this->subscriptionValidate = $subscriptionValidate;
        $this->subscriptionModel = $subscriptionModel;
    }

    /**
     * @throws \Exception
     */
    public function submitData(Request $request): void
    {
        try {
            $dataValidate = $this->subscriptionValidate->make($request)->validateRequest();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        try {
            $customerId = $this->storeCustomer($dataValidate['customer']);
            $productId = $dataValidate['product']['product_id'];
            $this->subscriptionModel->newQuery()->create([
                ProductSubscriptionModel::COL_CUSTOMER_ID => $customerId,
                ProductSubscriptionModel::COL_PRODUCT_ID => $productId,
                ProductSubscriptionModel::COL_STATUS => ProductSubscriptionModel::STATUS_PENDING
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    protected function storeCustomer(array $data)
    {
        try {

            /**
             * @var Customer $customer
             */
            $customer = Customer::query()->updateOrCreate(
                [
                    Customer::COL_EMAIL => $data['email']
                ],
                [
                    Customer::COL_FULL_NAME =>  $data['full_name'],
                    Customer::COL_PHONE_NUMBER => $data['phone_number'],
                    Customer::COL_IS_ADMIN => true,
                    Customer::COL_PASSWORD  => ''
                ]
            );
        } catch (\Exception $exception) {
            throw new \Exception(sprintf("Comment: save customer error. %s", $exception->getMessage()));
        }

        return $customer->{Customer::COL_ENTITY_ID};
    }
}
