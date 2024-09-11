<?php include('DBconnect.php');?>
<?php
    // サニタイズ
    $clean = array();
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    }
    if(!empty($clean)){
        if(!empty($clean['updateThisCounserllor'])){
            $query='update CounsellorData set Rank='.$clean["counsellorRank"].',Hospital='.$clean["counsellorHospital"].' where ID="'.$clean["counsellorID"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='update UserData set UserStatus='.$clean["counsellorUserStatus"].' where ID="'.$clean["counsellorID"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($clean['updateCounsellor'])){
            $query='update CounsellorData set Allname="'.$clean["Allname"].'" where ID="'.$_SESSION["ID"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $query='update UserData set Email="'.$clean["Email"].'" where ID="'.$_SESSION["ID"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:counsellor.php');
            exit;
        }
        
    }    
    $query='SELECT * from CounsellorData where ID="'.$_SESSION['ID'].'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    if(empty($_SESSION["nowAddic"])){
        $_SESSION["nowAddic"]=0;
    }
    if(empty($_SESSION["nowClassView"])){
        $_SESSION["nowClassView"]=0;
    }
    $row = mysqli_fetch_assoc($result);
    $_SESSION["rank"]=$row["Rank"];
    $Allname=$row["Allname"];
    $_SESSION["hospital"]=$row["Hospital"];
    $file=fopen('text/className.txt','r');
    $line=substr(fgets($file),0,-1);
    $classNameJP=explode(" ",$line);
    fclose($file);
    $query='SELECT * from aboutDB;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $row = mysqli_fetch_assoc($result);
    $addicNum=(int)$row["AddicNum"];
    
    $addicName=array();
    $addicNameJP=array();
    $hospitalNameJP=array();

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
    if(!empty($clean)){
        if(!empty($clean['updateThisFrontCoverBBS'])){//edit
            $query='update frontCoverBBS set BBSstatus='.$clean["FrontCoverBBSBBSstatus"];
            if($_SESSION["rank"]==0){
                $query.=',Hospital="';
                for($cnt=0;$cnt<$hospitalNum;$cnt++){
                    if(!empty($clean["FrontCoverBBSHospital".$cnt])){
                        $query.=1;
                    }else{
                        $query.=0;
                    }
                    
                }
                $query.='"';
            }
            $query.=',Addiction="';
            for($cnt=0;$cnt<$addicNum;$cnt++){
                if(!empty($clean["FrontCoverBBSAddiction".$cnt])){
                    $query.=1;
                }else{
                    $query.=0;
                }
                
            }
            $query.='",TextContents="'.$clean["FrontCoverBBSTextContents"].'"';
            $query.=' where Num='.$clean["FrontCoverBBSNum"].';';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($clean['plusFrontCoverBBS'])){//edit
            $query='SELECT MAX(Num) from frontCoverBBS;';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $biggestNum=mysqli_fetch_array($result)[0];
            $biggestNum++;
            $query='INSERT into frontCoverBBS values('.$biggestNum.',1,"';
            if($_SESSION["rank"]==0){
                for($cnt=0;$cnt<$hospitalNum;$cnt++){
                    if(!empty($clean["plusFrontCoverBBSHospital".$cnt])){
                        $query.=1;
                    }else{
                        $query.=0;
                    }
                    
                }
                $query.='","';
            }else{
                for($cnt=0;$cnt<$_SESSION["hospital"];$cnt++){
                    $query.=0;
                }
                $query.='1';
                $query2='SELECT count(*) from aboutHospital;';
                if(!($result2=mysqli_query($link,$query2))){
                    goto SQLerror;
                }
                $tmp=mysqli_fetch_array($result2)[0];
                for($cnt=0;$cnt<$tmp;$cnt++){
                    $query.=0;
                }
                $query.='","';
            }
            for($cnt=0;$cnt<$addicNum;$cnt++){
                if(!empty($clean["plusFrontCoverBBSAddiction".$cnt])){
                    $query.=1;
                }else{
                    $query.=0;
                }
            }
            $query.='",0,"'.$clean["plusFrontCoverBBSTextContents"].'");';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            header('Location:counsellor.php');
            exit;
        }
    }

    if($_SESSION["rank"]==0){
        $query='SELECT * from CounsellorData natural join UserData ORDER BY Rank ASC;';
    }else{
        $query='SELECT * from CounsellorData natural join UserData where Hospital='.$_SESSION["hospital"].'  ORDER BY Rank ASC;';
    }
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $counsellors=array_fill(0,$hospitalNum,[]);
    while ($row = mysqli_fetch_array($result)){
        if($_SESSION["rank"]==0){
            array_push($counsellors[$row[3]],$row);
        }else{
            array_push($counsellors[0],$row);
        }
    }
    $counsellorInfo=array();
    $file=fopen('text/counsellorInfo.txt','r');
    while($line=substr(fgets($file),0,-1)){
        array_push($counsellorInfo,explode(" ",$line));
    }
    fclose($file);
    $longestCounsellorInfoName=0;
    for($cnt=0;$cnt<count($counsellorInfo[1]);$cnt++){
        if(mb_strlen($counsellorInfo[1][$cnt])>$longestCounsellorInfoName){
            $longestCounsellorInfoName=mb_strlen($counsellorInfo[1][$cnt]);
        }
    }
    $query='SELECT Email from UserData where ID="'.$_SESSION["ID"].'";';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $Email=mysqli_fetch_array($result)[0];
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
    $sex=array('','男','女');
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
        public $Email;
        public $UserStatus;
    }
    $patientData=array();
    $patientNameData=array();
    $showFirst=0;
    $hospitalNotNone=-1;
    if($_SESSION["rank"]==0){
        $query='SELECT * from PatientData natural join UserData ORDER BY ID DESC;';
    }else{
        $query='SELECT * from PatientData natural join UserData where Hospital='.$_SESSION["hospital"].' ORDER BY ID DESC;';
        $hospitalNotNone=0;
    }
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    
    for($cnt=0;$cnt<$addicNum;$cnt++){
        array_push($patientData,[]);
        array_push($patientNameData,[]);
        for($cnt2=0;$cnt2<$hospitalNum;$cnt2++){
            array_push($patientData[$cnt],[]);
            array_push($patientNameData[$cnt],[]);
        }
    }
    while ($row = mysqli_fetch_assoc($result)) {
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
        $patient->Addictions=$row["Addictions"];
        $patient->Email=$row["Email"];
        $patient->UserStatus=$row["UserStatus"];
        for($cnt=0;$cnt<$addicNum;$cnt++){
            if((int)substr($patient->Addictions,$cnt,1)>0){
                array_push($patientData[$cnt][$patient->Hospital],$patient);
                array_push($patientNameData[$cnt][$patient->Hospital],$patient->Allname);
            }
        }
    }

    $query='SELECT * from frontCoverBBS where ID="0" ORDER BY Num DESC;';
    $frontCoverBBS=array();
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    while($row = mysqli_fetch_array($result)){
        if($_SESSION["rank"]==0){
            array_push($frontCoverBBS,$row);
        }else{
            if(substr($row[2],$_SESSION["hospital"],1)==1){
                array_push($frontCoverBBS,$row);
            }
        }
    }

    $searched=0;
    $frontCoverBBSShow=array('非表示','表示中');
    if(!empty($clean)){
        for($cnt=0;$cnt<$addicNum;$cnt++){
            if(!empty($clean[$addicName[$cnt].'Btn'])){
                $_SESSION["nowAddic"]=$cnt;
                header('Location:counsellor.php');
                exit;
            }
        }
        if(!empty($clean["goObserve"])){
            for($cnt=0;$cnt<$hospitalNum;$cnt++){
                for($cnt2=0;$cnt2<count($patientData[$_SESSION["nowAddic"]][$cnt]);$cnt2++){
                    if(!empty($clean[$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->ID])){
                        $_SESSION['patientID']=$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->ID;
                        header("Location: observe.php");
                        exit;
                    }
                }
            }
            header('Location:counsellor.php');
            exit;
        }
        if(!empty($clean["classSelectForm"])){
            $_SESSION["nowClassView"]=(int)$clean["classSelect"];
            header('Location:counsellor.php');
            exit;
        }
        
        if(!empty($clean["passReset"])){
            $query='UPDATE UserData SET Pass="'.password_hash($clean["password"],PASSWORD_BCRYPT).'" where ID="'.$_SESSION["ID"].'";';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $file_name = ".htpasswd";
            $ret_array = file( $file_name );
            for($cnt=0;$cnt<count($ret_array);$cnt++){
                if(substr($ret_array[$cnt],0,10)==$_SESSION["ID"]){
                    $ret_array[$cnt]=$_SESSION["ID"].':'.password_hash($clean["password"],PASSWORD_BCRYPT)."\n";
                }
            }
            file_put_contents($file_name, $ret_array);
            session_destroy();
            header('Location:../login.php');
            exit();
        }

        if(!empty($clean['searchName'])){
            $searched=1;
            $searchName=$clean['searchName'];
            $_SESSION["nowAddic"]=$clean["searchAddicNum"];
        }
        if(!empty($clean['newAccount'])){
            header("Location: registeration.php");
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
        }
    mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href="style/counsellor.css">
    <link rel="stylesheet" href="style/alert.css">
</head>
<header>
    <div id="humMenu">
        <input id="humCheck" type="checkbox">
        <label id="humOpen" for="humCheck"><img src="image/bars_24.png" alt="メニュー" width="68" height="56"></label>
        <label id="humClose" for="humCheck"></label>
        <nav>
        <form action="counsellor.php" method="post">
        <ol class="inner">
            <?php 
                for($cnt=0;$cnt<$addicNum;$cnt++){
                    echo '<li><input type="submit" id="'.$addicName[$cnt].'Btn" name="'.$addicName[$cnt].'Btn" class="none" >';
                    echo '<label for="'.$addicName[$cnt].'Btn" class="Btn">'.$addicNameJP[$cnt].'</label>';
                }
            ?>
        </ol>
        </form>
        </nav>
    </div>
    Yeah
    <form action="counsellor.php" method="post" name="classSelectForm">
    <input type="hidden" name="classSelectForm" value=1>
    <?php
    echo  '<select id="classSelect" name="classSelect" onchange="this.form.submit();">';
    for($cnt=0;$cnt<count($classNameJP);$cnt++){
        $tmp='<option value='.$cnt;
        if((int)$cnt==(int)$_SESSION["nowClassView"]){
            $tmp.=' selected=true';
        }
        $tmp.='>'.$classNameJP[$cnt].'</option>';
        echo $tmp;
    }
    $cnt=count($classNameJP);
    $tmp='<option value='.$cnt;
    if((int)$cnt==(int)$_SESSION["nowClassView"]){
        $tmp.=' selected=true';
    }
    $tmp.='>掲示板</option>';
    echo $tmp;
    echo '</select>';
    ?>
    </form>
    <form action="counsellor.php" method="post" name="headerForm">
        <input type="submit" id="newAccount" name="newAccount"  value=1 class="none">
        <label for="newAccount" class="btn canPush">新規登録</label>
    </form>
    <form action="counsellor.php" method="post" name="searchForm" >
        <input type="text" name="searchName" id="searchName" >
        <input type="hidden" name="searchAddicNum" id="searchAddicNum">
        <input type="button" id="search" name="search" class="none" onClick="searchNameCheck(this);">
        <label for="search" class="canPush"><img src="image/search.png" alt="検索" width="20" height="20"></label>
    </form>     
    <?php
    echo'<div id="infoMenu">
    <input id="infoCheck" name="infoCheck" type="checkbox">
    <label id="infoOpen" for="infoCheck">'.$Allname.'</label>
    <label id="infoClose" for="infoCheck"></label>
    <div id=info>';
    echo '<div class=oneSentence>名前　　　　　';
    echo '<textarea cols="50" rows="1" disabled=true>'.$Allname.'</textarea></div>';
    echo '<div class=oneSentence>メールアドレス';
    echo '<textarea cols="50" rows="1" readonly=true>'.$Email.'</textarea></div>';
    echo '<div class=oneSentence>'.$counsellorInfo[1][1].'　　　　　';
    echo '<textarea cols="50" rows="1" disabled=true>'.$counsellorInfo[2][$_SESSION["rank"]].'</textarea></div>';

    echo '<label id="infoUpdateOpen" for="infoUpdateCheck">編集</label>　　';
    echo '<label id="passOpen" for="passCheck">パスワードをリセットする</label>';
    echo '　<label for="infoCheck" class="canPush">閉じる</label>';
    echo '</div>';
    echo '</div>';
    echo '<input id="passCheck" name="passCheck" type="checkbox">';
    echo '<label id="passClose" for="passCheck"></label>';
    echo '<form action="counsellor.php" method="post" id="pass">';
    echo '新しいパスワード<input type="password" onCopy="return false;" id="password" name="password"><br>';
    echo '再入力　　　　　<input type="password" onCopy="return false;" id="password2"><br>';
    echo '<input type="hidden" name="passReset" value=1>';
    echo '<input type="button" onClick="passCheck(this);" value="送信">';
    echo '　　<label for="passCheck" class="canPush">閉じる</label>';
    echo '</form>';

    echo '<input id="infoUpdateCheck" name="infoUpdateCheck" type="checkbox">';
    echo'<label id="infoUpdateClose" for="infoUpdateCheck"></label>';
    echo '<div id=infoUpdate>';
    echo '<form action="counsellor.php" method="post">';
    echo '<label for=""><span>名前　　　　　</span><span class="Red">*必須</span>
        <input type="text" id="infoUpdateAllname" name="Allname" value="'.$Allname.'"><br></label>';
    echo '<label for=""><span>メールアドレス</span><span class="Red">*必須</span>
        <input type="email" id="infoUpdateEmail" name="Email" value="'.$Email.'"><br></label>';
    echo '<input type="hidden" name="updateCounsellor" value="送信" >';
    echo '<input type="button" value="送信" onClick="counsellorCheck(this);">';
    echo '　<label for="infoUpdateCheck" class="canPush">閉じる</label>';
    echo '</form></div>'
    ?>
    <form action="counsellor.php" method="post" >
        <input id="logOut" type="submit" name="logOut" class="btn none" value=1>
        <label id="logOutLabel" for="logOut" class="canPush"><img src="image/logOut.png" alt="ログアウト" width="40" height="40"></label>
    </form>
    
</header>
<body>
    
<div id="alert">
    <div>
        <p></p>
        <button>ok</button>
    </div>
</div>

    <div class="parent">
        <div class="child">
            <div class="inlineBlock">
            <h3 id=title class="inlineBlock"><?php 
                echo $addicNameJP[$_SESSION["nowAddic"]];
            ?></h3>
            <input type="button" id="displayAll" class="none inlinBlock" onClick="displayAllClick();">
            <label for="displayAll" class="canPush inlinBlock">全て表示</label>　
            <input type="button" id="notDisplayAll" class="none inlinBlock" onClick="notDisplayAllClick();">
            <label for="notDisplayAll" class="canPush inlinBlock">全て非表示</label><br>
            <form action="counsellor.php" method="post" class="inlineBlock">
            <ul class="overFlowAuto">
                <?php 
                if($_SESSION["nowClassView"]==0){
                    echo '<input type="hidden" name="goObserve" value=1>';
                }
                if($_SESSION["nowClassView"]<=1){
                for($cnt=0;$cnt<$hospitalNum;$cnt++){
                    echo '<input type="checkbox" id="pullDown'.$cnt.'" onclick="pullDown(this.id);" class="none">';
                    echo '<label for="pullDown'.$cnt.'" class="canPush">'.$hospitalNameJP[$cnt].'<img src="image/pullDown.png" alt="病院" width="20" height="12"></label><br>';
                    echo '<ol id="list'.$cnt.'" class="list">';
                    if($_SESSION["nowClassView"]==0){
                        for($cnt2=0;$cnt2<count($patientData[$_SESSION["nowAddic"]][$cnt]);$cnt2++){
                            $tmp='<li><input type="submit" class="none" id="'.$cnt.'_'.$cnt2.'" name="'.$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->ID.'">';
                            echo $tmp;
                            $tmp='<label id="'.$cnt.'_'.$cnt2.'Label" for="'.$cnt.'_'.$cnt2.'" class="patientBtnLabel canPush">名前：'.$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Allname.' 通院：'.$hospitalNameJP[(int)$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Hospital].'　性別：';
                            $tmp.=$sex[$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Sex];
                            $tmp.='　年齢：'.$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Age.'歳'."<br>症状：";
                            for($cnt22=0;$cnt22<$addicNum;$cnt22++){
                                if((int)substr($patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Addictions,$cnt22,1)>0){
                                    $tmp.=$addicNameJP[$cnt22].'　';
                                }
                            }
                            $tmp.="<br>担当：";
                            foreach($patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Counsellors as $counsellor){
                                $tmp.=$counsellor.'　';
                            }
                            $tmp.="<br>メールアドレス：".$patientData[$_SESSION["nowAddic"]][$cnt][$cnt2]->Email.'</label>';
                            echo $tmp;
                        }
                    }else if($_SESSION["nowClassView"]==1){
                        for($cnt2=0;$cnt2<count($counsellors[$cnt]);$cnt2++){
                            echo '<li><input type="button" class="patientBtn" id="'.$cnt.'_'.$cnt2.'" name="'.$counsellors[$cnt][$cnt2][0].'" value="名前　　　　　：'.$counsellors[$cnt][$cnt2][2].' 役職　　　　　：'.$counsellorInfo[2][$counsellors[$cnt][$cnt2][1]]."\nメールアドレス：".$counsellors[$cnt][$cnt2][6].'" onClick="updateThisCounsellor(this.id);">';
                        }
                    }
                    echo '</ol>';
                }
                }else if($_SESSION["nowClassView"]==2){
                    for($cnt=0;$cnt<count($frontCoverBBS);$cnt++){
                        echo '<li><input type="button" class="patientBtn" id="frontCoverBBS'.$cnt.' " value="'.$frontCoverBBSShow[$frontCoverBBS[$cnt][1]]."\n".$frontCoverBBS[$cnt][5].'" onClick=FrontCoverBBSClick(this.id)>';
                    }
                }
                
                ?>
            </ul>
            </form>
            </div>
            <div class="inlineBlock">　　</div>
            <?php
            if($_SESSION["nowClassView"]==1&&$_SESSION["rank"]<=1){
                echo '<div class="inlineBlock">';
                echo '<form action="counsellor.php" method="post" id="updateThisCounsellor" class="none">';
                echo '<div id="updateThisCounsellorDiv">';
                echo '<input type="hidden" name="updateThisCounserllor" value=1>';
                echo '<input type="hidden" id="counsellorID" name="counsellorID" >';
                echo '<div><label for="counsellor'.$counsellorInfo[0][2].'">'.$counsellorInfo[1][2].'　　　';
                for($cnt=0;$cnt<$longestCounsellorInfoName-mb_strlen($counsellorInfo[1][2]);$cnt++){
                    echo '　';
                }
                echo '<input type="text" id="counsellor'.$counsellorInfo[0][2].'" disabled=true></label></div>';
                echo '<div>'.$counsellorInfo[1][1].'　　　';
                for($cnt=0;$cnt<$longestCounsellorInfoName-mb_strlen($counsellorInfo[1][1]);$cnt++){
                    echo '　';
                }
                echo '<select id="counsellor'.$counsellorInfo[0][1].'" name="counsellor'.$counsellorInfo[0][1].'">';
                for($cnt=0;$cnt<count($counsellorInfo[2]);$cnt++){
                    echo '<option value='.$cnt.'>'.$counsellorInfo[2][$cnt].'</option>';
                }
                echo '</select></div>';
                echo '<div>'.$counsellorInfo[1][3].'　　　';
                for($cnt=0;$cnt<$longestCounsellorInfoName-mb_strlen($counsellorInfo[1][3]);$cnt++){
                    echo '　';
                }
                echo '<select id="counsellor'.$counsellorInfo[0][3].'" name="counsellor'.$counsellorInfo[0][3].'">';
                if($_SESSION["rank"]==0){
                    for($cnt=0;$cnt<$hospitalNum;$cnt++){
                        echo '<option value='.$cnt;
                        echo '>'.$hospitalNameJP[$cnt].'</option>';
                    }
                }else{
                    for($cnt=0;$cnt<$hospitalNum;$cnt++){
                        echo '<option value='.$_SESSION["hospital"];
                        echo '>'.$hospitalNameJP[$cnt].'</option>';
                    }
                }
                echo '</select></div>';
                echo 'アカウント<select id="counsellorUserStatus" name="counsellorUserStatus">';
                echo '<option value=0>停止</option>';
                echo '<option value=1>進行中</option>';
                echo '</select>';
                echo '<input type="submit" value="変更">';
                echo '</div></form></div>';
            }
            if($_SESSION["nowClassView"]==2&&$_SESSION["rank"]<=1){
                echo '<div class="inlineBlock">';
                echo '<form action="counsellor.php" method="post" id="updateThisFrontCoverBBSForm" class="none">';
                echo '<div id="updateThisCounsellorDiv">';
                echo '<input type="hidden" name="updateThisFrontCoverBBS" value=1>';
                echo '<input type="hidden" id="FrontCoverBBSNum" name="FrontCoverBBSNum" >';
                echo '表示　　';
                echo '<select id="FrontCoverBBSBBSstatus" name="FrontCoverBBSBBSstatus" >';
                for($cnt=0;$cnt<count($frontCoverBBSShow);$cnt++){
                    echo '<option value='.$cnt.'>'.$frontCoverBBSShow[$cnt].'</option>';
                }
                echo '</select><br>';
                if($_SESSION["rank"]==0){
                    echo '病院　　';
                    for($cnt=0;$cnt<$hospitalNum;$cnt++){
                        echo '<input type="checkbox" id="FrontCoverBBSHospital'.$cnt.'" name="FrontCoverBBSHospital'.$cnt.'">';
                        echo '<label for="FrontCoverBBSHospital'.$cnt.'">'.$hospitalNameJP[$cnt].'</label>';
                    }
                    echo '<br>';
                }
                echo '症状　　';
                for($cnt=0;$cnt<$addicNum;$cnt++){
                    echo '<input type="checkbox" id="FrontCoverBBSAddiction'.$cnt.'" name="FrontCoverBBSAddiction'.$cnt.'">';
                    echo '<label for="FrontCoverBBSAddiction'.$cnt.'">'.$addicNameJP[$cnt].'</label>';
                }
                echo '<br>テキスト';
                echo '<textarea cols="50" rows="2" id="FrontCoverBBSTextContents" name="FrontCoverBBSTextContents" ></textarea><br>';
                echo '<input type="button" value="変更" onClick=updateThisFrontCoverBBSClick(this)>';
                echo '</div></form></div>';

                echo '<div id="plusFrontCoverBBSMenu">';
                echo '<input type="checkbox" id="plusFrontCoverBBSCheck" name="plusFrontCoverBBSCheck" >';
                echo '<label id="plusFrontCoverBBSOpen" for="plusFrontCoverBBSCheck"><img src="image/plus.png" alt="追加" width="40" height="40">掲示板の追加</label>';
                echo '<label id="plusFrontCoverBBSClose" for="plusFrontCoverBBSCheck"></label>';
                echo '<form action="counsellor.php" method="post" id="plusFrontCoverBBSForm">';

                echo '<input type="hidden" name="plusFrontCoverBBS" value=1>';
                if($_SESSION["rank"]==0){
                    echo '病院　　';
                    for($cnt=0;$cnt<$hospitalNum;$cnt++){
                        echo '<input type="checkbox" id="plusFrontCoverBBSHospital'.$cnt.'" name="plusFrontCoverBBSHospital'.$cnt.'">';
                        echo '<label for="plusFrontCoverBBSHospital'.$cnt.'">'.$hospitalNameJP[$cnt].'</label>';
                    }
                    echo '<br>';
                }
                echo '症状　　';
                for($cnt=0;$cnt<$addicNum;$cnt++){
                    echo '<input type="checkbox" id="plusFrontCoverBBSAddiction'.$cnt.'" name="plusFrontCoverBBSAddiction'.$cnt.'">';
                    echo '<label for="plusFrontCoverBBSAddiction'.$cnt.'">'.$addicNameJP[$cnt].'</label>';
                }
                echo '<br>テキスト';
                echo '<textarea cols="50" rows="2" id="plusFrontCoverBBSTextContents" name="plusFrontCoverBBSTextContents" ></textarea><br>';
                echo '<input type="button" value="送信" onClick=plusFrontCoverBBSClick(this)>';
                echo '</form>';
            }
            ?>
        </div>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        var patientNameData=<?php $json_patientNameData=json_encode($patientNameData); echo $json_patientNameData; ?>;
        var nowAddic=<?php $json_nowAddic=json_encode($_SESSION["nowAddic"]); echo $json_nowAddic; ?>;
        var showFirst=<?php $json_showFirst=json_encode($showFirst); echo $json_showFirst; ?>;
        var hospitalNum=<?php $json_hospitalNum=json_encode($hospitalNum); echo $json_hospitalNum; ?>;
        var addicNum=<?php $json_addicNum=json_encode($addicNum); echo $json_addicNum; ?>;
        var searched=<?php $json_searched=json_encode($searched); echo $json_searched; ?>;
        var searchNameFrom=<?php $json_searchName=json_encode($searchName); echo $json_searchName; ?>;
        var nowClassView=<?php $json_nowClassView=json_encode($_SESSION["nowClassView"]); echo $json_nowClassView; ?>;
        var counsellors=<?php $json_counsellors=json_encode($counsellors); echo $json_counsellors; ?>;
        var rank=<?php $json_rank=json_encode($_SESSION["rank"]); echo $json_rank; ?>;
        var Emails=<?php $json_Emails=json_encode($Emails); echo $json_Emails; ?>;
        var frontCoverBBS=<?php $json_frontCoverBBS=json_encode($frontCoverBBS); echo $json_frontCoverBBS; ?>;
    </script>
    <script src="script/counsellor.js"></script>
</body>
</html>

