<?php
/**
 * @file     Check.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\item;

use libary\monitor\common\Utils;

/**
 * 所有服务基类
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
interface Base
{
    public function check();
    public function printReason();
    public function printData();
}

abstract class CheckBase implements Base
{
    public $priority = 0;
    public $fall = true;

    public function printReason()
    {
    }

    public function printData()
    {
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function setfall($fall)
    {
        $this->fall = $fall;
    }
}
