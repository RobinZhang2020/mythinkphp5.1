<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use app\user\model\User;
use think\facade\Session;
class Auth extends Controller
{
    protected $middleware = [
        'Auth' => [
            'except' => [
                'create',
                'save'
            ]
        ],
    ];
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
        $requestData = $request->post();
        //dump($requestData);
        $result = $this->validate($requestData, 'app\user\validate\Auth');
        //return $result;
        
        if (true !== $result) {
            return redirect('user/auth/create')->with('validate',$result);
        } else {
            $user=User::create($requestData);
            Session::set('user', $user);
            return redirect('user/auth/read')->params(['id' => $user->id]);
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        $user = User::find($id);
        $this->assign([
            'user' => $user,
        ]);
        return $this->fetch();
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
        $user_id = Session::get('user.id');
        if ($user_id !== $id) {
            return redirect('user/auth/edit', ['id' => $user_id]);
        }
        $user = User::find($user_id);
        $this->assign([
            'user' => $user,
        ]);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user_id = Session::get('user.id');

        if ($user_id !== $id) {
            return redirect('user/auth/edit', ['id' => $user_id])->with('validate', '非法操作');
        }
        $requestData = $request->put();
        $result = $this->validate($requestData, 'app\user\validate\UpdateUser');
    
        if (true !== $result) {
            return redirect('user/auth/edit', ['id' => $user_id])->with('validate', $result);
        } else {
            $name = $requestData['name'];
            User::where('id', $user_id)->update(['name' => $name]);
            Session::set('user.name', $name);
            return redirect('user/auth/edit', ['id' => $user_id])->with('validate', '修改成功');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
