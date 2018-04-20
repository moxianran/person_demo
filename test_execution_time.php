<?php
/**
 * Created by IntelliJ IDEA.
 * User: ying
 * Date: 18-3-22
 * Time: 下午3:40
 */
//xdebug_start_trace();

//测试php 查询时间
function getmicrotime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}

// 记录开始时间
$time_start = getmicrotime();
//echo microtime();
// 这里放要执行的PHP代码，如:
// echo create_password(6);

$return = 0;
for($i=1;$i<100000000;$i++) {
    $return += $i;
}


// 记录结束时间
$time_end = getmicrotime();
$time = $time_end - $time_start;

// 输出运行总时间
echo "执行时间 ".$time_end." - ".$time_start." =". $time ." seconds \n";
//echo microtime();

//xdebug_stop_trace();
