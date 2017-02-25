<?php
/**
 * @file     Start.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
use libary\monitor\Engine;

/**
 * 入口文件
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';
$dev = $argv[1];
if (!$dev=='online' || !$dev=='offline') {
    echo "environment parameter error.\n\n";
    exit;
} else {
    defined('ENV') or define('ENV', $dev);
}
$engine = new Engine();
$engine->runCheck();
