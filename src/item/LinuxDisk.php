<?php
/**
 * @file     LinuxDisk.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\item;

use libary\monitor\common\Utils;

/**
 * 磁盘检查
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class LinuxDisk extends CheckBase
{
    public $priority = 1;

    public function check()
    {
        /*----------检查磁盘空间-------------*/
        $cmd = "df -h";
        $arrRes = array();
        exec($cmd, $arrRes);
        unset($arrRes[0]);

        foreach ($arrRes as $val) {
            $val = Utils::split_line_space($val);
            if ($val[4] == '100%') {
                $msg =  'space:'.$val[0]."\t".$val[4];
                Utils::print_error($msg);
            }
        }

        /*----------检查inode使用-------------*/
        $cmd = "df -i";
        $arrRes = array();
        exec($cmd, $arrRes);
        unset($arrRes[0]);

        foreach ($arrRes as $val) {
            $val = Utils::split_line_space($val);
            if ($val[4] == '100%') {
                $msg =  'inode:'.$val[0]."\t".$val[4];
                Utils::print_error($msg);
            }
        }
    }
}
