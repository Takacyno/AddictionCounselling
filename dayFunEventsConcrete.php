<?php
echo '<div id="FunEvents" class="inlineBlock textAlignLeft">';
echo '<div class="oneSentence">'.$now_dateJP.'('.$week[$now_week].') '.'</div>';
echo '<input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
if($_SESSION["dDelay"]==0){
    if($remainFun>0){
        echo '<div class="oneSentence">今週はあと'.$remainFun.'回書いてください</div>';
    }
    if(count($completeFunEventsConcrete)>=$nowDateToDo[3]){
        echo '<div id="FunEventsConcreteDiv" class="none">';
    }else{
        echo '<div id="FunEventsConcreteDiv" class="oneSentence">';
    }
    echo '<div class="inlineBlock"><ol id="FunEventsOl">';
    for($cnt=0;$cnt<count($incompleteFunEventsConcrete);$cnt++){
        echo '<li><button id="FunEventsConcreteAbstractButton'.$incompleteFunEventsConcrete[$cnt][1].'" class="Abstractbtn" cols=200 row=2  value='.$cnt.' onclick="FunEventsConcreteButtonClick(this.value);">'.$incompleteFunEventsConcrete[$cnt][5].'</button>';
    }
    echo '</ol></div>';
    echo '<form action="observe.php" method="post" class="oneSentence">';
    echo '<input id="selecedFunEventsConcrete" name="selecedFunEventsConcrete" type="hidden" value='.$incompleteFunEventsConcrete[0][1].'>';
    echo '<textarea name="FunEventsConcreteForm" value=1 class="none">1</textarea>';
    echo '<select id="FunEventsConcreteSelect" name="FunEventsConcreteSelect" onchange="FunEventsConcreteSelectChange(this.value);">';
    for($cnt=0;$cnt<count($incompleteFunEventsConcrete);$cnt++){
        $tmp=$incompleteFunEventsConcrete[$cnt][1];
        echo '<option  value='.$cnt.'>'.$tmp.'番</option>';
    }
    echo '</select>';
    echo '<div class="oneSentence">'.$toDoNameJP[0].'<textarea id="FunEventsConcreteAbstract" cols=200 rows=2 disabled=true>'.$incompleteFunEventsConcrete[0][5].'</textarea></div>';
    echo '<div class="oneSentence">'.$toDoNameJP[1].'　　<textarea id="FunEventsConcrete" name="FunEventsConcrete" cols=200 rows=10 >'.$incompleteFunEventsConcrete[0][7].'</textarea></div>';
    echo '<input type="hidden" id="FunEventsConcreteSaveComplete" name="FunEventsConcreteSaveComplete">';
    echo '<input type="button" id="FunEventsConcreteSave" name="FunEventsConcreteSave" value="保存" onClick="FunEventsCompleteSaveCompleteClick(this);">';
    echo '<input type="button" id="FunEventsConcreteComplete" name="FunEventsConcreteComplete" value="完成" onClick="FunEventsCompleteSaveCompleteClick(this);">';
    echo '</form></div><br>';
    if($completeFunNum<$toDoSum[1][1]&&count($completeFunEventsConcrete)>=$nowDateToDo[3]){
        echo '<input type="button" id="showFunEventsConcreteButton" class="hidden" onclick="showFunEventsConcrete(this);">';
        echo '<label id="showFunEventsConcreteLabel" for="showFunEventsConcreteButton" class="canPush"  ><img src="image/plus.png" alt="追加" width="20" height="20"></label>';
    }
}
for($cnt=0;$cnt<count($completeFunEventsConcrete);$cnt++){ 
    echo '<div class="oneSentence">'.$toDoNameJP[0];
    $tmp=$completeFunEventsConcrete[$cnt][1];
    echo $tmp.'<textarea cols="100" rows="2" disabled=true>'.$completeFunEventsConcrete[$cnt][5].'</textarea></div>';
    echo '<div class="oneSentence">'.$toDoNameJP[1].'　　'.$tmp.'<textarea cols="100" rows="20" disabled=true>'.$completeFunEventsConcrete[$cnt][7].'</textarea>';
    echo '</div>';
}

echo '</div>';
?>