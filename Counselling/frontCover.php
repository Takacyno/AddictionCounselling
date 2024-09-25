<?php
echo '<div id="frontCover">';
echo '<div class="oneSentence">'.$todayJP.'('.$week[$now_week].') '.'<br>現在'.$stageName[$stage].'</div>';
if($stage==5||$stage==6){
    if($stage==5){
        echo '維持ステージの　';
    }
    echo '<input type="checkbox" id="descriptionCheck">';
    echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
    echo '<label id="descriptionClose" for="descriptionCheck"></label>';
    echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
    echo '<input type="checkbox" id="instructionCheck">';
    echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
    echo '<label id="instructionClose" for="instructionCheck"></label>';
    echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
}
if($stage==0&&$_SESSION["class"]==1){
echo '<form action="observe.php" method="post">';
    echo 'カウンセリングの開始日を設定する';
    echo '<select id="startProcessY" name="startProcessY">';
    echo '<option value='.$_SESSION['Y'].' selected=true>'.$_SESSION['Y'].'</option>';
    $tmp=$_SESSION['Y']+1;
    echo '<option value='.$tmp.'>'.$tmp.'</option>';
    echo '</select>年';
    echo '<select id="startProcessM" name="startProcessM">';
    for($cnt=1;$cnt<=12;$cnt++){
        echo '<option value='.$cnt;
        if($_SESSION['m']==$cnt){
            echo ' selected=true';
        }
        echo '>'.$cnt.'</option>';
    }
    echo '</select>月';
    echo '<select id="startProcessD" name="startProcessD">';
    for($cnt=1;$cnt<=31;$cnt++){
        echo '<option value='.$cnt;
        if($_SESSION['d']==$cnt){
            echo ' selected=true';
        }
        echo'>'.$cnt.'</option>';
    }
    echo '</select>日';
    echo '<input type="hidden" name="startProcess" value="送信">';
    echo '<input type="button" onclick="startProcessDate_check(this)" value="送信"></form>';

}
echo '<div>';
echo '<div class="Red">目標</div>';
echo $InfoAddicGoal.'<br>';
echo $patient->Goal.'<br>';
echo '</div>';
echo '<div>';
if(count($newestBBS)>0){
    echo '最新チャット<br>'.$newestBBS.'<br>';
}
echo '<br>';
for($cnt=0;$cnt<count($frontCoverBBS);$cnt++){
    $text = preg_replace(
        "/(https?|ftp)(:\/\/[[:alnum:]\+\$\;\?\.%,!#~*\/:@&=_-]+)/",
        "<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",
        $frontCoverBBS[$cnt]
    );
    $text=str_replace("\n","<br>",$text);
    echo '<div  class="noneBorder toDoNav canPush">'.$text.'</div>';
    echo '<br>';
}
echo '<br>';
echo '<form action="observe.php" method="post">';
echo '<input type="hidden" name="tests" value=1><ol>';
for($cnt=0;$cnt<count($testNameJP);$cnt++){
    echo '<li><button  class="noneBorder toDoNav canPush';
    if($_SESSION["class"]==0&&(int)substr($patient->TestShow,$cnt,1)==0){
        echo ' none';
    }
    echo '" name="testButton'.$cnt.'" value=1>'.$testNameJP[$cnt].'</button>';
}
echo '</ol>';
echo '</form></div>';
echo '</div>';
if($_SESSION["class"]==1){
    echo '<ul class="overFlowAuto">';
    for($cnt=0;$cnt<count($frontCoverBBSData);$cnt++){
        echo '<li><input type="button" class="patientBtn canPush" id="frontCoverBBS'.$cnt.' " value="'.$frontCoverBBSShow[$frontCoverBBSData[$cnt][1]]."\n".$frontCoverBBSData[$cnt][5].'" onClick=FrontCoverBBSClick(this.id)>';
    }
    echo '</ul>';
    echo '<div>';
    echo '<form action="observe.php" method="post" id="updateThisFrontCoverBBSForm" class="none">';
    echo '<div id="updateThisCounsellorDiv">';
    echo '<input type="hidden" name="updateThisFrontCoverBBS" value=1>';
    echo '<input type="hidden" id="FrontCoverBBSNum" name="FrontCoverBBSNum" >';
    echo '表示　　';
    echo '<select id="FrontCoverBBSBBSstatus" name="FrontCoverBBSBBSstatus" >';
    for($cnt=0;$cnt<count($frontCoverBBSShow);$cnt++){
        echo '<option value='.$cnt.'>'.$frontCoverBBSShow[$cnt].'</option>';
    }
    echo '</select><br>';
    echo '<br>テキスト';
    echo '<textarea cols="50" rows="2" id="FrontCoverBBSTextContents" name="FrontCoverBBSTextContents" ></textarea><br>';
    echo '<input type="button" value="変更" onClick=updateThisFrontCoverBBSClick(this)>';
    echo '</div></form></div>';

    echo '<div id="plusFrontCoverBBSMenu">';
    echo '<input type="checkbox" id="plusFrontCoverBBSCheck" name="plusFrontCoverBBSCheck" >';
    echo '<label id="plusFrontCoverBBSOpen" for="plusFrontCoverBBSCheck"><img src="image/plus.png" alt="追加" width="40" height="40">掲示板の追加</label>';
    echo '<label id="plusFrontCoverBBSClose" for="plusFrontCoverBBSCheck"></label>';
    echo '<form action="observe.php" method="post" id="plusFrontCoverBBSForm">';

    echo '<input type="hidden" name="plusFrontCoverBBS" value=1>';
    echo 'テキスト<br>';
    echo '<textarea cols="50" rows="2" id="plusFrontCoverBBSTextContents" name="plusFrontCoverBBSTextContents" ></textarea><br>';
    echo '<input type="button" value="送信" onClick=plusFrontCoverBBSClick(this)>';
    echo '</form>';
}
for($cnt=0;$cnt<count($frontDescriptionTexts)-1;$cnt++){
    echo '<br><input type="checkbox" id="descriptionCheck'.$cnt.'">';
    echo '<label id="descriptionOpen'.$cnt.'" for="descriptionCheck'.$cnt.'">'.$toDoNameJP[$cnt].'の説明文を表示</label>';
    echo '<div id="description'.$cnt.'"><label for="descriptionCheck'.$cnt.'">閉じる</label><br>'.$frontDescriptionTexts[$cnt].'</div>';
}
echo '<br><input type="checkbox" id="textDescriptionCheck">';
echo '<label id="textDescriptionOpen" for="textDescriptionCheck">想像の準備の説明文を表示</label>';
echo '<div id="textDescription"><label for="textDescriptionCheck" >閉じる</label><br>'.$frontDescriptionTexts[$cnt].'</div>';
?>