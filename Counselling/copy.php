<?php
    session_start();
    $DBhost='133.18.244.234';
    $DBusername='home10';
    $DBpassword='8940hakuyo';
    $link=mysqli_connect($DBhost,$DBusername,$DBpassword);
    $db=mysqli_select_db($link,"takayuki");
    $query='SELECT * from aboutDB;';
    $AddicNum='';
    $hospitalNum='';
    $err_msg=array();
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_assoc($result);
    $addicNum=(int)$row["AddicNum"];
    $hospitalNum=(int)$row["HospitalNum"];
    class Patient{
        public $ID;
        public $Allname;
        public $Hospital;
        public $Age;
        public $Sex;
        public $Counsellors=array();
        public $PersonalRelations;
        public $Residence;
        public $RhythmOfLife;
        public $Interests;
        public $Profession;
        public $WorkExp;
        public $HarshChildhoodExp;
        public $CriminalRecord;
        public $OtherTraumas;
        public $Supplement;
        public $Addictions;
    }
    $query='SELECT * from PatientData where ID="'.$_SESSION['PatientID'].'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_assoc($result);
    $patient=new Patient();
    $patient->ID=$row["ID"];
    $patient->Allname=$row["Allname"];
    $patient->Hospital=$row["Hospital"];
    $patient->Age=$row["Age"];
    $patient->Sex=$row["Sex"];
    for($cnt=0;$cnt<mb_strlen($row["Counsellors"])/10;$cnt++){
        $query2='SELECT Allname from CounsellorData where ID=\''.mb_substr($row["Counsellors"],$cnt*10,10).'\';';
        if(!($result2=mysqli_query($link,$query2))){
            goto SQLerror;
        }
        $row2=mysqli_fetch_assoc($result2);
        array_push($patient->Counsellors,$row2["Allname"]);
    }
    $patient->PersonalRelations=$row["PersonalRelations"];
    $patient->Residence=$row["Residence"];
    $patient->RhythmOfLife=$row["RhythmOfLife"];
    $patient->Interests=$row["Interests"];
    $patient->Profession=$row["Profession"];
    $patient->WorkExp=$row["WorkExp"];
    $patient->HarshChildhoodExp=$row["HarshChildhoodExp"];
    $patient->CriminalRecord=$row["CriminalRecord"];
    $patient->OtherTraumas=$row["OtherTraumas"];
    $patient->Supplement=$row["Supplement"];
    $patient->Addictions=$row["Addictions"];
    for($cnt=0;$cnt<$addicNum;$cnt++){
        if((int)substr($patient->Addictions,$cnt,1)>0){
            array_push($patientData[$cnt],$patient);
        }
    }
    
    $now_month_eng='y'.date("Y").'m'.date("n");
    $dayNum=date("t");
    $monthData=array();
    $dayName='';
    $checkNums=array();
    $MaxCheck=30;
    if($result=mysqli_query($link,$query)){
        $row = mysqli_fetch_assoc($result);
        foreach($row as $rowInRow){
            array_push($column,$rowInRow);
        }
        $ID=$column[0];
        $class=$column[1];
        $rank=$column[2];
        $Allname=$column[3];
        $emil=$column[5];
        $region=$column[6];
        for($cnt=0;$cnt<$AddicNum;$cnt++){
            array_push($addiction,$column[7+$cnt]);
            array_push($monthData,['']);
            if($addiction[$cnt]==1){
                $query='SELECT checkNum from about'.$addicNameEng[$cnt].' where ID=1;';
                if($result=mysqli_query($link,$query)){
                    $row = mysqli_fetch_assoc($result);
                    array_push($checkNums,$row["checkNum"]);
                    for($cnt2=1;$cnt2<=$dayNum;$cnt2++){
                        $dayName=$now_month_eng.'d'.$cnt2;
                        $query='SELECT '.$dayName.' from '.$addicNameEng[$cnt].'Data where ID="'.$ID.'";';
                        if($result=mysqli_query($link,$query)){
                            $row = mysqli_fetch_assoc($result);
                            array_push($monthData[$cnt],$row["$dayName"]);
                        }else{
                            echo "Error".mysqli_error($link);    
                        }
                    }
                }else{
                    echo "Error".mysqli_error($link);    
                }    
                
            }else{
                array_push($checkNums,0);
            }
        }
    }else{
        echo "Error".mysqli_error($link);    
    }
    $err_msg=array();
    $week = array('日','月','火','水','木','金','土');
    $now_month = date("Y年n月"); //表示する年月
    $start_date = date('Y-m-01'); //開始の年月日
    $end_date = date("Y-m-t"); //終了の年月日
    $start_week = date("w",strtotime($start_date)); //開始の曜日の数字
    $end_week = 6 - date("w",strtotime($end_date)); //終了の曜日の数字
    $addicCheckName=[
        ['beer','hiball'],
        ['derby']
    ];
    $nowAddic=-1;
    SQLerror:
        if(!empty(mysqli_error($link))){
            echo "Error".mysqli_error($link);    
        }
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <style>
        .hidden{
            display:none;
        }
    </style>
    <link rel="stylesheet" href="style/observe.css">
</head>
<body>
    <div id="humMenu">
        <input id="humCheck" type="checkbox">
        <label id="humOpen" for="humCheck"><img src="image/bars_24.png" alt="メニュー" width="68" height="56"></label>
        <label id="humClose" for="humCheck"></label>
        <nav class="nav1">
        <ol class="inner">
            <li id="addicLi0" class="hidden"><input type="button" class="addicBtn" id="addicBtn0" onclick="nav_click(this.id)" value=<?php echo $addicName[0];?>>
            <li id="addicLi1" class="hidden"><input type="button" class="addicBtn" id="addicBtn1" onclick="nav_click(this.id)" value=<?php echo $addicName[1];?>>
        </ol>
        </nav>
    </div>
    <div id="AddicMenu">
        <input id="humCheck2" type="checkbox">
        <label id="humOpen2" for="humCheck2"><img src="image/bars_24.png" alt="メニュー" width="68" height="56"></label>
        <label id="humClose2" for="humCheck2"></label>
        <nav class="nav2">
        <ol class="inner">
            <li id="addicLi0" class="hidden"><input type="button" class="addicBtn" id="addicBtn0" onclick="nav_click(this.id)" value=<?php echo $addicName[0];?>>
            <li id="addicLi1" class="hidden"><input type="button" class="addicBtn" id="addicBtn1" onclick="nav_click(this.id)" value=<?php echo $addicName[1];?>>
        </ol>
        </nav>
    </div>
    <div class="parent">
        <div class="child">
            <div id="calendar" class="calendar">
                <h2 id="addicTitle"></h2>
            <?php
                echo '<table class="cal" border="1">';
                //該当月の年月表示
                echo '<tr>';
                echo '<td colspan="7" class="center">'.$now_month.'</td>';
                echo '</tr>';
                    
                //曜日の表示 日～土
                echo '<tr>';
                foreach($week as $key => $youbi){
                    if($key == 0){ //日曜日
                        echo '<th class="sun">'.$youbi.'</th>';
                    }else if($key == 6){ //土曜日
                        echo '<th class="sat">'.$youbi.'</th>';
                    }else{ //平日
                        echo '<th>'.$youbi.'</th>';
                    }	
                }
                echo '</tr>';
                
                //日付表示部分ここから
                echo '<tr>';
                //開始曜日まで日付を進める
                for($i=0; $i<$start_week; $i++){
                    echo '<td></td>';
                }
                
                //1日～月末までの日付繰り返し
                for($i=1; $i<=date("t"); $i++){
                    $set_date = date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i);
                    $week_date = date("w", strtotime($set_date));
                    //土日で色を変える
                    if($week_date == 0){
                        //日曜日
                        echo '<td class="sun">
                                <input type="button" name="days[]" class="day" class="sun" onclick="day_click(this.value)" value="'.$i.'" id="day'.$i.'">
                            </td>';
                            // <label for="day'.$i.'" class="sun">'.$i.'</label>
                    }else if($week_date == 6){
                        //土曜日
                        echo '<td class="sat">
                                <input type="button" name="days[]" class="day" class="sat" onclick="day_click(this.value)" value="'.$i.'" id="day'.$i.'">
                            </td>';
                            // <label for="day'.$i.'" class="sat">'.$i.'</label>
                    }else{
                        //平日
                        echo '<td class="normDay">
                                <input type="button" name="days[]" class="day" class="normDay" onclick="day_click(this.value)" value="'.$i.'" id="day'.$i.'">
                            </td>';
                            // <label for="day'.$i.'" class="normDay">'.$i.'</label>
                    }	
                    if($week_date == 6){
                        echo '</tr>';
                        echo '<tr>';
                    }
                }
                
                //末日の余りを空白で埋める
                for($i=0; $i<$end_week; $i++){
                    echo '<td></td>';
                }
                
                echo '</tr>';
                echo '</table>';
            ?>
            </div>
            <div id="forms" class="forms">
                <div id="addicForm0" class="hidden">
                <form action="userPage.php" method="post">
                    <div class="form"><input type="text" name="addicText0" id="addicText0" class="hidden"><h3 id="addicHeader0"></h3></div>
                    <div class="form">                     
                    <input type="checkbox"  onclick="check_click(this.id)" name="beerCheck" value="1" id="beerCheck" disabled=true>
                    <label for="beerCheck">ビール</label>
                    <div id="beerSelectSet" class="hidden" >
                    <div class="err_msg"><?php echo $err_msg['beerSelect']; ?></div>
                    <select name="beerSelect" id="beerSelect" disabled=true>
                        <option value=0></option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                        <option value=9>9</option>
                    </select>
                    <label for="beerSelect">杯</label>
                    </div>
                    </div>
                    <div class="form">
                    <input type="checkbox"  onclick="check_click(this.id)" name="hiballCheck" value="1" id="hiballCheck" disabled=true>
                    <label for="hiballCheck">ハイボール</label>
                    <div id="hiballSelectSet" class="hidden" >
                    <div class="err_msg"><?php echo $err_msg['hiballSelect']; ?></div>
                    <select name="hiballSelect" id="hiballSelect" disabled=true>
                        <option value=0></option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                        <option value=4>4</option>
                        <option value=5>5</option>
                        <option value=6>6</option>
                        <option value=7>7</option>
                        <option value=8>8</option>
                        <option value=9>9</option>
                    </select>
                    <label for="beerSelect">杯</label>
                    </div>
                    </div>
                    <div class="form">
                    </div>
                    
                </form>
                </div>
                <div id="addicForm1" class="hidden">
                <form action="userPage.php" method="post">
                    <div class="form"><input type="text" name="addicText1" id="addicText1" class="hidden"><h3 id="addicHeader1"></h3></div>
                    <div class="form">
                    <input type="checkbox" onclick="check_click(this.id)" name="derbyCheck" value="1" id="derbyCheck" disabled=true>
                    <label for="derbyCheck">競馬</label>
                    <div id="derbySelectSet" class="hidden" >
                    <div class="err_msg"><?php echo $err_msg['derbySelect']; ?></div>
                    <select name="derbySelect" id="derbySelect" disabled=true>
                        <option value=0></option>
                        <option value=1>1～1千</option>
                        <option value=2>1千～1万</option>
                        <option value=3>1万～5万</option>
                        <option value=4>5万～10万</option>
                        <option value=5>10万～50万</option>
                        <option value=6>50万～100万</option>
                        <option value=7>100万～500万</option>
                        <option value=8>500万～1000万</option>
                        <option value=9>1000万～</option>
                    </select>
                    <label for="derbySelect">円</label>
                    </div>
                    </div>
                    <div class="form">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var addicName=<?php $json_addicName=json_encode($addicName); echo $json_addicName; ?>;
        var addicCheckName=<?php $json_addicCheckName=json_encode($addicCheckName); echo $json_addicCheckName; ?>;
        var liNum=<?php echo $AddicNum; ?>;
        var addictions=<?php $json_addiction=json_encode($addiction); echo $json_addiction; ?>;
        var nowAddic=<?php $json_nowAddic=json_encode($nowAddic); echo $json_nowAddic; ?>;
        var dayNum=<?php $json_dayNum=json_encode($dayNum); echo $json_dayNum; ?>;
        var checkNums=<?php $json_checkNums=json_encode($checkNums); echo $json_checkNums; ?>;
        var monthData=<?php $json_monthData=json_encode($monthData); echo $json_monthData; ?>;
        var addicNameEng=<?php $json_addicNameEng=json_encode($addicNameEng); echo 
        $addicNameEng; ?>;
        var MaxCheck=<?php $json_MaxCheck=json_encode($MaxCheck); echo $MaxCheck; ?>;
        if(nowAddic>=0){
            document.getElementById("addicTitle").textContent=addicName[nowAddic];
        }
        for(var i=0;i<liNum;i++){
            var liID="addicLi"+i;
            if(addictions[i]==1){
                if(nowAddic<0){
                    document.getElementById("addicTitle").textContent=addicName[i];
                    nowAddic=i;
                }
                document.getElementById(liID).classList.toggle("hidden");
            }
        }
        
        function day_click(clickedDay){
            var nowAddicForm="addicForm"+nowAddic;
            if(document.getElementById(nowAddicForm).classList.contains("hidden")){
                document.getElementById(nowAddicForm).classList.remove("hidden");
            }
            var addicHeader="addicHeader"+nowAddic;
            var addicText="addicText"+nowAddic;
            document.getElementById(addicHeader).textContent="<?php echo $now_month;?>"+clickedDay+"日";
            document.getElementById(addicText).value=clickedDay;
            
            for(var i=0;i<checkNums[nowAddic];i++){
                var addicCheck=addicCheckName[nowAddic][i]+"Check";
                var addicSelect=addicCheckName[nowAddic][i]+"Select";
                var addicValue=Number(monthData[nowAddic][Number(clickedDay)].substr(Number(i),1));
                var clickedCheck=addicSelect+"Set";
                if(addicValue>0){
                    document.getElementById(addicCheck).checked=true;
                    if(document.getElementById(clickedCheck).classList.contains("hidden")){
                        document.getElementById(clickedCheck).classList.remove("hidden"); 
                    }       
                    document.getElementById(addicSelect).options[addicValue].selected=true;
                }else{
                    document.getElementById(addicCheck).checked=false;
                    if(!document.getElementById(clickedCheck).classList.contains("hidden")){
                        document.getElementById(clickedCheck).classList.add("hidden"); 
                    }   
                    document.getElementById(addicSelect).options[0].selected=true;
                }
            }
        }
        function check_click(id){
            var clickedSelect=id.slice(0,-5)+"Select";
            var clickedSelectSet=clickedSelect+"Set";
            if(document.getElementById(clickedSelectSet).classList.contains("hidden")){
                document.getElementById(clickedSelectSet).classList.remove("hidden");    
            }else{
                document.getElementById(clickedSelectSet).classList.add("hidden");
                document.getElementById(clickedSelect).value=0;
            }
            
        }
        function nav_click(id){
            var nowAddicForm="addicForm"+nowAddic;
            var hiddenOrNot=0;
            if(document.getElementById(nowAddicForm).classList.contains("hidden")){
                hiddenOrNot=1;
            }else{
                document.getElementById(nowAddicForm).classList.add("hidden");
            }
            
            nowAddic=Number(id.substr(-1,1));
            document.getElementById("addicTitle").textContent=addicName[nowAddic];
            nowAddicForm="addicForm"+nowAddic;
            if(document.getElementById(nowAddicForm).classList.contains("hidden")&&hiddenOrNot==0){
                document.getElementById(nowAddicForm).classList.remove("hidden");
            }
        }
    </script>
</body>
</html>

