<div id="humMenu">
<input id="humCheck" type="checkbox" >
<label id="humOpen" for="humCheck">
<?php
    if($nowDateToDoAllOk==1){
        echo '<img src="image/bars_24.png" alt="メニュー" width="68" height="56">';
    }else{
        echo '<img src="image/hum!.png" alt="メニュー" width="68" height="56">';
    }
?>            
</label>
<label id="humClose" for="humCheck"></label>
<nav>
    <form action="observe.php" method="post">
        <textarea name="toDoNavForm" value=1 class="none">1</textarea>
        <ol class="inner">
        <?php
        $showToDo=array_fill(0,$toDoNum+3,0);
        $showToDo[0]=1;
        $showToDo[1]=1;
        $showToDo[$toDoNum+2]=1;
        echo '<li><button  class="none" id="toDoNav0" name="toDoNav0" value=1></button>
        <label for="toDoNav0"><img src="image/home.png" alt="ホームへ" width="40" height="40"></label>';
        echo '<li><button  class="noneBorder toDoNav" id="toDoNav1" name="toDoNav1" value=1>日記';
        for($cnt2=0;$cnt2<$LongestToDoName-2;$cnt2++){
            echo '　';
        }
        echo '</button>';
        if($_SESSION["nowCalView"]==1){
            for($cnt=2;$cnt<=3;$cnt++){
                if($FunEveShow[$cnt]>0){
                    echo '<li><button id="toDoNav'.$cnt.'" name="toDoNav'.$cnt.'" class="noneBorder toDoNav" value='.$cnt.'>'.$toDoNameJP[$cnt-2];
                    for($cnt2=0;$cnt2<=$LongestToDoName-mb_strlen($toDoNameJP[$cnt-2]);$cnt2++){
                        echo '　';
                    }
                    if($nowDateToDoOk[$cnt-2]<0){
                        echo '<img src="image/redBall.png" alt="未完了" width="10" height="10">';
                    }
                    echo '</button>';
                    $showToDo[$cnt]=1;
                }
            }
            for($cnt=4;$cnt<=$toDoNum+1;$cnt++){
                if($nowDateToDo[$cnt]>0||($cnt==7&&$showImaginationText==1)){
                    echo '<li><button id="toDoNav'.$cnt.'" name="toDoNav'.$cnt.'" class="noneBorder toDoNav " value='.$cnt.'>'.$toDoNameJP[$cnt-2];
                    for($cnt2=0;$cnt2<=$LongestToDoName-mb_strlen($toDoNameJP[$cnt-2]);$cnt2++){
                        echo '　';
                    }
                    if($nowDateToDoOk[$cnt-2]<0){
                        echo '<img src="image/redBall.png" alt="未完了" width="10" height="10">';
                    }
                    echo '</button>';
                    $showToDo[$cnt]=1;
                }
                
            }
        }else if($_SESSION["nowCalView"]==2){
            for($cnt=2;$cnt<=$toDoNum+1;$cnt++){
                echo '<li><button  id="toDoNav'.$cnt.'" name="toDoNav'.$cnt.'" class="noneBorder toDoNav" value='.$cnt.'>'.$toDoNameJP[$cnt-2];
                for($cnt2=0;$cnt2<=$LongestToDoName-mb_strlen($toDoNameJP[$cnt-2]);$cnt2++){
                    echo '　';
                }
                if($nowDateToDoOk[$cnt-2]<0){
                    echo '<img src="image/redBall.png" alt="未完了" width="10" height="10">';
                }
                echo '</button>';
                
            }
        }
        $chatNum=$toDoNum+2;
        echo '<li><button  class="noneBorder toDoNav" id="toDoNav"'.$chatNum.' name="toDoNav'.$chatNum.'" value='.$chatNum.'>チャット';
        for($cnt2=0;$cnt2<$LongestToDoName-4;$cnt2++){
            echo '　';
        }
        echo '</button>';
        ?>
        </ol>
    </form>
</nav>
</div>
<div id=prevNext>
<form action="observe.php" method="post" id=prevForm >
<input type="hidden" name="prevForm" value=1>
<input id="prev" type="button" name="prev" value=1 onClick="submitClick(this);">
<label id="prevLabel" for="prev"><img id="prevImage" src="image/prev.png" alt="前へ" ></label>
</form>
<h3 id=space>  </h3>
<form action="observe.php" method="post" id=nextForm>
<input type="hidden" name="nextForm" value=1>
<input id="next" type="button" name="next" value=1 onClick="submitClick(this);">
<label id="nextLabel" for="next" ><img id="nextImage" src="image/next.png" alt="次へ" ></label>
</form>
</div>
<h1 id="title">
<?php 
    if($_SESSION['nowToDoView']>0){
    echo $addicNameJP[$_SESSION["nowAddic"]];
        if($_SESSION['nowToDoView']==1){
            echo ' 日記';
        }else if($_SESSION['nowToDoView']==10){
            echo ' チャット';
        }else{
            echo ' '.$toDoNameJP[$_SESSION['nowToDoView']-2];
        }
    }
    echo '　'.$now_dateJP.'('.$week[$now_week].')';
?>
</h1>
<form action="observe.php" method="post" id="calendorSelectForm" name="calendorSelectForm">
<?php
    echo  '<select id="calendorSelect" name="calendorSelect" onchange="this.form.submit();">';
    for($cnt=1;$cnt<=$calViewNum;$cnt++){
        $tmp='<option value='.$cnt;
        if((int)$cnt==(int)$_SESSION["nowCalView"]){
            $tmp.=' selected=true';
        }
        $tmp.='>'.$calViewNameJP[$cnt-1].'</option>';
        echo $tmp;
    }
    echo '</select>';
?>
</form>
<form action="observe.php" method="post">
<input id="gotoToday" type="submit" name="gotoToday" class="none" value=1>
<label id="gotoTodayLabel" for="gotoToday" class="border canPush">今日に戻る</label>
</form>
<?php

include('Info.php');
if($_SESSION["class"]==1){
echo '<form action="observe.php" method="post">
<input id="goPatientSelect" type="submit" name="goPatientSelect" class="none"><label for="goPatientSelect" class="goPatientSelectLabel canPush">選択画面へ</label></form>';
}
?>
<form action="observe.php" method="post">
<input id="logOut" type="submit" name="logOut" class="btn none" value=1>
<label id="logOutLabel" for="logOut" class="btnLabel "><img src="image/logOut.png" alt="ログアウト" width="40" height="40"></label>
</form>