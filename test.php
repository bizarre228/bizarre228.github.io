<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if($_POST["btn"]){
    $str=trim($_POST["user_name"]);
    echo $str;  
}
$f=fopen("./test.txt","w");
if($f){
    fwrite($f,$str);
    fclose($f);
}
$f=fopen("./test.txt","r");
if($f){
    
    $rez=fread($f,30);
    echo "<br>Read File:{$rez}";
    fclose($f);
}
?>
    <form action="test.php" method="post" target="_self">
    <input type="text" name="user_name" maxlength="21">
    <input type="submit" value="Заказать звонок" name="btn">
    </form>
    <form action="" method="" target="_self">


    
</body>
</html>