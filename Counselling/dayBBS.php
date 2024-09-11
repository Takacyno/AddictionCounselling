<?php
echo '<div>'.$now_dateJP.'('.$week[$now_week].')</div>';
echo '<div id="BBS" class="BBS">';
for($cnt=0;$cnt<count($BBS);$cnt++){
    $text = ereg_replace("(https?|ftp)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$BBS[$cnt][3]);
    $text=str_replace("\n","<br>",$text);
    // if($_SESSION["class"]==1){
    //     if($BBS[$cnt][1]==$patient->ID){
    //         echo '<div class="hisBBS">';
    //         echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
    //         echo '<textarea cols=60 class="patientMessage" disabled=true>'.$text.'</textarea>';
    //         echo '</div>';
    //     }else if($BBS[$cnt][1]==$_SESSION['ID']){
    //         echo '<div class="yourBBS">';
    //         echo '<div class="oneSentence">'.$BBS[$cnt][0].'</div>';
    //         echo '<textarea cols=60 class="yourMessage" disabled=true>'.$text.'</textarea>';
    //         echo '</div>';
    //     }else{
    //         echo '<div class="hisBBS">';
    //         echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
    //         echo '<textarea cols=60 class="hisMessage" disabled=true>'.$text.'</textarea>';
    //         echo '</div>';
    //     }
    // }else{
    //     if($BBS[$cnt][1]==$_SESSION['ID']){
    //         echo '<div class="yourBBS">';
    //         echo '<div class="oneSentence">'.$BBS[$cnt][0].'</div>';
    //         echo '<textarea cols=60 class="yourMessage" disabled=true>'.$text.'</textarea>';
    //         echo '</div>';
    //     }else{
    //         echo '<div class="hisBBS">';
    //         echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
    //         echo '<textarea cols=60 class="hisMessage" disabled=true>'.$text.'</textarea>';
    //         echo '</div>';
    //     }
    // }
    if($_SESSION["class"]==1){
        if($BBS[$cnt][1]==$patient->ID){
            echo '<div class="hisBBS">';
            echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
            echo '<div cols=60 class="patientMessage" >'.$text.'</div>';
            echo '</div>';
        }else if($BBS[$cnt][1]==$_SESSION['ID']){
            echo '<div class="yourBBS">';
            echo '<div class="oneSentence">'.$BBS[$cnt][0].'</div>';
            echo '<div cols=60 class="yourMessage" >'.$text.'</div>';
            echo '</div>';
        }else{
            echo '<div class="hisBBS">';
            echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
            echo '<div cols=60 class="hisMessage" >'.$text.'</div>';
            echo '</div>';
        }
    }else{
        if($BBS[$cnt][1]==$_SESSION['ID']){
            echo '<div class="yourBBS">';
            echo '<div class="oneSentence">'.$BBS[$cnt][0].'</div>';
            echo '<div cols=60 class="yourMessage" >'.$text.'</div>';
            echo '</div>';
        }else{
            echo '<div class="hisBBS">';
            echo '<div class="oneSentence">'.$BBS[$cnt][2].' '.$BBS[$cnt][0].'</div>';
            echo '<div cols=60 class="hisMessage" >'.$text.'</div>';
            echo '</div>';
        }
    }
    
}
if(($_SESSION["class"]==0&&$BBS[count($BBS)-1][1]==$patient->ID)||($_SESSION["class"]==1&&$BBS[count($BBS)-1][1]==$_SESSION["ID"])){
    echo '<div id="UpdateBBSOpenDiv"><label  class="canPush" for="updateBBSCheck">編集</label></div>';
}
echo '</div>';
echo '<form id="BBSForm" action="observe.php" method="post" class="inlineBlock">';
echo '<textarea id="BBSinput" name="BBSinput" cols=100 rows=6 class="oneSentence"></textarea>';
echo '<input type="hidden" name="BBSSubmit" value=1>';
echo '<input  type="button" value="送信" onClick="submitClick(this);">';
echo '</form>';

if(($_SESSION["class"]==0&&$BBS[count($BBS)-1][1]==$patient->ID)||($_SESSION["class"]==1&&$BBS[count($BBS)-1][1]==$_SESSION["ID"])){
    echo '<input type="checkbox" id="updateBBSCheck" name="updateBBSCheck" >';
    echo '<label id="updateBBSClose" for="updateBBSCheck"></label>';
    echo '<form action="observe.php" method="post" id="updateBBSForm">';
    $text = ereg_replace("(https?|ftp)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$BBS[count($BBS)-1][3]);
    echo '<textarea id="updateBBSInput" name="updateBBSInput" cols=100 rows=6 class="oneSentence">'.$text.'</textarea>';
    echo '<input type="hidden" id="BBSUpdate" name="BBSUpdate" value=1>';
    echo '<input  type="button" value="変更" onClick="updateBBSClick(this);">　';
    echo '<input  type="button" value="削除" onClick="deleteBBSClick(this);">　';
    echo '<label for="updateBBSCheck">閉じる</label>';
    echo '</form>';
}
?>