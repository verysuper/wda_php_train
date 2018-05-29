<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
include("database.php");
if(isset($_POST["account"]))
{
    $account = $_POST["account"];
    try{
        $sql = "select password from member_05 where account = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(1, $account);
        $stmt->execute();
        $result = $stmt->fetch();
        $pw = isset($_POST["pw"])?$_POST["pw"]:die('ERROR: don\'t null.');
        if($pw == $result[0])
        {
            $_SESSION['user_id'] = $id;
            header("location:admin.php");
        }
        else
        {
            throw new PDOException("密碼錯誤");
        }
    }
    catch(PDOException $ex){
        die('ERROR: ' . $ex->getMessage());
    }
}
?>
<body>
<form action="" method="post">
    <p>登入</p>
    <P>account:<input type="text" name="account" required="required"></P>
    <P>password:<input type="password" name="pw" required="required"></P>
    <p><input type="submit" value="送出"></p>
</form>
</body>
</html>