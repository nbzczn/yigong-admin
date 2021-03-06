<?php

namespace App\Http\Requests\User;

use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
        return [
            'mobile' => 'unique:users|required|confirm_mobile_not_change',
            'password' => 'required',
            'code' => 'required|verify_code',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mobile.required' => '手机号必须',
            'mobile.unique' => '手机号已注册',
            'mobile.confirm_mobile_not_change' => '提交的手机号已变更',
            'password.required' => '密码必须',
            'name.max' => '公众号名称不得大于255个字符',
            'code.required' => '验证码必须',
            'code.verify_code' => '验证码错误或已过期',
        ];
    }
    /**
     * {@inheritdoc}
     */
    protected function failedValidation(Validator $validator)
    {
        throw new StoreResourceFailedException('数据验证不通过', $validator->errors());
    }
}
