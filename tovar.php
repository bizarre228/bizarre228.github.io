<?php
//  echo $_GET["tov1"];
           define("ServerName","localhost");
           define("UserLogin","root");
           define("UserPassword","root");
           define("DbName","puh");
if ($_GET){
        $flag=false;
        for($i=1;$i<=10;$i++){
            $tmp="tov".$i;  //$
            if($_GET[$tmp]){
                $flag=true;
                 break;
            }
            
        }
        if($flag){
            runMySQL();
        }  
}

function runMySQL(){
    $db=mysqli_connect(ServerName,UserLogin,UserPassword,DbName);

    if($db){
        if (mysqli_select_db($db,"puh")){
            mysqli_query($db,"SET names 'utf8'");
            getQuery();
            javaKol();
        }
        mysqli_close($db);
    }
}
function getQuery(){
    $date_time=date('Y-m-d [H:i:s]');
    for($i=1;$i<=10;$i++){
        $tmp="tov".$i;
        if($_GET[$tmp]){
            $kol=$_GET[$tmp];
            $q="INSERT INTO tovar (name,kol,dv)".
            "VALUES ({$i},{$kol},'{$date_time}')";
            mysqli_query($q);
        }
    }
}

function javaKol(){
    $otvet="";
    $sql="select name,SUM(kol) from tovar group by name ASC";

    $rez=mysqli_query($sql);
    for($i=0;$i<10;$i++){
       $row=mysqli_fetch_row($rez) ;
       $kol=$row[1]; //
       $otvet.=$kol;
       if($i!=9)$otvet.="~";// !=до
    }
    echo $otvet;
}


?>