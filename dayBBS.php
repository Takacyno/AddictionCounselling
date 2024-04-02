<?php
echo '<div>'.$now_dateJP.'('.$week[$now_week].')</div>';
echo '<div id="BBS" class="BBS">';
for($cnt=0;$cnt<count($BBS);$cnt++){
    $text = ereg_replace("(https?|ftp)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)","<a href=\"\\1\\2\" target=\"_blank\">\\1\\2</a>",$BBS[$cnt][3]);

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
echo '<div id="BBSbottom" class=oneSentence>　</div>';
echo '</div>';
echo '<form id="BBSForm" action="observe.php" method="post" class="inlineBlock">';
echo '<textarea id="BBSinput" name="BBSinput" cols=100 rows=6 class="oneSentence"></textarea>';
echo '<input type="hidden" name="BBSSubmit" value=1>';
echo '<input  type="button" value="送信" onClick="submitClick(this);">';
echo '</form>';
