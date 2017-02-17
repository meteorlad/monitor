<?php
/**
 * @file     Config.php
 * Copyright 2017 cn.wangbj@icloud.com
 * @date     2017-02-15
 */
namespace libary\monitor\common;

ini_set("display_errors", "On");
error_reporting(E_ALL && ~E_NOTICE);
/**
 * 配置文件
 * @Author: Gufeng Wang
 * @Mail cn.wangbj@icloud.com
 */
class Config
{
    public static $items_info = [
        '\libary\monitor\item\LinuxDisk',
        '\libary\monitor\item\Mysql',
        '\libary\monitor\item\Nginx',
        '\libary\monitor\item\PHP',
        '\libary\monitor\item\RabbitMq',
    ];

    public static $mysql_info = [
        //线下环境
        'offline'=>[
            'host'     => '192.168.5.110',
            'user'     => 'toowell',
            'pass'     => 'toowell2013db',
            'database' =>'insurance',
            'port'     => '3306'
        ],
        //线上环境
        'online'=> [
            'host'     => '127.0.0.1',
            'user'     => 'root',
            'pass'     => '123456',
            'database' => 'test',
            'port'     => '3306'
        ],
    ];

}
