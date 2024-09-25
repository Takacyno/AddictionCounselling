<?php include('DBconnect.php');?>    
<?php include('global.php');?>    
<?php
    
        // // セッションのライフタイム変更
        // ini_set( 'session.gc_maxlifetime', 60 );  // 秒(デフォルト:1440)
        
        // // セッションが存在していない(タイムアウトもしくはログアウトされている)
        // if($_SESSION['ID']="") {
            // ここにログイン処理を書く（ログイン画面に遷移させる）
            // header('Location:../login.php');
            // exit();            
        // セッションが存在している場合はセッションのライフタイムを更新
        // }
        //     unset($_SESSION['LOGIN_INFO']);
        //     $_SESSION['LOGIN_INFO'] = true;
        // }
        // public function initialize() {
        //     /**
        //      * セッションの終了をチェックする
        //      */
        //     if ($this->session->has('created')) {
        //         $created = $this->session->get('created');
        //         if ($created < (new DateTime('now'))->modify('-30 minute')) {
        //             // 指定時間経過後
        //             $this->session->remove('created'); 
        //         }
        //         // 最終アクセスから経過後としたいなら以下を生かせばいい createedよりも別の名前がよいかも
        //         //$this->session->set("created", new DateTime('now'));
        //     }
        // }
        
    // サニタイズ
    $clean = array();

    if (!empty($_POST)) {
        
        foreach ($_POST as $key => $value) {
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    }
    $query='SELECT * from aboutDB;';
    $err_msg=array();
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    
    $row = mysqli_fetch_assoc($result);
    $addicNum=(int)$row["AddicNum"];
    
    
    if($_SESSION["class"]==0){
        $query='SELECT Email from UserData where ID="'.$_SESSION['ID'].'";';
    }else{
        $query='SELECT Email from UserData where ID="'.$_SESSION['patientID'].'";';
    }
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_array($result);
    $Email=$row[0];
    $query='SELECT Email from UserData;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    
    $Emails=array();
    while ($row = mysqli_fetch_array($result)) {
        if($row[0]!=$Email){
            array_push($Emails,$row[0]);
        }
    }
    $addicName=array();
    $addicNameJP=array();
    $hospitalNameJP=array();
    $hospitalSelect=array();
    $calViewName=array();
    $calViewNameJP=array();
    $file=fopen('text/addicName.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($addicName,$lineContents[0]);
        array_push($addicNameJP,$lineContents[1]);
    }
    fclose($file);
    $file=fopen('text/test.txt','r');
    $testNameJP=array();
    while($line=substr(fgets($file),0,-1)){
        array_push($testNameJP,$line);
    }
    fclose($file);
    $query='SELECT * from aboutCalView;';
    
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($calViewName,$row["CalViewName"]);
        array_push($calViewNameJP,$row["CalViewNameJP"]);
    }
    $calViewNum=count($calViewName);
    $toDoSum=array();
    $file=fopen('text/toDoSum.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($toDoSum,$lineContents);
    }
    fclose($file);
    if(empty($_SESSION["nowAddic"])){
        $_SESSION["nowAddic"]=0;
    }
    if(empty($_SESSION["nowCalView"])){
        $_SESSION["nowCalView"]=1;
    }
    if(empty($_SESSION["nowToDoView"])){
        $_SESSION["nowToDoView"]=0;
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
    $now_dateTime=strtotime($now_date);
    $file=fopen('text/toDoName.txt','r');
    $line=substr(fgets($file),0,-1);
    $toDoName=explode(" ",$line);
    $toDoNum=count($toDoName);
    $toDoName[$toDoNum-1]=substr($toDoName[$toDoNum-1], 0, -1);
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
    $file=fopen('text/patientBasicInfo.txt','r');
    $patientBasicInfoName=array();
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($patientBasicInfoName,$lineContents);
    }
    fclose($file);
    $file=fopen('text/patientAddicInfo.txt','r');
    $patientAddicInfoName=array();
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($patientAddicInfoName,$lineContents);
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
        public $Goal;
        public $TestShow;
        public $Addictions;
        public $Holiday;
    }
    $patient=new Patient();
    if($_SESSION["class"]==0){
        $patient->ID=$_SESSION['ID'];
    }else{
        $patient->ID=$_SESSION['patientID'];
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Data where ID="'.$patient->ID.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if(!($row=mysqli_fetch_array($result))&&$patient->ID!=""){
        $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Data values("'.$patient->ID.'"';
        for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
            $query.=',""';
        }
        $query.=');';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }   
    }
    if(!empty($clean)){
        if($clean["passReset"]){
            $query='UPDATE UserData SET Pass="'.password_hash($clean["password"],PASSWORD_BCRYPT).'" where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $file_name = ".htpasswd";
            $ret_array = file( $file_name );
            for($cnt=0;$cnt<count($ret_array);$cnt++){
                if(substr($ret_array[$cnt],0,10)==$patient->ID){
                    $ret_array[$cnt]=$patient->ID.':'.password_hash($clean["password"],PASSWORD_BCRYPT)."\n";
                }
            }
            file_put_contents($file_name, $ret_array);
            session_destroy();
            header('Location:../login.php');
            exit();
        }
        if(!empty($clean["holidayForm"])){
            for($cnt=0;$cnt<7;$cnt++){
                if($clean["holiday".$cnt]==1){
                    $clean["Holiday"].=1;
                }else{
                    $clean["Holiday"].=0;
                }
            }
            $query='UPDATE PatientData SET Holiday="'.$clean["Holiday"].'" where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["toggleStatus"])){

            $query='SELECT UserStatus from UserData where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=1-(int)$row[0];
            $query='UPDATE UserData SET UserStatus="'.$tmp.'" where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["addPatient"])){
            $query='SELECT Email from UserData where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            if($clean["Email"]!=$row[0]){
                $query2='UPDATE UserData SET Email="'.$clean["Email"].'" where ID="'.$patient->ID.'";';
                if(!($result2=mysqli_query($link,$query2))){
                    goto SQLerror;
                }
            }
            
            $clean["Counsellors"]='';
            $clean["TestShow"]='';
            $clean["Addictions"]='';
            $clean["Holiday"]='';
            for($cnt=0;$cnt<count($_POST["counsellorIDs"]);$cnt++){
                $clean["Counsellors"].=$_POST["counsellorIDs"][$cnt]["counsellorIDs"];
            }
            for($cnt=0;$cnt<count($testNameJP);$cnt++){
                if($clean["testShow".$cnt]==1){
                    $clean["TestShow"].=1;
                }else{
                    $clean["TestShow"].=0;
                }
            }
            for($cnt=0;$cnt<$addicNum;$cnt++){
                if($clean["addictions".$cnt]==1){
                    if($clean["addicInterruptCheck".$cnt]==1){
                        $clean["Addictions"].=2;
                    }else{
                        $clean["Addictions"].=1;
                    }
                }else{
                    $clean["Addictions"].=0;
                }
            }
            for($cnt=0;$cnt<7;$cnt++){
                if($clean["holiday".$cnt]==1){
                    $clean["Holiday"].=1;
                }else{
                    $clean["Holiday"].=0;
                }
            }
            $query='UPDATE PatientData SET ';
            for($cnt=1;$cnt<count($patientBasicInfoName[0]);$cnt++){
                $query.=$patientBasicInfoName[0][$cnt].'="'.$clean["".$patientBasicInfoName[0][$cnt]].'"';
                if($cnt!=count($patientBasicInfoName[0])-1){
                    $query.=',';
                }
            }
            $query.=' where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            
            $query='UPDATE '.$addicName[$_SESSION["nowAddic"]].'Data SET ';
            for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
                if($cnt==count($patientAddicInfoName[0])-3){
                    continue;
                }
                $query.=$patientAddicInfoName[0][$cnt].'="'.$clean["".$patientAddicInfoName[0][$cnt]].'"';
                if($cnt!=count($patientAddicInfoName[0])-1){
                    $query.=',';
                }
            }
            
            $query.=' where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            for($cnt=0;$cnt<$addicNum;$cnt++){
                if($clean["addictions".$cnt]==1&&$clean['addicStartCounselling'.$cnt]==1){
                    $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ToDoNumber=0;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    if($clean["addicInterruptCheck".$cnt]==1){
                        if(!mysqli_fetch_array($result)){
                            $query='INSERT into '.$addicName[$cnt].'Process values("'.$patient->ID.'","'.$today.'",0,0);';
                            if(!($result=mysqli_query($link,$query))){
                                goto SQLerror;
                            }
                        }
                    }else{
                        if($row=mysqli_fetch_array($result)){
                            $file=fopen('text/toDoDefault.txt','r');
                            $startToDoweek=array(0,0,0,0,0,0,0,0,0,0);
                            $cnt2=0;
                            while($line=substr(fgets($file),0,-1)){
                                $lineContents=explode(" ",$line);
                                for($cnt3=2;$cnt3<count($toDoName)+2;$cnt3++){
                                    if($lineContents[$cnt3-2]>0&&$startToDoweek[$cnt3]==0){
                                        $startToDoweek[$cnt3]=$cnt2;
                                    }
                                }
                                $cnt2++;
                            }
                            fclose($file);
                            $startToDoweek[2]=0;
                            // if($cnt2-1>$_POST["addicRestartWeek".$cnt]){
                            $tmpDate=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+($cnt2-2-$_POST["addicRestartWeek".$cnt])*7,$_SESSION["Y"]));
                            $query='UPDATE '.$addicName[$cnt].'Process SET StartDate="'.$tmpDate.'" where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=1;';
                            if(!($result=mysqli_query($link,$query))){
                                goto SQLerror;
                            }
                            // }
                            for($cnt2=1;$cnt2<count($toDoName)+2;$cnt2++){
                                if($cnt2==4||$cnt2==6||$cnt2==7||$cnt2==9){
                                    // if($startToDoweek[$cnt2]>-$_POST["addicRestartWeek".$cnt]){}
                                    $tmpDate=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+($startToDoweek[$cnt2]-$_POST["addicRestartWeek".$cnt])*7,$_SESSION["Y"]));
                                    $query='UPDATE '.$addicName[$cnt].'Process SET StartDate="'.$tmpDate.'" where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber='.$cnt2.';'; 
                                    if(!($result=mysqli_query($link,$query))){
                                        goto SQLerror;
                                    }   
                                }
                            }

                            $query='DELETE from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ToDoNumber=0;';
                            if(!($result=mysqli_query($link,$query))){
                                goto SQLerror;
                            }
                        }
                    }
                }
            }
            // header('Location:observe.php');
            // exit;
        }
        if(!empty($clean['updateThisFrontCoverBBS'])){
            $query='update frontCoverBBS set BBSstatus='.$clean["FrontCoverBBSBBSstatus"].',TextContents="'.$clean["FrontCoverBBSTextContents"].'" where Num='.$clean["FrontCoverBBSNum"].';';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean['plusFrontCoverBBS'])){
            $query='SELECT MAX(Num) from frontCoverBBS;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $biggestNum=mysqli_fetch_array($result)[0];
            $biggestNum++;
            $query='INSERT into frontCoverBBS values('.$biggestNum.',1,"0","0","'.$patient->ID.'","'.$clean["plusFrontCoverBBSTextContents"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
    }
    $query='SELECT UserStatus from UserData where ID="'.$patient->ID.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_array($result);
    $patientStatus=$row[0];
    $query='SELECT * from PatientData where ID="'.$patient->ID.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
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
    if(empty($_SESSION["hospital"])){
        $_SESSION["hospital"]=$patient->Hospital;
    }
    $file=fopen('text/hospitalName.txt','r');
    if($_SESSION["class"]==1&&$_SESSION["rank"]==0){
        $cnt=0;
        while($line=substr(fgets($file),0,-1)){
            array_push($hospitalNameJP,$line);
            $cnt++;
        }
        $hospitalNum=$cnt;
    }else{
        $cnt=0;
        while($line=substr(fgets($file),0,-1)){
            if($cnt==$_SESSION["hospital"]){
                array_push($hospitalNameJP,$line);
                $cnt++;
            }
        }
        $hospitalNum=1;
    }
    fclose($file);
    $counsellors=array();
    for($cnt2=0;$cnt2<$hospitalNum;$cnt2++){
        array_push($counsellors,[]);
    }
    if($_SESSION["rank"]==0){
        $query='SELECT ID,Allname,Hospital from CounsellorData;';
    }else{
        $query='SELECT ID,Allname,Hospital from CounsellorData where Hospital='.$_SESSION["hospital"].';';
    }
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_array($result)) {
        array_push($counsellors[$row[2]],$row);
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
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'" ORDER BY Num DESC;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $newestBBSis=0;
    if($row = mysqli_fetch_array($result)){
        $newestBBS=$row[4];
    }
    
    $query='SELECT * from frontCoverBBS where ID="'.$patient->ID.'" ORDER BY Num DESC;';
    $frontCoverBBSData=array();
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_array($result)) {
        array_push($frontCoverBBSData,$row);
    }
    $frontCoverBBSShow=array('非表示','表示中');
    $frontCoverBBS=array();
    $query='SELECT TextContents from frontCoverBBS where BBSstatus>0 and ID="'.$patient->ID.'" ORDER BY Num DESC;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_array($result)) {
        array_push($frontCoverBBS,$row[0]);
    }
    $query='SELECT * from frontCoverBBS where BBSstatus>0 and ID="0" ORDER BY Num DESC;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while ($row = mysqli_fetch_array($result)) {
        if(((int)$row[2]==0&&substr($row[3],$_SESSION["nowAddic"],1)==1)||((int)$row[3]==0&&substr($row[2],$patient->Hospital,1)==1)||(substr($row[2],$patient->Hospital,1)==1&&substr($row[3],$_SESSION["nowAddic"],1)==1)){
            array_push($frontCoverBBS,$row[5]);
        }
    }
    
    if(!empty($clean)){
        if(!empty($clean["tests"])){
            for($cnt=0;$cnt<count($testNameJP);$cnt++){
                if(!empty($clean['testButton'.$cnt])){
                    $_SESSION["test"]=$cnt;
                    header('Location:test.php');
                    exit;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["calendorSelect"])){
            $_SESSION["nowCalView"]=(int)$clean["calendorSelect"];
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["gotoToday"])){
            $_SESSION["dDelay"]=0;
            $_SESSION["mDelay"]=0;
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["prevForm"])){
            if($_SESSION["nowCalView"]==1){
                $_SESSION["dDelay"]-=1;
                $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
                $now_dateTime=strtotime($now_date);
            }else if($_SESSION["nowCalView"]==2){
                $_SESSION["mDelay"]-=1;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["nextForm"])){
            if($_SESSION["nowCalView"]==1){
                $_SESSION["dDelay"]+=1;
                $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
                $now_dateTime=strtotime($now_date);
            }else if($_SESSION["nowCalView"]==2){
                $_SESSION["mDelay"]+=1;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["nowMonthForm"])){
            for($i=1; $i<=31; $i++){
                if(!empty($clean["day".$i])){
                    $_SESSION["dDelay"]=(int)((strtotime($clean["day".$i])-mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],$_SESSION["Y"]))/86400);
                    $_SESSION["nowCalView"]=1;
                    $now_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
                    $now_dateTime=strtotime($now_date);
                    break;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["toDoNavForm"])){
            for($cnt=0;$cnt<=$toDoNum+2;$cnt++){
                if(!empty($clean["toDoNav".$cnt])){
                    $_SESSION["nowToDoView"]=$cnt;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["toDoSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo set ';
            for($cnt=0;$cnt<$toDoNum;$cnt++){
                $query.=$toDoName[$cnt].'='.$clean[$toDoName[$cnt]."Select"]."";
                if($cnt!==$toDoNum-1){
                    $query.=",";
                }
            }
            $query.=' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["toDoDateChange"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Process set StartDate="'.$clean["toDoY"].'-'.$clean["toDoM"].'-'.$clean["toDoD"].'" where ID="'.$patient->ID.'" and ProcessStatus=';
            if($clean["toDoDateChange"]==1){
                $query.='2';
            }else{
                $query.='1';
            }
            $query.=' and ToDoNumber="'.$clean["toDoDateChange"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $file=fopen('text/toDoDefault.txt','r');
            $startToDoweek=array(0,0,0,0,0,0,0,0,0,0);
            $cnt=0;
            while($line=substr(fgets($file),0,-1)){
                $lineContents=explode(" ",$line);
                for($cnt2=2;$cnt2<count($toDoName)+2;$cnt2++){
                    if($lineContents[$cnt2-2]>0&&$startToDoweek[$cnt2]==0){
                        $startToDoweek[$cnt2]=$cnt;
                    }
                    
                }
                $cnt++;
            }
            fclose($file);
            $startToDoweek[1]=$cnt-2;
            $tmpArray=array([4,1],[6,1],[7,1],[1,2]);
            for($cnt=0;$cnt<count($tmpArray)-1;$cnt++){
                if($clean["toDoDateChange"]==$tmpArray[$cnt][0]){
                    $query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus='.$tmpArray[$cnt][1].' and ToDoNumber='.$tmpArray[$cnt][0].';';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    $changedDate=mysqli_fetch_array($result)[0];
                    for($cnt2=$cnt+1;$cnt2<count($tmpArray);$cnt2++){
                        $startDelay=(int)$startToDoweek[$tmpArray[$cnt2][0]]-(int)$startToDoweek[$tmpArray[$cnt][0]];
                        $startDelay*=7;
                        $query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus='.$tmpArray[$cnt2][1].' and ToDoNumber='.$tmpArray[$cnt2][0].';';
                        if(!($result=mysqli_query($link,$query))){
                            goto SQLerror;
                        }
                        $nextTmpDate=strtotime(mysqli_fetch_array($result)[0]);
                        $nextDateExpected=mktime(0,0,0,(int)date("m",strtotime($changedDate)),(int)date("d",strtotime($changedDate))+$startDelay,(int)date("Y",strtotime($changedDate)));
                        if($nextDateExpected>$nextTmpDate){
                            $query='update '.$addicName[$_SESSION["nowAddic"]].'Process set StartDate="'.date("Y-m-d",$nextDateExpected).'" where ID="'.$patient->ID.'" and ProcessStatus='.$tmpArray[$cnt2][1].' and ToDoNumber='.$tmpArray[$cnt2][0].';';
                            if(!($result=mysqli_query($link,$query))){
                                goto SQLerror;
                            }    
                        }
                    }
                    break;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["goPatientSelect"])){
            $POSTisSet=1;
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($clean["logOut"])){
            $POSTisSet=1;
            $tmp='';
            for($cnt=0;$cnt<count($testNameJP);$cnt++){
                $tmp.="0";
            }
            if($patient->TestShow!=$tmp&&$_SESSION["class"]==1){
                $query='UPDATE PatientData SET TestShow="'.$tmp.'" where ID="'.$patient->ID.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            session_destroy();
            header('Location:../login.php');
            exit();
        }
    }
    
    $err_msg=array();
    $sex=array('','男','女');
    $week = array('日','月','火','水','木','金','土');
    $next_date=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"]+1,$_SESSION["Y"]));
    $now_monthJP = date("Y年n月",mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //表示する年月
    $now_dateJP = date("Y年n月d日",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
    $todayJP= date("Y年n月d日",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],$_SESSION["Y"]));
    $now_week = date("w",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"]));
    $start_date = date('Y-m-01',mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //開始の年月日
    $end_date = date("Y-m-t",mktime(0,0,0,$_SESSION["m"]+$_SESSION["mDelay"],1,$_SESSION["Y"])); //終了の年月日
    $start_week = date("w",strtotime($start_date)); //開始の曜日の数字
    $end_week = 6 - date("w",strtotime($end_date)); //終了の曜日の数字
    $addicCheckName=[
        ['beer','hiball'],
        ['derby']
    ];
    
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
    $ObservationName[0][1]=trim($ObservationName[0][1]);
    $ObservationName[1][count($ObservationName[1])-1]=trim($ObservationName[1][count($ObservationName[1])-1]);
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
    $toDoDefault=array();
    if((int)(substr($patient->Holiday,$now_week,1))>0){
        $file=fopen('text/toDoDefaultHoliday.txt','r');
    }else{
        $file=fopen('text/toDoDefault.txt','r');
    }
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($toDoDefault,$lineContents);
    }
    fclose($file);
    
    for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
        ${'Info'.$patientAddicInfoName[0][$cnt]}=$row[$cnt+1];
        if(mb_strlen($patientAddicInfoName[1][$cnt])>$longestPatientInfoName){
            $longestPatientInfoName=mb_strlen($patientAddicInfoName[1][$cnt]);
        }
    }
    if(!empty($clean)){
        if(!empty($clean["plusOk"])){
            $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Calendor values("'.$patient->ID.'","'.date("Y-m-d H:i:s",mktime($clean["startHourSelect"],$clean["startMinuteSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'","'.date("Y-m-d H:i:s",mktime($clean["endHourSelect"],$clean["endMinuteSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'"';

            for($cnt=0;$cnt<count($calName);$cnt++){
                $query.=',"'.$clean[$calName[$cnt].'Plus'].'"';
            }
            for($cnt=0;$cnt<count($addicCalName);$cnt++){
                if((int)$clean['plusCheck'.$cnt]>0){
                    $query.=','.$clean['plusCheck'.$cnt];
                    $query.=','.$clean['plusNumSelect'.$cnt];
                    $query.=','.$clean['plusUnitSelect'.$cnt];
                }else{
                    $query.=',0,0,0';
                }
            }
            $query.=',"'.$clean["OtherPlus"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["plusUpdateOk"])){
            $query='SELECT StartDateTime from '.$addicName[$_SESSION["nowAddic"]].'Calendor where (ID="'.$patient->ID.'" and StartDateTime>="'.$now_date.' 00:00:00" and StartDateTime<="'.$now_date.' 23:50:00") or (ID="'.$patient->ID.'" and EndDateTime>="'.$now_date.' 00:00:00" and EndDateTime<="'.$now_date.' 23:50:00") ORDER BY StartDateTime ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            for($cnt=0;$cnt<=(int)$clean["plusUpdateOk"]-1;$cnt++){
                $row = mysqli_fetch_array($result);
            }

            $query='update '.$addicName[$_SESSION["nowAddic"]].'Calendor SET StartDateTime="'.date("Y-m-d H:i:s",mktime($clean["startHourUpdateSelect"],$clean["startMinuteUpdateSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'",EndDateTime="'.date("Y-m-d H:i:s",mktime($clean["endHourUpdateSelect"],$clean["endMinuteUpdateSelect"]*10,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"],$_SESSION["Y"])).'"';
            for($cnt=0;$cnt<count($calName);$cnt++){
                $query.=','.$calName[$cnt].'="'.$clean[$calName[$cnt].'PlusUpdate'].'"';
            }
            for($cnt=0;$cnt<count($addicCalName);$cnt++){
                if((int)$clean['plusUpdateCheck'.$cnt]>0){
                    $query.=','.$addicCalName[$cnt].'='.$clean['plusUpdateCheck'.$cnt];
                    $query.=','.$addicCalName[$cnt].'Num='.$clean['plusUpdateNumSelect'.$cnt];
                    $query.=','.$addicCalName[$cnt].'Unit='.$clean['plusUpdateUnitSelect'.$cnt];
                }else{
                    $query.=','.$addicCalName[$cnt].'=0';
                    $query.=','.$addicCalName[$cnt].'Num=0';
                    $query.=','.$addicCalName[$cnt].'Unit=0';
                }
            }
            $query.=',Other="'.$clean["OtherPlusUpdate"].'" where ID="'.$patient->ID.'" and StartDateTime="'.$row[0].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
    
        if(!empty($clean["FunEventsAbstractForm"])){
            $query='SELECT Num from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $notOkFunEventsAbstractNumber=array();
            while($row=mysqli_fetch_array($result)){
                array_push($notOkFunEventsAbstractNumber,$row[0]);
            }
            $saveOrComplete=$clean["FunEventsAbstractSaveComplete"];
            $cnt=$clean["FunEventsAbstractSaveCompleteNum"];
            $query='SELECT MAX(Num) from FunEvents where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            $biggestFunAbNum=$row[0]+1;
            if($cnt<count($notOkFunEventsAbstractNumber)){
            if($saveOrComplete==1){
                $query='update FunEvents SET StartDate="'.$now_date.'",Abstract="'.$clean['FunEventsAbstractInput'.$cnt].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsAbstractNumber[$cnt].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }else if($saveOrComplete==2){
                $query='update FunEvents SET StartDate="'.$now_date.'",AbstractOk=1,Abstract="'.$clean['FunEventsAbstractInput'.$cnt].'" where ID="'.$patient->ID.'" and Num='.$notOkFunEventsAbstractNumber[$cnt].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            }else{
                
                if($saveOrComplete==1){
                    $query='INSERT into FunEvents values("'.$patient->ID.'","'.$biggestFunAbNum.'","'.$now_date.'","0000-00-00",0,"'.$clean['FunEventsAbstractInput'.$cnt].'",0,"");';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                }else if($saveOrComplete==2){
                    $query='INSERT into FunEvents values("'.$patient->ID.'","'.$biggestFunAbNum.'","'.$now_date.'","0000-00-00",1,"'.$clean['FunEventsAbstractInput'.$cnt].'",0,"");';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                }   
            }
            // while($row=mysqli_fetch_array($result)){
            //     if($biggestFunAbNum<$row[0]){
            //         $biggestFunAbNum=$row[0];
            //     }
            // }
            // $biggestFunAbNum=$row[0]+1;
            // $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            // if(!($result=mysqli_query($link,$query))){
            //     goto SQLerror;
            // }
            // for($cnt=count($notOkFunEventsAbstractNumber);$cnt<$nowDateToDo[2];$cnt++){
            // $cnt=mysqli_fetch_array($result)[0];
            //     if(!empty($clean['FunEventsAbstractSave'.$cnt])){
            //         $query='INSERT into FunEvents values("'.$patient->ID.'","'.$biggestFunAbNum.'","'.$now_date.'","0000-00-00",0,"'.$clean['FunEventsAbstractInput'.$cnt].'",0,"");';
            //         // if(!($result=mysqli_query($link,$query))){
            //         //     goto SQLerror;
            //         // }
            //     }
            //     if(!empty($clean['FunEventsAbstractComplete'.$cnt])){
            //         $query='INSERT into FunEvents values("'.$patient->ID.'","'.$biggestFunAbNum.'","'.$now_date.'","0000-00-00",1,"'.$clean['FunEventsAbstractInput'.$cnt].'",0,"");';
            //         // if(!($result=mysqli_query($link,$query))){
            //         //     goto SQLerror;
            //         // }
            //     }
            // }
            //50check
            $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and AbstractOk=1;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            if($row[0]>=$toDoSum[0][1]){
                $query='INSERT into Process values("'.$patient->ID.'","'.$now_date.'",2,2);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $tmpDate=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"]+1,$_SESSION["Y"]));
                $query='INSERT into Process values("'.$patient->ID.'","'.$tmpDate.'",1,3);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["FunEventsConcreteForm"])){
            if($clean['FunEventsConcreteSaveComplete']==1){
                $query='update FunEvents SET Concrete="'.$clean['FunEventsConcrete'].'",EndDate="'.$now_date.'" where ID="'.$patient->ID.'" and Num='.$clean['selecedFunEventsConcrete'].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }else if($clean['FunEventsConcreteSaveComplete']==2){
                $query='update FunEvents SET ConcreteOk=1,Concrete="'.$clean['FunEventsConcrete'].'",EndDate="'.$now_date.'" where ID="'.$patient->ID.'" and Num='.$clean['selecedFunEventsConcrete'].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            //50check
            $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=1;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            if($row[0]>=$toDoSum[1][1]){
                $query='INSERT into Process values("'.$patient->ID.'","'.$now_date.'",2,3);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $tmpDate=date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"]+1,$_SESSION["Y"]));
                $query='INSERT into Process values("'.$patient->ID.'","'.$tmpDate.'",1,8);';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["ControlStimulusSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ControlStimulus SET Num="'.$clean['nowDateControlStimulusSelect'].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["EssayForm"])){
            $InfoEssay=$clean['EssayInput'];
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Data SET Essay="'.$clean['EssayInput'].'" where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='SELECT EssayWrite from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row=mysqli_fetch_array($result)){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'Essay SET EssayWrite=1 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                
            }else{
                $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Essay values("'.$patient->ID.'","'.$now_date.'",1,0);';
            }
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if(!empty($clean["EssayComplete"])){
                $InfoEssayOk=1;
                $query='update '.$addicName[$_SESSION["nowAddic"]].'Data SET EssayOk=1 where ID="'.$patient->ID.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                
                // $file=fopen('text/toDoDefault.txt','r');
                // $cnt=0;
                // while($line=substr(fgets($file),0,-1)){
                //     $lineContents=explode(" ",$line);
                //     if($lineContents[7]>0){
                //         $startEssayReadDelay=$cnt;
                //         break;
                //     }
                //     $cnt++;
                // }
                // fclose($file);
                // $query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=1;';
                // if(!($result=mysqli_query($link,$query))){
                //     goto SQLerror;
                // }
                // $row=mysqli_fetch_array($result);
                // $programStartDateTime=strtotime($row[0]);
                // $tmpDateTime=mktime(0,0,0,date('m',$programStartDateTime),date('d',$programStartDateTime)+$startEssayReadDelay*7,date('Y',$programStartDateTime));
                // if($now_dateTime>$tmpDateTime){
                //     $tmpDate=date("Y-m-d",$now_dateTime);
                // }else{
                //     $tmpDate=date("Y-m-d",$tmpDateTime);
                // }
                // $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Process values("'.$patient->ID.'","'.$tmpDate.'",1,9);';
                // if(!($result=mysqli_query($link,$query))){
                //     goto SQLerror;
                // }
            }
            header('Location:observe.php');
            exit;
        }

        if(!empty($clean["PseudoActSubmit"])){
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'PseudoAct where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'PseudoAct values("'.$patient->ID.'","'.$now_date.'",'.$tmp;
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1]);$cnt2++){
                    if($cnt2==3){
                        $query.=','.$clean[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'];
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($clean[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=',"'.$tmp.'"';
                        $query.=',"'.$clean[$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt]].'"';
                    }
                }
                // $query.=',"'.$clean[$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'"';
            }
            for($cnt=0;$cnt<count($ObservationName[2]);$cnt++){
                $query.=',"'.$clean[$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'"';
            }
            $query.=');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["PseudoActUpdate"])){
            // $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'PseudoAct where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            // if(!($result=mysqli_query($link,$query))){
            //     goto SQLerror;
            // }
            // $row = mysqli_fetch_array($result);
            // $tmp=$row[0]+1;
            $query='Update '.$addicName[$_SESSION["nowAddic"]].'PseudoAct SET ';
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1]);$cnt2++){
                    if($cnt2==3){
                        $query.=' '.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'='.$clean['Re'.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'].',';
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($clean['Re'.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=' '.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'="'.$tmp.'",';
                        $query.=' '.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'="'.$tmp.'",';
                        $query.=' '.$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt].'="'.$clean['Re'.$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt]].'",';        
                    }
                }
                // $query.=' '.$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt].'="'.$clean['Re'.$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'",';
            }
            for($cnt=0;$cnt<count($ObservationName[2]);$cnt++){
                $query.=' '.$ObservationName[2][$cnt].'="'.$clean['Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'"';
                if($cnt!=count($ObservationName[2])-1){
                    $query.=',';
                }
            }
            $query.=' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num="'.$clean["ObservationSelect"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["ImaginationSubmit"])){
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Imagination where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'Imagination values("'.$patient->ID.'","'.$now_date.'",'.$tmp;
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1]);$cnt2++){
                    if($cnt2==3){
                        $query.=','.$clean[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'];
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($clean[$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=',"'.$tmp.'"';
                        $query.=',"'.$clean[$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt]].'"';
                    }
                }
                // $query.=',"'.$clean[$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'"';
            }
            for($cnt=0;$cnt<count($ObservationName[2])-1;$cnt++){
                $query.=',"'.$clean[$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'"';
            }
            
            $query.=','.$clean["aboutWhatSelect"];
            for($cnt=0;$cnt<20;$cnt++){
                $query.=',"'.$clean[$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt].'"';
            }
            $query.=');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["ImaginationUpdate"])){
            // $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Imagination where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            // if(!($result=mysqli_query($link,$query))){
            //     goto SQLerror;
            // }
            // $row = mysqli_fetch_array($result);
            // $tmp=$row[0]+1;
            $query='Update '.$addicName[$_SESSION["nowAddic"]].'Imagination SET ';
            for($cnt=0;$cnt<count($ObservationName[0]);$cnt++){
                for($cnt2=0;$cnt2<count($ObservationName[1]);$cnt2++){
                    if($cnt2==3){
                        $query.=' '.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'='.$clean['Re'.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Select'].',';
                    }else{
                        $tmp='';
                        for($cnt3=0;$cnt3<count($ObservationNameJP[2+$cnt2*2]);$cnt3++){
                            if(!empty($clean['Re'.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'Check'.$cnt3])){
                                $tmp.=1;
                            }else{
                                $tmp.=0;
                            }
                        }
                        $query.=' '.$ObservationName[1][$cnt2].$ObservationName[0][$cnt].'="'.$tmp.'",';
                        $query.=' '.$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt].'="'.$clean['Re'.$ObservationName[1][$cnt2].'Text'.$ObservationName[0][$cnt]].'",';        
                    }
                }
                // $query.=' '.$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt].'="'.$clean['Re'.$ObservationName[1][count($ObservationName[1])-1].$ObservationName[0][$cnt]].'",';
            }
            for($cnt=0;$cnt<count($ObservationName[2])-1;$cnt++){
                $query.=' '.$ObservationName[2][$cnt].'="'.$clean['Re'.$toDoName[$_SESSION["nowToDoView"]-2].$ObservationName[2][$cnt]].'",';
            }
            $query.='aboutWhat='.$clean["ReaboutWhatSelect"];
            for($cnt=0;$cnt<20;$cnt++){
                $tmp=$cnt+1;
                $query.=',word'.$tmp.'="'.$clean['Re'.$toDoName[$_SESSION["nowToDoView"]-2].'word'.$cnt].'"';
            }
            $query.=' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num='.$clean["ObservationSelect"].';';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        // if(!empty($clean["plusObservationForm"])){
        //     if($_SESSION["nowToDoView"]==6){
        //         $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'PseudoAct where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        //         if(!($result=mysqli_query($link,$query))){
        //             goto SQLerror;
        //         }
        //         $row = mysqli_fetch_array($result);
        //         for($cnt=1;$cnt<=$row[0];$cnt++){
        //             if(!empty($clean["PseudoActSubmit".$cnt])){
        //                 $query='update '.$addicName[$_SESSION["nowAddic"]].'PseudoAct SET Observation="'.$clean['PseudoActInput'.$cnt].'",TimeZone='.$clean['PseudoActTimeZoneSelect'.$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num='.$clean['PseudoActSubmit'.$cnt].';';
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
        //             if(!empty($clean["ImaginationSubmit".$cnt])){
        //                 $query='update '.$addicName[$_SESSION["nowAddic"]].'Imagination SET Observation="'.$clean['ImaginationInput'.$cnt].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and Num='.$clean['ImaginationSubmit'.$cnt].';';
        //                 if(!($result=mysqli_query($link,$query))){
        //                     goto SQLerror;
        //                 }
        //             }
        //         }
        //     }
        // }
        if(!empty($clean["plusImaginationTextForm"])){
            $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].'ImaginationText where ID="'.$patient->ID.'" and ActionTextOk=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $incompleteImaginationTextNum=array();
            while($row=mysqli_fetch_array($result)){
                array_push($incompleteImaginationTextNum,$row[0]);
            }
            if($clean["ImaginationTextNum"]==count($incompleteImaginationTextNum)){
                $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'ImaginationText where ID="'.$patient->ID.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $nextImaginationTextNum=mysqli_fetch_array($result)[0];
                $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'ImaginationText values("'.$patient->ID.'","'.$now_date.'","'.date("Y-m-d",mktime(0,0,0,$clean["plusImaginationTextM".$clean["ImaginationTextNum"]],$clean["plusImaginationTextD".$clean["ImaginationTextNum"]],$clean["plusImaginationTextY".$clean["ImaginationTextNum"]])).'",'.$nextImaginationTextNum.',"'.$clean["plusImaginationText".$clean["ImaginationTextNum"]].'",'.$clean["ImaginationTextComplete"].');';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }else{
                $query='update '.$addicName[$_SESSION["nowAddic"]].'ImaginationText set StartDate="'.$now_date.'",ActionDate="'.date("Y-m-d",mktime(0,0,0,$clean["plusImaginationTextM".$clean["ImaginationTextNum"]],$clean["plusImaginationTextD".$clean["ImaginationTextNum"]],$clean["plusImaginationTextY".$clean["ImaginationTextNum"]])).'",ActionText="'.$clean["plusImaginationText".$clean["ImaginationTextNum"]].'",ActionTextOk='.$clean["ImaginationTextComplete"].' where ID="'.$patient->ID.'" and Num='.$incompleteImaginationTextNum[$clean["ImaginationTextNum"]].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["FunEventsReadSubmit"])){
            if($clean["FunEventsReadWhat"]==1){
                $query='UPDATE FunEvents SET Abstract="'.$clean["FunEventsReadAbstract"].'",Concrete="'.$clean["FunEventsReadConcrete"].'" where ID="'.$patient->ID.'" and Num='.$clean["FunEventsReadSelect"].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }else if($clean["FunEventsReadWhat"]==2){
                $query='Insert into FunEventsRead values("'.$patient->ID.'","'.$now_date.'",'.$clean["FunEventsReadSelect"];
                for($cnt=0;$cnt<20;$cnt++){
                    $query.=',"'.$clean["FunEventsRead".$cnt].'"';
                }
                $query.=');';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["EssayReadSubmit"])){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'Essay SET EssayRead="'.$clean['nowDateEssayReadSelect'].'" where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["BBSSubmit"])){
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $tmp=$row[0]+1;
            $query='Insert into '.$addicName[$_SESSION["nowAddic"]].'BBS values("'.$patient->ID.'","'.$today.'",'.$tmp.',"'.$_SESSION['ID'].'","'.$clean["BBSinput"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:observe.php');
            exit;
        }
        if(!empty($clean["BBSUpdate"])){
            $query='SELECT MAX(Num) from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($clean["BBSUpdate"]==1){
                $query='UPDATE '.$addicName[$_SESSION["nowAddic"]].'BBS set TextContents="'.$clean["updateBBSInput"].'" where ID="'.$patient->ID.'" and Num='.mysqli_fetch_array($result)[0].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }else if($clean["BBSUpdate"]==2){
                $query='DELETE from '.$addicName[$_SESSION["nowAddic"]].'BBS where ID="'.$patient->ID.'" and Num='.mysqli_fetch_array($result)[0].';';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }

        }
    }
$query='update FunEvents SET StartDate="'.$today.'" where ID="'.$patient->ID.'" and AbstractOk=0;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$query='update FunEvents SET EndDate="'.$today.'" where ID="'.$patient->ID.'" and ConcreteOk=0;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
// if($_SESSION["dDelay"]<0){
//     goto ToDoSetEnd;
// }
$query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ToDo where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}

if($patient->ID!=""&&!mysqli_fetch_array($result)){
    $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'ToDo values("'.$patient->ID.'","'.$now_date.'",0,0,0,0,0,0,0,0);';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }   
}
$query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=1;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}   
if($patient->ID!=""&&!mysqli_fetch_array($result)){
    if(empty($clean["startProcess"])){
        goto ToDoSetEnd;
    }
    $file=fopen('text/toDoDefault.txt','r');
    $startToDoweek=array(0,0,0,0,0,0,0,0,0,0);
    $cnt=0;
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        for($cnt2=2;$cnt2<count($toDoName)+2;$cnt2++){
            if($lineContents[$cnt2-2]>0&&$startToDoweek[$cnt2]==0){
                $startToDoweek[$cnt2]=$cnt;
            }
        }
        $cnt++;
    }
    $startToDoweek[2]=0;
    $tmpDate=date("Y-m-d",mktime(0,0,0,$clean["startProcessM"],$clean["startProcessD"]+($cnt-2)*7,$clean["startProcessY"]));
    $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Process values("'.$patient->ID.'","'.$tmpDate.'",2,1);';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    fclose($file);
    for($cnt=1;$cnt<count($toDoName)+2;$cnt++){
        if($cnt!=3&&$cnt!=8){
            $tmpDate=date("Y-m-d",mktime(0,0,0,$clean["startProcessM"],$clean["startProcessD"]+$startToDoweek[$cnt]*7,$clean["startProcessY"]));
            if($cnt==2){
                $query='INSERT into Process values("'.$patient->ID.'","'.$tmpDate.'",1,'.$cnt.');';
            }else{
                $query='INSERT into '.$addicName[$_SESSION["nowAddic"]].'Process values("'.$patient->ID.'","'.$tmpDate.'",1,'.$cnt.');';    
            }
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }   
        }
    }   
}

$query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ToDo where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';

if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$tmpToDo= mysqli_fetch_array($result);


$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and StartDate<="'.$now_date.'" and ProcessStatus=1 and ToDoNumber=3;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if($row=mysqli_fetch_array($result)){
    if($tmpToDo[2]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsAbstractEnd;
}
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=2;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<$now_dateTime){
    if($tmpToDo[2]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsAbstractEnd;
}
$query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and AbstractOk=1 and StartDate<"'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$row=mysqli_fetch_array($result);
if($row[0]>=$toDoSum[0][1]){
    if($tmpToDo[2]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsAbstractEnd;
}
for($cnt=0;$cnt<count($toDoDefault);$cnt++){
    if($toDoDefault[$cnt][0]>0){
        if($tmpToDo[2]!=$toDoDefault[$cnt][0]){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract='.$toDoDefault[$cnt][0].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $tmpToDo[2]=$toDoDefault[$cnt][0];
        }
        break;
    }
}
if($row[0]+$tmpToDo[2]>$toDoSum[0][1]){
    $tmp=$toDoSum[0][1]-$row[0];
    $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract='.$tmp.' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    goto FunEventsAbstractEnd;
}
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=2;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}   
$tmpDate=strtotime(mysqli_fetch_array($result)[0]);
$FunAbStartToNowWeek=(int)(($now_dateTime-$tmpDate)/(86400*7));
$tmpDate=date("Y-m-d",mktime(0,0,0,date("m",$tmpDate),date("d",$tmpDate)+$FunAbStartToNowWeek*7,date("Y",$tmpDate)));
$query='SELECT count(*) from FunEvents where AbstractOk=1 and StartDate>="'.$tmpDate.'" and StartDate<"'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$row=mysqli_fetch_array($result);
if($row[0]>$toDoSum[0][0]){
    if($tmpToDo[2]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsAbstractEnd;
}
if($row[0]+$tmpToDo[2]>$toDoSum[0][0]){
    $tmp=$toDoSum[0][0]-$row[0];
    $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEventsAbstract='.$tmp.' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    goto FunEventsAbstractEnd;
}
FunEventsAbstractEnd:
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=3 and StartDate<="'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(!($row=mysqli_fetch_array($result))){
    if($tmpToDo[3]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsEnd;
}
if(strtotime($row[0])>$now_dateTime){
    if($tmpToDo[3]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsEnd;
}
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=3;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if($row=mysqli_fetch_array($result)){
    if(strtotime($row[0])<=$now_dateTime){
        if($tmpToDo[3]>0){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        goto FunEventsEnd;
    }
}
for($cnt=0;$cnt<count($toDoDefault);$cnt++){
    if($toDoDefault[$cnt][1]>0){
        if($tmpToDo[3]!=$toDoDefault[$cnt][1]){
            $tmpToDo[3]=$toDoDefault[$cnt][1];
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents='.$toDoDefault[$cnt][1].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
        break;
    }
}

$query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=1 and EndDate<"'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$row=mysqli_fetch_array($result);
if($row[0]+$tmpToDo[3]>$toDoSum[1][1]){
    $tmp=$toDoSum[1][1]-$row[0];
    $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents='.$tmp.' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    goto FunEventsEnd;
}
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=3;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}   
$tmpDate=strtotime(mysqli_fetch_array($result)[0]);
$FunStartToNowWeek=(int)(($now_dateTime-$tmpDate)/(86400*7));
$tmpDate=date("Y-m-d",mktime(0,0,0,date("m",$tmpDate),date("d",$tmpDate)+$FunStartToNowWeek*7,date("Y",$tmpDate)));

$query='SELECT count(*) from FunEvents where ConcreteOk=1 and EndDate>="'.$tmpDate.'" and EndDate<"'.$now_date.'";';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$row=mysqli_fetch_array($result);
if($row[0]>$toDoSum[1][0]){
    if($tmpToDo[3]>0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    goto FunEventsEnd;        
}
if($row[0]+$tmpToDo[3]>$toDoSum[1][0]){
    $tmp=$toDoSum[1][0]-$row[0];
    $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET FunEvents='.$tmp.' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    goto FunEventsEnd;
}
    
FunEventsEnd:
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=1;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    for($cnt=0;$cnt<count($toDoName);$cnt++){
        if($cnt==2||$cnt==4||$cnt==5){
            if($tmpToDo[$cnt+2]!=$toDoDefault[count($toDoDefault)-1][$cnt]){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[$cnt].'='.$toDoDefault[count($toDoDefault)-1][$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
        }
    }
    goto ControlStimulusEnd;
}
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=7;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    $tmp=count($toDoDefault)-1;
    for($cnt=0;$cnt<count($toDoDefault);$cnt++){
        if($toDoDefault[$cnt][5]>0){
            $tmp=$cnt;
            break;
        }
    }
    for($cnt=0;$cnt<count($toDoName);$cnt++){
        if($cnt==2||$cnt==4||$cnt==5){
            if($tmpToDo[$cnt+2]!=$toDoDefault[$tmp][$cnt]){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[$cnt].'='.$toDoDefault[$tmp][$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
        }
    }
    goto ControlStimulusEnd;
}
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=6;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    $tmp=count($toDoDefault)-1;
    for($cnt=0;$cnt<count($toDoDefault);$cnt++){
        if($toDoDefault[$cnt][4]>0){
            $tmp=$cnt;
            break;
        }
    }
    for($cnt=0;$cnt<count($toDoName);$cnt++){
        if($cnt==2||$cnt==4||$cnt==5){
            if($tmpToDo[$cnt+2]!=$toDoDefault[$tmp][$cnt]){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[$cnt].'='.$toDoDefault[$tmp][$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
        }
    }
    goto ControlStimulusEnd;
}

$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=4;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    $tmp=count($toDoDefault)-1;
    for($cnt=0;$cnt<count($toDoDefault);$cnt++){
        if($toDoDefault[$cnt][2]>0){
            $tmp=$cnt;
            break;
        }
    }
    for($cnt=0;$cnt<count($toDoName);$cnt++){
        if($cnt==2||$cnt==4||$cnt==5){
            if($tmpToDo[$cnt+2]!=$toDoDefault[$tmp][$cnt]){
                $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[$cnt].'='.$toDoDefault[$tmp][$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
            }
        }
    }
    goto ControlStimulusEnd;
}
for($cnt=0;$cnt<count($toDoName);$cnt++){
    if($cnt==2||$cnt==4||$cnt==5){
        if($tmpToDo[$cnt+2]!=$toDoDefault[0][$cnt]){
            $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[$cnt].'='.$toDoDefault[0][$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
        }
    }
}
ControlStimulusEnd:
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=5;';

if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    $query='SELECT EssayOk from AlcoData where ID="'.$patient->ID.'"';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row=mysqli_fetch_array($result);
    if($tmpToDo[5]==0&&$row[0]==0){
        
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[3].'=1 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        goto EssayEnd;
    }
    if($tmpToDo[5]==1&&$row[0]==1){
        
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[3].'=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        goto EssayEnd;
    }
    goto EssayEnd;
}
if($tmpToDo[5]!=0){
    $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[3].'=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
}
EssayEnd:
$query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=8;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(($row=mysqli_fetch_array($result))&&strtotime($row[0])<=$now_dateTime){
    if($tmpToDo[8]!=1){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[6].'=1 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
}else{
    if($tmpToDo[8]!=0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[6].'=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
}
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and StartDate<="'.$now_date.'" and ProcessStatus=1 and ToDoNumber=9;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
$ok=1;
if(!mysqli_fetch_array($result)){
    $ok=0;
}
$query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and StartDate<="'.$now_date.'" and  ProcessStatus=2 and ToDoNumber=1;';
if(!($result=mysqli_query($link,$query))){
    goto SQLerror;
}
if(!mysqli_fetch_array($result)){
    $ok=0;
}
if($ok==1){
    if($tmpToDo[9]!=1){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[7].'=1 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
}else{
    if($tmpToDo[9]!=0){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET '.$toDoName[7].'=0 where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
}
ToDoSetEnd:
    if($_SESSION["dDelay"]>=0&&mb_substr($patient->Addictions,$_SESSION['nowAddic'],1)==2){
        $query='update '.$addicName[$_SESSION["nowAddic"]].'ToDo SET ';
        for($cnt=0;$cnt<count($toDoName);$cnt++){
            $query.=$toDoName[$cnt].'=0';
            if($cnt!=count($toDoName)-1){
                $query.=',';
            }
        }
        $query.=' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ToDo where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $nowDateToDo=mysqli_fetch_array($result);
    $addicInterruptWeek=array_fill(0,$addicNum,0);
    $addicStartCounselling=array_fill(0,$addicNum,0);
    for($cnt=0;$cnt<$addicNum;$cnt++){
        if((int)(substr($patient->Addictions,$cnt,1))==2){
            $query='SELECT StartDate from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ToDoNumber=0;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row=mysqli_fetch_array($result)){
                $tmpDate=$row[0];
            }
            $stage=0;
            $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=1 and StartDate<="'.$tmpDate.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row = mysqli_fetch_array($result)){
                $stage=1;
            }
            $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=4 and StartDate<="'.$tmpDate.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row = mysqli_fetch_array($result)){
                $stage=2;
            }
            $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=6 and StartDate<="'.$tmpDate.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row = mysqli_fetch_array($result)){
                $stage=4;
            }
            $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=7 and StartDate<="'.$tmpDate.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row = mysqli_fetch_array($result)){
                $stage=5;
            }
            $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=1 and StartDate<="'.$tmpDate.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if($row = mysqli_fetch_array($result)){
                $stage=6;
            }
                
            if($stage==6){
                $addicInterruptWeek[$cnt]=count($toDoDefault)-2;
            }else if($stage>=2){
                $tmp=0;
                $file=fopen('text/toDoDefault.txt','r');
                $startToDoweek=array(0,0,0,0,0,0,0,0,0,0);
                while($line=substr(fgets($file),0,-1)){
                    $lineContents=explode(" ",$line);
                    if($lineContents[$stage]>0){
                        break;
                    }
                    $tmp++;
                }
                fclose($file);
                $addicInterruptWeek[$cnt]=$tmp;
            }
        }
        $query='SELECT * from '.$addicName[$cnt].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=1 and StartDate<="'.$today.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        if($row = mysqli_fetch_array($result)){
            $addicStartCounselling[$cnt]=1;
        }
    }
    $file=fopen('text/stage.txt','r');
    $line=substr(fgets($file),0,-1);
    $stageName=explode(" ",$line);
    fclose($file);
    $stage=0;
    if((int)(substr($patient->Addictions,$_SESSION["nowAddic"],1))==2){
        $stage=1;
        goto StageSelected;
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber=1 and StartDate<="'.$today.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if($row = mysqli_fetch_array($result)){
        $stage=6;
        goto StageSelected;
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=7 and StartDate<="'.$today.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if($row = mysqli_fetch_array($result)){
        $stage=5;
        goto StageSelected;
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=6 and StartDate<="'.$today.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if($row = mysqli_fetch_array($result)){
        $stage=4;
        goto StageSelected;
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=4 and StartDate<="'.$today.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if($row = mysqli_fetch_array($result)){
        $stage=3;
        goto StageSelected;
    }
    $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=1 and StartDate<="'.$today.'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if($row = mysqli_fetch_array($result)){
        $stage=2;
        goto StageSelected;
    }
StageSelected:

    $startProcess=array(0);
    $startProcessDate=array(0);
    $finishProcess=array(0);
    $finishProcessDate=array(0);
    
    for($cnt=1;$cnt<count($nowDateToDo);$cnt++){
        if($cnt==2||$cnt==3||$cnt==8){
            $query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber='.$cnt.';';
        }else{
            $query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber='.$cnt.';';
        }
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        if($row = mysqli_fetch_array($result)){
            if(strtotime($row[0])<=$now_dateTime){
                array_push($startProcess,1);
            }else{
                array_push($startProcess,0);
            }
            array_push($startProcessDate,$row[0]);
        }else{
            array_push($startProcess,0);
            array_push($startProcessDate,0);
        }
        if($cnt==2||$cnt==3||$cnt==8){
            $query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber='.$cnt.';';
        }else{
            $query='SELECT StartDate from '.$addicName[$_SESSION["nowAddic"]].'Process where ID="'.$patient->ID.'" and ProcessStatus=2 and ToDoNumber='.$cnt.';';
        }
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        if($row = mysqli_fetch_array($result)){
            if(strtotime($row[0])<=$now_dateTime){
                array_push($finishProcess,1);
            }else{
                array_push($finishProcess,0);
            }
            array_push($finishProcessDate,$row[0]);
        }else{
            array_push($finishProcess,0);
            array_push($finishProcessDate,0);
        }
    }

    $tmpDate=mktime(0,0,0,date("m",strtotime($startProcessDate[7])),date("d",strtotime($startProcessDate[7]))-7,date("Y",strtotime($startProcessDate[7])));
    $showImaginationText=0;
    if($startProcessDate[7]!=0&&$tmpDate<=$now_dateTime){
        $showImaginationText=1;
    }
    $FunEveShow=array(0,0,0,0);

    if($_SESSION["dDelay"]<0){
        $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and AbstractOk=1 and StartDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        if(mysqli_fetch_array($result)[0]>0){
            $FunEveShow[2]=1;
        }
    }else if($_SESSION["dDelay"]==0){
        if($startProcessDate[2]!=0&&strtotime($startProcessDate[2])<=$now_dateTime&&mb_substr($patient->Addictions,$_SESSION['nowAddic'],1)==1){
            if($finishProcessDate[2]==0||$now_dateTime<=strtotime($finishProcessDate[2])){
                $FunEveShow[2]=1;
            }
        }
    }
    if($_SESSION["dDelay"]<0){
        $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=1 and EndDate="'.$now_date.'";';
        if(!($result=mysqli_query($link,$query))){
            goto SQLerror;
        }
        if(mysqli_fetch_array($result)[0]>0){
            $FunEveShow[3]=1;
        }
    }else if($_SESSION["dDelay"]==0){
        if($startProcessDate[3]!=0&&strtotime($startProcessDate[3])<=$now_dateTime&&mb_substr($patient->Addictions,$_SESSION['nowAddic'],1)==1){
            if($finishProcessDate[3]==0||$now_dateTime<=strtotime($finishProcessDate[3])){
            $FunEveShow[3]=1;
            }
        }
    }
    $nowDateToDoOk=array();
    for($cnt=0;$cnt<count($toDoName);$cnt++){
        if($nowDateToDo[$cnt+2]>0){
            switch($cnt){
                case 0:
                    $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and AbstractOk=1;';
                    break;       
                case 1:
                    $query='SELECT count(*) from '.$toDoName[$cnt].' where ID="'.$patient->ID.'" and EndDate="'.$now_date.'" and ConcreteOk=1;';
                    break;
                case 2:
                    $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                    break;
                case 4:
                case 5:
                    $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                    break;
                case 6:
                    $query='SELECT count(*) from '.$toDoName[$cnt].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
                    break;
                case 3:
                    $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'"  and EssayWrite=1;';
                    break;
                case 7:
                    $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'"  and EssayRead=1;';
                    break;
                default:
                    break;
            }
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            if($row[0]<$nowDateToDo[$cnt+2]){
                array_push($nowDateToDoOk,-1);
            }else{
                array_push($nowDateToDoOk,1);
            }
        }else{
            array_push($nowDateToDoOk,0);
        }
    }
    $nowDateToDoAllOk=1;
    for($cnt=0;$cnt<count($nowDateToDoOk);$cnt++){
        if($nowDateToDoOk[$cnt]<0){
            $nowDateToDoAllOk=0;
        }
    }
    $query='SELECT Concrete from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=1;';
    $FunEventsAll=array();
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while($row = mysqli_fetch_array($result)){
        array_push($FunEventsAll,$row[0]);
    }
    $completeFunNum=count($FunEventsAll);
    
    $defaultText=array();
    $file='text/instruction/ControlStimulusInstruction.txt';
    array_push($defaultText,file_get_contents($file));
    $file='text/instruction/PseudoActInstruction.txt';
    array_push($defaultText,file_get_contents($file));
    $file='text/instruction/ImaginationInstruction.txt';
    array_push($defaultText,file_get_contents($file));
    
    if(2<=$_SESSION["nowToDoView"]&&$_SESSION["nowToDoView"]<=count($toDoName)+1){
        $file='text/description/'.$toDoName[$_SESSION["nowToDoView"]-2].'Description.txt';
        $description=file_get_contents($file);
        $description=str_replace("\n","<br>",$description);
        if($_SESSION["nowToDoView"]==4||$_SESSION["nowToDoView"]==6||$_SESSION["nowToDoView"]==7){
            if(${'Info'.$toDoName[$_SESSION["nowToDoView"]-2].'Instruction'}!=""){
                $instruction=${'Info'.$toDoName[$_SESSION["nowToDoView"]-2].'Instruction'};
                $instruction=str_replace("\n","<br>",$instruction);
            }else{
                $file='text/instruction/'.$toDoName[$_SESSION["nowToDoView"]-2].'Instruction.txt';
                $instruction=file_get_contents($file);
                $instruction=str_replace("\n","<br>",$instruction);
            }
        }else{
            $file='text/instruction/'.$toDoName[$_SESSION["nowToDoView"]-2].'Instruction.txt';
            $instruction=file_get_contents($file);
            $instruction=str_replace("\n","<br>",$instruction);
            fclose($file);
        }
    }

    // if($_SESSION["nowCalView"]==1){
    global $frontDescriptionTexts;
        switch($_SESSION["nowToDoView"]){
        case 0:   
            $frontDescriptionTexts=array();
            for($cnt=0;$cnt<$toDoNum;$cnt++){
                $file='text/description/'.$toDoName[$cnt].'Description.txt';
                $frontDescription=file_get_contents($file);
                $frontDescription=str_replace("\n","<br>",$frontDescription);
                array_push($frontDescriptionTexts,$frontDescription);
            }
            $file='text/description/ImaginationTextDescription.txt';
            $frontDescription=file_get_contents($file);
            $frontDescription=str_replace("\n","<br>",$frontDescription);
            array_push($frontDescriptionTexts,$frontDescription);
            
            $file='text/instruction/KeepInstruction.txt';
            $instruction=file_get_contents($file);
            $instruction=str_replace("\n","<br>",$instruction);
            $file='text/description/KeepDescription.txt';
            $description=file_get_contents($file);
            $description=str_replace("\n","<br>",$description);
            break;
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
            $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and AbstractOk=1;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $completeFunAbSum=$row[0];
            
            $query='SELECT Num from FunEvents where ID="'.$patient->ID.'";';
            $biggestFunAbNum=0;
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            while($row=mysqli_fetch_array($result)){
                if($biggestFunAbNum<$row[0]){
                    $biggestFunAbNum=$row[0];
                }
            }
            $biggestFunAbNum+=1;
            if($_SESSION["dDelay"]==0&&$completeFunAbNum<$toDoSum[0][1]){
                $query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=2;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }   
                $tmpDate=strtotime(mysqli_fetch_array($result)[0]);
                $FunStartToNowWeek=(int)(($now_dateTime-$tmpDate)/(86400*7));
                $tmpDate=date("Y-m-d",mktime(0,0,0,date("m",$tmpDate),date("d",$tmpDate)+$FunStartToNowWeek*7,date("Y",$tmpDate)));

                $query='SELECT count(*) from FunEvents where AbstractOk=1 and StartDate>="'.$tmpDate.'" and StartDate<="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $row=mysqli_fetch_array($result);
                if($toDoSum[0][1]-$completeFunAbSum<$toDoSum[0][0]-$row[0]){
                    $remainFunAb=$toDoSum[0][1]-$completeFunAbSum;
                }else{
                    $remainFunAb=$toDoSum[0][0]-$row[0];
                }
                
            }
            $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and AbstractOk=1;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $completeFunAbNum=$row[0];
            $query='SELECT count(*) from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $FunEventsAbstract=array();
            if($completeFunAbNum>=$nowDateToDo[$_SESSION["nowToDoView"]]){
                $query='SELECT * from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and AbstractOk=1 ORDER BY Num ASC;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                for($cnt=0;$cnt<$completeFunAbNum;$cnt++){
                    if($row = mysqli_fetch_array($result)){
                        array_push($FunEventsAbstract,$row);
                    }
                }
                $query='SELECT * from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" and AbstractOk=0 ORDER BY Num ASC;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                if($row = mysqli_fetch_array($result)){
                    array_push($FunEventsAbstract,$row);
                }
            }else{
                $query='SELECT * from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$now_date.'" ORDER BY Num ASC;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                if($row[0]>$nowDateToDo[$_SESSION["nowToDoView"]]){
                    for($cnt=0;$cnt<$nowDateToDo[$_SESSION["nowToDoView"]];$cnt++){
                        $row = mysqli_fetch_array($result);
                        array_push($FunEventsAbstract,$row);
                    }
                }else{
                    while ($row = mysqli_fetch_array($result)) {
                        array_push($FunEventsAbstract,$row);
                    }
                }
            }
            break;
        case 3:
            $query='SELECT * from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=1 and EndDate="'.$now_date.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $completeFunEventsConcrete=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($completeFunEventsConcrete,$row);
            }
            if($_SESSION["dDelay"]==0&&$completeFunNum<$toDoSum[1][1]){
                $query='SELECT StartDate from Process where ID="'.$patient->ID.'" and ProcessStatus=1 and ToDoNumber=3;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }   
                $tmpDate=strtotime(mysqli_fetch_array($result)[0]);
                $FunStartToNowWeek=(int)(($now_dateTime-$tmpDate)/(86400*7));
                $tmpDate=date("Y-m-d",mktime(0,0,0,date("m",$tmpDate),date("d",$tmpDate)+$FunStartToNowWeek*7,date("Y",$tmpDate)));

                $query='SELECT count(*) from FunEvents where ConcreteOk=1 and EndDate>="'.$tmpDate.'" and EndDate<="'.$now_date.'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $row=mysqli_fetch_array($result);
                if($toDoSum[1][1]-$completeFunNum<$toDoSum[1][0]-$row[0]){
                    $remainFun=$toDoSum[1][1]-$completeFunNum;
                }else{
                    $remainFun=$toDoSum[1][0]-$row[0];
                }
            }
            $incompleteFunEventsConcrete=array();
            $query='SELECT * from FunEvents where ID="'.$patient->ID.'" and ConcreteOk=0 ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            while ($row = mysqli_fetch_array($result)) {
                array_push($incompleteFunEventsConcrete,$row);
            }   
            break;
        case 4:
            $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }       
            if(!mysqli_fetch_array($result)){
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
            $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $daySum=0;
            while ($row = mysqli_fetch_array($result)) {
                $daySum+=$row[0];
            }
            break;
        case 5:
        case 9:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            if(!mysqli_fetch_array($result)){
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
            if($_SESSION["nowToDoView"]==5){
                $query='SELECT EssayWrite from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate<"'.$now_date.'";';
            }else{
                $query='SELECT EssayRead from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate<"'.$now_date.'";';
            }
            
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $daySum=0;
            while ($row = mysqli_fetch_array($result)) {
                $daySum+=$row[0];
            }
            break;    
        case 6:
        case 7:
            $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row=mysqli_fetch_array($result);
            $daySum=$row[0];
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
            $textCheck=array(14,8,7,0,2);
            if($_SESSION["nowToDoView"]==7){
                $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ImaginationText where ID="'.$patient->ID.'" and ActionTextOk=1 ORDER BY Num ASC;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $ImaginationTextComplete=array();
                while ($row = mysqli_fetch_array($result)) {
                    array_push($ImaginationTextComplete,$row);
                }
                $query='SELECT * from '.$addicName[$_SESSION["nowAddic"]].'ImaginationText where ID="'.$patient->ID.'" and ActionTextOk=0 ORDER BY Num ASC;';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $ImaginationText=array();
                while ($row = mysqli_fetch_array($result)) {
                    array_push($ImaginationText,$row);
                }
            }
            
            if($_SESSION["nowToDoView"]==7){
                $file='text/description/'.$toDoName[$_SESSION["nowToDoView"]-2].'TextDescription.txt';
                $textDescription=file_get_contents($file);
                $textDescription=str_replace("\n","<br>",$textDescription);
                $file='text/instruction/'.$toDoName[$_SESSION["nowToDoView"]-2].'TextInstruction.txt';
                $textInstruction=file_get_contents($file);
                $textInstruction=str_replace("\n","<br>",$textInstruction);
            }
            break;
        case 8:
            $query='SELECT * from '.$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate="'.$now_date.'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $FunEventsRead=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($FunEventsRead,$row);
            }   
            $query='SELECT Abstract,Concrete from FunEvents where ID="'.$patient->ID.'" ORDER BY Num ASC;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $FunEvents=array();
            while ($row = mysqli_fetch_array($result)) {
                array_push($FunEvents,$row);
            }
            $query='SELECT count(*) from '.$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$now_date.'";';
            
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $row = mysqli_fetch_array($result);
            $daySum=$row[0];
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
                    if(count($tmpContents)>0){
                        array_push($monthContents,$addicNameJP[$_SESSION["nowAddic"]]);
                    }else{
                        array_push($monthContents,'');
                    }
                    
                    array_push($monthTimesJP,$tmpTimesJP);
                }
                
                break;
            case 2:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from FunEvents where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'" and AbstractOk=1;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0];
                        array_push($tmpContents,$tmp.'完');
                    }
                    array_push($monthContents,$tmpContents);
                }
                
                break;
            case 3:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from FunEvents where ID="'.$patient->ID.'" and EndDate="'.$month_Days[$i].'" and ConcreteOk=1;';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0];
                        array_push($tmpContents,$tmp.'完');
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
                $query='SELECT Num from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$month_Days[1].'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $monthSum=0;
                while ($row = mysqli_fetch_array($result)) {
                    $monthSum+=$row[0];
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
                if($_SESSION["nowToDoView"]==5){
                    $query='SELECT EssayWrite from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate<"'.$month_Days[1].'";';
                }else{
                    $query='SELECT EssayRead from '.$addicName[$_SESSION["nowAddic"]].'Essay where ID="'.$patient->ID.'" and StartDate<"'.$month_Days[1].'";';
                }
                
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $monthSum=0;
                while ($row = mysqli_fetch_array($result)) {
                    $monthSum+=$row[0];
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
                $query='SELECT count(*) from '.$addicName[$_SESSION["nowAddic"]].$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$month_Days[1].'";';
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $row=mysqli_fetch_array($result);
                $monthSum=$row[0];
                break;
            case 8:
                for($i=1; $i<=$month_DaysNum; $i++){
                    $tmpContents=array();
                    $query='SELECT Num from FunEventsRead where ID="'.$patient->ID.'" and StartDate="'.$month_Days[$i].'";';
                    if(!($result=mysqli_query($link,$query))){
                        goto SQLerror;
                    }
                    while ($row = mysqli_fetch_array($result)) {
                        $tmp=$row[0]+1;
                        array_push($tmpContents,$tmp.'番');
                    }
                    array_push($monthContents,$tmpContents);
                }
                $query='SELECT count(*) from '.$toDoName[$_SESSION["nowToDoView"]-2].' where ID="'.$patient->ID.'" and StartDate<"'.$month_Days[1].'";';
                
                if(!($result=mysqli_query($link,$query))){
                    goto SQLerror;
                }
                $row = mysqli_fetch_array($result);
                $monthSum=$row[0];
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
            mysqli_close($link);
            die();
        }
    mysqli_close($link);
?>