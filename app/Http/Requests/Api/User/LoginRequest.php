<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $passwordMinLength = config('app.api.login_password_min_length');
        return [
            'email' => 'required|email',
            'password' => 'required|min:' . $passwordMinLength
        ];
    }

    public function messages(): array
    {
        $passwordMinLength = config('app.api.login_password_min_length');
        return [
            'email.required' => trans('api/user.login.validation.email.required'),
            'email.email' => trans('api/user.login.validation.email.email'),
            'password.required' => trans('api/user.login.validation.password.required'),
            'password.min' => trans('api/user.login.validation.password.min', ['min' => $passwordMinLength])
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new  HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
                'type' => 'validation',
                'validation' => true
            ], 404)
        );
    }
}
