<?php
echo '<div id="FunEventsAbstract" class="inlineBlock textAlignLeft">';
echo '<input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
echo '<div class="oneSentence">'.$now_dateJP.'('.$week[$now_week].') '.'</div>';
echo '<form action="observe.php" method="post" class="oneSentence">';
echo '<input type="hidden" id="FunEventsAbstractForm" name="FunEventsAbstractForm" value=1>';
// echo '<textarea name="FunEventsAbstractForm" value=1 class="none">1</textarea>';
if($_SESSION["dDelay"]!=0){
    for($cnt=0;$cnt<count($FunEventsAbstract);$cnt++){ 
        echo '<div class="oneSentence">'.$toDoNameJP[0];
        $tmp=$FunEventsAbstract[$cnt][1];
        echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'"  disabled=true>'.$FunEventsAbstract[$cnt][5].'</textarea>';
        echo '</div>';
    }
}else if($completeFunAbNum>=$nowDateToDo[2]){
    if($remainFunAb>0){
        echo '<div class="oneSentence">今週はあと'.$remainFunAb.'回書いてください</div>';
    }
    echo '<input type="hidden" id="FunEventsAbstractSaveComplete" name="FunEventsAbstractSaveComplete" value=1>';
    echo '<input type="hidden" id="FunEventsAbstractSaveCompleteNum" name="FunEventsAbstractSaveCompleteNum" value=1>';
    // echo '<input type="hidden" id="FunEventsAbstractSave" name="FunEventsAbstractSave">';
    for($cnt=0;$cnt<$completeFunAbNum;$cnt++){ 
        echo '<div class="oneSentence">'.$toDoNameJP[0];
        $tmp=$FunEventsAbstract[$cnt][1];
        echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'" disabled=true>'.$FunEventsAbstract[$cnt][5].'</textarea></div>';
    }
    if($completeFunAbSum<$toDoSum[0][1]){
        // echo $completeFunAbNum.' '.$toDoSum[0][1];
        echo '<input type="button" id="showFunEventsAbstractButton" class="hidden" onclick="showFunEventsAbstract(this);">';
        echo '<br><label id="showFunEventsAbstractLabel" for="showFunEventsAbstractButton" class="canPush"  ><img src="image/plus.png" alt="追加" width="20" height="20"></label>';
        echo '<div class="none" id="plusOneFunEventsAbstractDiv">'.$toDoNameJP[0];
        if(count($FunEventsAbstract)>$completeFunAbNum){
            $tmp=$FunEventsAbstract[$completeFunAbNum][1];
            echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'"  >'.$FunEventsAbstract[$completeFunAbNum][5].'</textarea>';
        }else{
            $tmp=$biggestFunAbNum;
            echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'"  ></textarea>';
        }
        // echo '<button id="FunEventsAbstractSave'.$cnt.'" name="FunEventsAbstractSave'.$cnt.'" value=1>保存</button>';
        // echo '<button id="FunEventsAbstractComplete'.$cnt.'" name="FunEventsAbstractComplete'.$cnt.'" value=1>完成</button>';
        echo '<input type="button" id="1__'.$cnt.'" value="保存" onClick="FunEventsAbstractSaveCompleteClick(this);">';
        echo '<input type="button" id="2__'.$cnt.'" value="完成" onClick="FunEventsAbstractSaveCompleteClick(this);">';
        echo '</div>';

    }
}else{
    echo '<div class="oneSentence">'.$toDoNameJP[0].'</div>';
    if($remainFunAb>0){
        echo '<div class="oneSentence">今週はあと'.$remainFunAb.'回書いてください</div>';
    }
    echo '<input type="hidden" id="FunEventsAbstractSaveComplete" name="FunEventsAbstractSaveComplete">';
    echo '<input type="hidden" id="FunEventsAbstractSaveCompleteNum" name="FunEventsAbstractSaveCompleteNum">';
    echo '<input type="hidden" id="FunEventsAbstractSave" name="FunEventsAbstractSave">';
    for($cnt=0;$cnt<count($FunEventsAbstract);$cnt++){ 
        echo '<div class="oneSentence">'.$toDoNameJP[0];
        $tmp=$FunEventsAbstract[$cnt][1];
        echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'"  ';
        if($FunEventsAbstract[$cnt][4]==1){
            echo 'disabled=true>'.$FunEventsAbstract[$cnt][5].'</textarea>';
        }else{
            echo'>'.$FunEventsAbstract[$cnt][5].'</textarea>';
            echo '<input type="button" id="1__'.$cnt.'" value="保存" onClick="FunEventsAbstractSaveCompleteClick(this);">';
            echo '<input type="button" id="2__'.$cnt.'" value="完成" onClick="FunEventsAbstractSaveCompleteClick(this);">';
        }
        echo '</div>';
    }
    if($completeFunAbNum<$toDoSum[0][1]){
        if(count($FunEventsAbstract)<$nowDateToDo[2]){
            $cnt=count($FunEventsAbstract);
            echo '<div class="oneSentence">'.$toDoNameJP[0];
            $tmp=$biggestFunAbNum;
            echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'"  ></textarea>';
            echo '<input type="button" id="1__'.$cnt.'" value="保存" onClick="FunEventsAbstractSaveCompleteClick(this);">';
            echo '<input type="button" id="2__'.$cnt.'" value="完成" onClick="FunEventsAbstractSaveCompleteClick(this);">';
            echo '</div>';
        }
        // for($cnt=count($FunEventsAbstract);$cnt<$nowDateToDo[2];$cnt++){ 
        //     echo '<div class="oneSentence">'.$toDoNameJP[0];
        //     $tmp=$biggestFunAbNum-count($FunEventsAbstract)+$cnt;
        //     echo $tmp.'<textarea id="FunEventsAbstractInput'.$cnt.'" name="FunEventsAbstractInput'.$cnt.'" cols="100" rows="2" ></textarea>';
        //     echo '<button id="FunEventsAbstractSave'.$cnt.'" name="FunEventsAbstractSave'.$cnt.'" value=1>保存</button>';
        //     echo '<button id="FunEventsAbstractComplete'.$cnt.'" name="FunEventsAbstractComplete'.$cnt.'" value=1>完成</button>';
        //     echo '</div>';
        // }
    }
}
echo '</form>';
echo '</div>';

?>