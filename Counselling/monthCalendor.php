<?php
echo '<form action="observe.php" method="post">';
echo '<textarea name="nowMonthForm" value=1 class="none">1</textarea>';
echo '<table id="monthCal" >';
//該当月の年月表示
echo '<tr>';
echo '<td colspan="7" class="month border">'.$now_monthJP.'</td>';
echo '</tr>';
    
//曜日の表示 日～土
echo '<tr>';
foreach($week as $key => $youbi){
    if($key == 0){ //日曜日
        echo '<th class="border sun" >'.$youbi.'</th>';
    }else if($key == 6){ //土曜日
        echo '<th class="border sat" >'.$youbi.'</th>';
    }else{ //平日
        echo '<th class="border">'.$youbi.'</th>';
    }	
}
echo '</tr>';

//日付表示部分ここから
echo '<tr class="monthCalTr">';
//開始曜日まで日付を進める
for($i=0; $i<$start_week; $i++){
    echo '<td class="border"></td>';
}
//1日～月末までの日付繰り返し
for($i=1; $i<=date("t",strtotime($end_date)); $i++){
    $set_date = date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i);
    $week_date = date("w", strtotime($set_date));
    //土日で色を変える
    if($week_date == 0){
        //日曜日
        echo '<td class="sun border "><button name="day'.$i.'" class="day sun ';
    }else if($week_date == 6){
        //土曜日
        echo '<td class="sat border "><button name="day'.$i.'" class="day sat ';
    }else{
        //平日
        echo '<td class="normDay border "><button name="day'.$i.'" class="day normDay ';
    }	
    echo 'noneBorder overFlowAuto"  value="'.$set_date.'" id="day'.$i.'">'.$i.'<br><br>';
    switch($_SESSION["nowToDoView"]){
    case 1:
        echo $monthContents[$i];
        // $tmpStr='';
        // for($cnt=0; $cnt<count($monthContents[$i]); $cnt++){
        //     $tmpStr.=$monthTimesJP[$i][$cnt][0].'～'.$monthTimesJP[$i][$cnt][1].'<br>';
        //     for($cnt2=3;$cnt2<=5;$cnt2++){    
        //         $tmpStr.=$calNameJP[$cnt2-3].'：'.$monthContents[$i][$cnt][$cnt2].'<br>';
        //     }
        //     for($cnt2=0;$cnt2<count($addicCalNameJP);$cnt2++){ 
        //         if($monthContents[$i][$cnt][6+$cnt2*3]>0){
        //             $tmpStr.=$addicCalNameJP[$cnt2].$addicCalNumName[$monthContents[$i][$cnt][6+$cnt2*3+1]].$addicCalUnitName[$cnt2][$monthContents[$i][$cnt][6+$cnt2*3+2]].' ';
        //         }
        //     }
        //     $tmpStr.='<br>'.$monthContents[$i][$cnt][6+count($addicCalNameJP)*3];
            
        //     if($cnt!=count($monthContents[$i])-1){
        //         $tmpStr.='<br>';
        //     }
        // }
        // echo $tmpStr;
        break;
    case 2:
    case 3:
    case 8:
        for($cnt=0; $cnt<count($monthContents[$i]); $cnt++){
            echo $monthContents[$i][$cnt];
            echo '<br>';
        }
        if($_SESSION["nowToDoView"]==8){
            $tmp=$monthSum+1;
            $tmp2=(int)count($monthContents[$i]);
            $monthSum+=$tmp2;
            if($tmp2==1){
                echo '累計'.$tmp.'回目';
            }else if($tmp2>1){
                echo '累計'.$tmp.'回目～'.$monthSum.'回目';
            }
        }
        break;
    case 4:
    case 5:
    case 6:
    case 7:
    case 9:
        if(count($monthContents[$i])>0){
            echo $monthContents[$i][0].'<br>';
            $tmp=$monthSum+1;
            $tmp2=(int) filter_var($monthContents[$i][0], FILTER_SANITIZE_NUMBER_INT);
            if($_SESSION["nowToDoView"]==5||$_SESSION["nowToDoView"]==9){
                if(!empty($monthContents[$i][0])){
                    $monthSum+=1;
                    echo '累計'.$monthSum.'回目';
                }
            }else{
                $monthSum+=$tmp2;
                if($tmp2==1){
                    echo '累計'.$monthSum.'回目';
                }else if($tmp2>1){
                    echo '累計'.$tmp.'回目～'.$monthSum.'回目';
                }
            }
        }
        break;
    case 10:
        for($cnt=0; $cnt<count($monthContents[$i]); $cnt++){
            echo $monthContents[$i][$cnt][0];
            if($cnt!=count($monthContents[$i])-1){
                echo '<br>';
            }
        }
        break;
    default:
        break;
    }
    
    echo '</button></td>';
    if($week_date == 6 ){
        echo '</tr>';
        if($i!=date("t",strtotime($end_date))){
            echo '<tr class="monthCalTr">';
        }
    }
}

//末日の余りを空白で埋める
if($end_week>0){
    for($i=0; $i<$end_week; $i++){
        echo '<td class="border"></td>';
    }
    echo '</tr>';
}
echo '</table>';
echo '</form>';
?>