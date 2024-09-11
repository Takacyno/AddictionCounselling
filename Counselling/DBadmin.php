<?php
    $err_msg=array();
    $host = $_SERVER['HTTP_HOST'];
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
    $display=array();
    $check=0;
    $region=32;
    $regionNum=$region+64;
    echo implode('', array_map('chr', [$regionNum]));
    if(mysqli_connect_errno()){
        die("接続できません".mysqli_connect_error()."\n");
      }else{
        if(!empty($_POST['query'])){
            $check=0;
            $query=$_POST['query'];
            if(substr($query,0,6)==="SELECT"){
                if($result=mysqli_query($link,$query)){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $ToDisplay='';
                        foreach($row as $rowInRow){
                            $ToDisplay.=$rowInRow." ";
                        }
                        array_push($display,$ToDisplay);
                    }
                }else{
                    echo "Error".mysqli_error($link);    
                }
            }else if(substr($query,0,4)==="SHOW"){
                $subQuery=substr($query,5);
                $query="SELECT * from ".$subQuery.";";
                if($result=mysqli_query($link,$query)){
                    $columns=mysqli_fetch_fields($result);
                    foreach($columns as $column){
                        array_push($display,$column->name);
                        // array_push($display,$column->table_name);
                    }
                }else{
                    echo "Error".mysqli_error($link);    
                }
            }else if(substr($query,0,4)==="yeah"){
                $check=1;
                // $arrays=array();
                // for($cnt=0;$cnt<3;$cnt++){
                //     array_push($arrays,[]);
                //     for($cnt2=0;$cnt2<4;$cnt2++){
                //         array_push($arrays[$cnt],$cnt*4+$cnt2);
                //     }
                // }
                // for($cnt=0;$cnt<3;$cnt++){
                //     for($cnt2=0;$cnt2<4;$cnt2++){
                //         array_push($display,$arrays[$cnt][$cnt2]);
                //     }
                // }
            }else if($query==="SET nowMonth"){

            }else{
                if(mysqli_query($link,$query)){
                    $query="SELECT * from users;";
                    if($result=mysqli_query($link,$query)){
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($display,"ID=" . $row["userID"]." class=" . $row["class"]." rank=" . $row["rank"]." Allname=" . $row["Allname"]." email=" . $row["email"]." region=" . $row["region"]." alcohol=" . $row["alcohol"]." gamble=" . $row["gamble"]);
                        }   
                    }else{
                        echo "Error".mysqli_error($link);
                    }
                }else{
                    echo "Error".mysqli_error($link);
                }
            }
            
        }
      }

    mysqli_close($link);

?>
<!DOCTYPE html>

<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/DBadmin.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
    <header>

    </header>

    <div class="parent">
        <div class="child">
            <h1>データベース管理者</h1>
            <form action="DBadmin.php" method="post" name="queryForm">
                <div class="queryDiv">
                    <label for=""><span>クエリ</span><br>
                    <textarea type=text name="query" id="" cols="100" rows="30" ></textarea>
                    </label>
                </div>
                <div class="displayDiv">
                    <div class="err_msg"><?php echo $err_msg['query']; ?></div>
                    <label for=""><span>結果</span><br>
                    <textarea type=text name="display" id="" cols="100" rows="30" readonly><?php
                        if(isset($_POST['query'])){
                            foreach($display as $rowInDisplay){
                                echo $rowInDisplay."\n";
                            }
                        }
                    ?></textarea>
                    </label>
                </div><br>
                <button type="submit" name="submit">送信</button>
                <?php 
                    
                ?>
            </form>
        </div>
    </div>
</body>
</html>
