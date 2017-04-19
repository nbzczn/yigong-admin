<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserProfile\updateRequest;
use App\Http\Transformers\UserProfileTransformer;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function detail(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        return $this->response->item($profile, new UserProfileTransformer);
    }
    /**
     * 更新详细资料
     *
     * @Put("/user_profile/update")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"card_id": "身份证号码", "real_name": "姓名", "gender": "性别", "address": "地址"}),
     *      @Response(200, body={}),
     *      @Response(422, body={"message": "合法性验证信息", "errors": "错误信息，是个json对象"})
     * })
     *
     * @author 陈泽韦 549226266@qq.com
     */
    public function update(updateRequest $request)
    {
        $user = $request->user();
        $profileModel = UserProfile::findOrNew($user->id);
        $profileModel->user_id = $user->id;
        $profileModel->card_id = $request->input('card_id', '');
        $profileModel->real_name = $request->input('real_name', '');
        $profileModel->gender = $request->input('gender', '');
        $profileModel->address = $request->input('address', '');
        $profileModel->save();
        return $this->response->item($profileModel, new UserProfileTransformer);
    }
}
