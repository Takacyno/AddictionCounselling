<?php include("pretreatment.php"); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mind Nature webプログラム</title>
    <link rel="stylesheet" href="style/observe.css">
    <link rel="stylesheet" href="style/alert.css">
    <link rel="stylesheet" href="css/bootstrap.css">
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
    <?php include("header.php"); ?>
    </header>
    
    <section><?php include("date.php"); ?></section>
    
    <section><?php include("title.php"); ?></section>
    
    <main>
        <?php
        if($_SESSION["nowCalView"]==1){
            switch($_SESSION["nowToDoView"]){
            case 0:    
                include('frontCover.php');
                break;
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
            if($_SESSION["class"]==1&&$_SESSION["nowToDoView"]>0){
                include('toDoSelect.php');
            }
        }else if($_SESSION["nowCalView"]==2){
            if($_SESSION["nowToDoView"]==0){
                include('frontCover.php');
            }else{
                include('monthCalendor.php');
            }
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
        var addicNum=<?php $json_addicNum=json_encode(count($addicNum)); echo $json_addicNum; ?>;
        var calAlertNameJP=<?php $json_calAlertNameJP=json_encode($calAlertNameJP); echo $json_calAlertNameJP; ?>;
        var mdY=<?php $json_mdY=json_encode(array($_SESSION["Y"],$_SESSION["m"],$_SESSION["d"]+$_SESSION["dDelay"])); echo $json_mdY; ?>;
        var observations=<?php $json_observations=json_encode(count($Observation)); echo $json_observations; ?>;
        var Observation=<?php $json_Observation=json_encode($Observation); echo $json_Observation; ?>;
        var ObservationName=<?php $json_ObservationName=json_encode($ObservationName); echo $json_ObservationName; ?>;
        var ObservationNameJP=<?php $json_ObservationNameJP=json_encode($ObservationNameJP); echo $json_ObservationNameJP; ?>;
        var textDisplay=<?php $json_textDisplay=json_encode($textDisplay); echo $json_textDisplay; ?>;
        var FunEvents=<?php $json_FunEvents=json_encode($FunEvents); echo $json_FunEvents; ?>;
        var counsellors=<?php $json_counsellors=json_encode($counsellors); echo $json_counsellors; ?>;
        var Emails=<?php $json_Emails=json_encode($Emails); echo $json_Emails; ?>;
        var todayText=<?php $json_today=json_encode($today); echo $json_today; ?>;
        var startProcess=<?php $json_startProcess=json_encode($startProcess); echo $json_startProcess; ?>;
        var startProcessDate=<?php $json_startProcessDate=json_encode($startProcessDate); echo $json_startProcessDate; ?>;
        var finishProcess=<?php $json_finishProcess=json_encode($finishProcess); echo $json_finishProcess; ?>;
        var finishProcessDate=<?php $json_finishProcessDate=json_encode($finishProcessDate); echo $json_finishProcessDate; ?>;
        var incompleteFunEventsConcrete=<?php $json_incompleteFunEventsConcrete=json_encode($incompleteFunEventsConcrete); echo $json_incompleteFunEventsConcrete; ?>;
        var ImaginationText=<?php $json_ImaginationText=json_encode($ImaginationTextComplete); echo $json_ImaginationText; ?>;
        var defaultText=<?php $json_defaultText=json_encode($defaultText); echo $json_defaultText; ?>;
        var frontCoverBBS=<?php $json_frontCoverBBSData=json_encode($frontCoverBBSData); echo $json_frontCoverBBSData; ?>;
        var daySum=<?php $json_daySum=json_encode($daySum); echo $json_daySum; ?>;
        var addicStartCounselling=<?php $json_addicStartCounselling=json_encode($addicStartCounselling); echo $json_addicStartCounselling; ?>;
        var textCheck=<?php $json_textCheck=json_encode($textCheck); echo $json_textCheck; ?>;
    </script>
    <script src="script/observe.js"></script>
    </main>
</body>
</html>

