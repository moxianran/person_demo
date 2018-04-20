<?php
/*************************************
 * PHP amqp(RabbitMQ) Demo - publisher
 * Author: ying
 * Date: 2018/4/13
 *************************************/
//配置信息
$conn_args = array(
    'host' => '127.0.0.1',
    'port' => '5672',
    'login' => 'guest',
    'password' => 'guest',
    'vhost'=>'/'
);
$e_name = 'e_ying'; //交换机名
$q_name = 'q_ying'; //队列名
$k_route = 'key_1'; //路由key

//创建连接和channel
$conn = new AMQPConnection($conn_args);
if (!$conn->connect()) {
    die("Cannot connect to the broker!\n");
}
$channel = new AMQPChannel($conn);

//创建队列
$q = new AMQPQueue($channel);
$q->setName($q_name);
$q->setFlags(AMQP_DURABLE); //持久化
$q->declare();

//创建交换机对象
$ex = new AMQPExchange($channel);
$ex->setName($e_name);
$ex->setType(AMQP_EX_TYPE_DIRECT); //direct类型
$ex->setFlags(AMQP_DURABLE); //持久化
$ex->declare();

//绑定交换机与队列，并指定路由键
$q->bind($e_name, $k_route);

//发送消息
//$channel->startTransaction(); //开始事务
for($i=0; $i<5; ++$i){
    $message = "TEST MESSAGE! 测试消息！";

    $message = $message.$i."---";
//    echo "Send Message:".$ex->publish($message, $k_route)."\n";

}
//$channel->commitTransaction(); //提交事务

$conn->disconnect();