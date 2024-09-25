<?php
echo '<br><input type="checkbox" id="descriptionCheck">';
echo '<label id="descriptionOpen" for="descriptionCheck">説明文を表示</label>　';
echo '<label id="descriptionClose" for="descriptionCheck"></label>';
echo '<div id="description"><label for="descriptionCheck">閉じる</label><br>'.$description.'</div>';
echo '<input type="checkbox" id="instructionCheck">';
echo '<label id="instructionOpen" for="instructionCheck">やり方を表示</label>';
echo '<label id="instructionClose" for="instructionCheck"></label>';
echo '<div id="instruction"><label for="instructionCheck">閉じる</label><br>'.$instruction.'</div><br>';
if($_SESSION["nowToDoView"]==7&&$showImaginationText==1){
    echo $toDoNameJP[$_SESSION["nowToDoView"]-2].'のための準備<br>';
    echo '<input type="checkbox" id="textDescriptionCheck">';
    echo '<label id="textDescriptionOpen" for="textDescriptionCheck">説明文を表示</label>　';
    echo '<label id="textDescriptionClose" for="textDescriptionCheck"></label>';
    echo '<div id="textDescription"><label for="textDescriptionCheck">閉じる</label><br>'.$textDescription.'</div>';
    echo '<input type="checkbox" id="textInstructionCheck">';
    echo '<label id="textInstructionOpen" for="textInstructionCheck">やり方を表示</label>';
    echo '<label id="textInstructionClose" for="textInstructionCheck"></label>';
    echo '<div id="textInstruction"><label for="textInstructionCheck">閉じる</label><br>'.$textInstruction.'</div><br>';
}
if(count($Observation)>0){
    echo '<form id="ReObservationForm" action="observe.php" method="post" class="oneSentence">';
    echo '<select id="ObservationSelect" name="ObservationSelect" onchange="ObservationSelect_change(this.value);">';
    for($cnt=1;$cnt<=count($Observation);$cnt++){
        $tmp='<option value='.$cnt;
        if($cnt==count($Observation)){
            $tmp.=' selected=true';
        }
        $tmp.='>'.$cnt.'回目</option>';
        echo $tmp;
    }
    echo '</select>';


    // echo '</div>';
// for($cnt=0;$cnt<count($Observation);$cnt++){
    $cnt=count($Observation)-1;
    $tmp=$daySum+$cnt+1;
    echo '<textarea id="ReObservationHowmany" rows=1 disabled=true>累計'.$tmp.'回目　';
    if($_SESSION["nowToDoView"]==6){
        if($tmp%10==0){
            echo $ObservationNameJP[26][1];
        }else{
            echo $ObservationNameJP[26][0];
        }
    }
    echo '</textarea></div>';
    
    if($_SESSION["nowToDoView"]==7){
        echo '<div class="oneSentence"><ol id="ReaboutWhatOl">';
        for($cnt2=0;$cnt2<count($ImaginationTextComplete);$cnt2++){
            echo '<li><input type="button" id="ReaboutWhatButton'.$cnt2.'"  cols=200 row=2  value='.$cnt2.' class="none" onclick="ReaboutWhatClick(this.value);"><label for="ReaboutWhatButton'.$cnt2.'" class="canPush">'.$ImaginationTextComplete[$cnt2][4].'</label>';
        }
        echo '</ol></div>';
        echo '<select id="ReaboutWhatSelect" name="ReaboutWhatSelect" onchange="ReaboutWhatSelectChange(this.value);">';
        for($cnt2=0;$cnt2<count($ImaginationTextComplete);$cnt2++){
            $tmp=$cnt2+1;
            echo '<option  value='.$cnt2.'>'.$tmp.'番</option>';
        }
        echo '<div class="oneSentence"><textarea cols=200 rows=2 id="ReaboutWhatText">'.$ImaginationTextComplete[$Observation[$cnt][22]][4].'</textarea></div>について想像<br>';
    }
    for($cnt2=0;$cnt2<2;$cnt2++){
        $textCount=0;
        echo '<div class="inlineBlock textAlignLeft">';
        echo '<div class="oneSentence">'.$ObservationNameJP[0][0].$toDoNameJP[$_SESSION["nowToDoView"]-2].$ObservationNameJP[0][$cnt2+1].'</div>';
        for($cnt3=0;$cnt3<5;$cnt3++){
            echo '<div class="oneSentence">'.$ObservationNameJP[1+$cnt3*2][0];
            if($cnt3==3){
                echo '</div><div class="oneSentence"><select id="Re'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Select" name="Re'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Select" >';
                for($cnt4=0;$cnt4<count($ObservationNameJP[2+$cnt3*2]);$cnt4++){
                    $tmp='<option value='.$cnt4;
                    if($cnt4==$Observation[$cnt][3+$textCount+$cnt2*9]){
                        $tmp.=' selected=true';
                    }
                    $tmp.='>';
                    $tmp.=$ObservationNameJP[2+$cnt3*2][$cnt4];
                    $tmp.='</option>';
                    echo $tmp;
                }
                echo '</select></div>';
                $textCount++;
            }else{
                for($cnt4=0;$cnt4<count($ObservationNameJP[2+$cnt3*2]);$cnt4++){
                    if($cnt4%$columnNum[$cnt3]==0){
                        echo '<div class="oneSentence">';
                    }
                    echo '<input id="Re'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'" name="Re'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'" type="checkbox"  ';
                    if(substr($Observation[$cnt][3+$textCount+$cnt2*9],$cnt4,1)==1){
                        echo 'checked';
                    }
                    if($cnt4==$textCheck[$cnt3]){
                        echo ' onchange="RetextDisplaySwitch(this.id);"';
                    }
                    echo '><label for="Re'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'">'.$ObservationNameJP[2+$cnt3*2][$cnt4].'</label>';
                    for($cnt5=0;$cnt5<$longestObservationName[$cnt3]-mb_strlen($ObservationNameJP[2+$cnt3*2][$cnt4]);$cnt5++){
                        echo '　';
                    }
                    if(($cnt4+1)%$columnNum[$cnt3]==0||$cnt4==count($ObservationNameJP[2+$cnt3*2])-1){
                        echo '</div>';
                    }
                }
                echo '</div>';

                echo '<div id="Re'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'Div" class="';
                if(substr($Observation[$cnt][3+$textCount+$cnt2*9],$textCheck[$cnt3],1)!=1){
                    echo ' none';
                }
                echo'">'.$ObservationNameJP[11][0].'<textarea id="Re'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'" name="Re'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'" cols=100 rows=1 >'.$Observation[$cnt][4+$textCount+$cnt2*9].'</textarea></div>';

                $textCount+=2;
            }
        }
        // echo '<div id="Re'.'OtherText'.$ObservationName[0][$cnt2].'Div" class="';
        // if(substr($Observation[$cnt][7+$cnt2*6],$textDisplay[0],1)!=1){
        //     echo ' none';
        // }
        // echo'">'.$ObservationNameJP[11][0].'<textarea id="Re'.'OtherText'.$cnt2.'" name="Re'.'OtherText'.$cnt2.'" cols=100 rows=1 >'.$Observation[$cnt][8+$cnt2*6].'</textarea>　　</div>';
        echo '</div>';
    }
    
    echo '</div><div class="oneSentence ">　</div><div class="oneSentence textAlignLeft">'.$ObservationNameJP[12][0].$toDoNameJP[$_SESSION["nowToDoView"]-2].$ObservationNameJP[12][1];
    echo '<select id="Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][0].'Select" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][0].'Select" onchange="RetextDisplaySwitch(this.id);">';
    for($cnt2=0;$cnt2<count($ObservationNameJP[13]);$cnt2++){
        $tmp='<option value='.$cnt2;
        if($cnt2==$Observation[$cnt][21]){
            $tmp.=' selected=true';
        }
        $tmp.='>';
        $tmp.=$ObservationNameJP[13][$cnt2];
        $tmp.='</option>';
        echo $tmp;
    }
    echo '</select></div>';
    
    for($cnt2=0;$cnt2<3;$cnt2++){
        echo '<div id="Re'.$ObservationName[2][1+$cnt2*2].'Div" class="';
        if($cnt2==0&&$Observation[$cnt][21]==0){
            echo 'none';
        }else{
            // echo 'oneSentence';    
        }
        echo ' textAlignLeft">'.$ObservationNameJP[14+$cnt2*3][0].'<select id="Re'.$ObservationName[2][1+$cnt2*2].'Select" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][1+$cnt2*2].'" onchange="RetextDisplaySwitch(this.id);">';
        for($cnt3=0;$cnt3<count($ObservationNameJP[15+$cnt2*3]);$cnt3++){
            $tmp='<option value='.$cnt3;
            if($cnt3==$Observation[$cnt][22+$cnt2*2]){
                $tmp.=' selected=true';
            }
            $tmp.='>';
            $tmp.=$ObservationNameJP[15+$cnt2*3][$cnt3];
            $tmp.='</option>';
            echo $tmp;
        }
        echo '</select>　<div id="Re'.$ObservationName[2][2+$cnt2*2].'Div" ';
        if(!$Observation[$cnt][22+$cnt2*2]==$textDisplay[$cnt2+1]){
            echo 'class="none"';
        }else{
            // echo 'class="oneSentence"';                            
        }
        echo '>'.$ObservationNameJP[16+$cnt2*3][0].'<textarea id="Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][2+$cnt2*2].'" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][2+$cnt2*2].'" cols=100 rows=1 ';
        echo ' >'.$Observation[$cnt][23+$cnt2*2].'</textarea></div></div>';

    }
    if($_SESSION["nowToDoView"]==6){
        echo '<div class="oneSentence textAlignLeft">'.$ObservationNameJP[23][0].'<select id="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'TimeZoneSelect" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'TimeZone" >';
        for($cnt2=0;$cnt2<count($ObservationNameJP[24]);$cnt2++){
            $tmp='<option value='.$cnt2;
            if($cnt2==$Observation[$cnt][28]){
                $tmp.=' selected=true';
            }
            $tmp.='>'.$ObservationNameJP[24][$cnt2];
            $tmp.='</option>';
            echo $tmp;
        }
        echo '</select></div>';
    }
    if($_SESSION["nowToDoView"]==7){
        echo '<div class="oneSentence">20単語の書き出し</div>';
        for($cnt2=0;$cnt2<20;$cnt2++){
            if($cnt2%3==0){
                echo '<div class="oneSentence">';
            }
            echo '<textarea id="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt2.'" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt2.'" cols=60 rows=1>'.$Observation[$cnt][29+$cnt2].'</textarea>';
            if(($cnt2+1)%3==0||$cnt2+1==20){
                echo '</div>';
            }
        }
    }
    echo '<input type="hidden" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'Update" value=1>';
    echo '<div class="oneSentence"><input type="button" id="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'Update" name="Re'.$toDoName[$_SESSION["nowToDoView"]-2].'Update" value="変更" onClick="submitClick(this);"></div>';
    echo '<div class="oneSentence ">　</div></form>';
}
if($nowDateToDo[$_SESSION["nowToDoView"]]>0){
echo '<div id="plusObservationMenu">';
echo '<input type="checkbox" id="plusObservationCheck" name="plusObservationCheck" >';
echo '<label id="plusObservationOpen" for="plusObservationCheck"><img src="image/plus.png" alt="追加" width="40" height="40">'.$toDoNameJP[$_SESSION["nowToDoView"]-2].'の追加</label>';
echo '<label id="plusObservationClose" for="plusObservationCheck"></label>';
echo '<form action="observe.php" method="post" id="plusObservationForm">';
$tmp=$daySum+count($Observation)+1;
echo '<div class="oneSentence">累計'.$tmp.'回目　';
if($_SESSION["nowToDoView"]==6){
    if(($tmp)%10==0){
        echo $ObservationNameJP[25][1];
    }else{
        echo $ObservationNameJP[25][0];
    }
}

echo '</div>';
if($_SESSION["nowToDoView"]==7){
    echo '<div class="oneSentence"><ol id="aboutWhatOl">';
    for($cnt=0;$cnt<count($ImaginationTextComplete);$cnt++){
        echo '<li><input type="button" id="aboutWhatButton'.$cnt.'"  cols=200 row=2  value='.$cnt.' class="none" onclick="aboutWhatClick(this.value);"><label for="aboutWhatButton'.$cnt.'" class="canPush">'.$ImaginationTextComplete[$cnt][4].'</label>';
    }
    echo '</ol></div>';
    echo '<select id="aboutWhatSelect" name="aboutWhatSelect" onchange="aboutWhatSelectChange(this.value);">';
    for($cnt=0;$cnt<count($ImaginationTextComplete);$cnt++){
        $tmp=$cnt+1;
        echo '<option  value='.$cnt.'>'.$tmp.'番</option>';
    }
    echo '</select>';
    echo '<div class="oneSentence"><textarea id="aboutWhatText" cols=200 rows=2 disabled=true>'.$ImaginationTextComplete[0][4].'</textarea></div>について想像<br>';
}
for($cnt2=0;$cnt2<2;$cnt2++){
    echo '<div class="inlineBlock textAlignLeft">';
    echo '<div class="oneSentence">'.$ObservationNameJP[0][0].$toDoNameJP[$_SESSION["nowToDoView"]-2].$ObservationNameJP[0][$cnt2+1].'</div>';
    for($cnt3=0;$cnt3<5;$cnt3++){
        echo '<div class="oneSentence">'.$ObservationNameJP[1+$cnt3*2][0];
        if($cnt3==3){
            echo '</div><div class="oneSentence"><select id="'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Select" name="'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Select">';
            for($cnt4=0;$cnt4<count($ObservationNameJP[2+$cnt3*2]);$cnt4++){
                $tmp='<option value='.$cnt4;
                $tmp.='>';
                $tmp.=$ObservationNameJP[2+$cnt3*2][$cnt4];
                $tmp.='</option>';
                echo $tmp;
            }
            echo '</select></div>';
            $textCount++;
        }else{
            for($cnt4=0;$cnt4<count($ObservationNameJP[2+$cnt3*2]);$cnt4++){
                if($cnt4%$columnNum[$cnt3]==0){
                    echo '<div class="oneSentence">';
                }
                echo '<input id="'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'" name="'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'" type="checkbox"';
                if($cnt4==$textCheck[$cnt3]){
                    echo ' onchange="textDisplaySwitch(this.id);"';
                }
                echo '><label for="'.$ObservationName[1][$cnt3].$ObservationName[0][$cnt2].'Check'.$cnt4.'">'.$ObservationNameJP[2+$cnt3*2][$cnt4].'</label>';
                for($cnt5=0;$cnt5<$longestObservationName[$cnt3]-mb_strlen($ObservationNameJP[2+$cnt3*2][$cnt4]);$cnt5++){
                    echo '　';
                }
                if(($cnt4+1)%$columnNum[$cnt3]==0||$cnt4==count($ObservationNameJP[2+$cnt3*2])-1){
                    echo '</div>';
                }
            }
            echo '</div>';
            // echo '<div id="OtherText'.$ObservationName[0][$cnt2].'Div" class="none ">'.$ObservationNameJP[11][0].'<textarea id="OtherText'.$ObservationName[0][$cnt2].'" name="OtherText'.$ObservationName[0][$cnt2].'" cols=80 rows=1 ></textarea>　　';
            echo '<div id="'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'Div" class="none ">'.$ObservationNameJP[11][0].'<textarea id="'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'" name="'.$ObservationName[1][$cnt3].'Text'.$ObservationName[0][$cnt2].'" cols=80 rows=1 ></textarea></div>';

            $textCount+=2;
        }
    }
    echo '</div>';
}

echo '<div class="oneSentence ">　</div><div class="oneSentence textAlignLeft">'.$ObservationNameJP[12][0].$toDoNameJP[$_SESSION["nowToDoView"]-2].$ObservationNameJP[12][1];
echo '<select id="'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][0].'Select" name="'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][0].'" onchange="textDisplaySwitch(this.id);">';
for($cnt2=0;$cnt2<count($ObservationNameJP[13]);$cnt2++){
    $tmp='<option value='.$cnt2;
    $tmp.='>';
    $tmp.=$ObservationNameJP[13][$cnt2];
    $tmp.='</option>';
    echo $tmp;
}
echo '</select></div>';
for($cnt=0;$cnt<3;$cnt++){
    echo '<div id="'.$ObservationName[2][1+$cnt*2].'Div" class="';
    if($cnt==0){
        echo 'none ';
    }else{
        // echo 'oneSentence ';
    }
    echo ' textAlignLeft">'.$ObservationNameJP[14+$cnt*3][0].'<select id="'.$ObservationName[2][1+$cnt*2].'Select" name="'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][1+$cnt*2].'" onchange="textDisplaySwitch(this.id);">';
    for($cnt2=0;$cnt2<count($ObservationNameJP[15+$cnt*3]);$cnt2++){
        $tmp='<option value='.$cnt2;
        $tmp.='>';
        $tmp.=$ObservationNameJP[15+$cnt*3][$cnt2];
        $tmp.='</option>';
        echo $tmp;
    }
    echo '</select>　<div id="'.$ObservationName[2][2+$cnt*2].'Div" class="none">'.$ObservationNameJP[16+$cnt*3][0].'<textarea id="'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][2+$cnt*2].'" name="'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][2+$cnt*2].'" cols=100 rows=1 ></textarea></div></div>';
}
if($_SESSION["nowToDoView"]==6){
    echo '<div class="oneSentence textAlignLeft">'.$ObservationNameJP[23][0].'<select id="'.$toDoName[$_SESSION["nowToDoView"]-2].'TimeZone" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'TimeZone">';
    for($cnt2=0;$cnt2<count($ObservationNameJP[24]);$cnt2++){
        $tmp='<option value='.$cnt2;
        $tmp.='>';
        $tmp.=$ObservationNameJP[24][$cnt2];
        $tmp.='</option>';
        echo $tmp;
    }
    echo '</select></div>';
}
if($_SESSION["nowToDoView"]==7){
    echo '<div class="oneSentence">20単語の書き出し</div>';
    for($cnt2=0;$cnt2<20;$cnt2++){
        if($cnt2%3==0){
            echo '<div class="oneSentence">';
        }
        echo '<textarea id="'.$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt2.'" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt2.'" cols=60 rows=1 ></textarea>';
        if(($cnt2+1)%3==0||$cnt2+1==20){
            echo '</div>';
        }
    }
}
echo '<div class="oneSentence">';
//edit
echo '<input type="hidden" name="'.$toDoName[$_SESSION["nowToDoView"]-2].'Submit" value=1>';
echo '<input type="button" id="'.$toDoName[$_SESSION["nowToDoView"]-2].'SubmitButton"  value="送信" onClick="submitClick(this);">';

echo '　　　　　<label for="plusObservationCheck" class="canPush">閉じる</label></div></form>';

echo '</div>';
}
if($_SESSION["nowToDoView"]==7&&$showImaginationText==1){
    echo '<div id="plusImaginationTextMenu">';
    echo '<input type="checkbox" id="plusImaginationTextCheck" name="plusImaginationTextCheck" >';
    echo '<label id="plusImaginationTextOpen" for="plusImaginationTextCheck"><img src="image/plus.png" alt="追加" width="40" height="40">'.$toDoNameJP[$_SESSION["nowToDoView"]-2].'のための準備</label>';
    echo '<label id="plusImaginationTextClose" for="plusImaginationTextCheck"></label>';
    echo '<form action="observe.php" method="post" id="plusImaginationTextForm">';
    
    for($cnt=0;$cnt<=count($ImaginationText);$cnt++){
        echo '<select id="plusImaginationTextY'.$cnt.'" name="plusImaginationTextY'.$cnt.'">';
        for($cnt2=1970;$cnt2<=$_SESSION['Y'];$cnt2++){
            echo '<option value='.$cnt2;
            if($cnt==count($ImaginationText)){
                if($cnt2==$_SESSION['Y']){
                    echo ' selected=true';
                }
            }else{
                if($cnt2==date('Y',strtotime($ImaginationText[$cnt][2]))){
                    echo ' selected=true';
                }
            }
            echo '>'.$cnt2.'</option>';
        }
        echo '</select>年';
        echo '<select id="plusImaginationTextM'.$cnt.'" name="plusImaginationTextM'.$cnt.'">';
        for($cnt2=1;$cnt2<=12;$cnt2++){
            echo '<option value='.$cnt2;
            if($cnt==count($ImaginationText)){
                if($cnt2==1){
                    echo ' selected=true';
                }
            }else{
                if($cnt2==date('m',strtotime($ImaginationText[$cnt][2]))){
                    echo ' selected=true';
                }
            }
            echo '>'.$cnt2.'</option>';
        }
        echo '</select>月';
        echo '<select id="plusImaginationTextD'.$cnt.'" name="plusImaginationTextD'.$cnt.'">';
        for($cnt2=1;$cnt2<=31;$cnt2++){
            echo '<option value='.$cnt2;
            if($cnt==count($ImaginationText)){
                if($cnt2==1){
                    echo ' selected=true';
                }
            }else{
                if($cnt2==date('d',strtotime($ImaginationText[$cnt][2]))){
                    echo ' selected=true';
                }
            }
            echo '>'.$cnt2.'</option>';
        }
        echo '</select>日<br>';
        echo '<textarea cols=100 rows=2 name="plusImaginationText'.$cnt.'">';
        if($cnt!=count($ImaginationText)){
            echo $ImaginationText[$cnt][4];
        }
        echo'</textarea>';
        echo '<input type="button" id="0ImaginationText'.$cnt.'" onclick="plusImaginationTextDate_check(this)" value="保存">';
        echo '<input type="button" id="1ImaginationText'.$cnt.'" onclick="plusImaginationTextDate_check(this)" value="完成"><br>';
    }

    echo '<label for="plusImaginationTextCheck" class="canPush">閉じる</label>';
    echo '<input type="hidden" name="plusImaginationTextForm" value="送信">';
    echo '<input type="hidden" id="ImaginationTextNum" name="ImaginationTextNum">';
    echo '<input type="hidden" id="ImaginationTextComplete" name="ImaginationTextComplete">';
    echo '</form></div>';
    
}
?>