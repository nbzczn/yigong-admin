FORMAT: 1A

# 天平义工API

# User [/api/user]
用户资源接口

## 创建用户 [POST /api/user]


+ Request (application/json)
    + Body

            {
                "mobile": "手机号",
                "password": "密码",
                "code": "短信验证码"
            }

+ Response 200 (application/json)
    + Body

            {
                "id": "用户主键"
            }

+ Response 422 (application/json)
    + Body

            {
                "message": "合法性验证信息",
                "errors": "错误信息，是个json对象"
            }