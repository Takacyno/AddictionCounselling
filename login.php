
<?php
    session_start();
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
    $class='';
    $email='';
    $password='';
    $err_msg=array();
    $AdminData=array(
        'email'=>'',
        'password'=>''
    );
    // サニタイズ
    $clean = array();
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $clean[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
    }
    $query='SELECT * from aboutAdmin where ID=1';
    if($result=mysqli_query($link,$query)){
        $row = mysqli_fetch_assoc($result);
        $AdminData['email']=$row["email"];
        $AdminData['password']=$row["pass"];
    }else{
        echo "Error".mysqli_error($link);    
    }
    if(!empty($clean['email'])&&!empty($clean['password'])){
        $email=$clean['email'];
        $password=$clean['password'];
        if($email===''){
            $err_msg['email']='入力してください';
        }
        if ($password === '') {
            $err_msg['password'] = '入力してください';
        }
        if(empty($err_msg)){
            if($AdminData['email'] == $email && password_verify($password,$AdminData['password'])){
                $_SESSION['ID'] ="admin";
                $_SESSION["class"]=2;
                $_SESSION["Pass"]=$password;
                header('Location:redirectCounsellor.php');
            }else{
                $query='SELECT * from UserData where Email="'.$email.'";';
                if($result=mysqli_query($link,$query)){
                    $row = mysqli_fetch_assoc($result);
                    if($row["UserStatus"]==1){
                        if(password_verify($password,$row["Pass"])){
                            $_SESSION['ID'] = $row["ID"];
                            $_SESSION["class"]=$row["Class"];
                            $_SESSION["Pass"]=$password;
                            $_SESSION["email"]=$clean['email'];
                            header('Location:redirectCounsellor.php');
                        }else{
                            $err_msg['email'] = 'メールアドレスまたはパスワードが違います';
                        }
                    }else{
                        $err_msg['email'] = 'メールアドレスまたはパスワードが違います';
                    }
                }else{
                    echo "Error".mysqli_error($link);    
                }
            }
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
  <link rel="stylesheet" href="login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test</title>
</head>
<body>
    <div class="parent">
        <div class="child">
            <h1>ログイン画面</h1>
            <form action="login.php" method="post" name="loginForm">
                <div class="err_msg"><?php
                 if (isset($err_msg['email'])) {
                    echo $err_msg['email'];
                }
                 ?></div>
                <label for=""><span>メールアドレス</span>
                <input type="email" name="email" maxlength=50><br>
                </label>
                <div class="err_msg"><?php
                 if (isset($err_msg['password'])) {
                    echo $err_msg['password'];
                }
                 ?></div>
                <label for=""><span>パスワード</span>
                <input type="password" name="password" maxlength=50><br>
                </label>
                <button type="submit" name="login">送信</button>
            </form>
        </div>

    </div>
    
</body>
</html>
