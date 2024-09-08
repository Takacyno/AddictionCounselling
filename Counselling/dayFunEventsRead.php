<?php
echo '<div>'.$now_dateJP.'('.$week[$now_week].')</div>';
echo '<input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
if($nowDateToDo[$_SESSION["nowToDoView"]]>0){
    if(count($FunEventsRead)>0){
        $tmp=$FunEventsRead[0][2];
        echo '<form id="FunEventsReadForm" action="observe.php" method="post" class="inlineBlock"';
        echo '<div class="oneSentence">'.$tmp.'番</div>';
        echo '<div class="oneSentence"><textarea id="'.$toDoName[$_SESSION["nowToDoView"]-2].'" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'" cols=200 rows=10 disabled=true>'.$FunEvents[$FunEventsRead[0][2]-1][1].'</textarea></div>';
        echo '<div class="oneSentence">を読み返しての20単語書き出し　';
        $tmp=$daySum+1;
        echo '累計'.$tmp.'回目';
        '</div>';
        for($cnt=0;$cnt<20;$cnt++){
            if($cnt%3==0){
                echo '<div class="oneSentence">';
            }
            echo '<textarea id="'.$toDoName[$_SESSION["nowToDoView"]-2].$cnt.'" name="'.$toDoName[$_SESSION["nowToDoView"]-2].$cnt.'" cols=60 rows=1 disabled=true>'.$FunEventsRead[0][3+$cnt].'</textarea>';
            if(($cnt+1)%3==0||$cnt+1==20){
                echo '</div>';
            }
        }
        echo '</form>';
    }else{
        echo '<div id="FunEventsReadAbstractDiv" class="inlineBlock"><ol>';
        for($cnt=0;$cnt<count($FunEvents);$cnt++){
            echo '<li><button id="FunEventsReadAbstractButton'.$cnt.'" class="Abstractbtn" cols=200 row=2 value='.$cnt.' onclick="FunEventsReadButtonClick(this.value);">'.$FunEvents[$cnt][0].'</button>';
        }
        echo '</ol></div>';
        echo '<form id="FunEventsReadForm" action="observe.php" method="post" class="inlineBlock">';
        echo '<select id="FunEventsReadSelect" name="FunEventsReadSelect" onchange="FunEventsReadSelectChange(this.value);">';
        for($cnt=0;$cnt<count($FunEvents);$cnt++){
            $tmp=$cnt+1;
            echo '<option value='.$tmp.'>'.$tmp.'番</option>';
        }
        echo '</select>';
        echo '<div class="oneSentence"><textarea id="FunEventsReadAbstract" name="FunEventsReadAbstract" cols=200 rows=2>'.$FunEvents[0][0].'</textarea><br><textarea id="FunEventsReadConcrete" name="FunEventsReadConcrete" cols=200 rows=10>'.$FunEvents[0][1].'</textarea><br><input type="button" value="テキストを変更" onClick="FunEventsReadTextSubmitClick(this);"></div>';
        echo '<div class="oneSentence">を読み返しての20単語書き出し　';
        $tmp=$daySum+1;
        echo '累計'.$tmp.'回目';
        '</div>';
        for($cnt=0;$cnt<20;$cnt++){
            if($cnt%3==0){
                echo '<div class="oneSentence">';
            }
            echo '<textarea id="'.$toDoName[$_SESSION["nowToDoView"]-2].$cnt.'" name="'.$toDoName[$_SESSION["nowToDoView"]-2].$cnt.'" cols=60 rows=1></textarea>';
            if(($cnt+1)%3==0||$cnt+1==20){
                echo '</div>';
            }
        }
        echo '<input name="FunEventsReadSubmit" type="hidden" value=1>';
        echo '<input id="FunEventsReadWhat" name="FunEventsReadWhat" type="hidden">';
        echo '<input type="button" value="決定" onClick="FunEventsReadSubmitClick(this);">';
        echo '</form>';
    }
}
?>