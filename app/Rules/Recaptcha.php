<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value,   // value này là recaptcha_token ở client gửi qua
            'ip' => request()->ip(),
        ]);
        //throw new ModelNotFoundException('User not found by ID ' . $response);
        if ($response->successful() && $response->json('success') ) {
            return true;

        }

        throw new ModelNotFoundException('User not found by ID ' . $response);
        return false;
    }

    public function message()
    {
        return 'Failed to validate ReCaptcha.';
    }
}
