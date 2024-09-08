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
    $addicName=array();
    $addicNameJP=array();
    $hospitalName=array();
    $calViewName=array();
    $calViewNameJP=array();
    $file=fopen('text/addicName.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($addicName,$lineContents[0]);
        array_push($addicNameJP,$lineContents[1]);
    }
    fclose($file);
    $query='SELECT HospitalName from aboutHospital;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($hospitalName,$row["HospitalName"]);
    }
    $query='SELECT * from aboutCalView;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($calViewName,$row["CalViewName"]);
        array_push($calViewNameJP,$row["CalViewNameJP"]);
    }
    $calViewNum=count($calViewName);
    if(empty($_SESSION["nowAddic"])){
        $_SESSION["nowAddic"]=0;
    }
    if(empty($_SESSION["nowCalView"])){
        $_SESSION["nowCalView"]=1;
    }
    if(empty($_SESSION["nowToDoView"])){
        $_SESSION["nowToDoView"]=1;
    }
    if(empty($_SESSION["m"])){
        $_SESSION["m"]=date("n");
    }
    if(empty($_SESSION["d"])){
        $_SESSION["d"]=date("d");
    }
    if(empty($_SESSION["Y"])){
        $_SESSION["Y"]=date("Y");
    }
    if(empty($_SESSION["dDelay"])){
        $_SESSION["dDelay"]=0;
    }
    if(empty($_SESSION["mDelay"])){
        $_SESSION["mDelay"]=0;
    }
    $today=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],$_SESSION["Y"]));
    $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
    $file=fopen('text/toDoName.txt','r');
    $line=substr(fgets($file),0,-1);
    $toDoName=explode(" ",$line);
    $toDoNum=count($toDoName);
    $line=substr(fgets($file),0,-1);
    $toDoNameJP=explode(" ",$line);
    $LongestToDoName=4;
    for($cnt=0;$cnt<$toDoNum;$cnt++){
        if(mb_strlen($toDoNameJP[$cnt])>$LongestToDoName){
            $LongestToDoName=mb_strlen($toDoNameJP[$cnt]);
        }
    }
    $line=substr(fgets($file),0,-1);
    $toDoMaxNum=array();
    $tmp=explode(" ",$line);
    foreach($tmp as $rowInTmp){
        array_push($toDoMaxNum,(int)$rowInTmp);
    }
    fclose($file);

    class Patient{
        public $ID;
        public $Allname;
        public $Hospital;
        public $Age;
        public $Sex;
        public $CounsellorIDs=array();
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
    $query='SELECT * from PatientData where ID="'.$_SESSION['ID'].'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $patient=new Patient();
    $file=fopen('text/patientBasicInfo.txt','r');
    $patientBasicInfoName=array();
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($patientBasicInfoName,$lineContents);
    }
    fclose($file);
    $row = mysqli_fetch_array($result);
    $longestPatientInfoName=0;
    for($cnt=0;$cnt<count($patientBasicInfoName[0]);$cnt++){
        if($cnt==5){
            for($cnt2=0;$cnt2<mb_strlen($row[$cnt])/10;$cnt2++){
                $query2='SELECT Allname from CounsellorData where ID=\''.mb_substr($row[$cnt],$cnt2*10,10).'\';';
                if(!($result2=mysqli_query($link,$query2))){
                    goto SQLerror;
                }
                $row2=mysqli_fetch_array($result2);
                array_push($patient->CounsellorIDs,mb_substr($row[$cnt],$cnt2*10,10));
                array_push($patient->Counsellors,$row2[0]);
            }       
        }else{
            $patient->$patientBasicInfoName[0][$cnt]=$row[$cnt];
        }
        if(mb_strlen($patientBasicInfoName[1][$cnt])>$longestPatientInfoName){
            $longestPatientInfoName=mb_strlen($patientBasicInfoName[1][$cnt]);
        }
    }
    // if(mb_strlen($patientBasicInfoName[1][5])>$longestPatientInfoName){
    //     $longestPatientInfoName=mb_strlen($patientBasicInfoName[1][5]);
    // }
    // for($cnt=0;$cnt<mb_strlen($row[5])/10;$cnt++){
    //     $query2='SELECT Allname from CounsellorData where ID=\''.mb_substr($row[5],$cnt*10,10).'\';';
    //     if(!($result2=mysqli_query($link,$query2))){
    //         goto SQLerror;
    //     }
    //     $row2=mysqli_fetch_array($result2);
    //     array_push($patient->CounsellorIDs,mb_substr($row[5],$cnt*10,10));
    //     array_push($patient->Counsellors,$row2[0]);
    // }
    // for($cnt=6;$cnt<count($patientBasicInfoName[0]);$cnt++){
    //     $patient->$patientBasicInfoName[0][$cnt]=$row[$cnt];
    //     if(mb_strlen($patientBasicInfoName[1][$cnt])>$longestPatientInfoName){
    //         $longestPatientInfoName=mb_strlen($patientBasicInfoName[1][$cnt]);
    //     }
    // }
    if(!empty($_POST)){
        if(!empty($_POST["calendorSelect"])){
            $_SESSION["nowCalView"]=(int)$_POST["calendorSelect"];
        }
        if(!empty($_POST["prev"])){
            if($_SESSION["nowCalView"]==1){
                $_SESSION["dDelay"]-=1;
                $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
            }else if($_SESSION["nowCalView"]==2){
                $_SESSION["mDelay"]-=1;
            }
            
        }
        if(!empty($_POST["next"])){
            if($_SESSION["nowCalView"]==1){
                $_SESSION["dDelay"]+=1;
                $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
            }else if($_SESSION["nowCalView"]==2){
                $_SESSION["mDelay"]+=1;
            }
        }
        if(!empty($_POST["nowMonthForm"])){
            for($i=1; $i<=31; $i++){
                if(!empty($_POST["day".$i])){
                    $_SESSION["dDelay"]=(int)((strtotime($_POST["day".$i])-mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],$_SESSION["Y"]))/86400);
                    $_SESSION["nowCalView"]=1;
                    $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
                    break;
                }
            }
        }
        if(!empty($_POST["toDoNavForm"])){
            for($cnt=1;$cnt<=$toDoNum+2;$cnt++){
                if(!empty($_POST["toDoNav".$cnt])){
                    $_SESSION["nowToDoView"]=$cnt;
                }
            }
        }
        if(!empty($_POST["toDoSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo set ';
            for($cnt=0;$cnt<$toDoNum;$cnt++){
                $query.=$toDoName[$cnt].'='.$_POST[$toDoName[$cnt]."Select"]."";
                if($cnt!==$toDoNum-1){
                    $query.=",";
                }
            }
            $query.=' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["goPatientSelect"])){
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($_POST["logOut"])){
            session_destroy();
            header('Location:index.php');
            exit;
        }
    }
    $err_msg=array();
    $sex=array('','男','女');
    $week = array('日','月','火','水','木','金','土');
    $next_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"]+1,$_SESSION["Y"]));
    $now_monthJP = date("Y年n月",mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //表示する年月
    $now_dateJP = date("Y年n月d日",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
    $now_week = date("w",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
    $start_date = date('Y-m-01',mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //開始の年月日
    $end_date = date("Y-m-t",mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //終了の年月日
    $start_week = date("w",strtotime($start_date)); //開始の曜日の数字
    $end_week = 6 - date("w",strtotime($end_date)); //終了の曜日の数字
    $addicCheckName=[
        ['beer','hiball'],
        ['derby']
    ];
    $toDoDefault=array();
    $file=fopen('text/toDoDefault.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($toDoDefault,$lineContents);
    }
    fclose($file);
    $file=fopen('text/calName.txt','r');
    $line=substr(fgets($file),0,-1);
    $calName=explode(" ",$line);
    $line=substr(fgets($file),0,-1);
    $calNameJP=explode(" ",$line);
    $line=substr(fgets($file),0,-1);
    $calAlertNameJP=explode(" ",$line);
    fclose($file);
    $file=fopen('text/'.$addicName[$_SESSION["nowAddic"]].'Name.txt','r');
    $addicCalUnitName=array();
    $addicCalName=explode(" ",substr(fgets($file),0,-1));
    $addicCalNameJP=explode(" ",substr(fgets($file),0,-1));
    $addicCalNumName=explode(" ",substr(fgets($file),0,-1));
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($addicCalUnitName,$lineContents);
    }
    fclose($file);
    $ObservationName=array();
    $ObservationNameJP=array();
    $file=fopen('text/Observation.txt','r');
    while($line=substr(fgets($file),0,-1)){
        array_push($ObservationName,explode(" ",$line));
    }
    fclose($file);
    $file=fopen('text/ObservationJP.txt','r');
    while($line=substr(fgets($file),0,-1)){
        array_push($ObservationNameJP,explode(" ",$line));
    }
    fclose($file);
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Data where ID="'.$patient->ID.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_array($result);
    $file=fopen('text/patientAddicInfo.txt','r');
    $patientAddicInfoName=array();
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($patientAddicInfoName,$lineContents);
    }
    fclose($file);
    
    for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
        ${'Info'.$patientAddicInfoName[0][$cnt]}=$row[$cnt+1];
        if(mb_strlen($patientAddicInfoName[1][$cnt])>$longestPatientInfoName){
            $longestPatientInfoName=mb_strlen($patientAddicInfoName[1][$cnt]);
        }
    }
    
    
    if(!empty($_POST)){
        if(!empty($_POST["plusOk"])){
            $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Calendor values("'.$patient->ID.'","'.date("Y-m-d H:i:s",mktime($_POST["startHourSelect"],$_POST["startMinuteSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'","'.date("Y-m-d H:i:s",mktime($_POST["endHourSelect"],$_POST["endMinuteSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'"';

            for($cnt=0;$cnt<count($calName);$cnt++){
                $query.=',"'.$_POST[$calName[$cnt].'Plus'].'"';
            }
            for($cnt=0;$cnt<count($addicCalName);$cnt++){
                if((int)$_POST['plusCheck'.$cnt]>0){
                    $query.=','.$_POST['plusCheck'.$cnt];
                    $query.=','.$_POST['plusNumSelect'.$cnt];
                    $query.=','.$_POST['plusUnitSelect'.$cnt];
                }else{
                    $query.=',0,0,0';
                }
            }
            $query.=',"'.$_POST["OtherPlus"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["plusUpdateOk"])){
            $query='SELECT StartDateTime from '.$addicName[$_SESSION["nowAddic"]].'Calendor where (ID="'.$patient->ID.'" and StartDateTime>="'.$now_date.' 00:00:00" and StartDateTime<="'.$now_date.' 23:50:00") or (ID="'.$patient->ID.'" and EndDateTime>="'.$now_date.' 00:00:00" and EndDateTime<="'.$now_date.' 23:50:00") ORDER BY StartDateTime ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            for($cnt=0;$cnt<=(int)$_POST["plusUpdateOk"]-1;$cnt++){
                $row = mysqli_fetch_array($result);
            }

            $query='update '.$addicName[$_SESSION["nowAddic"]].'Calendor SET StartDateTime="'.date("Y-m-d H:i:s",mktime($_POST["startHourUpdateSelect"],$_POST["startMinuteUpdateSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'",EndDateTime="'.date("Y-m-d H:i:s",mktime($_POST["endHourUpdateSelect"],$_POST["endMinuteUpdateSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'"';
            for($cnt=0;$cnt<count($calName);$cnt++){
                $query.=','.$calName[$cnt].'="'.$_POST[$calName[$cnt].'PlusUpdate'].'"';
            }
            for($cnt=0;$cnt<count($addicCalName);$cnt++){
                if((int)$_POST['plusUpdateCheck'.$cnt]>0){
                    $query.=','.$addicCalName[$cnt].'='.$_POST['plusUpdateCheck'.$cnt];
                    $query.=','.$addicCalName[$cnt].'Num='.$_POST['plusUpdateNumSelect'.$cnt];
                    $query.=','.$addicCalName[$cnt].'Unit='.$_POST['plusUpdateUnitSelect'.$cnt];
                }else{
                    $query.=','.$addicCalName[$cnt].'=0';
                    $query.=','.$addicCalName[$cnt].'Num=0';
                    $query.=','.$addicCalName[$cnt].'Unit=0';
                }
            }
            $query.=',Other="'.$_POST["OtherPlusUpdate"].'" where ID="'.$patient->ID.'" and StartDateTime="'.$row[0].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
    }
    $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'ToDo where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_array($result);
    if($row[0]==0&&$patient->ID!=''){
        $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'ToDo values("'.$patient->ID.'","'.$now_date.'",0,0,0,0,0,0,0,0);';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }   
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ToDo where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $nowDateToDo=mysqli_fetch_array($result);
    if(!empty($_POST)){
        if(!empty($_POST["FunEventsAbstractForm"])){
            $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and AbstractOk=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $notOkFunEventsAbstractNumber = mysqli_fetch_array($result);
            for($cnt=0;$cnt<$nowDateToDo[2];$cnt++){
                $tmp=$cnt+1;
                if(!empty($_POST['FunEventsAbstractSave'.$tmp])){
                    $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET StartDate="'.$now_date.'",Abstract="'.$_POST['FunEventsAbstractInput'.$tmp].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsAbstractNumber[$cnt].';';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    break;
                }
                if(!empty($_POST['FunEventsAbstractComplete'.$tmp])){
                    $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET StartDate="'.$now_date.'",AbstractOk=1,Abstract="'.$_POST['FunEventsAbstractInput'.$tmp].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsAbstractNumber[$cnt].';';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    break;
                }
            }
        }
        if(!empty($_POST["FunEventsForm"])){
            $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and ConcreteOk=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $notOkFunEventsNumber =array(); 
            while($row=mysqli_fetch_array($result)){
                array_push($notOkFunEventsNumber,$row[0]);
            }
            for($cnt=0;$cnt<$nowDateToDo[2];$cnt++){
                $tmp=$cnt+1;
                if(!empty($_POST['FunEventsSave'.$tmp])){
                    $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET EndDate="'.$today.'",Concrete="'.$_POST['FunEventsInput'.$tmp].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsNumber[$cnt].';';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    break;
                }
                if(!empty($_POST['FunEventsComplete'.$tmp])){
                    $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET EndDate="'.$today.'",ConcreteOk=1,Concrete="'.$_POST['FunEventsInput'.$tmp].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsNumber[$cnt].';';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    break;
                }
            }
        }
        if(!empty($_POST["ControlStimulusSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ControlStimulus SET Num="'.$_POST['nowDateControlStimulusSelect'].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["EssayForm"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Data SET Essay="'.$_POST['EssayInput'].'" where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Essay SET EssayWrite=1 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if(!empty($_POST["EssayComplete"])){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'Data SET EssayOk=1 where ID="'.$patient->ID.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
        }

        if(!empty($_POST["PseudoActSubmit"])){
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'PseudoAct where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'PseudoAct values("'.$patient->ID.'","'.$now_date.'",'.$tmp;
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1])-1;$cnt2++){
                    if($cnt2==3){
                        $query.=','.$_POST[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'];
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($_POST[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=',"'.$tmp.'"';
                    }
                }
                $query.=',"'.$_POST[$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'"';
            }
            for($cnt=0;$cnt<count($ObservationName[2]);$cnt++){
                $query.=',"'.$_POST[$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'"';
            }
            $query.=');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["ImaginationSubmit"])){
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Imagination where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'Imagination values("'.$patient->ID.'","'.$now_date.'",'.$tmp;
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1])-1;$cnt2++){
                    if($cnt2==3){
                        $query.=','.$_POST[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'];
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($_POST[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=',"'.$tmp.'"';
                    }
                }
                $query.=',"'.$_POST[$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'"';
            }
            for($cnt=0;$cnt<count($ObservationName[2])-1;$cnt++){
                $query.=',"'.$_POST[$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'"';
            }
            for($cnt=0;$cnt<20;$cnt++){
                $query.=',"'.$_POST[$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt].'"';
            }
            $query.=');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }

        // if(!empty($_POST["plusObservationForm"])){
        //     if($_SESSION["nowToDoView"]==6){
        //         $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'PseudoAct where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        //         if(!($result=mysqli_query($link,$query))){
        //             goto SQLerror;
        //         }
        //         $row = mysqli_fetch_array($result);
        //         for($cnt=1;$cnt<=$row[0];$cnt++){
        //             if(!empty($_POST["PseudoActSubmit".$cnt])){
        //                 $query='update '.$addicName[$_SESSION["nowAddic"]].'PseudoAct SET Observation="'.$_POST['PseudoActInput'.$cnt].'",TimeZone='.$_POST['PseudoActTimeZoneSelect'.$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num='.$_POST['PseudoActSubmit'.$cnt].';';
        //                 if(!($result=mysqli_query($link,$query))){
        //                     goto SQLerror;
        //                 }
        //             }
        //         }
        //     }else{
        //         $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Imagination where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        //         if(!($result=mysqli_query($link,$query))){
        //             goto SQLerror;
        //         }
        //         $row = mysqli_fetch_array($result);
        //         for($cnt=1;$cnt<=$row[0];$cnt++){
        //             if(!empty($_POST["ImaginationSubmit".$cnt])){
        //                 $query='update '.$addicName[$_SESSION["nowAddic"]].'Imagination SET Observation="'.$_POST['ImaginationInput'.$cnt].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num='.$_POST['ImaginationSubmit'.$cnt].';';
        //                 if(!($result=mysqli_query($link,$query))){
        //                     goto SQLerror;
        //                 }
        //             }
        //         }
        //     }
        // }

        if(!empty($_POST["FunEventsReadSubmit"])){
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'FunEventsRead values("'.$patient->ID.'","'.$now_date.'",'.$_POST["FunEventsReadSelect"];
            for($cnt=0;$cnt<20;$cnt++){
                $query.=',"'.$_POST["FunEventsRead".$cnt].'"';
            }
            $query.=');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["EssayReadSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Essay SET EssayRead="'.$_POST['nowDateEssayReadSelect'].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        if(!empty($_POST["BBSSubmit"])){
            $query='SELECT max(*) from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'BBS values("'.$patient->ID.'","'.$today.'",'.$tmp.',"'.$_SESSION['ID'].'","'.$_POST["BBSinput"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
    }
    // if($_SESSION["nowCalView"]==1){
        switch($_SESSION["nowToDoView"]){
        case 1:
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Calendor where (ID="'.$patient->ID.'" and StartDateTime>="'.$now_date.' 00:00:00" and StartDateTime<="'.$now_date.' 23:50:00") or (ID="'.$patient->ID.'" and EndDateTime>="'.$now_date.' 00:00:00" and EndDateTime<="'.$now_date.' 23:50:00") ORDER BY StartDateTime ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $todayContents=array();
            $dayTimeJP=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($todayContents,$row);
            }
            $todayTimes=array();
            foreach($todayContents as $rowInTodayContents){
                array_push($todayTimes,array(date('Y/m/d H:i',strtotime($rowInTodayContents[1])),date('Y/m/d H:i',strtotime($rowInTodayContents[2]))));
            }
            $query='SELECT StartDateTime,EndDateTime from '.$addicName[$_SESSION["nowAddic"]].'Calendor where (ID="'.$patient->ID.'" and StartDateTime>="'.$next_date.' 00:00:00" and StartDateTime<="'.$next_date.' 23:50:00") or (ID="'.$patient->ID.'" and EndDateTime>="'.$next_date.' 00:00:00" and EndDateTime<="'.$next_date.' 23:50:00") ORDER BY StartDateTime ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            while ($row = mysqli_fetch_array($result)) {
                array_push($todayTimes,array(date('Y/m/d H:i',strtotime($row[0])),date('Y/m/d H:i',strtotime($row[1]))));
            }
            for($cnt=0;$cnt<count($todayContents);$cnt++){
                array_push($dayTimeJP,[]);
                if(strtotime($todayContents[$cnt][1])<strtotime($now_date.' 00:00:00')){
                    $nowDateTimeJP =date("昨日のG時i分",strtotime($todayContents[$cnt][1]));
                }else{
                    $nowDateTimeJP =date("今日のG時i分",strtotime($todayContents[$cnt][1]));
                }
                array_push($dayTimeJP[$cnt],$nowDateTimeJP);
                if(strtotime($todayContents[$cnt][2])>strtotime($now_date.' 23:50:00')){
                    $nowDateTimeJP =date("明日のG時i分",strtotime($todayContents[$cnt][2]));
                }else{
                    $nowDateTimeJP =date("今日のG時i分",strtotime($todayContents[$cnt][2]));
                }
                array_push($dayTimeJP[$cnt],$nowDateTimeJP);
            }
            if(count($todayContents)>0){
                if(strtotime($todayContents[0][1])<strtotime($now_date.' 00:00:00')){
                    $todayContents[0][1]=$now_date.' 00:00:00';
                }
                if(strtotime($todayContents[count($todayContents)-1][2])>strtotime($now_date.' 23:50:00')){
                    $todayContents[count($todayContents)-1][2]=$next_date.' 00:00:00';
                }
            }
            $dayFullOrNot=array();
            for($cnt=0;$cnt<144;$cnt++){
                array_push($dayFullOrNot,0);
            }
            foreach($todayContents as $rowInDayContents){
                $startTimeIndex=(strtotime($rowInDayContents[1])-strtotime($now_date.' 00:00:00'))/600;
                $filledIndexNum=(strtotime($rowInDayContents[2])-strtotime($rowInDayContents[1]))/600;
                $dayFullOrNot[$startTimeIndex]=$filledIndexNum;
                for($cnt=1;$cnt<$filledIndexNum;$cnt++){
                    $dayFullOrNot[$startTimeIndex+$cnt]=-1;
                }
            }
            break;
        case 2:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $ConcreteNum=$row[0];
            $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET StartDate="'.$today.'" where ID="'.$patient->ID.'" and AbstractOk=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and StartDate="'.$today.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $toDayFunEventsAbstractNum=$row[0];
            if($_SESSION["dDelay"]==0&&$nowDateToDo[$_SESSION["nowToDoView"]]>$toDayFunEventsAbstractNum){
                for($cnt=0;$cnt<$nowDateToDo[$_SESSION["nowToDoView"]]-$toDayFunEventsAbstractNum;$cnt++){
                    $tmp=$ConcreteNum+$cnt;
                    $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'FunEvents values("'.$patient->ID.'",'.$tmp.',"'.$today.'","0000-00-00",0,"",0,"");';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }       
                }
            }
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $FunEventsAbstractToDoNum=$row[0];
            $FunEventsAbstractToDo=array();
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }       
            if($FunEventsAbstractToDoNum>$nowDateToDo[$_SESSION["nowToDoView"]]){
                for($cnt=0;$cnt<$nowDateToDo[2];$cnt++){
                    $row = mysqli_fetch_array($result);
                    array_push($FunEventsAbstractToDo,$row);
                }
            }else{
                while ($row = mysqli_fetch_array($result)) {
                    array_push($FunEventsAbstractToDo,$row);
                }   
            }
            break;
        case 3:
            $query='update '.$addicName[$_SESSION["nowAddic"]].'FunEvents SET EndDate="'.$today.'" where ID="'.$patient->ID.'" and ConcreteOk=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and EndDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $FunEventsToDoNum=$row[0];
            $FunEventsToDo=array();
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and EndDate="'.$now_date.'" ORDER BY Num ASC;';
            
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }       
            if($FunEventsToDoNum>$nowDateToDo[$_SESSION["nowToDoView"]]){
                for($cnt=0;$cnt<$nowDateToDo[$_SESSION["nowToDoView"]];$cnt++){
                    $row = mysqli_fetch_array($result);
                    array_push($FunEventsToDo,$row);
                }
            }else{
                while ($row = mysqli_fetch_array($result)) {
                    array_push($FunEventsToDo,$row);
                }   
            }
            break;
        case 4:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }       
            $row = mysqli_fetch_array($result);
            if($row[0]==0){
                $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' values("'.$patient->ID.'","'.$now_date.'",0);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }   
            }
            $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }       
            $row = mysqli_fetch_array($result);
            $ControlStimulus=$row[0];
            break;
        case 5:
        case 9:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            if($row[0]==0){
                $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Essay values("'.$patient->ID.'","'.$now_date.'",0,0);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }   
            }
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $Essays=mysqli_fetch_array($result);
            break;    
        case 6:
        case 7:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            $ObservationSum=$row[0];
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $Observation=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($Observation,$row);
            }   
            
            $longestObservationName=array();
            $columnNum=array();
            for($cnt=0;$cnt<5;$cnt++){
                $tmp=0;
                for($cnt2=0;$cnt2<count($ObservationNameJP[$cnt*2+2]);$cnt2++){
                    if(mb_strlen($ObservationNameJP[$cnt*2+2][$cnt2])>$tmp){
                        $tmp=mb_strlen($ObservationNameJP[$cnt*2+2][$cnt2]);
                    }
                }
                array_push($longestObservationName,$tmp);
                array_push($columnNum,(int)(50/($tmp+2)));
            }
            $textDisplay=array(2,5,2,1);
            break;
        case 8:
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $FunEventsRead=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($FunEventsRead,$row);
            }   
            $query='SELECT Abstract,Concrete from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $FunEvents=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($FunEvents,$row);
            }   
            break;
        case 10:
            $query='SELECT StartDate,PostID,TextContents from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $BBS=array();
            while ($row = mysqli_fetch_array($result)){
                $messangerName='';
                $messangDate=date('Y n/j',strtotime($row[0]));
                if($row[1]==$patient->ID){
                    $messangerName=$patient->Allname;
                }
                for($cnt=0;$cnt<count($patient->CounsellorIDs);$cnt++){
                    if($row[1]==$patient->CounsellorIDs[$cnt]){
                        $messangerName=$patient->Counsellors[$cnt];
                    }
                }
                if($messangerName==''){
                    $query2='SELECT Allname from CounsellorData where ID="'.$row[1].'";';
                    if(!($result2=mysqli_query($link,$query2))){
                        goto SQLerror;
                    }       
                    $row2 = mysqli_fetch_array($result2);
                    $messangerName=$row2[0];
                }
                array_push($BBS,array($messangDate,$row[1],$messangerName,$row[2]));
            }
        default:
            break;
        }
        $month_Days=array('');
        $month_DaysNum=date("t",strtotime($end_date));
        for($i=1; $i<=$month_DaysNum; $i++){
            array_push($month_Days,date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i));
        }
        $monthContents=array([]);
        switch($_SESSION["nowToDoView"]){
            case 1:
                $monthTimesJP=array([]);
                for($i=1; $i<=$month_DaysNum; $i++){
                    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Calendor where ID="'.$patient->ID.'" and StartDateTime>="'.$month_Days[$i].' 00:00:00" and StartDateTime<="'.$month_Days[$i].' 23:50:00"  ORDER BY StartDateTime ASC;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    $tmpContents=array();
                    $tmpTimesJP=array();
                    while ($row = mysqli_fetch_array($result)) {
                        array_push($tmpContents,$row);
                        $tmpThisTimeJP=array(date("G時i分",strtotime($row[1])));
                        if(strtotime($row[2])>strtotime($month_Days[$i].' 23:50:00')){
                            array_push($tmpThisTimeJP,date("翌日のG時i分",strtotime($todayContents[$cnt][2])));
                        }else{
                            array_push($tmpThisTimeJP,date("G時i分",strtotime($todayContents[$cnt][2])));
                        }
                        array_push($tmpTimesJP,$tmpThisTimeJP);
                    }
                    array_push($monthContents,$tmpContents);
                    array_push($monthTimesJP,$tmpTimesJP);
                }
                break;
            case 2:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'" and AbstractOk=1;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0]+1;
                        array_push($tmpContents,$tmp.'番を完成');
                    }
                    array_push($monthContents,$tmpContents);
                }
                break;
            case 3:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'FunEvents where ID="'.$patient->ID.'" and EndDate="'.$month_Days[$i].'" and ConcreteOk=1;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0]+1;
                        array_push($tmpContents,$tmp.'番を完成');
                    }
                    array_push($monthContents,$tmpContents);
                }
                break;
            case 4:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'ControlStimulus where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'";';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    $row = mysqli_fetch_array($result);
                    if($row[0]>0){
                        array_push($monthContents,[$row[0].'回']);
                        
                    }else{
                        array_push($monthContents,[]);
                    }                    
                }
                break;
            case 5:
            case 9:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $query='SELECT EssayWrite,EssayRead from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'";';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    $row = mysqli_fetch_array($result);
                    if($_SESSION["nowToDoView"]==5){
                        if($row[0]>0){
                            array_push($monthContents,['書いた']);
                        }else{
                            array_push($monthContents,[]);
                        }
                    }else{
                        if($row[1]>0){
                            array_push($monthContents,['読んだ']);
                        }else{
                            array_push($monthContents,[]);
                        }
                    }

                    
                }
                break;
            case 6:
            case 7:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'";';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    $row = mysqli_fetch_array($result);
                    if($row[0]>0){
                        array_push($monthContents,[$row[0].'回']);
                        
                    }else{
                        array_push($monthContents,[]);
                    }
                }
                break;
            case 8:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'FunEventsRead where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'";';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0]+1;
                        array_push($tmpContents,$tmp.'番を読み返した');
                    }
                    array_push($monthContents,$tmpContents);
                }
                break;
            case 10:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT StartDate,PostID,TextContents from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'" ORDER BY Num ASC;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    
                    while ($row = mysqli_fetch_array($result)){
                        $messangerName='';
                        $messangDate=date('Y n/j',strtotime($row[0]));
                        if($row[1]==$patient->ID){
                            $messangerName=$patient->Allname;
                        }
                        for($cnt=0;$cnt<count($patient->CounsellorIDs);$cnt++){
                            if($row[1]==$patient->CounsellorIDs[$cnt]){
                                $messangerName=$patient->Counsellors[$cnt];
                            }
                        }
                        if($messangerName==''){
                            $query2='SELECT Allname from CounsellorData where ID="'.$row[1].'";';
                            if(!($result2=mysqli_query($link,$query2))){
                                goto SQLerror;
                            }       
                            $row2 = mysqli_fetch_array($result2);
                            $messangerName=$row2[0];
                        }
                        array_push($tmpContents,array($messangerName.':'.$row[2]));
                    }
                    array_push($monthContents,$tmpContents);
                }
                break;
            default:
                break;
        }
    // }
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
    <link rel="stylesheet" href="style/observe.css">
</head>
<body>
    <header>
        <div id="humMenu">
            <input id="humCheck" type="checkbox" >
            <label id="humOpen" for="humCheck"><img src="image/bars_24.png" alt="メニュー" width="68" height="56"></label>
            <label id="humClose" for="humCheck"></label>
            <nav>
                <form action="observe.php" method="post">
                    <textarea name="toDoNavForm" value=1 class="none">1</textarea>
                    <ol class="inner">
                    <?php
                    echo '<li><button  class="noneBorder toDoNav" id="toDoNav1" name="toDoNav1" value=1>日記';
                    for($cnt2=0;$cnt2<$LongestToDoName-2;$cnt2++){
                        echo '　';
                    }
                    echo '</button>';
                    if($_SESSION["nowCalView"]==1){
                        for($cnt=2;$cnt<=$toDoNum+1;$cnt++){
                            if($nowDateToDo[$cnt]>0){
                                echo '<li><button id="toDoNav'.$cnt.'" name="toDoNav'.$cnt.'" class="noneBorder toDoNav" value='.$cnt.'>'.$toDoNameJP[$cnt-2];
                                for($cnt2=0;$cnt2<$LongestToDoName-mb_strlen($toDoNameJP[$cnt-2]);$cnt2++){
                                    echo '　';
                                }
                                echo '</button>';
                            }
                        }
                    }else if($_SESSION["nowCalView"]==2){
                        for($cnt=2;$cnt<=$toDoNum+1;$cnt++){
                            echo '<li><button  id="toDoNav'.$cnt.'" name="toDoNav'.$cnt.'" class="noneBorder toDoNav" value='.$cnt.'>'.$toDoNameJP[$cnt-2];
                            for($cnt2=0;$cnt2<$LongestToDoName-mb_strlen($toDoNameJP[$cnt-2]);$cnt2++){
                                echo '　';
                            }
                            echo '</button>';
                        }
                    }
                    $chatNum=$toDoNum+2;
                    echo '<li><button  class="noneBorder toDoNav" id="toDoNav"'.$chatNum.' name="toDoNav'.$chatNum.'" value='.$chatNum.'>チャット';
                    for($cnt2=0;$cnt2<$LongestToDoName-4;$cnt2++){
                        echo '　';
                    }
                    echo '</button>';
                    ?>
                    </ol>
                </form>
            </nav>
        </div>
        <div id=prevNext>
        <form action="observe.php" method="post" id=prevForm>
            <input id="prev" type="submit" name="prev" class="btn" value=1>
            <label id="prevLabel" for="prev" class="btnLabel"><img src="image/prev.png" alt="前へ" ></label>
        </form>
        <h3 id=space>  </h3>
        <form action="observe.php" method="post" id=nextForm>
            <input id="next" type="submit" name="next" class="btn" value=1>
            <label id="nextLabel" for="next" class="btnLabel"><img src="image/next.png" alt="次へ" ></label>
        </form>
        </div>
        <h1 id="title">
            <?php 
                echo $addicNameJP[$_SESSION["nowAddic"]];
                    if($_SESSION['nowToDoView']==0){
                        echo ' 日記';
                    }else if($_SESSION['nowToDoView']==10){
                        echo ' チャット';
                    }else{
                        echo ' '.$toDoNameJP[$_SESSION['nowToDoView']-2];
                    }
        
            ?>
        </h1>
        <form action="observe.php" method="post" id="calendorSelectForm" name="calendorSelectForm">
            <?php
                echo  '<select id="calendorSelect" name="calendorSelect" onchange="this.form.submit();">';
                for($cnt=1;$cnt<=$calViewNum;$cnt++){
                    $tmp='<option value='.$cnt;
                    if((int)$cnt==(int)$_SESSION["nowCalView"]){
                        $tmp.=' selected=true';
                    }
                    $tmp.='>'.$calViewNameJP[$cnt-1].'</option>';
                    echo $tmp;
                }
                echo '</select>';
            ?>
        </form>
        <div id="infoMenu">
            <input id="infoCheck" name="infoCheck" type="checkbox">
            <label id="infoOpen" for="infoCheck"><?php echo $patient->Allname;?></label>
            <label id="infoClose" for="infoCheck"></label>
            <div id=info>
                <?php
                for($cnt=0;$cnt<count($patientBasicInfoName[0]);$cnt++){
                    echo '<div class=oneSentence>';
                    $tmpStr='<label class="info" >'.$patientBasicInfoName[1][$cnt];
                    if($cnt==0){
                        for($cnt2=0;$cnt2<$longestPatientInfoName-1;$cnt2++){
                            $tmpStr.='　';
                        }
                    }else{
                        for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                            $tmpStr.='　';
                        }
                    }
                    echo $tmpStr;
                    echo '</label><textarea id="BasicInfo'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1">';
                    if($cnt==2){
                        echo $hospitalName[$patient->$patientBasicInfoName[0][$cnt]];
                    }else if($cnt==4){
                        echo $sex[$patient->$patientBasicInfoName[0][$cnt]];
                    }else if($cnt==5){
                        for($cnt2=0;$cnt2<count($patient->Counsellors);$cnt2++){
                            echo $patient->Counsellors[$cnt2].' ';
                        }
                    }else if($cnt==count($patientBasicInfoName[0])-1){
                        for($cnt2=0;$cnt2<$addicNum;$cnt2++){
                            if((int)(substr($patient->Addictions,$cnt2,1))>0){
                                echo $addicNameJP[$cnt2].'　';
                            }
                        }
                    }else{
                        echo $patient->$patientBasicInfoName[0][$cnt];
                    }
                    echo '</textarea></div>';
                }
                for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
                    if($cnt==count($patientAddicInfoName[0])-3){
                        continue;
                    }
                    echo '<div class=oneSentence>';
                    $tmpStr='<label class="info" >'.$patientAddicInfoName[1][$cnt];
                    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientAddicInfoName[1][$cnt]);$cnt2++){
                        $tmpStr.='　';
                    }
                    echo $tmpStr;
                    echo '</label><textarea id="AddicInfo'.$patientAddicInfoName[0][$cnt].'" cols="50" rows="1">';
                    echo ${'Info'.$patientAddicInfoName[0][$cnt]};
                    echo '</textarea></div>';
                }
                ?>
            </div>
        </div>
        <form action="observe.php" method="post">
            <input id="goPatientSelect" type="submit" name="goPatientSelect"  value="選択画面へ">
            
        </form>    
        <form action="observe.php" method="post">
            <input id="logOut" type="submit" name="logOut" class="btn none" value=1>
            <label id="logOutLabel" for="logOut" class="btnLabel "><img src="image/logOut.png" alt="ログアウト" width="40" height="40"></label>
        </form>
    </header>
        <?php
        if($_SESSION["nowCalView"]==1){
            switch($_SESSION["nowToDoView"]){
            case 1:    
                include('dayCalendor.php');
                break;
            case 2:
                include('dayFunEventsAbstract.php');
                break;
            case 3:
                include('dayFunEventsConcrete.php');
                break;
            case 4:
            case 9:
                include('dayOnlySelect.php');
                break;
            case 5:
                include('dayEssay.php');
                break;
            case 6:
            case 7:
                include('dayObservation.php');
                break;
            case 8:
                include('dayFunEventsRead.php');
                break;
            case 10:
                include('dayBBS.php');
                break;
            default:
                break;
            }
            include('toDoSelect.php');
        }else if($_SESSION["nowCalView"]==2){
            include('monthCalendor.php');
        }    
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        var nowAddic=<?php $json_nowAddic=json_encode($_SESSION["nowAddic"]); echo $json_nowAddic; ?>;
        var calViewName=<?php $json_calViewName=json_encode($calViewName); echo $json_calViewName; ?>;
        var nowCalView=<?php $json_nowCalView=json_encode($_SESSION["nowCalView"]); echo $json_nowCalView; ?>;
        var nowToDoView=<?php $json_nowToDoView=json_encode($_SESSION["nowToDoView"]); echo $json_nowToDoView; ?>;
        var calViewNum=<?php $json_calViewNum=json_encode($calViewNum); echo $json_calViewNum; ?>;
        var toDoNum=<?php $json_toDoNum=json_encode($toDoNum); echo $json_toDoNum; ?>;
        var toDoName=<?php $json_toDoName=json_encode($toDoName); echo $json_toDoName; ?>;
        var toDoDefault=<?php $json_toDoDefault=json_encode($toDoDefault); echo $json_toDoDefault; ?>;
        var todayTimes=<?php $json_todayTimes=json_encode($todayTimes); echo $json_todayTimes; ?>;
        var todayContents=<?php $json_todayContents=json_encode($todayContents); echo $json_todayContents; ?>;
        var calName=<?php $json_calName=json_encode($calName); echo $json_calName; ?>;
        var calNameJP=<?php $json_calNameJP=json_encode($calNameJP); echo $json_calNameJP; ?>;
        var addicCalNum=<?php $json_addicCalNameNum=json_encode(count($addicCalNameJP)); echo $json_addicCalNameNum; ?>;
        var calAlertNameJP=<?php $json_calAlertNameJP=json_encode($calAlertNameJP); echo $json_calAlertNameJP; ?>;
        var mdY=<?php $json_mdY=json_encode(array($_SESSION["Y"],$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"])); echo $json_mdY; ?>;
        var observations=<?php $json_observations=json_encode(count($Observation)); echo $json_observations; ?>;
        var ObservationName=<?php $json_ObservationName=json_encode($ObservationName); echo $json_ObservationName; ?>;
        var textDisplay=<?php $json_textDisplay=json_encode($textDisplay); echo $json_textDisplay; ?>;
        var FunEvents=<?php $json_FunEvents=json_encode($FunEvents); echo $json_FunEvents; ?>;
    </script>
    <script src="script/observe.js"></script>
</body>
</html>
