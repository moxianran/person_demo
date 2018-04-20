<?php
$cl = function($name){
    return sprintf('hello %s',$name);
};
echo $cl('fuck');
echo "<br /><br />";

$message = 'hello';
$example = function() use ($message){
    var_dump($message);
};
echo $example();

echo "<br /><br />";

$message = 'world';
//输出hello 因为继承变量的值的时候是函数定义的时候而不是 函数被调用的时候
echo $example();

echo "<br /><br />";

$message = 'hello';
//此处传引用
$example = function() use(&$message){
    var_dump($message);
};
echo $example();

echo "<br /><br />";

$message = 'world';
echo $example();

echo "<br /><br />";


class Cart{
    //在类里面定义常量用 const 关键字，而不是通常的 define() 函数。
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK  = 3.00;
    const PRICE_EGGS  = 6.95;

    protected $products = [];
    public function add($product,$quantity){
        $this->products[$product] = $quantity;
    }
    public function getQuantity($product){
        //是否定义了
        return isset($this->products[$product])?$this->products[$product]:FALSE;
    }
    public function getTotal($tax){
        $total = 0.0;
        $callback = function($quantity,$product) use ($tax , &$total){
            //constant 返回常量的值
            //__class__返回类名
            $price = constant(__CLASS__."::PRICE_".strtoupper($product));

            $total += ($price * $quantity)*($tax+1.0);
        };
        //array_walk() 函数对数组中的每个元素应用用户自定义函数。在函数中，数组的键名和键值是参数
        array_walk($this->products,$callback);
        //回调匿名函数
        return round($total,2);

    }
}


$my_cart = new Cart();
//$my_cart->add('butter',1);
$my_cart->add('milk',3);
//$my_cart->add('eggs',6);


print($my_cart->getTotal(0.05));