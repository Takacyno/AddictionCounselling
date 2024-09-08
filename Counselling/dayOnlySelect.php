<?php
echo '<div id="'.$toDoName[$_SESSION["nowToDoView"]-2].'" class="inlineBlock textAlignLeft">';
echo '<div class="oneSentence">'.$now_dateJP.'('.$week[$now_week].') '.'</div>';
echo '<input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br><br>';
echo '<form action="observe.php" method="post" class="oneSentence">';
if($_SESSION["nowToDoView"]==4){
    echo '<div class="oneSentence">'.$InfoControlStimulusText.'</div>';   
}else{
    echo '<div class="oneSentence">'.$InfoEssay.'</div>';   
}

echo '<div>今日は'.$nowDateToDo[$_SESSION["nowToDoView"]].'回行ってください。</div>';
echo '<div class="oneSentence">'.$toDoNameJP[$_SESSION["nowToDoView"]-2];

echo '<select id="nowDate'.$toDoName[$_SESSION["nowToDoView"]-2].'Select" name="nowDate'.$toDoName[$_SESSION["nowToDoView"]-2].'Select">';
if($_SESSION["nowToDoView"]==4){
    for($cnt2=0;$cnt2<=50;$cnt2++){
        $tmp='<option value='.$cnt2;
        if($_SESSION["nowToDoView"]==4){
            if($cnt2==$ControlStimulus){
                $tmp.=' selected=true';
            }
        }else{
            if($cnt2==$Essays[3]){
                $tmp.=' selected=true';
            }
        }
        $tmp.='>';
        if($cnt2!==0){
            $tmp.=$cnt2;
        }
        $tmp.='</option>';
        echo $tmp;
    }
}else if($_SESSION["nowToDoView"]==9){
    for($cnt2=0;$cnt2<=1;$cnt2++){
        $tmp='<option value='.$cnt2;
        if($_SESSION["nowToDoView"]==4){
            if($cnt2==$ControlStimulus){
                $tmp.=' selected=true';
            }
        }else{
            if($cnt2==$Essays[3]){
                $tmp.=' selected=true';
            }
        }
        $tmp.='>';
        if($cnt2!==0){
            $tmp.=$cnt2;
        }
        $tmp.='</option>';
        echo $tmp;
    }
}

echo '</select>';
echo '<button id="'.$toDoName[$_SESSION["nowToDoView"]-2].'Submit" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'Submit" value=1>送信</button>';
    echo '<div>';
    $tmp=$daySum+1;

    if($_SESSION["nowToDoView"]==4){
        $tmp2=(int)$ControlStimulus;
    }else{
        $tmp2=(int)$Essays[3];
    }
    $daySum+=$tmp2;
    if($tmp2==1){
        echo '累計'.$tmp.'回目';
    }else if($tmp2>1){
        echo '累計'.$tmp.'回目～'.$daySum.'回目';
    }
    echo '</div>';
echo '</div>';
echo '</form>';
echo '</div>';
?>