<?php
    session_start();
    if($host=="localhost"){
        $DBhost='localhost';
        $DBusername='root';
        $DBpassword='local';
        $link=mysqli_connect($DBhost,$DBusername,$DBpassword);
        $db=mysqli_select_db($link,"local");
    }else{
        $DBhost='133.18.244.234';
        $DBusername='home10';
        $DBpassword='8940hakuyo';
        $link=mysqli_connect($DBhost,$DBusername,$DBpassword);
        $db=mysqli_select_db($link,"takayuki");
    }
    $file=fopen('text/test.txt','r');
    $testNameJP=array();
    while($line=substr(fgets($file),0,-1)){
        array_push($testNameJP,$line);
    }
    fclose($file);
    if($_SESSION["test"]==0){
        $file='text/tests/audit.txt';
        $description=file_get_contents($file);
    }
    $file=fopen('text/tests/test'.$_SESSION["test"].'.txt','r');
    $questionType=substr(fgets($file),0,-1);
    $line=substr(fgets($file),0,-1);
    $questionNum=$line;
    $questionTitle=array();
    $questions=array();
    $questionSelectNum=array();
    $answers=array();
    if($questionType==1){
        for($cnt=0;$cnt<$questionNum;$cnt++){
            $line=substr(fgets($file),0,-1);
            $lineContents=explode(" ",$line);
            array_push($answers,[]);
            array_push($questionSelectNum,substr(fgets($file),0,-1));
            for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                array_push($answers[$cnt],0);
            }
            for($cnt2=0;$cnt2<count($lineContents);$cnt2++){
                $answers[$cnt][$lineContents[$cnt2]-1]=1;
            }
            $line=substr(fgets($file),0,-1);
            array_push($questionTitle,$line);
            array_push($questions,[]);
            for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                $line=substr(fgets($file),0,-1);
                array_push($questions[$cnt],$line);
            }
        }
    }else{
        for($cnt=0;$cnt<$questionNum;$cnt++){
            array_push($questionSelectNum,substr(fgets($file),0,-1));
            $line=substr(fgets($file),0,-1);
            array_push($questionTitle,$line);
            array_push($questions,[]);
            for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                $line=substr(fgets($file),0,-1);
                array_push($questions[$cnt],$line);
            }
        }
        $grade=array();
        $gradeText=array();
        while($line=substr(fgets($file),0,-1)){
            $lineContents=explode(" ",$line);
            array_push($grade,$lineContents[0]);
            array_push($gradeText,$lineContents[1]);
        }
    }
    
    if(empty($_SESSION["testView"])){
        if($_SESSION["class"]==0){
            $_SESSION["testView"]=0;
        }else{
            $_SESSION["testView"]=1;
        }
    }
    // サニタイズ
    $clean = array();
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    }
    if(!empty($clean)){
        if(!empty($clean["testSubmit"])){
            $query='SELECT count(*) from TestScore where ID="'.$_SESSION["ID"].'" and whatTest='.$_SESSION["test"].';';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $num=mysqli_fetch_array($result)[0];
            $query='INSERT into TestScore values("'.$_SESSION["ID"].'",'.$_SESSION["test"].','.$num.',"'.date("Y-m-d",mktime(0,0,0,$_SESSION["m"],$_SESSION["d"],$_SESSION["Y"])).'","';
            $point=0;
            for($cnt=0;$cnt<$questionNum;$cnt++){
                $ok=1;
                for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                    if($questionType==0){
                        if(!empty($clean[$cnt.'check'.$cnt2])){
                            $query.='1';
                            $point+=$cnt2;
                        }else{
                            $query.='0';
                        }    
                    }else{
                        if(!empty($clean[$cnt.'check'.$cnt2])){
                        
                            $query.='1';
                            if($answers[$cnt][$cnt2]!=1){
                                $ok=0;
                            }
                        }else{
                            $query.='0';
                            if($answers[$cnt][$cnt2]!=0){
                                $ok=0;
                            }
                        }
                    }
                }
                if($questionType==1&&$ok==1){
                    $point++;
                }

            }
            $query.='",'.$point.');';
            if(!($result=mysqli_query($link,$query))){
                goto SQLerror;
            }
            $_SESSION["testView"]=1;
            header('Location:test.php');
            exit;
        }
    }
    $query='SELECT StartDate,Answer,testPoint from TestScore where ID="';
    if($_SESSION["class"]==0){
        $query.=$_SESSION["ID"];
    }else{
        $query.=$_SESSION["patientID"];
    }
    $query.='" and whatTest='.$_SESSION["test"].' ORDER BY Num ASC;';
    if(!($result=mysqli_query($link,$query))){
        goto SQLerror;
    }
    $testDate=array();
    $testRecord=array();
    $testPoint=array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($testDate,date("Y年m月d日",strtotime($row[0])));
        array_push($testRecord,$row[1]);
        array_push($testPoint,$row[2]);
    }

    if(!empty($clean)){
        if(!empty($clean["goObserve"])){
            $_SESSION["testView"]=0;
            header('Location:observe.php');
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
    <link rel="stylesheet" href="style/test.css">
    <link rel="stylesheet" href="style/alert.css">
</head>
<body>
<div id="alert">
    <div>
        <p></p>
        <button>ok</button>
    </div>
</div>

    <header>
        
        <form action="test.php" method="post">
        <input id="goObserve" type="submit" name="goObserve" class="none">
        <label for="goObserve" class="goObserveLabel canPush">戻る</label>
        </form>
        <?php echo $testNameJP[$_SESSION["test"]];?>
        <form action="test.php" method="post">
        <input id="logOut" type="submit" name="logOut" class="btn none" value=1>
        <label id="logOutLabel" for="logOut" class="canPush"><img src="image/logOut.png" alt="ログアウト" width="40" height="40"></label>
        </form>
    </header>
    <?php
    if($questionType==0){
        echo $description;
    }
    if($_SESSION["testView"]==0){
        echo '<form action="test.php" method="post">';
            for($cnt=0;$cnt<$questionNum;$cnt++){
                $tmp=$cnt+1;
                echo $tmp."問目　".$questionTitle[$cnt].'<br>';
                for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                    echo '<input type="checkbox" id="'.$cnt.'check'.$cnt2.'" name="'.$cnt.'check'.$cnt2.'" value=1>';
                    echo '<label for="'.$cnt.'check'.$cnt2.'" class="canPush">'.$questions[$cnt][$cnt2].'</label>　';
                }
                echo '<br><br>';
            }
            echo '<input type="hidden" name="testSubmit" value="送信">';
            echo '<input type="button" id="testSubmit" value="送信" onclick="testCheck(this);">';
        echo '</form>';
    }else{
        echo '<select id="testRecordSelect" onchange="testRecordSelectChange(this.value);">';
        for($cnt=0;$cnt<count($testRecord);$cnt++){
            $tmp=$cnt+1;
            echo '<option value='.$cnt;
            if($cnt==count($testRecord)-1){
                echo ' selected=true';
            }
            echo '>'.$tmp.'回目</option>';
        }

        echo '</select>';
        for($i=0;$i<count($testRecord);$i++){
            echo '<div id="Div'.$i.'" ';
            if($i!=count($testRecord)-1){
                echo 'class="none"';
            }
            echo '>';
            if($questionType==0){
                for($cnt=0;$cnt<count($grade);$cnt++){
                    if((int)$testPoint[$i]<=(int)$grade[$cnt]){
                        echo '<div class="red">'.$gradeText[$cnt].'</div>';
                        break;
                    }
                }
            }else{
                echo $testDate[$i].'　'.$testPoint[$i].'/'.$questionNum.'点<br>';
            }
            $questionSelectSum=0;
            for($cnt=0;$cnt<$questionNum;$cnt++){
                $ok=1;
                for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                    if(substr($testRecord[$i],$questionSelectSum+$cnt2,1)!=$answers[$cnt][$cnt2]){
                        $ok=0;
                        break;
                    }
                }
                if($questionType==1){
                    if($ok==1){
                        echo '<img src="image/redCircle.png" alt="正解" width="20" height="20">';
                    }else{
                        echo '<img src="image/check.png" alt="間違い" width="20" height="20">';
                    }
                }
                $tmp=$cnt+1;
                echo $tmp."問目　".$questionTitle[$cnt];
                if($questionType==1&&$ok!=1){
                    echo '<div class="inline red">　正解:';
                    $tmp=array();
                    for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                        if($answers[$cnt][$cnt2]==1){
                            array_push($tmp,$cnt2+1);
                        }
                    }
                    echo $tmp[0];
                    for($cnt2=1;$cnt2<count($tmp);$cnt2++){
                        echo ','.$tmp[$cnt2];
                    }
                    echo '</div>';
                }
                echo '<br>';
                for($cnt2=0;$cnt2<$questionSelectNum[$cnt];$cnt2++){
                    echo '<input type="checkbox" id="'.$i.'time'.$cnt.'check'.$cnt2.'" disabled=true ';
                    if(substr($testRecord[$i],$questionSelectSum+$cnt2,1)==1){
                        echo 'checked ';
                    }
                    echo '><label for="'.$i.'time'.$cnt.'check'.$cnt2.'" class="canPush">'.$questions[$cnt][$cnt2].'</label>　';
                }
                echo '<br><br>';
                $questionSelectSum+=$questionSelectNum[$cnt];
            }
            echo '</div>';
        }
    }
    ?>
    <script>
        var test=<?php $json_test=json_encode($_SESSION["test"]); echo $json_test; ?>;
        var questionNum=<?php $json_questionNum=json_encode($questionNum); echo $json_questionNum; ?>;questionSelectNum
        var questionSelectNum=<?php $json_questionSelectNum=json_encode($questionSelectNum); echo $json_questionSelectNum; ?>;
        var testRecordNum=<?php $json_testRecordNum=json_encode(count($testRecord)); echo $json_testRecordNum; ?>;
        
    </script>
    <script src="script/test.js"></script>
</body>
</html>

