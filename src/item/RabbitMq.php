<?php
/**
 * @file     Rabbit.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\item;

use libary\monitor\common\Utils;

/**
 * Rabbit服务检查
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class RabbitMq extends CheckBase
{
    public $priority = 5;

    public function check()
    {
        $c_user = Utils::get_current_uname();
        if ($c_user != 'root') {
            Utils::print_error("'".__CLASS__."' need root privilege to run check");

            return ;
        }
        $cmd = "ps -efH | grep 'rabbitmq' | grep -v grep  | wc -l";
        $arrRes = Utils::get_cmd_res($cmd);
        $nginx_num  = intval($arrRes[0]);
        if ($nginx_num == 0) {
            $msg = "no rabbitmq-server process";
            Utils::print_error($msg);
        }
    }
}
