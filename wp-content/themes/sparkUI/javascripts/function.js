/**
 * Created by zhangxue on 17/5/26.
 */

//个人主页和他人主页wiki收藏部分js
function get_favorite_wiki($user_id,$admin_url) {
    var data = {
        action: "get_user_favorite_wiki",
        user_ID: $user_id,
        get_wiki_type: "publish"
    };
    $.ajax({
        type: "POST",
        url: $admin_url,
        data: data,
        dataType: "json",
        success: function(data){
            $("#wiki_favorite").text(data.wikis.length);
            if(data.wikis.length!=0){
                $("#wiki_list").html("");
                for(var i=0;i<data.wikis.length;i++) {
                    $("#wiki_list").append("<p>"+"<a href=\"/?yada_wiki="+data.wikis[i].post_name+"\">"+data.wikis[i].post_title+"</a>"+"</p>");
                    $("#wiki_list").append("<p>"+data.wikis[i].post_content.substring(0, 30)+"..."+"</p>");
                    $("#wiki_list").append("<hr>");
                }
            }else{
                var html ='<div class="alert alert-info">'+
                    '<a href="#" class="close" data-dismiss="alert">&times;</a>'+
                    '<strong>Oops,还没有收藏!</strong>去wiki页面逛逛吧。'+
                    '</div>';
                $("#wiki_list").css('margin-top',"0px");
                $("#wiki_list").html(html);
            }
        },
        error: function() {
            alert("wiki获取失败!");
        }
    });
}

//个人主页和他人主页项目收藏部分js 改变翻页的位置css
function pageFavorite(flag) {
    if(flag==true) $("#page_favorite").css({"position":"absolute","bottom":"-15%","left":"40%"});
    else $("#page_favorite").css({"text-align":"center","margin-bottom":"20px"});
}

//header的选择搜索
function selectSearchCat(value) {
    var post_type= document.getElementById("selectPostType");
    if(value=="wiki"){
        post_type.value = "yada_wiki";
    } else if(value=="project"){
        post_type.value = "post";
    } else{
        post_type.value = "";
    }
}

//wiki和项目页面已收藏和未收藏
function setCSS(flag) {
    if(flag == 1){  //未收藏
        addFavorite();
    }else{
        cancelFavorite();
    }
}

//画出我的知识图谱
function myKnowledgeChart(jsonstring) {
    var myChart = echarts.init(document.getElementById('chart'));
    option = null;
    myChart.showLoading();
//var jsonURL = "<?php//get_template_directory_uri()?>/asset/test.json";
//$.get(jsonURL, function (data) {

    var jsonString = jsonstring;
    myChart.hideLoading();
//处理json数据
    var data = JSON.parse(jsonString);
    data.nodes.forEach(function (node) {
        if(node.value>100){
            node.symbolSize = node.value/15;
        }else if(node.value<10){
            node.symbolSize = node.value*5;
        }else{
            node.symbolSize = node.value;
        }
        node.label = {
            normal:{
                show:true
            }
        }
    });
    option = {
        title: {
            text: 'My Knowledge'
            //top: 'bottom',
            //left: 'right'
        },
        tooltip: {},
        legend: [{
            data: data.categories.map(function(a) {
                return a.name;
            })
        }],
        series: [{
            type: 'graph',      //关系图
            //name: 'My Knowledge',  //tooltip显示
            layout: 'force',  //布局怎么显示,
            animationDuration: 1500,
            animationEasingUpdate: 'quinticInOut',
            draggable: true, //节点可拖拽
            roam: 'move',     //鼠标缩放和平移漫游
            focusNodeAdjacency: 'true',  //是否在鼠标移到节点上的时候突出显示节点以及节点的边和邻接节点。
            smybol: 'circle',          //节点的形状'circle', 'rect', 'roundRect', 'triangle', 'diamond', 'pin', 'arrow'
            data: data.nodes,
            links: data.links,
            categories:data.categories,
            force: {
                edgeLength: 100,//连线的长度
                repulsion: 100  //子节点之间的间距
            },
            label: {
                normal: {
                    position: 'right',
                    formatter: '{b}'
                }
            },
            lineStyle: {
                normal: {
                    curveness: 0.3
                }
            }
        }]
    };
    myChart.setOption(option);

    myChart.on('dbclick',function (params) {
        var data = params.data;
        console.log(data);
        //判断节点的相关数据是否正确
        if (data != null && data != undefined) {
            if (data.url != null && data.url != undefined) {
                //根据节点的扩展属性url打开新页面
                location.replace(data.url);
            }
        }
    });
}

//画出项目页面的知识图谱
function proChart(jsonstring) {
    var myChart = echarts.init(document.getElementById('prochart'));
    option = null;
    myChart.showLoading();
    var jsonString = jsonstring;
    myChart.hideLoading();
    //处理json数据
    var jsondata = JSON.parse(jsonString);
    jsondata.nodes.forEach(function (node) {
        if (node.value > 50) {
            node.symbolSize = node.value / 25;
        } else if (node.value < 10) {
            node.symbolSize = node.value * 5;
        } else {
            node.symbolSize = node.value;
        }
        node.label = {
            normal: {
                show: true
            }
        }
    });
    option = {
        title: {
            //text: 'My Knowledge'
            //top: 'bottom',
            //left: 'right'
        },
        tooltip: {},
        legend: [
//                          {
//                        data: jsondata.categories.map(function(a) {
//                            return a.name;
//                        })
//
//                    }
        ],
        series: [{
            type: 'graph',      //关系图
            //name: 'My Knowledge',  //tooltip显示
            layout: 'force',  //布局怎么显示,
            animationDuration: 1500,
            animationEasingUpdate: 'quinticInOut',
            draggable: true,
            roam: 'move',     //是否开启鼠标缩放和平移漫游。默认不开启。如果只想要开启缩放或者平移，可以设置成 'scale' 或者 'move'。设置成 true 为都开启
            focusNodeAdjacency: 'true',  //是否在鼠标移到节点上的时候突出显示节点以及节点的边和邻接节点。
            smybol: 'circle',          //节点的形状'circle', 'rect', 'roundRect', 'triangle', 'diamond', 'pin', 'arrow'
            data: jsondata.nodes,
            links: jsondata.links,
            //categories:jsondata.categories,
            //categories:jsondata.categories,
            force: {
                edgeLength: 100,//连线的长度
                repulsion: 100  //子节点之间的间距
            },
            label: {
                normal: {
                    position: 'right',
                    formatter: '{b}'
                }
            },
            lineStyle: {
                normal: {
                    curveness: 0.3
                }
            }
        }]
    };

    myChart.setOption(option);

    myChart.on('dbclick', function (params) {
        var data = params.data;
        //判断节点的相关数据是否正确
        if (data != null && data != undefined) {
            if (data.url != null && data.url != undefined) {
                //根据节点的扩展属性url打开新页面
                location.replace(data.url);
            }
        }
    });
}