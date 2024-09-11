<?php
$todayContentsIdx=0;
echo '<table id="dayCal" >';
echo '<tr><th></th><th>'.$now_dateJP.'('.$week[$now_week].')</th></tr>';
if($dayFullOrNot[0]==0){
    echo '<tr><td></td><td class="borderObottom "></td></tr>';
}else{
    $tmpStr='<tr><td></td><td rowspan="'.$dayFullOrNot[0].'" class="filledTime"><button class="filledTimeBtn" name="schedule'.$todayContentsIdx.'" onclick="schedule_click(this.value)"  value='.$todayContentsIdx.'>';
    $tmpStr.=$dayTimeJP[$todayContentsIdx][0].'～'.$dayTimeJP[$todayContentsIdx][1].'<br>';
    for($cnt2=3;$cnt2<=5;$cnt2++){    
        $tmpStr.=$calNameJP[$cnt2-3].'：'.$todayContents[$todayContentsIdx][$cnt2].'<br>';
    }
    for($cnt2=0;$cnt2<count($addicCalNameJP);$cnt2++){ 
        if($todayContents[$todayContentsIdx][6+$cnt2*3]>0){
            $tmpStr.=$addicCalNameJP[$cnt2].$addicCalNumName[$todayContents[$todayContentsIdx][6+$cnt2*3+1]].$addicCalUnitName[$cnt2][$todayContents[$todayContentsIdx][6+$cnt2*3+2]].' ';
        }
    }
    $tmpStr.='<br>'.$todayContents[$todayContentsIdx][6+count($addicCalNameJP)*3].'</button></td></tr>';
    echo $tmpStr;
    $todayContentsIdx++;
}
for($cnt=1;$cnt<3;$cnt++){
    if($dayFullOrNot[$cnt]==-1){
        echo '<tr><td></td></tr>';
    }else if($dayFullOrNot[$cnt]==0){
        echo '<tr><td></td><td class="notFilledTime"></td></tr>';
    }else{
        $tmpStr='<tr><td></td><td rowspan="'.$dayFullOrNot[$cnt].'" class="filledTime"><button class="filledTimeBtn" name="schedule'.$todayContentsIdx.'" onclick="schedule_click(this.value)"  value='.$todayContentsIdx.'>';
        $tmpStr.=$dayTimeJP[$todayContentsIdx][0].'～'.$dayTimeJP[$todayContentsIdx][1].'<br>';
        for($cnt2=3;$cnt2<=5;$cnt2++){
            $tmpStr.=$calNameJP[$cnt2-3].'：'.$todayContents[$todayContentsIdx][$cnt2].'<br>';
        }
        for($cnt2=0;$cnt2<count($addicCalNameJP);$cnt2++){ 
            if($todayContents[$todayContentsIdx][6+$cnt2*3]>0){
                $tmpStr.=$addicCalNameJP[$cnt2].$addicCalNumName[$todayContents[$todayContentsIdx][6+$cnt2*3+1]].$addicCalUnitName[$cnt2][$todayContents[$todayContentsIdx][6+$cnt2*3+2]].' ';
            }
        }
        $tmpStr.='<br>'.$todayContents[$todayContentsIdx][6+count($addicCalNameJP)*3].'</button></td></tr>';
        echo $tmpStr;
        $todayContentsIdx++;
    }
}
for($cnt=3;$cnt<=140;$cnt++){
    if($dayFullOrNot[$cnt]==-1){
        if($cnt%6==3){
            $tmp=($cnt+3)/6;
            echo '<tr><td rowspan="6" class="textRight">'.$tmp.'時</td></tr>';
        }else{
            echo '<tr></tr>';
        }
    }else if($dayFullOrNot[$cnt]==0){
        if($cnt%6==3){
            $tmp=($cnt+3)/6;
            echo '<tr><td rowspan="6" class="textRight">'.$tmp.'時</td><td class="notFilledTime"></td></tr>';
        }else{
            echo '<tr><td class="notFilledTime"></td></tr>';
        }
    }else{
        if($cnt%6==3){
            $tmp=($cnt+3)/6;
            $tmpStr='<tr><td rowspan="6" class="textRight">'.$tmp.'時</td><td rowspan="'.$dayFullOrNot[$cnt].'" class="filledTime">';
        }else{
            $tmpStr='<tr><td rowspan="'.$dayFullOrNot[$cnt].'" class="filledTime">';
        }
        $tmpStr.='<button class="filledTimeBtn" name="schedule'.$todayContentsIdx.'" onclick="schedule_click(this.value)"  value='.$todayContentsIdx.'>';
        $tmpStr.=$dayTimeJP[$todayContentsIdx][0].'～'.$dayTimeJP[$todayContentsIdx][1].'<br>';
        for($cnt2=3;$cnt2<=5;$cnt2++){    
            $tmpStr.=$calNameJP[$cnt2-3].'：'.$todayContents[$todayContentsIdx][$cnt2].'<br>';
        }
        for($cnt2=0;$cnt2<count($addicCalNameJP);$cnt2++){ 
            if($todayContents[$todayContentsIdx][6+$cnt2*3]>0){
                $tmpStr.=$addicCalNameJP[$cnt2].$addicCalNumName[$todayContents[$todayContentsIdx][6+$cnt2*3+1]].$addicCalUnitName[$cnt2][$todayContents[$todayContentsIdx][6+$cnt2*3+2]].' ';
            }
        }
        $tmpStr.='<br>'.$todayContents[$todayContentsIdx][6+count($addicCalNameJP)*3].'</button></td></tr>';
        echo $tmpStr;
        $todayContentsIdx++;
    }
}
for($cnt=141;$cnt<143;$cnt++){
    if($dayFullOrNot[$cnt]==-1){
        echo '<tr><td></td></tr>';
    }else if($dayFullOrNot[$cnt]==0){
        echo '<tr><td></td><td class="notFilledTime"></td></tr>';
    }else{
        $tmpStr='<tr><td></td><td rowspan="'.$dayFullOrNot[143].'" class="filledTime"><button class="filledTimeBtn" name="schedule'.$todayContentsIdx.'" onclick="schedule_click(this.value)"  value='.$todayContentsIdx.'>';
        $tmpStr.=$dayTimeJP[$todayContentsIdx][0].'～'.$dayTimeJP[$todayContentsIdx][1].'<br>';
        for($cnt2=3;$cnt2<=5;$cnt2++){    
            $tmpStr.=$calNameJP[$cnt2-3].'：'.$todayContents[$todayContentsIdx][$cnt2].'<br>';
        }
        for($cnt2=0;$cnt2<count($addicCalNameJP);$cnt2++){ 
            if($todayContents[$todayContentsIdx][6+$cnt2*3]>0){
                $tmpStr.=$addicCalNameJP[$cnt2].$addicCalNumName[$todayContents[$todayContentsIdx][6+$cnt2*3+1]].$addicCalUnitName[$cnt2][$todayContents[$todayContentsIdx][6+$cnt2*3+2]].' ';
            }
        }
        $tmpStr.='<br>'.$todayContents[$todayContentsIdx][6+count($addicCalNameJP)*3].'</button></td></tr>';
        echo $tmpStr;
        $todayContentsIdx++;
    }
}
if($dayFullOrNot[143]==-1){
    echo '<tr><td></td></tr>';
}else if($dayFullOrNot[143]==0){
    echo '<tr><td></td><td class="borderOtop "></td></tr>';
}else{
    echo '<tr><td></td><td rowspan="'.$dayFullOrNot[143].'" class="filledTime"><button class="filledTimeBtn" name="time'.$cnt.'" onclick="schedule_click(this.value)" value='.$todayContentsIdx.'></button></td></tr>';
    echo $tmpStr;
    $todayContentsIdx++;
}
echo '</table>';
echo '<div id="plusMenu">';
    echo '<input type="checkbox" id="plusCheck" name="plusCheck" >';
    echo '<label id="plusOpen" for="plusCheck"><img src="image/plus.png" alt="追加" width="40" height="40"></label>';
    echo '<label id="plusClose" for="plusCheck"></label>';
    echo '<form action="observe.php" method="post" id="calPlusForm">';
    echo '<div class="oneSentence">';
    echo '<select id="startHourSelect" name="startHourSelect">';
        for($cnt=0;$cnt<24;$cnt++){
            echo '<option value='.$cnt.'>今日の'.$cnt.'</option>';
        }
    echo '</select>時';
    echo '<select id="startMinuteSelect" name="startMinuteSelect">';
        for($cnt=0;$cnt<6;$cnt++){
            $tmp=$cnt*10;
            echo '<option value='.$cnt.'>'.$tmp.'</option>';
        }
    echo '</select>分～';
    echo '<select id="endHourSelect" name="endHourSelect">';
        for($cnt=0;$cnt<24;$cnt++){
            echo '<option value='.$cnt.'>今日の'.$cnt.'</option>';
        }
        for($cnt=0;$cnt<24;$cnt++){
            $tmp=24+$cnt;
            echo '<option value='.$tmp.'>明日の'.$cnt.'</option>';
        }
    echo '</select>時';
    echo '<select id="endMinuteSelect" name="endMinuteSelect">';
        for($cnt=0;$cnt<6;$cnt++){
            $tmp=$cnt*10;
            echo '<option value='.$cnt.'>'.$tmp.'</option>';
        }
    echo '</select>分';
    echo '</div>';
    for($cnt=0;$cnt<3;$cnt++){
        echo '<div class="oneSentence">';
        echo $calNameJP[$cnt];
        echo '<textarea id="'.$calName[$cnt].'Plus" name="'.$calName[$cnt].'Plus" cols="50" rows="1"></textarea></div>';
    }
    for($cnt=0;$cnt<count($addicCalNameJP);$cnt++){ 
        echo '<div class="oneSentence">';
        echo $addicCalNameJP[$cnt];
        for($cnt2=0;$cnt2<6-mb_strlen($addicCalNameJP[$cnt]);$cnt2++){ 
            echo '　';
        }
        echo '<input type="checkbox" id="plusCheck'.$cnt.'" name="plusCheck'.$cnt.'" onclick="addicPlus_click(this.id)" class="plusBtn" value=1>';
        echo '<select id="plusNumSelect'.$cnt.'" name="plusNumSelect'.$cnt.'" class="plusBtn none">';
            for($cnt2=0;$cnt2<count($addicCalNumName);$cnt2++){
                echo '<option value='.$cnt2.'>'.$addicCalNumName[$cnt2].'</option>';
            }
        echo '</select>';
        echo '<select id="plusUnitSelect'.$cnt.'" name="plusUnitSelect'.$cnt.'" class="plusBtn none">';
            for($cnt2=0;$cnt2<count($addicCalUnitName[$cnt]);$cnt2++){
                echo '<option value='.$cnt2.'>'.$addicCalUnitName[$cnt][$cnt2].'</option>';
            }
        echo '</select>';
        echo '</div>';
    }
    echo '<div class="oneSentence">補足<textarea id="OtherPlus" name="OtherPlus" cols="50" rows="1"></textarea></div>';
    echo '<input type="text" name="plusOk" type="button" class="none" value="1">';
    echo '<input id="plusSubmit" name="plusSubmit" type="button" onclick="check_time(this)" value="追加">　';
    echo '<label  for="plusCheck" class="canPush">閉じる</label>';
    echo '</form>';
echo '</div>';

echo '<div id="plusUpdateMenu">';
    echo '<input type="checkbox" id="plusUpdateCheck" name="plusUpdateCheck" >';
    echo '<label id="plusUpdateClose" for="plusUpdateCheck"></label>';
    echo '<form action="observe.php" method="post" id="calplusUpdateForm">';
    echo '<div class="oneSentence">';
    echo '<select id="startHourUpdateSelect" name="startHourUpdateSelect">';
        for($cnt=0;$cnt<24;$cnt++){
            echo '<option value='.$cnt.'>今日の'.$cnt.'</option>';
        }
    echo '</select>時';
    echo '<select id="startMinuteUpdateSelect" name="startMinuteUpdateSelect">';
        for($cnt=0;$cnt<6;$cnt++){
            $tmp=$cnt*10;
            echo '<option value='.$cnt.'>'.$tmp.'</option>';
        }
    echo '</select>分～';
    echo '<select id="endHourUpdateSelect" name="endHourUpdateSelect">';
        for($cnt=0;$cnt<24;$cnt++){
            echo '<option value='.$cnt.'>今日の'.$cnt.'</option>';
        }
        for($cnt=0;$cnt<24;$cnt++){
            $tmp=24+$cnt;
            echo '<option value='.$tmp.'>明日の'.$cnt.'</option>';
        }
    echo '</select>時';
    echo '<select id="endMinuteUpdateSelect" name="endMinuteUpdateSelect">';
        for($cnt=0;$cnt<6;$cnt++){
            $tmp=$cnt*10;
            echo '<option value='.$cnt.'>'.$tmp.'</option>';
        }
    echo '</select>分';
    echo '</div>';
    for($cnt=0;$cnt<count($calName);$cnt++){
        echo '<div class="oneSentence">';
        echo $calNameJP[$cnt];
        echo '<textarea id="'.$calName[$cnt].'PlusUpdate" name="'.$calName[$cnt].'PlusUpdate" cols="50" rows="1"></textarea></div>';
    }
    for($cnt=0;$cnt<count($addicCalNameJP);$cnt++){ 
        echo '<div class="oneSentence">';
        echo $addicCalNameJP[$cnt];
        for($cnt2=0;$cnt2<6-mb_strlen($addicCalNameJP[$cnt]);$cnt2++){ 
            echo '　';
        }
        echo '<input type="checkbox" id="plusUpdateCheck'.$cnt.'" name="plusUpdateCheck'.$cnt.'" onclick="addicPlusUpdate_click(this.id)" class="plusUpdateBtn" value=1>';
        echo '<select id="plusUpdateNumSelect'.$cnt.'" name="plusUpdateNumSelect'.$cnt.'" class="plusUpdateBtn none">';
            for($cnt2=0;$cnt2<count($addicCalNumName);$cnt2++){
                echo '<option value='.$cnt2.'>'.$addicCalNumName[$cnt2].'</option>';
            }
        echo '</select>';
        echo '<select id="plusUpdateUnitSelect'.$cnt.'" name="plusUpdateUnitSelect'.$cnt.'" class="plusUpdateBtn none">';
            for($cnt2=0;$cnt2<count($addicCalUnitName[$cnt]);$cnt2++){
                echo '<option value='.$cnt2.'>'.$addicCalUnitName[$cnt][$cnt2].'</option>';
            }
        echo '</select>';
        echo '</div>';
    }
    echo '<div class="oneSentence">補足<textarea id="OtherPlusUpdate" name="OtherPlusUpdate" cols="50" rows="1"></textarea></div>';
    echo '<input type="text" id="plusUpdateOk" name="plusUpdateOk" class="none" value="1">';
    echo '<input id="plusUpdateSubmit" name="plusUpdateSubmit" type="button" onclick="check_updateTime(this)" value="変更">　';
    echo '<label  for="plusUpdateCheck" class="canPush">閉じる</label>';
    echo '</form>';
echo '</div>';
?>