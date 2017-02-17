<?php
/**
 * @file     Utils.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\common;

/**
 * 工具文件
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class Utils
{
    public static function get_cmd_res($cmd)
    {
        $arrRes = array();
        exec($cmd,$arrRes);

        return $arrRes;
    }

    public static function print_error($msg)
    {
        echo $msg."\n";
        echo "---------------------------\n";
    }

    public static function split_line_space($line)
    {
        return  preg_split('/\s+/', $line);
    }

    public static function get_current_uname()
    {
        $c_uid = posix_getuid();
        $u_uinfo = posix_getpwuid($c_uid);
        return $u_uinfo['name'];
    }

}
