<?php

namespace App\Http\Controllers\Controller;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.reg');
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
        if(!$data['username'] || !$data['email'] || !$data['pass1'] || !$data['pass2']){
            header('Refresh:3;url=/user/reg');
            die('参数不完整，请重新填写信息');
        }

        unset($data['pass2']);
        $data['pass1'] = password_hash($data['pass1'],1);
        $data['create_time'] = time();
        $id = User::insertGetId($data);
        if($id){
            echo '注册成功';
            header('Refresh:3;url=/user/login');
        }else{
            echo '注册失败';
            header('Refresh:3;url=/user/reg');
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
