<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    const SEX_UN = 10;  //未知
    const SEX_BOY = 20; // 男
    const SEX_GRIL = 30;    //女

    protected $table = 'student';

    protected $fillable = ['name', 'age', 'sex']; //模型中定义哪些属性是可以进行赋值的

    //public $timestamps = true; //默认为true

    //提供一个定制的时间戳格式
    /*protected function getDateFormat()
    {
        //默认 return 'Y-m-d H:i:s';
        //return time();
    }

    protected function asDateTime($val)
    {
        return $val;
    }*/

    /**
     * @function 实现数据库 数字与性别的转化
     * @param null $ind
     * @return array
     */
    public function sexTrans($ind = null)
    {
        $arr = [
            self::SEX_UN => '未知',//self是指向类本身，也就是self是不指向任何已经实例化的对象，一般self使用来指向类中的静态变量。
            self::SEX_BOY => '男',
            self::SEX_GRIL => '女',
        ];

        if ($ind !== null) {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }

        return $arr;
    }


}