<?php

namespace DDDD\Subscription\Services;

use DDDD\Customer\Models\Customer;
use DDDD\Subscription\Tools\SubscriptionValidate;
use DDDD\Subscription\Models\SubscriptionModel;
use Illuminate\Http\Request;

class SubmitSubscriptionServiceService implements ISubmitSubscriptionService
{
    protected SubscriptionValidate $subscriptionValidate;
    protected SubscriptionModel $subscriptionModel;

    /**
     * @param SubscriptionValidate $subscriptionValidate
     * @param SubscriptionModel $subscriptionModel
     */
    public function __construct(
        SubscriptionValidate $subscriptionValidate,
        SubscriptionModel $subscriptionModel
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
            $urlId = $dataValidate['url']['url_id'];
            $this->subscriptionModel->newQuery()->create([
                SubscriptionModel::COL_CUSTOMER_ID => $customerId,
                SubscriptionModel::COL_URL_ID => $urlId,
                SubscriptionModel::COL_STATUS => SubscriptionModel::STATUS_PENDING
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
