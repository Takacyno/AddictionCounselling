
<h3 id="title">
<?php 
    if($_SESSION['nowToDoView']>0){
    echo $addicNameJP[$_SESSION["nowAddic"]];
        if($_SESSION['nowToDoView']==1){
            echo ' 日記';
        }else if($_SESSION['nowToDoView']==10){
            echo ' チャット';
        }else{
            echo ' '.$toDoNameJP[$_SESSION['nowToDoView']-2];
        }
    }
?>
</h3>