<?php
           define("ServerName","localhost");
           define("UserLogin","root");
           define("UserPassword","root");
           define("DbName","puh");

           function makeOpisian(){
                     $db=mysqli_connect(ServerName,UserLogin,UserPassword,DbName);
                     if($db){
                        // if(mysqli_select_db(DbName,$db)){
                             mysqli_query($db,"SET names 'utf8'");

                             $rez = mysqli_query( $db,"SELECT * FROM opisian");
                             $out_page="";
                             for($i=0;$i<10;$i++){
                                 $row=mysqli_fetch_row($rez);
                                 $name=$row[1];
                        $txt=$row[2];
                        $out_page.="<h1 class='h1_opisian'>{$name}</h1>".
                        "<div class='div_opisian'>{$txt}</div><br/>";
                             }
                             echo $out_page;
                         } 
                         mysqli_close($db);
                     }
                    
                    
                
            
           function getIdMenu(){
              $tmp=0;
              if($_GET){
                  if($_GET["id"]){
                          $tmp=$_GET["id"];

                  }
                  if(!(($tmp>=1)&&($tmp<=3))) $tmp=0;
              }
                 return $tmp;
           }
           function getHTML($nom){
               $html="";
               $db=mysqli_connect(ServerName,UserLogin,UserPassword,DbName);
               if($db){
                mysqli_query($db,"SET names 'utf8'");
               $rez = mysqli_query( $db,"SELECT * FROM razmetka WHERE (id={$nom})");
               $kol_str=mysqli_num_rows($rez);
               if($kol_str==1){
            $row=mysqli_fetch_row($rez);
            $html=$row[1];
               }
               }
               mysqli_close($db);
               echo $html;
           }
           function testPost(){

            if($_POST["btn"]){
                $rez="";
                if(trim($_POST["user_name"])=="") $rez="Введите имя";
                else if(trim($_POST["user_phone"])=="") $rez="Введите телефон";
                else{
                    $info="Name :".trim ($_POST["uesr_name"]).
                          "Tel:".trim($_POST["uesr_phone"]);
                          
                          $file_name="".rand(100000,99999999).".txt";
                          $rez="Заявка отправлена";
                          $f=fopen(".doc/.$file_name","w");
        if($f){
            fwrite($f,$info);
            fclose($f);
        }
    }
        echo "<h1 class='h1_opisian' style='font-size:35px;'> {$rez}</h1>";
  
            }
        }
        function makeTable(){
            $db=mysqli_connect(ServerName,UserLogin,UserPassword,DbName);
            if($db){
                if(mysqli_select_db($db,DbName)){
                     mysqli_query($db,"SET names 'utf8'");


                    $sql1="SELECT name,sum(kol) from tovar group by name ASC";
                    $rez1=mysqli_query($db,$sql1);
                    $sql2="SELECT name from opisian";
                    $rez2=mysqli_query($db,$sql2);

                    $out_page="";
                    for($i=0;$i<10;$i++){
                        $row1=mysqli_fetch_row($rez1);
                        $row2=mysqli_fetch_row($rez2);
                        $kol=$row1[1];
                        $name=$row2[0];

                        $out_page.="<tr><td>{$name}</td><td>{$kol}</td></tr>";


                }
                echo $out_page;
         
            }
            mysqli_close($db);
        }
        }
?>