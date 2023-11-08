<?php

namespace DDDD\TourEnquire\Tools;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourEnquireValidate
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
                'phone' => ['numeric', 'required'],
                'email' => ['string', 'email', 'required', 'max:255'],
                'message' => ['required'],
                'name' => ['required'],
                'tourId' =>['required'],
            ],
            're-captcha' => [
                'recaptcha_token' => ['required', new ReCaptcha()]
            ]
        ];

    }

    public function make(Request $request): TourEnquireValidate
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
       // $product = $this->validator::validate($this->request->all(), $this->rules['product']);
        $this->validator::validate($this->request->all(), $this->rules['re-captcha']);
        return ['customer' => $customer];
    }
}
