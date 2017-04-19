<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\User\storeRequest;
use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * 用户资源接口
 *
 * @Resource("User", uri="/api/user")
 */
class UserController extends Controller
{
    /**
     * 注册用户
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({"mobile": "手机号", "password": "密码", "code": "短信验证码"}),
     *      @Response(200, body={"id": "用户主键"，"mobile": "手机号"}),
     *      @Response(422, body={"message": "合法性验证信息", "errors": "错误信息，是个json对象"})
     * })
     *
     * @author 陈泽韦 549226266@qq.com
     */
    public function store(storeRequest $request)
    {
        $model = new User;
        $model->mobile = $request->mobile;
        $model->password = bcrypt($request->password);
        $model->save();

        return $this->response->item($model, new UserTransformer);
    }

    public function detail(Request $request)
    {
        $user = $request->user();
        $detail = User::with('profile')->find($user->id);
        return $this->response->array($detail);
    }

}
