<?php
session_start();
if(isset($_SESSION['prihlaseni'])){
  require_once('connect.php');
  $var1 = $_POST['var1']; 
  
  //$data["string"] = "[";
  
 $con = Pripojit();
 $statement = "SELECT `od`, `do` FROM `objednavky` WHERE produkty_idprodukty = $var1";
  $generator = $con->prepare($statement);
  $generator->bind_result($od, $do);
  $generator->execute();
  while($generator->fetch()){
    // $data["string"] = $data["string"]."{ \"start \":  \"$od \",  \"end \":  \"$do \" }";

    $row["start"] = $od;
    $row["end"] = $do;
    $data[] = $row;
    
   //  { 'start': moment('2017-10-25'), 'end': moment('2017-10-27') },
  }
  //$data["string"] = $data["string"]."]";
  if(empty($data)){
    $row["start"] = '2019-09-01';
    $row["end"] = '2019-09-01';
    $data[] = $row;
  }
  echo json_encode($data);
  $generator->close();
}

             
       ?>