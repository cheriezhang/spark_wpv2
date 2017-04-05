<!--提问按钮ok-->

<?php
//本页面是问答页面的侧边栏。
global $wpdb;
$page_ask_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'ask'");
$ask_page_ID="?page_id=".$page_ask_id;

//为全部标签做准备。
global $wpdb;
$tag_id = array();
$tag_name = array();//存储每个链接的名字;
$link = array(); // 存储每个标签的链接;
$tag_count = array();
//==============获取所有tag的id信息===============
$tags = get_terms( 'dwqa-question_tag', array_merge( array( 'orderby' => 'count', 'order' => 'DESC' )));
//=============================
foreach($tags as $key => $temp){
    $tag_id[]=$temp->term_id;
    $tag_count[]=$temp->count;
    array_push($link,get_term_link(intval($tag_id[$key]), 'dwqa-question_tag'));
}
for($i=0;$i<count($tag_id);$i++){
    $sql ="SELECT name FROM $wpdb->terms WHERE term_id=".$tag_id[$i];
    $tag_name_result=$wpdb->get_results($sql,'ARRAY_A');
    array_push($tag_name,$tag_name_result[0]['name']);
}
?>

<script>
    flag=false;
    function show_all_tags() {
        var $all_tags=document.getElementById('all_tags');
        var $related_tags = document.getElementById('hot_tags');
        if(flag){
            $all_tags.style.display ="block";
            $related_tags.style.display="none";
        }else{
            $all_tags.style.display="none";
            $related_tags.style.display="block";
        }
        flag=!flag;
    }
</script>
<style>
    .label-default[href]:focus,
    .label-default[href]:hover{background-color: transparent;outline: none;color: #fe642d}
    #buttonForAllTags{  outline: none;border:0px;color:gray;float: right;display: inline-block;margin-top: 20px;padding: 0 12px}
</style>
<!--=======================================================-->

<<<<<<< HEAD
<div class="col-md-3 col-sm-3 col-xs-3 right" id="col3">
    <div class="sidebar_button">
=======
<div class="col-md-4 col-sm-4 col-xs-4 right">
    <div class="sidebar_button" style="margin-top: 20px">
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
        <a href="<?php echo site_url().$ask_page_ID;?>" style="color: white">我要提问</a>
    </div>
    <!--热门标签-->
    <div class="sidebar_list">
        <div class="sidebar_list_header">
<<<<<<< HEAD
            <p>热门标签</p>
            <a id="sidebar_list_link" onclick="show_all_tags()">全部标签</a>
=======
            <p style="font-size: large;display:inline-block;margin-top: 5%;font-weight: bold">热门标签</p>
            <button id="buttonForAllTags" class="btn btn-default" onclick="show_all_tags()" style="">全部标签</button>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
        </div>
        <!--                分割线-->
        <div class="sidebar_divline"></div>


        <div id="hot_tags" style="word-wrap: break-word; word-break: keep-all;">
            <h4>
                <?php
                for($i=0;$i<9;$i++){?>
                    <a class="label label-default" href="<?=$link[$i]?>"><?=$tag_name[$i]?><span class="badge">(<?=$tag_count[$i]?>)</span></a>
                <?php  } ?>
            </h4>
        </div>

        <div id="all_tags" style="display: none;word-wrap: break-word; word-break: keep-all;">
            <h4>
                <?php
                foreach ($tag_name as $key =>$i){?>
                    <a class="label label-default" href="<?=$link[$key]?>"><?=$i?><span class="badge">(<?=$tag_count[$key]?>)</span></a>
                <?php }
                ?>
            </h4>
        </div>
    </div>



<div class="sidebar_list">
    <div class="sidebar_list_header">
<<<<<<< HEAD
        <p>助教团</p>
        <a href="#" id="sidebar_list_link">加入</a>
=======
        <p style="font-size: large;display:inline-block;margin-top: 5%;font-weight: bold">助教团</p>
        <a href="#" style="color:gray;float: right;display: inline-block;margin-top: 5%">加入</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
    </div>
    <!--分割线-->
    <div class="sidebar_divline"></div>
    <!--助教列表-->
    <ul class="list-group">
        <li class="list-group-item">
            <div style="display: inline-block;vertical-align: baseline">
                <img src="<?php bloginfo("template_url")?>/img/avatar.png" style="margin-top: -15px">
            </div>
            <div style="display: inline-block; vertical-align: baseline">
<<<<<<< HEAD
                <a href="personal.php" class="author_link">如影随风</a>
=======
                <a href="personal.php">如影随风</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                <p>北邮信通院大四学长</p>
            </div>
        </li>
        <li class="list-group-item">
            <div style="display: inline-block;vertical-align: baseline">
                <img src="<?php bloginfo("template_url")?>/img/avatar.png" style="margin-top: -15px">
            </div>
            <div style="display: inline-block; vertical-align: baseline">
<<<<<<< HEAD
                <a href="personal.php" class="author_link">如影随风</a>
=======
                <a href="personal.php">如影随风</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                <p>北邮信通院大四学长</p>
            </div>
        </li>
        <li class="list-group-item">
            <div style="display: inline-block;vertical-align: baseline">
                <img src="<?php bloginfo("template_url")?>/img/avatar.png" style="margin-top: -15px">
            </div>
            <div style="display: inline-block; vertical-align: baseline">
<<<<<<< HEAD
                <a href="personal.php" class="author_link">如影随风</a>
=======
                <a href="personal.php">如影随风</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                <p>北邮信通院大四学长</p>
            </div>
        </li>
        <li class="list-group-item">
            <div style="display: inline-block;vertical-align: baseline">
                <img src="<?php bloginfo("template_url")?>/img/avatar.png" style="margin-top: -15px">
            </div>
            <div style="display: inline-block; vertical-align: baseline">
<<<<<<< HEAD
                <a href="personal.php" class="author_link">如影随风</a>
=======
                <a href="personal.php">如影随风</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                <p>北邮信通院大四学长</p>
            </div>
        </li>
        <li class="list-group-item">
            <div style="display: inline-block;vertical-align: baseline">
                <img src="<?php bloginfo("template_url")?>/img/avatar.png" style="margin-top: -15px">
            </div>
            <div style="display: inline-block; vertical-align: baseline">
<<<<<<< HEAD
                <a href="personal.php" class="author_link">如影随风</a>
=======
                <a href="personal.php">如影随风</a>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                <p>北邮信通院大四学长</p>
            </div>
        </li>
    </ul>
</div>

<!--雷锋榜ok-->
    <div class="sidebar_list">
        <div class="sidebar_list_header">
            <p>雷锋榜</p>
            <!--列表头-->
<<<<<<< HEAD
            <ul id="sidebar_list_choose" class="nav nav-pills">
                <li class="active"><a href="#helperday" data-toggle="tab">日</a></li>
                <li><a href="#helpermonth" data-toggle="tab">周</a></li>
=======
            <ul id="helperTab" class="nav nav-pills" style="float: right">
                <li class="active"><a href="#helperday" data-toggle="tab" style="width: 20px;margin-top: 5px;">日</a></li>
                <li><a href="#helpermonth" data-toggle="tab" style="width: 20px;margin-top: 5px;">周</a></li>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
            </ul>
        </div>
        <!--分割线 下面的是列表-->
        <div class="sidebar_divline"></div>
        <!--列表内容 需要填写的都用php提取出来就行-->
        <div id="helperTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="helperday">
                <ul class="list-group">
                    <?php
                    $from_day=strtotime("-1 day")+8*3600;
                    $answer_most =array();
                    $answer_most=dwqa_user_most_answer(10,$from_day);
                    $answer_most_author_id = $answer_most[0]['post_author'];
                    for($i=0;$i<10;$i++){
                        ?>
                        <li class="list-group-item">
                        <img src="<?php bloginfo("template_url")?>/img/n<?php echo $i+1;?>.png" style="display: inline-block;margin-right: 10px;">
                        <?php echo get_avatar($answer_most[$i]['post_author'],20,'');?>
<<<<<<< HEAD
                        <a href="<?php echo dwqa_get_author_link($answer_most[$i]['post_author']);?>" class="author_link"><?php echo get_userdata($answer_most[$i]['post_author'])->display_name;?></a>
                            <p style="display: inline-block;float: right"><?php echo $answer_most[$i]['answer_count'];?> 答</p>
=======
                        <a href="<?php echo dwqa_get_author_link($answer_most[$i]['post_author']);?>" style="display:inline-block;"><?php echo get_userdata($answer_most[$i]['post_author'])->display_name;?></a>
                            <p style="display: inline-block;float: right"><?php echo $answer_most[$i]['answer_count'];?>答</p>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade" id="helpermonth">
                <ul class="list-group">
                    <?php
                    $from_week=strtotime("-1 week")+8*3600;
                    $answer_most_this_week = array();
                    $answer_most_this_week = dwqa_user_most_answer(10,$from_week);
                    //$answer_most_this_week_author_id = $answer_most_this_week[0]['post_author'];
                    for($i=0;$i<10;$i++){
                        ?>
                        <li class="list-group-item">
                            <img src="<?php bloginfo("template_url")?>/img/n<?php echo $i+1;?>.png" style="display: inline-block;margin-right: 10px;"/>
                            <?php echo get_avatar($answer_most_this_week[$i]['post_author'],20,'');?>
<<<<<<< HEAD
                            <a href="<?php echo dwqa_get_author_link($answer_most_this_week[$i]['post_author']);?>" class="author_link">
                                <?php echo get_userdata($answer_most_this_week[$i]['post_author'])->display_name;?>
                            </a>
                            <p style="display: inline-block;float: right"><?php echo $answer_most_this_week[$i]['answer_count'];?> 答
=======
                            <a href="<?php echo dwqa_get_author_link($answer_most_this_week[$i]['post_author']);?>" style="display:inline-block;">
                                <?php echo get_userdata($answer_most_this_week[$i]['post_author'])->display_name;?>
                            </a>
                            <p style="display: inline-block;float: right"><?php echo $answer_most_this_week[$i]['answer_count'];?>答
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div><!--helper-->

<!--好问榜-->
    <div class="sidebar_list">
        <div class="sidebar_list_header">
            <p>好问榜</p>
            <!--列表头-->
<<<<<<< HEAD
            <ul id="sidebar_list_choose" class="nav nav-pills">
                <li><a href="#askerday" data-toggle="tab">日</a></li>
                <li class="active"><a href="#askermonth" data-toggle="tab">周</a></li>
=======
            <ul id="askerTab" class="nav nav-pills" style="float: right">
                <li><a href="#askerday" data-toggle="tab" style="width: 20px;margin-top: 5px;">日</a></li>
                <li class="active"><a href="#askermonth" data-toggle="tab" style="width: 20px;margin-top: 5px;">周</a></li>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
            </ul>
        </div>
        <!--分割线-->
        <div class="sidebar_divline"></div><!--下面的是列表

        <!--列表内容 需要填写的都用php提取出来就行-->
        <div id="askerTabContent" class="tab-content">
            <div class="tab-pane fade" id="askerday">
                <ul class="list-group">
                    <?php
                    $from_day=strtotime("-1 day")+8*3600;
                    $ask_most =array();
                    $ask_most=dwqa_user_most_ask(10,$from_day);
                    $ask_most_author_id = $ask_most[0]['post_author'];
                    for($i=0;$i<10;$i++){
                        ?>
                        <li class="list-group-item">
                            <img src="<?php bloginfo("template_url")?>/img/n<?php echo $i+1;?>.png" style="display: inline-block;margin-right: 10px;">
                            <?php echo get_avatar($ask_most[$i]['post_author'],20,'');?>
<<<<<<< HEAD
                            <a href="<?php echo dwqa_get_author_link($ask_most[$i]['post_author']);?>" class="author_link"><?php echo get_userdata($answer_most[$i]['post_author'])->display_name;?></a>
                            <p style="display: inline-block;float: right"><?php echo $ask_most[$i]['ask_count'];?> 问</p>
=======
                            <a href="<?php echo dwqa_get_author_link($ask_most[$i]['post_author']);?>" style="display:inline-block;"><?php echo get_userdata($answer_most[$i]['post_author'])->display_name;?></a>
                            <p style="display: inline-block;float: right"><?php echo $ask_most[$i]['ask_count'];?>问</p>
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="tab-pane fade in active" id="askermonth">
                <ul class="list-group">
                    <?php
                    $from_week=strtotime("-1 week")+8*3600;
                    $ask_most_this_week = array();
                    $ask_most_this_week = dwqa_user_most_ask(10,$from_week);
                    //$answer_most_this_week_author_id = $answer_most_this_week[0]['post_author'];
                    for($i=0;$i<10;$i++){
                        ?>
                        <li class="list-group-item">
                            <img src="<?php bloginfo("template_url")?>/img/n<?php echo $i+1;?>.png" style="display: inline-block;margin-right: 10px;"/>
                            <?php echo get_avatar($ask_most_this_week[$i]['post_author'],20,'');?>
<<<<<<< HEAD
                            <a href="<?php echo dwqa_get_author_link($ask_most_this_week[$i]['post_author']);?>" class="author_link">
                                <?php echo get_userdata($ask_most_this_week[$i]['post_author'])->display_name;?>
                            </a>
                            <p style="display: inline-block;float: right"><?php echo $ask_most_this_week[$i]['ask_count'];?> 问
=======
                            <a href="<?php echo dwqa_get_author_link($ask_most_this_week[$i]['post_author']);?>" style="display:inline-block;">
                                <?php echo get_userdata($ask_most_this_week[$i]['post_author'])->display_name;?>
                            </a>
                            <p style="display: inline-block;float: right"><?php echo $ask_most_this_week[$i]['ask_count'];?>问
>>>>>>> 0736b4fcc462d013e0d3eb82e8bbadfb98202f56
                            </p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div><!--asker-->
</div>