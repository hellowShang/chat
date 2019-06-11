<?php

namespace App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MongoDB\Client;

class MongoController extends Controller
{
    public $client;
    public $collection;

    public function __construct()
    {
        // 连接MongoDB
        $this->client = new Client("mongodb://localhost:27017");
        $this->collection = $this->client->mongo->test;    // mongo是数据库库名   test是数据表
    }

    // MongoDB 增
    public function insert(){
        // 添加一条
        $res = $this->collection->insertOne(['name' => 'zhangsan','age' => 12,'email' => '123123@qq.com','pass' => '123123']);
        // 添加多条
        /*
         $data = [
                    [
                        'name' => 'zhangsan',
                        'age' => 12,
                        'email' => '123@qq.com',
                        'pass' => '123123'
                    ],
                    [
                        'name' => 'lisi',
                        'age' => 13,
                        'email' => '123123@qq.com',
                        'pass' => '123123'
                    ],
                    [
                        'name' => 'wangwu',
                        'age' => 14,
                        'email' => '123123123@qq.com',
                        'pass' => '123123'
                    ],
                    [
                        'name' => 'zhuliu',
                        'age' => 15,
                        'email' => '123123123123@qq.com',
                        'pass' => '123123'
                    ],
            ];
        $res = $this->collection->insertMany($data);
        */

        // 打印自增id
        var_dump($res->getInsertedId());
    }

    // MongoDB 查
    public function select(){
        // 不加where条件  查询所有
//        $arr = $this->collection->find()->toArray();
        // 查询单条
        $arr = $this->collection->findOne(['name' => 'zhangsan']);
        echo "<pre>";print_r($arr);echo "</pre>";die;

        // toArray()的话，就不用foreach了
//        foreach($arr as $k=>$v){
//            echo "<pre>";print_r($v);echo "</pre>";
//        }
    }

    // MongoDB 改
    public function update(){
        // 修改单条
//        $res = $this->collection->updateOne(['name' => 'zhangsan'],['$set' => ['age' => 8]]);
        // 修改多条
        $res = $this->collection->updateMany(['name' => 'zhangsan'],['$set' => ['age' => 2000]]);

        // 返回受影响的行数
        var_dump($res->getMatchedCount());
    }

    // MongoDB 删
    public function delete(){
        // 删除单条
//        $res = $this->collection->deleteOne(['name' => 'zhangsan']);
        // 删除多条
        $res = $this->collection->deleteMany(['name' => 'zhangsan']);

        // 返回受影响行数
        var_dump($res->getDeletedCount());
    }
}
