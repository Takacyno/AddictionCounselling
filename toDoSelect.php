<?php
echo '<form action="observe.php" method="post" id="nowDateToDo">';
for($cnt=0;$cnt<$toDoNum;$cnt++){
    echo '<div class="oneSentence">';
    echo '<label class="info">'.$toDoNameJP[$cnt];
    for($cnt2=0;$cnt2<$LongestToDoName-mb_strlen($toDoNameJP[$cnt]);$cnt2++){
        echo '　';
    }
    echo'</label>';
    echo '<select disabled=true>';
    for($cnt2=0;$cnt2<$toDoMaxNum[$cnt]+1;$cnt2++){
        $tmp='<option value='.$cnt2;
        if($cnt2==$nowDateToDo[$cnt+2]){
            $tmp.='  selected=true';
        }
        $tmp.='>';
        if($cnt2!==0){
            $tmp.=$cnt2;
        }
        $tmp.='</option>';
        echo $tmp;
    }
    echo '</select>';
    echo '</div>';
    
}
// echo '<input type="submit" name="toDoSubmit">';
echo '</form>';
if($_SESSION['dDelay']>=0){
    
    // echo '<div id="nowDateToDoDefault">';
    //     echo 'デフォルトの値を入れる<br><select id="toDoDefaultSelect" name="toDoDefaultSelect">';
    //         echo '<option value=0></option>';
    //             for($cnt=1;$cnt<count($toDoDefault);$cnt++){
    //                 echo '<option value='.$cnt.'>week'.$cnt.'</option>';
    //             }
    //             echo '<option value='.count($toDoDefault).'>After</option>';
    //     echo '</select><br>';
    //     echo '<input type="button" onclick="toDoDefault_click()" value="セットする">';
    // echo '</div>';
    echo '<form action="observe.php" method="post" id="toDoProcessForm" class="inlineBlock">';
    $nowProcessNum=0;
    if($startProcess[4]==1){
        if($startProcess[6]==1){
            if($startProcess[7]==1){
                if($finishProcess[1]==0){
                    echo '維持ステージの開始日を変更する';
                    echo '<input type="hidden" id="toDoDateChange" name="toDoDateChange" value=1>';
                    $nowProcessNum=1;
                }else{
                    goto SkipToDoDateSelect;
                }
            }else{
                echo '想像の開始日を変更する';
                echo '<input type="hidden" id="toDoDateChange" name="toDoDateChange" value=7>';
                $nowProcessNum=7;
            }
        }else{
            echo '疑似行為の開始日を変更する';
            echo '<input type="hidden" id="toDoDateChange" name="toDoDateChange" value=6>';
            $nowProcessNum=6;
        }
    }else{
        if($startProcess[1]==1){
            echo '制御刺激の開始日を変更する';
            echo '<input type="hidden" id="toDoDateChange" name="toDoDateChange" value=4>';
            $nowProcessNum=4;
        }else{
            goto SkipToDoDateSelect;
        }
    }

    echo '<br><select id="toDoY" name="toDoY">';
    echo '<option value='.$_SESSION['Y'];
    if($nowProcessNum==1){
        if(date('Y',strtotime($finishProcessDate[$nowProcessNum]))==$_SESSION['Y']){
            echo ' selected=true';
        }
    }else{
        if(date('Y',strtotime($startProcessDate[$nowProcessNum]))==$_SESSION['Y']){
            echo ' selected=true';
        }
    }
    echo '>'.$_SESSION['Y'].'</option>';
    $tmp=$_SESSION['Y']+1;
    echo '<option value='.$tmp;
    if($nowProcessNum==1){
        if(date('Y',strtotime($finishProcessDate[$nowProcessNum]))==$tmp){
            echo ' selected=true';
        }
    }else{
        if(date('Y',strtotime($startProcessDate[$nowProcessNum]))==$tmp){
            echo ' selected=true';
        }
    }
    echo '>'.$tmp.'</option>';
    echo '</select>年';
    echo '<select id="toDoM" name="toDoM">';
    for($cnt=1;$cnt<=12;$cnt++){
        echo '<option value='.$cnt;
        if($nowProcessNum==1){
            if(date('m',strtotime($finishProcessDate[$nowProcessNum]))==$cnt){
                echo ' selected=true';
            }
        }else{
            if(date('m',strtotime($startProcessDate[$nowProcessNum]))==$cnt){
                echo ' selected=true';
            }
        }
        echo '>'.$cnt.'</option>';
    }
    echo '</select>月';
    echo '<select id="toDoD" name="toDoD">';
    for($cnt=1;$cnt<=31;$cnt++){
        echo '<option value='.$cnt;
        if($nowProcessNum==1){
            if(date('d',strtotime($finishProcessDate[$nowProcessNum]))==$cnt){
                echo ' selected=true';
            }
        }else{
            if(date('d',strtotime($startProcessDate[$nowProcessNum]))==$cnt){
                echo ' selected=true';
            }
        }
        echo'>'.$cnt.'</option>';
    }
    echo '</select>日';
    echo '<input type="button" onclick="toDoDate_check(this)" value="送信">';
    SkipToDoDateSelect:
    echo '</form>';
}

?>