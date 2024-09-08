<?php
session_start();
?>
<body>
<script>
    var id=<?php $json_id=json_encode($_SESSION['ID']); echo $json_id; ?>;
    var pass=<?php $json_pass=json_encode($_SESSION['Pass']); echo $json_pass; ?>;
    var classNum=<?php $json_classNum=json_encode($_SESSION['class']); echo $json_classNum; ?>;
    var xhr=new XMLHttpRequest();
    if(classNum==2){
        xhr.open("GET","./Counselling/DBadmin.php",false,id,pass);
        xhr.send(null);
        location.href="./Counselling/DBadmin.php";
    }else if(classNum==1){
        xhr.open("GET","./Counselling/counsellor.php",false,id,pass);
        xhr.send(null);
        location.href="./Counselling/counsellor.php";
    }else{
        xhr.open("GET","./Counselling/observe.php",false,id,pass);
        xhr.send(null);
        location.href="./Counselling/observe.php";
    }
</script>
</body>