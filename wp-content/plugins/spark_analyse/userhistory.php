<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 17:08
 */
//include_once('../../../wp-config.php');
header("Content-type:text/html;charset=utf-8");
function history()
{
    global $wpdb;
//    $con=mysqli_connect('localhost', 'root', 'qingfeng','test') ;
////if (!$con){ die('Could not connect: ' . mysql_error());}
//
//    mysqli_query($con,"set names 'gbk'");//输出中文
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $history = $wpdb->get_results("SELECT action_post_id FROM `wp_user_history` WHERE `user_id` = '$sql'");
    $m = 0;
    foreach ($history as $a) {
        $historylist[$m] = $a->action_post_id;
        $m++;
    }
    global $sql;
    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($historylist);
    $m=0;

    while($c>0){

        $sql[$a] =$wpdb->get_var( "SELECT class1 FROM `new_wiki` WHERE `wiki_id` = '$historylist[$m]'");
        $his_tag[$a]=$sql[$a];

//        $his_tag[$a] = mb_convert_encoding($his_tag[$a], 'utf-8', 'gbk');
        $m++;
        $a++;
        $c--;
    }
    $m=0;
    $c=count($historylist);
    while($c>0) {
        if ($historylist[$m]==0 or $his_tag[$m]==null){
            unset ($his_tag[$m]);
        }
        $m++;
        $c--;
    }
    $a=array_count_values($his_tag);
    arsort($a);
    $key=array(null,null,null,null,null);
    $value=array(null,null,null,null,null);
    $key=array_keys($a);
    $key=array_slice($key,0,5);
    $value=array_values($a);
    $value=array_slice($value,0,5);
//    echo "用户最喜欢的内容是 ".$key[0]." 共看了相关知识 ".$value[0]."次".
//          "其次为 ".$key[1]." 共看了相关知识 ".$value[1]."次";
//    echo  '</br>';
   return array_merge($key,$value);
}

function mysearch()
{
    global $wpdb;
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $articulnum=$wpdb->get_var("SELECT COUNT(*) FROM " . SS_TABLE . " WHERE `user` = '$sql'");
    $c = $articulnum;
    $textid=$wpdb->get_results("SELECT id FROM " . SS_TABLE . " WHERE `user` = '$sql'");
    $m=0;
    foreach($textid as $a){
        $textlist2[$m]=$a->id;
        $m++;
    }
    $m=0;
    $a=0;
    global $textlist3;
    global $articul;
    $articul=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    while($c>0)  //$c是该用户一共有多少搜索次数
    {
        $count=$wpdb->get_var("SELECT repeat_count FROM " . SS_TABLE . " WHERE `id` ='$textlist2[$m]'");
        //echo $count;
        while($count>=0) {
            $articul[$a] = $wpdb->get_var("SELECT keywords FROM " . SS_TABLE . " WHERE `id` ='$textlist2[$m]'");
            $count--;
            $a++;
        }
        $m++;
        $c--;
    }
    return $articul;
}

function myaskclass(){

    global $wpdb;
    global $sql;
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $ask = $wpdb->get_results("SELECT `ID` FROM `wp_posts` WHERE `post_author` = '$sql'and post_status='publish' and post_type='dwqa-question'");
    $m = 0;
    foreach ($ask as $a) {
        $asklist[$m] = $a->ID;
        $m++;
    }

    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($asklist);
    global $articul;
    $m=0;

    while($c>0)  //$c是该用户一共有多少提问次数
    {
        $articul.= $wpdb->get_var("SELECT post_content FROM `wp_posts` WHERE `ID` ='$asklist[$m]'");

        $m++;
        $c--;
    }
    $jiqixuexinum=substr_count($articul,'聚类')+substr_count($articul,'算法')+substr_count($articul,'贝叶斯')+substr_count($articul,'神经网络')+substr_count($articul,'决策树');
    $jisuanjishijuenum=substr_count($articul,'图像')+substr_count($articul,'识别')+substr_count($articul,'监督')+substr_count($articul,'特征');
    $tuijiannum=substr_count($articul,'用户')+substr_count($articul,'属性')+substr_count($articul,'冷启动')+substr_count($articul,'推荐')+substr_count($articul,'画像');
    $danpianjinum=substr_count($articul,'引脚')+substr_count($articul,'mCookie')+substr_count($articul,'Arduino')+substr_count($articul,'pin')+substr_count($articul,'串口')+substr_count($articul,'单片机')+substr_count($articul,'led');
    $dianlufenxinum=substr_count($articul,'电路')+substr_count($articul,'电流')+substr_count($articul,'电阻')+substr_count($articul,'戴维南')+substr_count($articul,'电极')+substr_count($articul,'等效');
    $shuzidianlunum=substr_count($articul,'MOS')+substr_count($articul,'半导体')+substr_count($articul,'三极管')+substr_count($articul,'电平')+substr_count($articul,'译码器')+substr_count($articul,'场效应管');
    $tongyuannum=substr_count($articul,'卷积')+substr_count($articul,'互信息')+substr_count($articul,'傅里叶')+substr_count($articul,'傅立叶')
        +substr_count($articul,'信道')+substr_count($articul,'信源')+substr_count($articul,'香农')+substr_count($articul,'噪声')
        +substr_count($articul,'滤波')+substr_count($articul,'IIR')+substr_count($articul,'量化')+substr_count($articul,'FIR')+substr_count($articul,'载波');
    $tongxinnum=substr_count($articul,'以太网')+substr_count($articul,'衰落')+substr_count($articul,'复用')+substr_count($articul,'GSM')+substr_count($articul,'4G')+substr_count($articul,'5G')+substr_count($articul,'蜂窝')+substr_count($articul,'基站')
        +substr_count($articul,'多径')+substr_count($articul,'扩频');
    $diancinum=substr_count($articul,'电荷')+substr_count($articul,'磁场')+substr_count($articul,'线圈')+substr_count($articul,'电势')+substr_count($articul,'麦克斯韦')+substr_count($articul,'通量')+substr_count($articul,'库伦');
    $bianchengnum=substr_count($articul,'指针')+substr_count($articul,'变量')+substr_count($articul,'类型')+substr_count($articul,'数组')+substr_count($articul,'PHP')+substr_count($articul,'php')+substr_count($articul,'Pyhton')+substr_count($articul,'python')
        +substr_count($articul,'html')+substr_count($articul,'Html')+substr_count($articul,'js')+substr_count($articul,'JS')+substr_count($articul,'javascript')+substr_count($articul,'css')+substr_count($articul,'chart');
    $jisuanjijichunum=substr_count($articul,'操作系统')+substr_count($articul,'Linux')+substr_count($articul,'DOS')+substr_count($articul,'微软')+substr_count($articul,'CPU')+substr_count($articul,'磁场');
    $webnum=substr_count($articul,'路由器')+substr_count($articul,'网络拓扑')+substr_count($articul,'OSPFv2')+substr_count($articul,'SFC')+substr_count($articul,'组播');

    $score=array("机器学习"=>$jiqixuexinum,"计算机视觉"=>$jisuanjishijuenum,"推荐系统"=>$tuijiannum,"电路分析"=>$dianlufenxinum,"单片机"=>$danpianjinum,"数字电路"=>$shuzidianlunum,"通信原理"=>$tongyuannum,"移动通信"=>$tongxinnum,"电磁波"=>$diancinum,"编程语言"=>$bianchengnum,"计算机基础"=>$jisuanjijichunum,"网络"=>$webnum);
    arsort($score);
    $key=array_keys($score);
    $key=array_slice($key,0,5);
    $value=array_values($score);
    $value=array_slice($value,0,5);
    return array_merge($key,$value);

}

function mysearchclass(){

    global $wpdb;
    global $sql;
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $search = $wpdb->get_results("SELECT id FROM `wp_search_statistics` WHERE `user` = '$sql'");
    $m = 0;
    foreach ($search as $a) {
        $searchlist[$m] = $a->id;
        $m++;
    }

    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($searchlist);
    global $articul;
    $m=0;

    while($c>0)  //$c是该用户一共有多少搜索次数
    {
        $articul.= $wpdb->get_var("SELECT keywords FROM `wp_search_statistics` WHERE `id` ='$searchlist[$m]'");

        $m++;
        $c--;
    }
    $jiqixuexinum=substr_count($articul,'聚类')+substr_count($articul,'算法')+substr_count($articul,'贝叶斯')+substr_count($articul,'神经网络')+substr_count($articul,'决策树');
    $jisuanjishijuenum=substr_count($articul,'图像')+substr_count($articul,'识别')+substr_count($articul,'监督')+substr_count($articul,'特征');
    $tuijiannum=substr_count($articul,'用户')+substr_count($articul,'属性')+substr_count($articul,'冷启动')+substr_count($articul,'推荐')+substr_count($articul,'画像');
    $danpianjinum=substr_count($articul,'引脚')+substr_count($articul,'mCookie')+substr_count($articul,'Arduino')+substr_count($articul,'pin')+substr_count($articul,'串口')+substr_count($articul,'单片机')+substr_count($articul,'led');
    $dianlufenxinum=substr_count($articul,'电路')+substr_count($articul,'电流')+substr_count($articul,'电阻')+substr_count($articul,'戴维南')+substr_count($articul,'电极')+substr_count($articul,'等效');
    $shuzidianlunum=substr_count($articul,'MOS')+substr_count($articul,'半导体')+substr_count($articul,'三极管')+substr_count($articul,'电平')+substr_count($articul,'译码器')+substr_count($articul,'场效应管');
    $tongyuannum=substr_count($articul,'卷积')+substr_count($articul,'互信息')+substr_count($articul,'傅里叶')+substr_count($articul,'傅立叶')
        +substr_count($articul,'信道')+substr_count($articul,'信源')+substr_count($articul,'香农')+substr_count($articul,'噪声')
        +substr_count($articul,'滤波')+substr_count($articul,'IIR')+substr_count($articul,'量化')+substr_count($articul,'FIR')+substr_count($articul,'载波');
    $tongxinnum=substr_count($articul,'以太网')+substr_count($articul,'衰落')+substr_count($articul,'复用')+substr_count($articul,'GSM')+substr_count($articul,'4G')+substr_count($articul,'5G')+substr_count($articul,'蜂窝')+substr_count($articul,'基站')
        +substr_count($articul,'多径')+substr_count($articul,'扩频');
    $diancinum=substr_count($articul,'电荷')+substr_count($articul,'磁场')+substr_count($articul,'线圈')+substr_count($articul,'电势')+substr_count($articul,'麦克斯韦')+substr_count($articul,'通量')+substr_count($articul,'库伦');
    $bianchengnum=substr_count($articul,'指针')+substr_count($articul,'变量')+substr_count($articul,'类型')+substr_count($articul,'数组')+substr_count($articul,'PHP')+substr_count($articul,'php')+substr_count($articul,'Pyhton')+substr_count($articul,'python')
        +substr_count($articul,'html')+substr_count($articul,'Html')+substr_count($articul,'js')+substr_count($articul,'JS')+substr_count($articul,'javascript')+substr_count($articul,'css')+substr_count($articul,'chart');
    $jisuanjijichunum=substr_count($articul,'操作系统')+substr_count($articul,'Linux')+substr_count($articul,'DOS')+substr_count($articul,'微软')+substr_count($articul,'CPU')+substr_count($articul,'磁场');
    $webnum=substr_count($articul,'路由器')+substr_count($articul,'网络拓扑')+substr_count($articul,'OSPFv2')+substr_count($articul,'SFC')+substr_count($articul,'组播');

    $score=array("机器学习"=>$jiqixuexinum,"计算机视觉"=>$jisuanjishijuenum,"推荐系统"=>$tuijiannum,"电路分析"=>$dianlufenxinum,"单片机"=>$danpianjinum,"数字电路"=>$shuzidianlunum,"通信原理"=>$tongyuannum,"移动通信"=>$tongxinnum,"电磁波"=>$diancinum,"编程语言"=>$bianchengnum,"计算机基础"=>$jisuanjijichunum,"网络"=>$webnum);
    arsort($score);
    $key=array_keys($score);
    $key=array_slice($key,0,5);
    $value=array_values($score);
    $value=array_slice($value,0,5);
    return array_merge($key,$value);

}

function myfavoriteclass(){

    global $wpdb;
    global $sql;
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $favorite = $wpdb->get_results("SELECT favorite_post_id FROM `wp_favorite` WHERE `user_id` = '$sql'");
    $m = 0;
    foreach ($favorite as $a) {
        $favoritelist[$m] = $a->favorite_post_id;
        $m++;
    }

    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($favoritelist);
    global $articul;
    $m=0;

    while($c>0)  //$c是该用户一共有多少收藏次数
    {
        $articul.= $wpdb->get_var("SELECT post_content FROM `$wpdb->posts` WHERE `ID` ='$favoritelist[$m]'");

        $m++;
        $c--;
    }
    $jiqixuexinum=substr_count($articul,'聚类')+substr_count($articul,'算法')+substr_count($articul,'贝叶斯')+substr_count($articul,'神经网络')+substr_count($articul,'决策树');
    $jisuanjishijuenum=substr_count($articul,'图像')+substr_count($articul,'识别')+substr_count($articul,'监督')+substr_count($articul,'特征');
    $tuijiannum=substr_count($articul,'用户')+substr_count($articul,'属性')+substr_count($articul,'冷启动')+substr_count($articul,'推荐')+substr_count($articul,'画像');
    $danpianjinum=substr_count($articul,'引脚')+substr_count($articul,'mCookie')+substr_count($articul,'Arduino')+substr_count($articul,'pin')+substr_count($articul,'串口')+substr_count($articul,'单片机')+substr_count($articul,'led');
    $dianlufenxinum=substr_count($articul,'电路')+substr_count($articul,'电流')+substr_count($articul,'电阻')+substr_count($articul,'戴维南')+substr_count($articul,'电极')+substr_count($articul,'等效');
    $shuzidianlunum=substr_count($articul,'MOS')+substr_count($articul,'半导体')+substr_count($articul,'三极管')+substr_count($articul,'电平')+substr_count($articul,'译码器')+substr_count($articul,'场效应管');
    $tongyuannum=substr_count($articul,'卷积')+substr_count($articul,'互信息')+substr_count($articul,'傅里叶')+substr_count($articul,'傅立叶')
        +substr_count($articul,'信道')+substr_count($articul,'信源')+substr_count($articul,'香农')+substr_count($articul,'噪声')
        +substr_count($articul,'滤波')+substr_count($articul,'IIR')+substr_count($articul,'量化')+substr_count($articul,'FIR')+substr_count($articul,'载波');
    $tongxinnum=substr_count($articul,'以太网')+substr_count($articul,'衰落')+substr_count($articul,'复用')+substr_count($articul,'GSM')+substr_count($articul,'4G')+substr_count($articul,'5G')+substr_count($articul,'蜂窝')+substr_count($articul,'基站')
        +substr_count($articul,'多径')+substr_count($articul,'扩频');
    $diancinum=substr_count($articul,'电荷')+substr_count($articul,'磁场')+substr_count($articul,'线圈')+substr_count($articul,'电势')+substr_count($articul,'麦克斯韦')+substr_count($articul,'通量')+substr_count($articul,'库伦');
    $bianchengnum=substr_count($articul,'指针')+substr_count($articul,'变量')+substr_count($articul,'类型')+substr_count($articul,'数组')+substr_count($articul,'PHP')+substr_count($articul,'php')+substr_count($articul,'Pyhton')+substr_count($articul,'python')
        +substr_count($articul,'html')+substr_count($articul,'Html')+substr_count($articul,'js')+substr_count($articul,'JS')+substr_count($articul,'javascript')+substr_count($articul,'css')+substr_count($articul,'chart');
    $jisuanjijichunum=substr_count($articul,'操作系统')+substr_count($articul,'Linux')+substr_count($articul,'DOS')+substr_count($articul,'微软')+substr_count($articul,'CPU')+substr_count($articul,'磁场');
    $webnum=substr_count($articul,'路由器')+substr_count($articul,'网络拓扑')+substr_count($articul,'OSPFv2')+substr_count($articul,'SFC')+substr_count($articul,'组播');

    $score=array("机器学习"=>$jiqixuexinum,"计算机视觉"=>$jisuanjishijuenum,"推荐系统"=>$tuijiannum,"电路分析"=>$dianlufenxinum,"单片机"=>$danpianjinum,"数字电路"=>$shuzidianlunum,"通信原理"=>$tongyuannum,"移动通信"=>$tongxinnum,"电磁波"=>$diancinum,"编程语言"=>$bianchengnum,"计算机基础"=>$jisuanjijichunum,"网络"=>$webnum);
    arsort($score);
    $key=array_keys($score);
    $key=array_slice($key,0,5);
    $value=array_values($score);
    $value=array_slice($value,0,5);
    return array_merge($key,$value);

}

function projectclass(){
    global $wpdb;
    global $sql;
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $project=$wpdb->get_results("SELECT ID FROM `$wpdb->posts` WHERE `post_author` ='$sql' and `post_type` ='post'");
    $m = 0;
    foreach ($project as $a) {
        $projectlist[$m] = $a->ID;
        $m++;
    }
    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($projectlist);
    global $articul;
    $m=0;

    while($c>0)  //$c是该用户一共有多少项目
    {
        $articul.= $wpdb->get_var("SELECT post_content FROM `$wpdb->posts` WHERE `ID` ='$projectlist[$m]'");

        $m++;
        $c--;
    }
    $jiqixuexinum=substr_count($articul,'聚类')+substr_count($articul,'算法')+substr_count($articul,'贝叶斯')+substr_count($articul,'神经网络')+substr_count($articul,'决策树');
    $jisuanjishijuenum=substr_count($articul,'图像')+substr_count($articul,'识别')+substr_count($articul,'监督')+substr_count($articul,'特征');
    $tuijiannum=substr_count($articul,'用户')+substr_count($articul,'属性')+substr_count($articul,'冷启动')+substr_count($articul,'推荐')+substr_count($articul,'画像');
    $danpianjinum=substr_count($articul,'引脚')+substr_count($articul,'mCookie')+substr_count($articul,'Arduino')+substr_count($articul,'pin')+substr_count($articul,'串口')+substr_count($articul,'单片机')+substr_count($articul,'led');
    $dianlufenxinum=substr_count($articul,'电路')+substr_count($articul,'电流')+substr_count($articul,'电阻')+substr_count($articul,'戴维南')+substr_count($articul,'电极')+substr_count($articul,'等效');
    $shuzidianlunum=substr_count($articul,'MOS')+substr_count($articul,'半导体')+substr_count($articul,'三极管')+substr_count($articul,'电平')+substr_count($articul,'译码器')+substr_count($articul,'场效应管');
    $tongyuannum=substr_count($articul,'卷积')+substr_count($articul,'互信息')+substr_count($articul,'傅里叶')+substr_count($articul,'傅立叶')
        +substr_count($articul,'信道')+substr_count($articul,'信源')+substr_count($articul,'香农')+substr_count($articul,'噪声')
        +substr_count($articul,'滤波')+substr_count($articul,'IIR')+substr_count($articul,'量化')+substr_count($articul,'FIR')+substr_count($articul,'载波');
    $tongxinnum=substr_count($articul,'以太网')+substr_count($articul,'衰落')+substr_count($articul,'复用')+substr_count($articul,'GSM')+substr_count($articul,'4G')+substr_count($articul,'5G')+substr_count($articul,'蜂窝')+substr_count($articul,'基站')
        +substr_count($articul,'多径')+substr_count($articul,'扩频');
    $diancinum=substr_count($articul,'电荷')+substr_count($articul,'磁场')+substr_count($articul,'线圈')+substr_count($articul,'电势')+substr_count($articul,'麦克斯韦')+substr_count($articul,'通量')+substr_count($articul,'库伦');
    $bianchengnum=substr_count($articul,'指针')+substr_count($articul,'变量')+substr_count($articul,'类型')+substr_count($articul,'数组')+substr_count($articul,'PHP')+substr_count($articul,'php')+substr_count($articul,'Pyhton')+substr_count($articul,'python')
        +substr_count($articul,'html')+substr_count($articul,'Html')+substr_count($articul,'js')+substr_count($articul,'JS')+substr_count($articul,'javascript')+substr_count($articul,'css')+substr_count($articul,'chart');
    $jisuanjijichunum=substr_count($articul,'操作系统')+substr_count($articul,'Linux')+substr_count($articul,'DOS')+substr_count($articul,'微软')+substr_count($articul,'CPU')+substr_count($articul,'磁场');
    $webnum=substr_count($articul,'路由器')+substr_count($articul,'网络拓扑')+substr_count($articul,'OSPFv2')+substr_count($articul,'SFC')+substr_count($articul,'组播');

    $score=array("机器学习"=>$jiqixuexinum,"计算机视觉"=>$jisuanjishijuenum,"推荐系统"=>$tuijiannum,"电路分析"=>$dianlufenxinum,"单片机"=>$danpianjinum,"数字电路"=>$shuzidianlunum,"通信原理"=>$tongyuannum,"移动通信"=>$tongxinnum,"电磁波"=>$diancinum,"编程语言"=>$bianchengnum,"计算机基础"=>$jisuanjijichunum,"网络"=>$webnum);
    arsort($score);
    $key=array_keys($score);
    $key=array_slice($key,0,5);
    $value=array_values($score);
    $value=array_slice($value,0,5);
    return array_merge($key,$value);

}

function history_value()
{
    global $wpdb;
//    $con=mysqli_connect('localhost', 'root', 'qingfeng','test') ;
////if (!$con){ die('Could not connect: ' . mysql_error());}
//
//    mysqli_query($con,"set names 'gbk'");//输出中文
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $history = $wpdb->get_results("SELECT action_post_id ,action_time FROM `wp_user_history` WHERE `user_id` = '$sql' and `user_action` = 'browse'");
    $m = 0;
    foreach ($history as $a) {
        $historylist[$m] = $a->action_post_id;
        $historytime[$m]=$a->action_time;
        $m++;
    }

    global $sql;
    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($historylist);
    $m=0;

    while($c>0){

        $sql[$a] =$wpdb->get_var( "SELECT class1 FROM `new_wiki` WHERE `wiki_id` = '$historylist[$m]'");//只统计了wiki的类型
        $his_tag[$a]=$sql[$a];
//        $his_tag[$a] = mb_convert_encoding($his_tag[$a], 'utf-8', 'gbk');
        $m++;
        $a++;
        $c--;
    }
    $c=count($historylist);
    $m=0;
    while($c>0) {
        if ($historylist[$m]==0 or $his_tag[$m]==null){
            unset ($his_tag[$m]);//删除数组中的这个值（索引值不变）
            unset ($historytime[$m]);
        }
        $m++;
        $c--;
    }
    $his_tag=array_merge($his_tag);//（返回一个新的标签组）
    $historytime=array_merge($historytime);//（返回一个新的时间组）
   $c=count($his_tag)-1;
//        $result_array=array_combine($his_tag,$historytime);
//    print_r($his_tag);
    echo '</br>';
    $c=count($historytime);
    $m=0;
    $time0=strtotime(20170601);
    while($c>0){
        $historytime[$m]=date("Ymd",strtotime($historytime[$m]));
        $historytime[$m]=strtotime($historytime[$m]);
        $historytime[$m]=($historytime[$m]-$time0)/86400;//与6.1隔了多少天
        $m++;
        $c--;
    }
//    print_r($historytime); // 输出用户的浏览wiki的分类与时间，二者相对应



//    echo "用户最近的兴趣为".$his_tag[$c];
    $c=count($his_tag);
    $m=0;
    while ($c>0){
        switch($his_tag[$m]){
            case "推荐系统":
                $his_num[$m]=1.1;
                break;
            case "信息检索":
                $his_num[$m]=1.2;
                break;
            case "计算机视觉":
                $his_num[$m]=1.3;
                break;
            case "自然语言处理":
                $his_num[$m]=1.4;
                break;
            case "搜索引擎":
                $his_num[$m]=1.5;
                break;
            case "知识图谱":
                $his_num[$m]=1.6;
                break;
            case "机器学习":
                $his_num[$m]=1.7;
                break;
            case "工程框架":
                $his_num[$m]=1.8;
                break;
            case "单片机":
                $his_num[$m]=2.1;
                break;
            case "电路仿真":
                $his_num[$m]=2.2;
                break;
            case "微机原理":
                $his_num[$m]=2.3;
                break;
            case "电路分析":
                $his_num[$m]=2.4;
                break;
            case "模拟电路":
                $his_num[$m]=2.5;
                break;
            case "数字电路":
                $his_num[$m]=2.6;
                break;
            case "嵌入式系统":
                $his_num[$m]=2.7;
                break;
            case "通信电子电路":
                $his_num[$m]=2.8;
                break;
            case "物联网":
                $his_num[$m]=2.9;
                break;
            case "信息论":
                $his_num[$m]=3.1;
                break;
            case "随机信号分析":
                $his_num[$m]=3.2;
                break;
            case "信号与系统":
                $his_num[$m]=3.3;
                break;
            case "通信网理论基础":
                $his_num[$m]=3.4;
                break;
            case "数字信号处理":
                $his_num[$m]=3.5;
                break;
            case "通信原理":
                $his_num[$m]=3.6;
                break;
            case "电磁场与电磁波":
                $his_num[$m]=3.7;
                break;
            case "射频与微波技术":
                $his_num[$m]=3.8;
                break;
            case "宽带接入技术":
                $his_num[$m]=3.9;
                break;
            case "移动通信":
                $his_num[$m]=3.0;
                break;
            case "光纤通信":
                $his_num[$m]=3.0;
                break;
            case "数据结构与算法":
                $his_num[$m]=4.1;
                break;
            case "计算机网络":
                $his_num[$m]=4.2;
                break;
            case "网络安全":
                $his_num[$m]=4.3;
                break;
            case "数据库技术与应用":
                $his_num[$m]=4.4;
                break;
            case "计算机组成原理":
                $his_num[$m]=4.5;
                break;
            case "操作系统":
                $his_num[$m]=4.6;
                break;
            case "编程语言":
                $his_num[$m]=4.7;
                break;
            case "软件定义网络":
                $his_num[$m]=4.8;
                break;
            default:
                $his_num[$m]=0;
        }
        $m++;
        $c--;
    }//人工智能是1，电子是2，通信是3，计算机是4

//    print_r($his_num) ;//输出用户浏览记录的分类情况，以数字代表

    $c=count($his_num);
    $m=0;
    while($c>0){
        $his_num_f[$m]=floor($his_num[$m]);//向下舍入整数
        $m++;
        $c--;
    }
//    print_r($his_num_f);//输出用户浏览记录的分类情况，以数字代表，只显示个位
    $c=count($historytime);
    $a=$historytime[$c-1];//最近的那一次操作隔了多少天
    $timelong=array(0);
    $timelong1=array_pad($timelong,$a+1,0);//到最近那一次那一天为止，这个数组全设为0
    $timelong2=array_pad($timelong,$a+1,0);
    $timelong3=array_pad($timelong,$a+1,0);
    $timelong4=array_pad($timelong,$a+1,0);
    $m=0;
    $flag1=0;$flag2=0;$flag3=0;$flag4=0;
    while($c>0){
//         $timelong[$historytime[$m]]=$his_num_f[$m];
//        $m++;01234
//        $c--;
        if ($his_num_f[$m]==1){
            $flag1++;
            $timelong1=arr($historytime[$m],$a+1,$flag1,$timelong1);//historytime为这次操作的时间和6.1相隔的天数，$a+1为从6.1开始到最近那一次的时间长度
//            $timelong1[$historytime[$m]]=$flag1;
        }
        else if($his_num_f[$m]==2){
            $flag2++;
            $timelong2=arr($historytime[$m],$a+1,$flag2,$timelong2);
        }
        else if($his_num_f[$m]==3){
            $flag3++;
            $timelong3=arr($historytime[$m],$a+1,$flag3,$timelong3);
        }
        else if($his_num_f[$m]==4){
            $flag4++;
            $timelong4=arr($historytime[$m],$a+1,$flag4,$timelong4);
//            $timelong4[$historytime[$m]]=$flag4;
        }
        $m++;
        $c--;
    }
//    print_r($timelong1);echo '</br>';print_r($timelong2);echo '</br>';print_r($timelong3);echo '</br>';print_r($timelong4);
//    print_r($timelong4);
    //timelong1是人工智能  timelong2是电子  timelong3是通信  timelong4计算机
//    $c=count($his_num);
//    $avg=array_sum($his_num_f)/$c;
//    $var=getVariance($avg,$his_num_f);
//    echo $var;//方差
//    echo '</br>';
    return $timelong=array($timelong1,$timelong2,$timelong3,$timelong4);//返回的每个timelong都是数组
}
function arr($start,$long,$value,$array){//相当于不停更新最近那一次到之前某一次这个时间段的次数
    $m=0;
    $long=$long-$start;
    while ($long>0){
        $array[$start+$m]=$value;
        $m++;
        $long--;
    }
    return $array;
}

function abilityhistory_value()
{
    global $wpdb;
//    $con=mysqli_connect('localhost', 'root', 'qingfeng','test') ;
////if (!$con){ die('Could not connect: ' . mysql_error());}
//
//    mysqli_query($con,"set names 'gbk'");//输出中文
    $c=get_option('spark_search_user_copy_right');
    $sql =$wpdb->get_var( "SELECT ID FROM `$wpdb->users` WHERE `user_login` = '$c'");
    $history = $wpdb->get_results("SELECT action_post_id ,action_time FROM `wp_user_history` WHERE `user_id` = '$sql' and `user_action` = 'publish'");
    $m = 0;
    foreach ($history as $a) {
        $historylist[$m] = $a->action_post_id;
        $historytime[$m]=$a->action_time;
        $m++;
    }

    global $sql;
    $a=0;
    $his_tag=array(
        "数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足","数据不足"
    );
    $c=count($historylist);
    $m=0;

    while($c>0){

        $sql[$a] =$wpdb->get_var( "SELECT class1 FROM `new_wiki` WHERE `wiki_id` = '$historylist[$m]'");//只统计了wiki的类型
        $his_tag[$a]=$sql[$a];
//        $his_tag[$a] = mb_convert_encoding($his_tag[$a], 'utf-8', 'gbk');
        $m++;
        $a++;
        $c--;
    }
    $c=count($historylist);
    $m=0;
    while($c>0) {
        if ($historylist[$m]==0 or $his_tag[$m]==null){
            unset ($his_tag[$m]);//删除数组中的这个值（索引值不变）
            unset ($historytime[$m]);
        }
        $m++;
        $c--;
    }
    $his_tag=array_merge($his_tag);//（返回一个新的标签组）
    $historytime=array_merge($historytime);//（返回一个新的时间组）
    $c=count($his_tag)-1;
//        $result_array=array_combine($his_tag,$historytime);
//    print_r($his_tag);
    echo '</br>';
    $c=count($historytime);
    $m=0;
    $time0=strtotime(20170601);
    while($c>0){
        $historytime[$m]=date("Ymd",strtotime($historytime[$m]));
        $historytime[$m]=strtotime($historytime[$m]);
        $historytime[$m]=($historytime[$m]-$time0)/86400;//与6.1隔了多少天
        $m++;
        $c--;
    }
//    print_r($historytime); // 输出用户的浏览wiki的分类与时间，二者相对应



//    echo "用户最近的兴趣为".$his_tag[$c];
    $c=count($his_tag);
    $m=0;
    while ($c>0){
        switch($his_tag[$m]){
            case "推荐系统":
                $his_num[$m]=1.1;
                break;
            case "信息检索":
                $his_num[$m]=1.2;
                break;
            case "计算机视觉":
                $his_num[$m]=1.3;
                break;
            case "自然语言处理":
                $his_num[$m]=1.4;
                break;
            case "搜索引擎":
                $his_num[$m]=1.5;
                break;
            case "知识图谱":
                $his_num[$m]=1.6;
                break;
            case "机器学习":
                $his_num[$m]=1.7;
                break;
            case "工程框架":
                $his_num[$m]=1.8;
                break;
            case "单片机":
                $his_num[$m]=2.1;
                break;
            case "电路仿真":
                $his_num[$m]=2.2;
                break;
            case "微机原理":
                $his_num[$m]=2.3;
                break;
            case "电路分析":
                $his_num[$m]=2.4;
                break;
            case "模拟电路":
                $his_num[$m]=2.5;
                break;
            case "数字电路":
                $his_num[$m]=2.6;
                break;
            case "嵌入式系统":
                $his_num[$m]=2.7;
                break;
            case "通信电子电路":
                $his_num[$m]=2.8;
                break;
            case "物联网":
                $his_num[$m]=2.9;
                break;
            case "信息论":
                $his_num[$m]=3.1;
                break;
            case "随机信号分析":
                $his_num[$m]=3.2;
                break;
            case "信号与系统":
                $his_num[$m]=3.3;
                break;
            case "通信网理论基础":
                $his_num[$m]=3.4;
                break;
            case "数字信号处理":
                $his_num[$m]=3.5;
                break;
            case "通信原理":
                $his_num[$m]=3.6;
                break;
            case "电磁场与电磁波":
                $his_num[$m]=3.7;
                break;
            case "射频与微波技术":
                $his_num[$m]=3.8;
                break;
            case "宽带接入技术":
                $his_num[$m]=3.9;
                break;
            case "移动通信":
                $his_num[$m]=3.0;
                break;
            case "光纤通信":
                $his_num[$m]=3.0;
                break;
            case "数据结构与算法":
                $his_num[$m]=4.1;
                break;
            case "计算机网络":
                $his_num[$m]=4.2;
                break;
            case "网络安全":
                $his_num[$m]=4.3;
                break;
            case "数据库技术与应用":
                $his_num[$m]=4.4;
                break;
            case "计算机组成原理":
                $his_num[$m]=4.5;
                break;
            case "操作系统":
                $his_num[$m]=4.6;
                break;
            case "编程语言":
                $his_num[$m]=4.7;
                break;
            case "软件定义网络":
                $his_num[$m]=4.8;
                break;
            default:
                $his_num[$m]=0;
        }
        $m++;
        $c--;
    }//人工智能是1，电子是2，通信是3，计算机是4

//    print_r($his_num) ;//输出用户浏览记录的分类情况，以数字代表

    $c=count($his_num);
    $m=0;
    while($c>0){
        $his_num_f[$m]=floor($his_num[$m]);//向下舍入整数
        $m++;
        $c--;
    }
//    print_r($his_num_f);//输出用户浏览记录的分类情况，以数字代表，只显示个位
    $c=count($historytime);
    $a=$historytime[$c-1];//最近的那一次操作隔了多少天
    $timelong=array(0);
    $timelong1=array_pad($timelong,$a+1,0);//到最近那一次那一天为止，这个数组全设为0
    $timelong2=array_pad($timelong,$a+1,0);
    $timelong3=array_pad($timelong,$a+1,0);
    $timelong4=array_pad($timelong,$a+1,0);
    $m=0;
    $flag1=0;$flag2=0;$flag3=0;$flag4=0;
    while($c>0){
//         $timelong[$historytime[$m]]=$his_num_f[$m];
//        $m++;01234
//        $c--;
        if ($his_num_f[$m]==1){
            $flag1++;
            $timelong1=arr($historytime[$m],$a+1,$flag1,$timelong1);//historytime为这次操作的时间和6.1相隔的天数，$a+1为从6.1开始到最近那一次的时间长度
//            $timelong1[$historytime[$m]]=$flag1;
        }
        else if($his_num_f[$m]==2){
            $flag2++;
            $timelong2=arr($historytime[$m],$a+1,$flag2,$timelong2);
        }
        else if($his_num_f[$m]==3){
            $flag3++;
            $timelong3=arr($historytime[$m],$a+1,$flag3,$timelong3);
        }
        else if($his_num_f[$m]==4){
            $flag4++;
            $timelong4=arr($historytime[$m],$a+1,$flag4,$timelong4);
//            $timelong4[$historytime[$m]]=$flag4;
        }
        $m++;
        $c--;
    }
//    print_r($timelong1);echo '</br>';print_r($timelong2);echo '</br>';print_r($timelong3);echo '</br>';print_r($timelong4);
//    print_r($timelong4);
    //timelong1是人工智能  timelong2是电子  timelong3是通信  timelong4计算机
//    $c=count($his_num);
//    $avg=array_sum($his_num_f)/$c;
//    $var=getVariance($avg,$his_num_f);
//    echo $var;//方差
//    echo '</br>';
    return $timelong=array($timelong1,$timelong2,$timelong3,$timelong4);//返回的每个timelong都是数组
}


