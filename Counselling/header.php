<div id="humMenu">
<input id="humCheck" type="checkbox" >
<label id="humOpen" for="humCheck">
<?php
    if($nowDateToDoAllOk==1){
        echo '<img src="image/bars_24.png" alt="メニュー" width="34" height="28">';
    }else{
        echo '<img src="image/hum!.png" alt="メニュー" width="34" height="28">';
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
            if($showToDo[$_SESSION["nowToDoView"]]!=1){
                $_SESSION["nowToDoView"]=0;
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

<?php
include('Info.php');
if($_SESSION["class"]==1){
echo '<form action="observe.php" method="post">
<input id="goPatientSelect" type="submit" name="goPatientSelect" class="none"><label for="goPatientSelect" class="goPatientSelectLabel canPush">選択画面へ</label></form>';
}
?>

<form action="observe.php" method="post">
<input id="logOut" type="submit" name="logOut" class=" none" value=1>
<label id="logOutLabel" for="logOut" class="btnLabel "><img src="image/logOut.png" alt="ログアウト" width="20" height="20"></label>
</form>