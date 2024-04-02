<?php
echo '<div id="frontCover">';
echo '<div class="oneSentence">'.$now_dateJP.'('.$week[$now_week].') '.'<br>現在'.$stageName[$stage].'</div><br>';
if($stage==0){
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
echo $InfoControlStimulusText.'<br>';
echo $InfoAddicGoal.'<br>';
echo $patient->Goal.'<br>';
echo '</div>';
echo '<div>';
echo '<ol>';
for($cnt=0;$cnt<count($frontCoverBBS);$cnt++){
    echo '<li><div  class="noneBorder toDoNav canPush">'.$frontCoverBBS[$cnt].'</div>';
}
echo '</ol>';
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
?>