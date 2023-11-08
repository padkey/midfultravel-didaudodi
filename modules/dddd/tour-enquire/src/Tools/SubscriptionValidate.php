<?php

namespace DDDD\Subscription\Tools;

use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionValidate
{
    /**
     * @var
     */
    private $request;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var array[]
     */
    protected $rules;

    /**
     * @var string[]
     */
    protected $messages;


    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
        $this->rules = [
            'customer' => [
                'phone_number' => ['numeric', 'required'],
                'email' => ['string', 'email', 'required', 'max:255'],
                'full_name' => ['required']
            ],
            'url' => [
                'url_id' => ['numeric', 'required']
            ],
            're-captchar' => [
                'recaptcha-token' => ['required', new ReCaptcha()]
            ]
        ];

    }

    public function make(Request $request): SubscriptionValidate
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function validateRequest(): array
    {
        $customer = $this->validator::validate($this->request->all(), $this->rules['customer']);
        $url = $this->validator::validate($this->request->all(), $this->rules['url']);
        $this->validator::validate($this->request->all(), $this->rules['re-captchar']);
        return ['customer' => $customer, 'url' => $url];
    }
}
