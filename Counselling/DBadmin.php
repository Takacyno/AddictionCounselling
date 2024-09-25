<?php include('DBconnect.php');?>
<?php
    $err_msg=array();
    $display=array();
    $check=0;
    $region=32;
    $regionNum=$region+64;
    // echo implode('', array_map('chr', [$regionNum]));
    if(mysqli_connect_errno()){
        die("接続できません".mysqli_connect_error()."\n");
      }else{
        if(!empty($_POST['query'])){
            $check=0;
            $queries = explode(";", $_POST['query']);
            for($i=0;$i<count($queries);$i++){
                $queries[$i] .= ';';
            }
            array_pop($queries);
            try {
                foreach ($queries as $query) {
                    if ($result = mysqli_query($link, $query)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ToDisplay = '';
                            foreach ($row as $rowInRow) {
                                $ToDisplay .= "\"" . $rowInRow . "\",";
                            }
                            array_push($display, $ToDisplay);
                        }
                    } else {
                        throw new Exception("Error: " . mysqli_error($link));
                    }
                }
                // トランザクションをコミット
                mysqli_commit($link);
            } catch (Exception $e) {
                // エラーが発生した場合はロールバック
                mysqli_rollback($link);
                echo $e->getMessage();
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
                    <div class="err_msg"><?php if(isset($err_msg['query'])){echo $err_msg['query'];} ?></div>
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
