<?php
echo '<div id="Essay" class="inlineBlock textAlignLeft">';
echo '<div class="oneSentence">'.$now_dateJP.'('.$week[$now_week].') '.'</div>';
echo '<input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
echo '<form action="observe.php" method="post" class="oneSentence">';
    echo '<textarea name="EssayForm" value=1 class="none">1</textarea>';
    echo '<div class="oneSentence">'.$toDoNameJP[3].'　';
    if($InfoEssayOk==1){
        echo '完成済み';
    }else{
        echo '未完成';
    }
    echo'</div><div class="oneSentence"><textarea id="EssayInput" name="EssayInput" cols="100" rows="50"';
    if($InfoEssayOk==1){
        echo ' disabled=true';
    }
    echo '>'.$InfoEssay.'</textarea>';
    if($InfoEssayOk!=1){
        echo '<input type="hidden" id="EssaySaveComplete" name="EssayComplete">';
        echo '<input type="button" id="EssaySave" value="保存" onClick="submitClick(this);">';
        echo '<input type="button" id="EssayComplete" value="完成" onClick="EssayCompleteClick(this);">';
    }
    echo '</div>';
echo '</form>';
echo '</div>';
?>