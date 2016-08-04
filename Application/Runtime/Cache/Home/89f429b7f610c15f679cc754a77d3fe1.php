<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>抽奖页面</title>
<link href="<?php echo (WORK_LOG); ?>/lucky/css/cj.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo (WORK_LOG); ?>/js/jquery-1.11.1.min.js"></script>
</head>

<body style="background:#fff;">
  <div class="container">
      <div class="logo"><img src="<?php echo (WORK_LOG); ?>/lucky/images/rp.png" class="img"></div>
        <div class="clear"></div>
        <div class="bg">
          <div class="cj">
            <div class="start_draw"  id="btn1" onclick="return StartGame()">
              
            </div>
            <img src="<?php echo (WORK_LOG); ?>/lucky/images/cj.png" class="img1">
            <table class="list" id="tb">
              <tr>
                  <td class="li"><img src="<?php echo ($list[0]['logo']); ?>" alt="" /></td><td class="li"><img src="<?php echo ($list[1]['logo']); ?>" alt="" /></td><td class="li"><img src="<?php echo ($list[2]['logo']); ?>" alt="" /></td><td class="li"><img src="<?php echo ($list[3]['logo']); ?>" alt="" /></td>
              </tr>
              <tr>
                  <td class="li"><img src="<?php echo ($list[11]['logo']); ?>" alt="" /></td><td></td><td></td><td class="li"><img src="<?php echo ($list[4]['logo']); ?>" alt="" /></td>
              </tr>
              <tr>
                  <td class="li"><img src="<?php echo ($list[10]['logo']); ?>" alt="" /></td><td></td><td></td><td class="li"><img src="<?php echo ($list[5]['logo']); ?>" alt="" /></td>
              </tr>
              <tr>
                  <td class="li"><img src="<?php echo ($list[9]['logo']); ?>" /></td><td class="li"><img src="<?php echo ($list[8]['logo']); ?>" alt="" /></td><td class="li"><img src="<?php echo ($list[7]['logo']); ?>" alt="" /></td><td class="li"><img src="<?php echo ($list[6]['logo']); ?>" alt="" /></td>
              </tr>
            </table>
            
            </div>
            <div class="clear"></div>
            <div class="zj_wrap">
                <div class="zj" style="position: relative;">
                    <ul id="demo" style="position: absolute; top:0;"> 
                        <li>中奖人:奖品</li>
                        <li>中奖人:奖品</li>
                        <li>中奖人:奖品</li>
                    </ul> 
                </div>
              <div class="md">中奖名单</div>
            </div>
            <script> 
                var speed=40;
                var demo=$("#demo"); 
                var time=0;
                function Marquee(){ 
                  time--;
                  if(time%30==0){
                    time=0;
                   demo.find('li').eq(0).appendTo(demo);
                  }
                 demo.css({"top":time+'px'});
                } 
                var MyMar=setInterval(Marquee,speed) 
            </script> 
            <div class="clear"></div>
        </div>
    
    
    
</div>
<script>
  /*
      * 删除左右两端的空格
      */
     function Trim(str){
         return str.replace(/(^\s*)|(\s*$)/g, ""); 
     }
     
        /*
         * 定义数组
         */
        function GetSide(m,n){
            //初始化数组
            var arr = [];
            for(var i=0;i<m;i++){
                arr.push([]);
                for(var j=0;j<n;j++){
                    arr[i][j]=i*n+j;
                }
            }
            //获取数组最外圈
            var resultArr=[];
            var tempX=0,
             tempY=0,
             direction="Along",
             count=0;
            while(tempX>=0 && tempX<n && tempY>=0 && tempY<m && count<m*n)
            {
                count++;
                resultArr.push([tempY,tempX]);
                if(direction=="Along"){
                    if(tempX==n-1)
                        tempY++;
                    else
                        tempX++;
                    if(tempX==n-1&&tempY==m-1)
                        direction="Inverse"
                }
                else{
                    if(tempX==0)
                        tempY--;
                    else
                        tempX--;
                    if(tempX==0&&tempY==0)
                        break;
                }
            }
            return resultArr;
        }
        
       var index=0,           //当前亮区位置
       prevIndex=0,          //前一位置
       Speed=300,           //初始速度
       Time,            //定义对象
       arr = GetSide(4,4),         //初始化数组
         EndIndex=0,           //决定在哪一格变慢
         tb = document.getElementById("tb"),     //获取tb对象 
         cycle=0,           //转动圈数   
         EndCycle=0,           //计算圈数
        flag=false,           //结束转动标志 
        quick=0,           //加速
        endnum=10,       //结束位置
        start=0,       //开始
        alertinfo;      //提示语
        btn = document.getElementById("btn1")
        
        function StartGame(){

          if(start==0){
            start=1;
            $.ajax({
             dataType:"json",
             type:"post",
             success:function(data){
               console.log(data);
               if(data.status==1){
                 endnum=data.data;
                 alertinfo=JSON.stringify(data.info);

                
               }
             }
            })

            clearInterval(Time);
            cycle=0;
            flag=false;
            EndIndex=Math.floor(Math.random()*12);
            EndCycle=1;
            Time = setInterval(Star,Speed);

          }
        }
        
        function Star(num){
            //跑马灯变速
            if(flag==false){
              //走五格开始加速
             if(quick==4){
                 clearInterval(Time);
                 Speed=50;
                 Time=setInterval(Star,Speed);
             }
             //跑N圈减速
             //console.log("cycle:"+cycle);
             // if(cycle>=EndCycle+1 && index==parseInt(EndIndex)){
             if(cycle>=EndCycle+1){
                 // console.log("cycle:"+cycle);
                 // console.log("EndCycle:"+EndCycle+1);
                 // console.log("index:"+index);
                 // console.log("EndIndex:"+parseInt(EndIndex));
                 clearInterval(Time);
                 Speed=300;
                 flag=true;       //触发结束       
                 Time=setInterval(Star,Speed);
             }
            }
            
            if(index>=arr.length){
                index=0;
                cycle++;
            }
            
           //结束转动并选中号码
       //trim里改成数字就可以减速，变成Endindex的话就没有减速效果了
            tb.rows[arr[index][0]].cells[arr[index][1]].className="li playcurr";
            if(index>0)
                prevIndex=index-1;
            else{
                prevIndex=arr.length-1;
            }
            tb.rows[arr[prevIndex][0]].cells[arr[prevIndex][1]].className="li playnormal";
            if(flag==true && index==(parseInt(endnum)-1)){ 
               quick=0;
               alert(alertinfo);
               // setTimeout("return alert('alterinfo');",1000);
               start=0;
               clearInterval(Time);
               return false;
            }
            index++;
            quick++;
        }
</script>
</body>
</html>