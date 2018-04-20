<?php
/**
 * Laravel 服务容器实例
 * 控制反转（IoC）和依赖注入（DI）
 * Created by IntelliJ IDEA.
 * User: ying
 * Date: 18-4-13
 * Time: 下午3:25
 */

interface SuperModuleInterface
{
    /**
     * 超能力激活方法
     * 任何一个超能力都得有该方法，并拥有一个参数
     *@param array $target 针对目标，可以是一个或多个，自己或他人
     */
    public function activate(array $target);
}

/**
 * X-超能量
 */
class XPower implements SuperModuleInterface
{
    public function activate(array $target)
    {
        // 这只是个例子。。具体自行脑补
        echo "发射超能量";
    }
    public function fashe()
    {
        echo "发射超能量";

    }
}

/**
 * 终极炸弹 （就这么俗）
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target)
    {
        // 这只是个例子。。具体自行脑补
        echo "装载终极炸弹";
    }
}

class Superman
{
    public $module;
    //类型约束
    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module;
    }

    public function say_hi()
    {
        echo "hello world<br/>";
    }
}

//$superModule = new XPower;
//// 初始化一个超人，并注入一个超能力模组依赖
//$superMan = new Superman($superModule);
//echo $superMan->say_hi();
//$superMan->module->fashe();
//die;

//超级工厂
class Container
{
    protected $binds;

    protected $instances;

    public function bind($abstract, $concrete)
    {
        //是否属于闭包、匿名函数
        if ($concrete instanceof Closure) {

            //print_r($concrete);
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }

        //print_r($this->binds);
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        //将$this 插入到数组 $parameters
        array_unshift($parameters, $this);

        //调用回调函数，并把一个数组参数作为回调函数的参数
        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}

// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂添加超人的生产脚本
$container->bind('superman', function($container, $moduleName) {
    return new Superman($container->make($moduleName));
});

// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('xpower', function($container) {
    return new XPower;
});

// 同上
$container->bind('ultrabomb', function($container) {
    return new UltraBomb;
});

// ****************** 华丽丽的分割线 **********************
// 开始启动生产
$superman_1 = $container->make('superman', ['xpower']);
$superman_2 = $container->make('superman', ['ultrabomb']);
$superman_3 = $container->make('superman', ['xpower']);


var_dump($superman_1);

$superman_1->module->fashe();

var_dump($superman_2);
var_dump($superman_3);
die;