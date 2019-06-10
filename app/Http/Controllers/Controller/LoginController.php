<?php

namespace App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(!$data['account'] || !$data['pass']){
            header('Refresh:3;url=/user/login');
            die('参数必填');
        }
        $arr = User::where('email',$data['account'])->first();
        $arr = json_decode(json_encode($arr),true);
        if($arr){
            if(password_verify($data['pass'],$arr['pass1'])){
//                $name = 'username'.$arr['id'];
//                setcookie($name,$arr['username'],time()+6004800);
                session(['id' => $arr['id'],'username' => $arr['username']]);
                echo '登录成功';
                header('Refresh:3;url=/user/index');
            }else{
                header('Refresh:3;url=/user/login');
                die('密码错误');
            }
        }else{
            header('Refresh:3;url=/user/reg');
            die('请先注册');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
