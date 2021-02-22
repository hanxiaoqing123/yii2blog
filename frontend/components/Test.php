<?php


namespace frontend\components;

use Yii;

class Test
{
    public $name;
    private $_age;
    private $_t;

    // Test依赖T,通过构造方法的参数传递进去
    public function __construct($age, T $t)
    {
        $this->_t = $t;
        $this->_age = $age;
    }

}

