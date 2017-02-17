<?php
/**
 * @file     PHP.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\item;

use libary\monitor\common\Utils;
/**
 * PHP服务检查
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class PHP extends CheckBase
{
    public $priority = 4;

    public function check()
    {

        $c_user = Utils::get_current_uname();
        if ($c_user != 'root') {
            Utils::print_error("'".__CLASS__."' need root privilege to run check");

            return ;
        }
        $cmd = "ps -efH | grep 'php-fpm' | grep -v grep  | wc -l";
        $arrRes = Utils::get_cmd_res($cmd);
        $nginx_num  = intval($arrRes[0]);
        if ($nginx_num == 0) {
            $msg = "no php process";
            Utils::print_error($msg);
        }

    }

 }
