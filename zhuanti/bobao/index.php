<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>双十一播报</title>
    <meta name="keywords" content="双十一播报">
    <meta name="description" content="双十一播报">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.5">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="./css/flipclock.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/slider.css">

    <script src="./js/jquery.min.js"></script>
    <script src="./js/flipclock.js"></script>
    <script src="./js/countUp.js"></script>
    <script src="./js/RangeSlider.js"></script>

    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <script src="js/modernizr-custom.js"></script>
</head>
<body class="demo-3">
<div class="page-view">
    <div class="project">
        <div class="bobao-wapper2">
            <div class="bobao_time">
                <div class="clock2" style="margin:2em;"></div>
            </div>
            <div class="bobao_turnover">
                <h1 class="jumbo" id="myTargetElement2" data-text=""></h1>
            </div>
            <div class="button-group" style="display: none;position: fixed;bottom: 0;right:50px;">
                <div id="test2">
                    <input type="range" id="h3" value="0">
                </div>
            </div>
            <a href="###" class="default" id="setCss2">&#9749</a>
        </div>
    </div>
    <div class="project">
        <div class="bobao-wapper1">
            <div class="bobao_time">
                <div class="clock1" style="margin:2em;"></div>
            </div>
            <div class="bobao_turnover">
                <h1 class="jumbo" id="myTargetElement"></h1><h2 class="jumbo">亿<h2>
            </div>
            <div class="button-group" style="display: none;position: fixed;bottom: 0;right:50px;">
                <div id="test">
                    <input type="range" id="h1" value="0">
                    <input type="range" id="h2" value="0">
                </div>
            </div>
            <a href="###" class="default" id="setCss1">&#9749</a>
        </div>
    </div>

    <nav class="arrows">
        <div class="arrow previous">
            <svg viewBox="208.3 352 4.2 6.4">
                <polygon class="st0" points="212.1,357.3 211.5,358 208.7,355.1 211.5,352.3 212.1,353 209.9,355.1"/>
            </svg>
        </div>
        <div class="arrow next">
            <svg viewBox="208.3 352 4.2 6.4">
                <polygon class="st0" points="212.1,357.3 211.5,358 208.7,355.1 211.5,352.3 212.1,353 209.9,355.1"/>
            </svg>
        </div>
    </nav>
</div>
<script src="js/zepto.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/demo.js"></script>
<?php require_once('../baidutongji.php')?>
</body>
</html>
<script type="text/javascript">
    $(function () {
        Date.prototype.format =function(format){
            var o = {
                "M+" : this.getMonth()+1, //month
                "d+" : this.getDate(), //day
                "h+" : this.getHours(), //hour
                "m+" : this.getMinutes(), //minute
                "s+" : this.getSeconds(), //second
                "q+" : Math.floor((this.getMonth()+3)/3), //quarter
                "S" : this.getMilliseconds() //millisecond
            }
            if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
                (this.getFullYear()+"").substr(4- RegExp.$1.length));
            for(var k in o)if(new RegExp("("+ k +")").test(format))
                format = format.replace(RegExp.$1,
                    RegExp.$1.length==1? o[k] :
                        ("00"+ o[k]).substr((""+ o[k]).length));
            return format;
        }
    });
    /*单位亿*/
    $(function () {
        var clock1,clock2,flag=true;
        /*设置时间牌*/
        clock1 = $('.clock1').FlipClock({
            clockFace: 'TwentyFourHourClock',
        });
        clock2 = $('.clock2').FlipClock({
            clockFace: 'TwentyFourHourClock',
        });
        /*初始化营业额*/
        init();
        var options = {
            useEasing : true,
            useGrouping : true,
            separator : ',',
            decimal : '.',
            prefix : '',
            suffix : ''
        };
        /*营业额显示*/
        var demo1 = new countUp("myTargetElement", 0, 0, 2, 1, options);
        var demo2 = new countUp("myTargetElement2", 0, 0, 2, 1, options);
        demo1.start();
        demo2.start();
        function sendDate() {
            var str="",newDate = new Date();
            str = `${newDate.format("yyyy-MM-dd")}`;
            return str
        }
        function init() {
            var sendDateStr = sendDate();
            if(sendDateStr > "2017-11-11")sendDateStr = "2017-11-11";
            $.ajax({
                type:'GET',
                url:'http://oa-m.da-mai.com/?r=monitor/activity/DisplayBusinessVolume',
                data:{activity_name:'2017双十一',date:sendDateStr},
                success:function (res) {
                    if(res.code == 0){
                        var value1 = res.data.display_business_volume/100000000;
                        var value2 = res.data.display_business_volume;
                        var demo1 = new countUp("myTargetElement", 0, value1, 2, 1, options);
                        var demo2 = new countUp("myTargetElement2", 0, value2, 2, 1, options);
                        demo1.start();
                        demo2.start();
                    }
                }
            })
        }
        /*5分钟刷新*/
        setInterval(function () {
            init()
        },5000)
    })
</script>