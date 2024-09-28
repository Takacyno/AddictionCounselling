<?php include('DBconnect.php');?>
<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    $clean = array();
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    }
    $query='SELECT * from aboutDB;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_assoc($result);
    $addicNum=(int)$row["AddicNum"];
    if(empty($_SESSION["nowCreateClass"])){
        $_SESSION["nowCreateClass"]=1;
    }
    $file=fopen('text/test.txt','r');
    $testNameJP=array();
    while($line=substr(fgets($file),0,-1)){
        array_push($testNameJP,$line);
    }
    fclose($file);
    $addicName=array();
    $addicNameJP=array();
    $hospitalNameJP=array();
    $week = array('日','月','火','水','木','金','土');
    $file=fopen('text/addicName.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($addicName,$lineContents[0]);
        array_push($addicNameJP,$lineContents[1]);
    }
    fclose($file);
    $file=fopen('text/hospitalName.txt','r');
    if($_SESSION["rank"]==0){
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
    $file=fopen('text/className.txt','r');
    $line=substr(fgets($file),0,-1);
    $classNameJP=explode(" ",$line);
    fclose($file);
    $query='SELECT Email from UserData;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $Emails=array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($Emails,$row[0]);
    }
    $sex=array('','男','女');
    $counsellorName=array();
    $file=fopen('text/counsellorInfo.txt','r');
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($counsellorName,$lineContents);
    }
    fclose($file);
    $file=fopen('text/patientBasicInfo.txt','r');
    $patientBasicInfoName=array();
    while($line=substr(fgets($file),0,-1)){
        $lineContents=explode(" ",$line);
        array_push($patientBasicInfoName,$lineContents);
    }
    fclose($file);
    $longestPatientInfoName=0;
    for($cnt=0;$cnt<count($patientBasicInfoName[0]);$cnt++){
        if(mb_strlen($patientBasicInfoName[1][$cnt])>$longestPatientInfoName){
            $longestPatientInfoName=mb_strlen($patientBasicInfoName[1][$cnt]);
        }
    }
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
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    //   require 'PHPMailer/src/Exception.php';
  
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';
    if(!empty($clean)){
    //     if(!empty($clean["addPatient"])){
    //         $tmp=$clean["Hospital"]-1;
    //         $query='SELECT ID from PatientData where Hospital="'.$tmp.'";';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         $IDMaxnumber=0;
    //         while ($row = mysqli_fetch_array($result)) {
    //             echo $row[0];
    //             if((int)substr($row[0],2)>(int)$IDMaxnumber){
    //                 $IDMaxnumber=(int)substr($row[0],2);
    //             }
    //         }
    //         $IDMaxnumber+=1;
    //         $IDNumstr=(string)$IDMaxnumber;
    //         $zeros=8-mb_strlen($IDNumstr);
    //         $hospitalChrNum=$clean["Hospital"]+64;
    //         $hospitalChr=chr($hospitalChrNum);
    //         $IDStr='0'.$hospitalChr;
    //         for($cnt=0;$cnt<$zeros;$cnt++){
    //             $IDStr.='0';
    //         }
    //         $IDStr.=$IDNumstr;
    //         $pass='';
    //         for($cnt=0;$cnt<6;$cnt++){
    //             $tmp=mt_rand(0,61);
    //             if($tmp<=9){
    //                 $pass.=chr($tmp+48);
    //             }else if(10<=$tmp&&$tmp<=35){
    //                 $pass.=chr($tmp+55);
    //             }else{
    //                 $pass.=chr($tmp+61);
    //             }
    //         }
            
            
    //         $mail = new PHPMailer(true);
    //         try {
    //             //Gmail 認証情報
    //             $query='SELECT * from emailData;';
    //             if(!($result=mysqli_query($link,$query))){
    //               goto SQLerror;
    //             }
    //             $row = mysqli_fetch_assoc($result);
                      
    //             $host = $row['Host'];
    //             $username = $row['Account']; 
    //             $password = $row['Pass'];
              
    //             //差出人
    //             $from = 'staff@mind-nature.net';
    //             $fromname = 'カウンセリングサイト';
              
    //             //宛先
    //             $to = 'staff@mind-nature.net';
    //             $toname = '谷原宗之';
              
    //             //件名・本文
    //             $subject=$clean["Allname"]."さんのアカウントを作成しました";
    //             $body=$clean["Allname"]."さんのメールアドレスは\n".$clean["Email"]."\nパスワードは\n".$pass."\nです";  
              
    //             //メール設定
    //             $mail->SMTPDebug = 2; //デバッグ用
    //             $mail->isSMTP();
    //             $mail->SMTPAuth = true;
    //             $mail->Host = $host;
    //             $mail->Username = $username;
    //             $mail->Password = $password;
    //             $mail->SMTPSecure = 'tls';
    //             $mail->Port = 587;
    //             $mail->CharSet = "utf-8";
    //             $mail->Encoding = "base64";
    //             $mail->setFrom($from, $fromname);
    //             $mail->addAddress($to, $toname);
    //             $mail->Subject = $subject;
    //             $mail->Body    = $body;
              
    //             //メール送信
    //             $mail->send();
    //             echo '成功した';
              
    //           } catch (Exception $e) {
    //             echo '失敗: ', $mail->ErrorInfo;
    //             goto SQLerror;
    //           }
            
    //         $pass=password_hash($pass,PASSWORD_BCRYPT);
    //         $file=fopen(".htpasswd","a");
    //         fputs($file,$IDStr.':'.$pass."\n");
    //         fclose($file);
    //         $query='INSERT into UserData values("'.$IDStr.'",0,"'.$pass.'","'.$clean["Email"].'",1);';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         $clean["Counsellors"]='';
    //         $clean["Addictions"]='';
    //         $clean["Holiday"]='';
    //         $clean["Hospital"]=$clean["Hospital"]-1;
    //         for($cnt=0;$cnt<count($clean["counsellorIDs"]);$cnt++){
    //             $clean["Counsellors"].=$clean["counsellorIDs"][$cnt];
    //         }
    //         for($cnt=0;$cnt<count($testNameJP);$cnt++){
    //             if($clean["testShow".$cnt]==1){
    //                 $clean["TestShow"].=1;
    //             }else{
    //                 $clean["TestShow"].=0;
    //             }
    //         }
    //         for($cnt=0;$cnt<$addicNum;$cnt++){
    //             if($clean["addictions".$cnt]==1){
    //                 $clean["Addictions"].=1;
    //             }else{
    //                 $clean["Addictions"].=0;
    //             }
    //         }
    //         for($cnt=0;$cnt<7;$cnt++){
    //             if($clean["holiday".$cnt]==1){
    //                 $clean["Holiday"].=1;
    //             }else{
    //                 $clean["Holiday"].=0;
    //             }
    //         }
    //         $query='INSERT into PatientData values("'.$IDStr.'"';
    //         for($cnt=1;$cnt<count($patientBasicInfoName[0]);$cnt++){
    //             $query.=',"'.$clean[$patientBasicInfoName[0][$cnt]].'"';
    //         }
    //         $query.=');';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         header('Location:counsellor.php');
    //         exit;
    //     }
    //     if(!empty($clean["addCounsellor"])){
    //         $tmp=$clean["counsellorHospital"]-1;
    //         $query='SELECT ID from CounsellorData where Hospital="'.$tmp.'";';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         $IDMaxnumber=0;
    //         while ($row = mysqli_fetch_array($result)) {
    //             if((int)substr($row[0],2)>$IDMaxnumber){
    //                 $IDMaxnumber=(int)substr($row[0],2);
    //             }
    //         }
    //         $IDMaxnumber+=1;
            
    //         $IDNumstr=(string)$IDMaxnumber;
    //         $zeros=8-mb_strlen($IDNumstr);
    //         $hospitalChrNum=$clean["counsellorHospital"]+64;
    //         $hospitalChr=chr($hospitalChrNum);
    //         $IDStr=$hospitalChr.'0';
    //         for($cnt=0;$cnt<$zeros;$cnt++){
    //             $IDStr.='0';
    //         }
    //         $IDStr.=$IDNumstr;
    //         $pass='';
    //         for($cnt=0;$cnt<6;$cnt++){
    //             $tmp=mt_rand(0,61);
    //             if($tmp<=9){
    //                 $pass.=chr($tmp+48);
    //             }else if(10<=$tmp&&$tmp<=35){
    //                 $pass.=chr($tmp+55);
    //             }else{
    //                 $pass.=chr($tmp+61);
    //             }
    //         }
    //         $mail = new PHPMailer(true);
    //         try {
    //             //Gmail 認証情報
    //             $query='SELECT * from emailData;';
    //             if(!($result=mysqli_query($link,$query))){
    //               goto SQLerror;
    //             }
    //             $row = mysqli_fetch_assoc($result);
                      
    //             $host = $row['Host'];
    //             $username = $row['Account']; 
    //             $password = $row['Pass'];
              
    //             //差出人
    //             $from = 'staff@mind-nature.net';
    //             $fromname = 'カウンセリングサイト';
              
    //             //宛先
    //             $to = 'staff@mind-nature.net';
    //             $toname = '谷原宗之';
              
    //             //件名・本文
    //             $subject=$clean["Allname"]."さんのアカウントを作成しました";
    //             $body=$clean["Allname"]."さんのメールアドレスは\n".$clean["Email"]."\nパスワードは\n".$pass."\nです";  
              
    //             //メール設定
    //             $mail->SMTPDebug = 2; //デバッグ用
    //             $mail->isSMTP();
    //             $mail->SMTPAuth = true;
    //             $mail->Host = $host;
    //             $mail->Username = $username;
    //             $mail->Password = $password;
    //             $mail->SMTPSecure = 'tls';
    //             $mail->Port = 587;
    //             $mail->CharSet = "utf-8";
    //             $mail->Encoding = "base64";
    //             $mail->setFrom($from, $fromname);
    //             $mail->addAddress($to, $toname);
    //             $mail->Subject = $subject;
    //             $mail->Body    = $body;
              
    //             //メール送信
    //             $mail->send();
    //             echo '成功した';
              
    //           } catch (Exception $e) {
    //             echo '失敗: ', $mail->ErrorInfo;
    //             goto SQLerror;
    //           }
            
    //         $pass=password_hash($pass,PASSWORD_BCRYPT);
    //         $file=fopen(".htpasswd","a");
    //         fputs($file,$IDStr.':'.$pass."\n");
    //         fclose($file);
    //         $query='INSERT into UserData values("'.$IDStr.'",1,"'.$pass.'","'.$clean["counsellorEmail"].'",1);';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         $clean["counsellorHospital"]=$clean["counsellorHospital"]-1;
    //         $query='INSERT into CounsellorData values("'.$IDStr.'"';
    //         for($cnt=1;$cnt<count($counsellorName[0]);$cnt++){
    //             $query.=',"'.$clean['counsellor'.$counsellorName[0][$cnt]].'"';
    //         }
    //         $query.=');';
    //         if(!($result=mysqli_query($link,$query))){
    //             goto SQLerror;
    //         }
    //         echo '<script>alert("新しいカウンセラーのアカウントを作成しました");</script>';
    //         header('Location:counsellor.php');
    //         exit;
    //     }
        if(!empty($clean["classSelect"])){
            $_SESSION["nowCreateClass"]=(int)$clean["classSelect"];
        }
        if(!empty($clean["goPatientSelect"])){
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($clean["logOut"])){
            session_destroy();
            header('Location:../login.php');
            exit;
        }
    }
SQLerror:
    if(!empty(mysqli_error($link))){
        echo "Error".mysqli_error($link);    
        mysqli_close($link);
        die();
    }
mysqli_close($link);
?>
<!DOCTYPE html>

<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/registeration.css">
  <link rel="stylesheet" href="style/alert.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
<div id="alert">
    <div>
        <p></p>
        <button>ok</button>
    </div>
</div>
<div id="confirm" class="none">
    <div>
        <p></p>
        <input type="hidden" id="okORcancel">
        <button id='ok' onclick="ok_click()">ok</button>
        <button id='cancel' onclick="cancel_click()">キャンセル</button>
    </div>
</div>
    <header>
    <?php
        echo '<form action="registeration.php" method="post" id="classSelectForm" name="classSelectForm">';
            echo  '<select id="classSelect" name="classSelect" onchange="this.form.submit();">';
            for($cnt=1;$cnt<=2;$cnt++){
                $tmp='<option value='.$cnt;
                if((int)$cnt==(int)$_SESSION["nowCreateClass"]){
                    $tmp.=' selected=true';
                }
                $tmp.='>'.$classNameJP[$cnt-1].'</option>';
                echo $tmp;
            }
            echo '</select>';
        echo '</form>';
    ?>
        <form action="registeration.php" method="post">
            <input id="goPatientSelect" type="submit" name="goPatientSelect" class="canPush"  value="選択画面へ">
            
        </form>    
        <form action="registeration.php" method="post">
            <input id="logOut" type="submit" name="logOut" class="btn none" value=1>
            <label id="logOutLabel" for="logOut" class="canPush "><img src="image/logOut.png" alt="ログアウト" width="40" height="40"></label>
        </form>
    </header>

    <div class="parent">
        <div class="child">
            <h1>アカウントを作成</h1>
            <?php
            if($_SESSION["nowCreateClass"]==1){
                echo '<form action="registeration.php" method="post" name="patientAccountForm">';
                echo '<div id="cautionAllname"></div>
                <label for=""><span>名前　　　　　</span><span class="Red">*必須</span>
                <input type="text" id="Allname" name="Allname" id=""><br>
                </label>
                <div id="cautionEmail"></div>
                <label for=""><span>メールアドレス</span><span class="Red">*必須</span>
                <input type="email" id="Email" name="Email" id=""><br>
                </label>
                <label for=""><span>病院　　　　　</span><span class="Red">*必須 </span><select id="Hospital" name="Hospital">
                    <option value=0></option>';
                    for($cnt=1;$cnt<=$hospitalNum;$cnt++){
                        echo '<option value='.$cnt.'>'.$hospitalNameJP[$cnt-1].'</option>';
                    }
                echo '</select><br></label>
                <span>症状　　　　　</span><span class="Red">*必須</span>';
                    for($cnt=0;$cnt<$addicNum;$cnt++){
                        echo '<input type="checkbox" id="addicCheck'.$cnt.'" name="addictions'.$cnt.'" value="1" >';
                        echo '<label for="addicCheck'.$cnt.'">'.$addicNameJP[$cnt].'に関する悩み</label>';
                    }
                    echo '<br>';
                    $cnt=3;
                    echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                        echo '　';
                    }
                    echo '</label><textarea id="BasicInfo'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1"></textarea><br>';

                    $cnt=4;
                    echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                        echo '　';
                    }
                    echo '</label>';
                    echo  '<select id="BasicInfo'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'">';
                    echo '<option value=0></option>';
                    for($cnt=1;$cnt<count($sex);$cnt++){
                        echo '<option value='.$cnt.'>'.$sex[$cnt].'</option>';
                    }
                    echo '</select><br>';
                    
                    $cnt=5;
                    echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                        echo '　';
                    }
                    echo '<div id="BasicInfoCounsellors" class="inlineBlock"></div>';
                    echo '</label>';
                    echo '<br>';
                    for($cnt2=0;$cnt2<$longestPatientInfoName;$cnt2++){
                        echo '　';
                    }
                    echo '<div id="plusMenu">';
                        echo '<input type="checkbox" id="plusCheck" name="plusCheck" >';
                        echo '<label id="plusOpen" for="plusCheck"><img src="image/plus.png" alt="追加" width="20" height="20"></label>';
                        echo '<label id="plusClose" for="plusCheck"></label>';
                        echo '<div id="plusDiv" class="inlineBlock">';

                        echo '<div class="Block">';
                        echo '<input type="text" name="searchName" id="searchName" >';
                        echo '<input type="button" id="search" name="search" class="none" onClick="searchNameCheck();">';
                        echo '<label for="search" class="canPush"><img src="image/search.png" alt="検索" width="20" height="20"></label>';
                        echo '</div>';

                        for($cnt=0;$cnt<$hospitalNum;$cnt++){
                            echo '<input type="checkbox" id="pullDown'.$cnt.'" onclick="pullDown(this.id);" class="none">';
                            echo '<label for="pullDown'.$cnt.'" class="canPush">'.$hospitalNameJP[$cnt].'<img src="image/pullDown.png" alt="病院" width="20" height="12"></label><br>';
                            echo '<ol id="list'.$cnt.'" class="list none">';
                            for($cnt2=0;$cnt2<count($counsellors[$cnt]);$cnt2++){
                                echo '<li><input type="button" class="patientBtn" id="'.$cnt.'_'.$cnt2.'" name="'.$counsellors[$cnt][$cnt2][0].'" value="'.$counsellors[$cnt][$cnt2][1].'" onClick="addCounsellor(this.name,this.value);">';
                            }
                            echo '</ol>';
                        }
                        
                        echo '</div>';
                    echo '</div><br>';

                    for($cnt=6;$cnt<count($patientBasicInfoName[0])-3;$cnt++){
                        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                        for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                            echo '　';
                        }
                        echo '</label><textarea id="BasicInfo'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1"></textarea><br>';
                    }
                    $cnt=count($patientBasicInfoName[0])-3;
                    echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                        for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                            echo '　';
                        }
                    echo '</label>';
                    for($cnt=0;$cnt<count($testNameJP);$cnt++){
                        echo '<input type="checkbox" id="testShowCheck'.$cnt.'" name="testShow'.$cnt.'" value="1"';
                        echo '><label for="testShowCheck'.$cnt.'">'.$testNameJP[$cnt].'</label>';
                    }
                    echo '<br>';
                    $cnt=count($patientBasicInfoName[0])-1;
                    echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
                        for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                            echo '　';
                        }
                    echo '</label>';
                    for($cnt=0;$cnt<7;$cnt++){
                        echo '<input type="checkbox" id="holidayCheck'.$cnt.'" name="holiday'.$cnt.'" value="1"';
                        echo '><label for="holidayCheck'.$cnt.'">'.$week[$cnt].'</label>';
                    }
                    echo '<br>';
                echo '<input type="text" name="addPatient" value="送信" class="none">';
                echo '<input type="button" value="送信" onClick="newPatientCheck(this);">';
                echo '</form>';
            }else if($_SESSION["nowCreateClass"]==2){
                echo '<form action="registeration.php" method="post" name="counsellorAccountForm">';
                echo '<label for=""><span>役職　　　　　</span><span class="Red">*必須 </span><select id="counsellorRank" name="counsellorRank">';
                echo '<option value=0></option>';

                for($cnt=1;$cnt<count($counsellorName[2]);$cnt++){
                    echo '<option value='.$cnt.'>'.$counsellorName[2][$cnt].'</option>';
                }
                echo '</select><br></label>';
                echo '<label for=""><span>名前　　　　　</span><span class="Red">*必須 </span>';
                echo '<input type="text" id="counsellorAllname" name="counsellorAllname"><br></label>';
                echo '<label for=""><span>メールアドレス</span><span class="Red">*必須 </span>';
                echo '<input type="email" id="counsellorEmail" name="counsellorEmail" id=""><br></label>';
                echo '<label for=""><span>病院　　　　　</span><span class="Red">*必須 </span><select id="counsellorHospital" name="counsellorHospital">';
                echo '<option value=0></option>';
                for($cnt=1;$cnt<=$hospitalNum;$cnt++){
                    echo '<option value='.$cnt.'>'.$hospitalNameJP[$cnt-1].'</option>';
                }
                echo '</select><br></label>';
                echo '<input type="text" name="addCounsellor" value="送信" class="none">';
                echo '<input type="button" value="送信" onClick="newCounsellorCheck(this);">';
                echo '</form>';
            }
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        var Emails=<?php $json_Emails=json_encode($Emails); echo $json_Emails; ?>;
        var counsellors=<?php $json_counsellors=json_encode($counsellors); echo $json_counsellors; ?>;
        var addicNum=<?php $json_addicNum=json_encode($addicNum); echo $json_addicNum; ?>;
    </script>
    <script src="script/registeration.js"></script>
</body>
</html>
