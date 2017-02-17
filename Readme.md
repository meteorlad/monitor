# monitor

###**一、工具简单介绍**
monitor环境检测工具，检测disk,nginx,php,mysql,rabbitmq的问题。通过运行monitor脚本，就可以将lnmp环境中的各种问题报告出来，如磁盘满了、php进程、nginx进程、mysql连接、rabbitm进程等。monitor能够直接指明问题所在，主要用于对一台已出现服务异常的机器进行具体问题的排查。

###**二、检测的问题项**
- nginx存活
  检查nginx进程是否正常运行。
- php存活
  检查php进程是否正常运行。
- mysql连接
  通过mysqli_connect命令检查mysql是否可以连接。
- rabbitmq存活
  检查rabbitmq进程是否正常运行。

###**三、使用方法说明**
monitor用php开发，下载所有php文件，命令行下执行start.php脚本文件即可，执行完毕会将检查到的问题一项项打印出来。最好以root用户执行，有些检测项需要root权限，用其它帐号会导致这些检测项无效。
>[root@wanggufeng src]# php Start.php offline<br>
>environment check beginning
>
>environment check completed<br>
环境（./monitor/src/common/Config.php不同的环境配置文件在此配置）：<br>
线下环境：offline<br>
线上环境：online<br>
 
###**四、添加自定检测**
目前已有的检测项只是最常需要检测的问题，还有许多其它问题需要检测，这只需要添加一个php文件放到item目录下即可，以检查cpu负载的代码为例，在checkitems/CpuLoad.php 文件中实现，基本代码结构如下:

    class CpuLoad extends Check {
        public function check(){
            $arrRes = Utils::get_cmd_res(' mpstat -P ALL | wc -l');
            $cpu_num = $arrRes[0] - 4;
            $arrRes = Utils::get_cmd_res_split('uptime');
            $load_one_minute = trim($arrRes[0][7],' ,');
            if($load_one_minute > 2*$cpu_num) {
                $msg =  "cpu number: {$cpu_num}, load in 1 minute: {$load_one_minute}";
                Utils::print_error($msg);
            }
        }
    }
    
新的检测项需要继承Check类，并在check函数中实现自己的检查逻辑即可。另外可以定义问题检测的优先级,代表了检测的顺序，在类中声明$priority变量即可，值越小，优先级越高，默认是最低检测优先级。

###**五、关于捐助作者**
* 为什么要捐助？<br/>
* 一篇好文章可以帮助你节省大量的时间，而你的时间是相当宝贵的。
向文章的作者提供小额捐助，可以鼓励作者写出更好的文章。这是一种良性循环，现在就行动吧！<br>
<div style="width:100px;border:1px solid red">
![zb_pay](http://s1.wanggufeng.cn/zb_pay.jpg "zb_pay") &nbsp;&nbsp;
![wx_pay](http://s1.wanggufeng.cn/wx_pay.jpg "wx_pay")
</div>
<span style="font-size: 14px; color: rgb(136, 136, 136);">（支持微信与支付宝）</span>