<?php
/**
 * @file     Mysql.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\item;

use libary\monitor\common\Utils;
use libary\monitor\common\Config;

/**
 * 数据检查
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class Mysql extends CheckBase
{
    public $priority = 2;

    public function check()
    {
        $c_user = Utils::get_current_uname();
        if ($c_user != 'root') {
            Utils::print_error("'".__CLASS__."' need root privilege to run check");

            return ;
        }
        $mysql_info = Config::${'mysql_info'};
        $link = mysqli_connect($mysql_info[ENV]['host'].':'.$mysql_info[ENV]['port'], $mysql_info[ENV]['user'], $mysql_info[ENV]['pass'], $mysql_info[ENV]['database'], $mysql_info[ENV]['port']);
        if (!isset($link->connect_errno) || $link->connect_errno!=0) {
            $msg = "mysql connection failed";
            Utils::print_error($msg);
        }
    }
}
