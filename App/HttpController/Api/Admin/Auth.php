<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/11/21
 * Time: 20:06
 */

namespace App\HttpController\Api\Admin;


use App\Model\Admin\AdminModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;

class Auth extends AdminBase
{
    protected $whiteList = ['login'];


    /**
     * login
     * 127.0.0.1:9501/Api/Admin/Auth/login?account=xsk&password=123456
     * 登陆,参数验证注解写法
     * @Param(name="account", alias="帐号", required="", lengthMax="20")
     * @Param(name="password", alias="密码", required="", lengthMin="6", lengthMax="16")
     * @throws \EasySwoole\ORM\Exception\Exception
     * @throws \Throwable
     * @author Tioncico
     * Time: 10:18
     */
    function login()
    {
        $param = $this->request()->getRequestParam();
        $model = new AdminModel();
        $model->adminAccount = $param['account'];
        $model->adminPassword = md5($param['password']);

        if ($user = $model->login()) {
            $sessionHash = md5(time() . $user->adminId);
            $user->update([
                'adminLastLoginTime' => time(),
                'adminLastLoginIp' => $this->clientRealIP(),
                'adminSession' => $sessionHash
            ]);

            $rs = $user->toArray();
            unset($rs['adminPassword']);
            $rs['adminSession'] = $sessionHash;
            $this->response()->setCookie('adminSession', $sessionHash, time() + 3600, '/');
            $this->writeJson(Status::CODE_OK, $rs);
        } else {
            $this->writeJson(Status::CODE_BAD_REQUEST, '', '密码错误');
        }

    }

    /**
     * logout
     * 退出登录,参数注解写法
     * @Param(name="adminSession", from={COOKIE}, required="")
     * @return bool
     * @author Tioncico
     * Time: 10:23
     */
    function logout()
    {
        $sessionKey = $this->request()->getRequestParam($this->sessionKey);
        if (empty($sessionKey)) {
            $sessionKey = $this->request()->getCookieParams('adminSession');
        }
        if (empty($sessionKey)) {
            $this->writeJson(Status::CODE_UNAUTHORIZED, '', '尚未登入');
            return false;
        }
        $result = $this->getWho()->logout();
        if ($result) {
            $this->writeJson(Status::CODE_OK, '', "登出成功");
        } else {
            $this->writeJson(Status::CODE_UNAUTHORIZED, '', 'fail');
        }
    }

    function getInfo()
    {
        $this->writeJson(200, $this->getWho()->toArray(), 'success');
    }
}