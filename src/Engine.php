<?php
/**
 * @file     Engine.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor;

use libary\monitor\common\Config;

/**
 * 服务转发
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class Engine
{
    private $allclass = array();

    private $objset =array();

    public function runCheck($print_reason = false,$print_data = false)
    {

        $this->allclass = Config::${'items_info'};
        //批量实例对象
        foreach ($this->allclass as $val) {
           $this->objset[$val] = new $val;
        }
        usort($this->objset, array($this,'cmp'));
        echo "\n\nenvironment check beginning\n\n";
        foreach ($this->objset as $obj) {
           if (method_exists($obj, 'check')) {
               $res = $obj->check();
               if ($res === false) {
                   if ($print_reason && method_exists($obj, 'printReason')) {
                       $obj->printReason();
                   }
                   if ($print_data && method_exists($obj, 'printData')) {
                       $obj->printData();
                   }
               }
               if($res === false && !$obj->fall) break;
           } else {
               continue;
           }

        }
        echo "\n\nenvironment check completed\n\n";

    }

    public function cmp($a, $b)
    {
        if ($a->priority == $b->priority) {
            return 0;
        }

        return ($a->priority < $b->priority) ? -1 : 1;
    }

}
