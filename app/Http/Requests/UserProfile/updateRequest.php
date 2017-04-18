<?php

namespace App\Http\Requests\UserProfile;

use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'real_name' => 'required',
            'card_id' => 'required',
            'gender' => 'required',
            'address' => 'required',
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
            'real_name.required' => '姓名必须填写',
            'card_id.required' => '身份证号码必须填写',
            'gender.required' => '性别必须选择',
            'address.required' => '地址必须填写',
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
