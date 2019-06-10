<?php

namespace App\Http\Controllers\Controller;

use App\Model\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 用户聊天界面
    public function index(){
        $content = Content::get();
        $username = session('username');
        $data = [
            'content' => $content,
            'username' => $username
        ];
        return view('user.index',$data);
    }

    // 聊天数据入库
    public function content(){
        $content = request()->input('content');
        $name = session('username');
        $data = [
            'content'   => $content,
            'username'  => $name,
            'create_time' => time()
        ];
        $res = Content::insert($data);
        if($res){
            echo json_encode(['code' => 1]);
        }else{
            echo json_encode(['code' => 2]);
        }
    }

    // 聊天数据获取
    public function detail(){
        $info = Content::get();
        echo json_encode(['info' => $info,'code' => 1]);
    }
}
