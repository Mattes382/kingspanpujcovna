<?php
session_start();
if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
  require_once('connect.php');
  $var1 = $_POST['var1']; 
  $var2 = $_POST['var2']; 
  
  //$data["string"] = "[";
  
 $con = Pripojit();
 $statement = "UPDATE `objednavky` SET `Status`=? WHERE idbjednavky=?";
  $generator = $con->prepare($statement);
  $generator->bind_param('ii', $var1, $var2);
  $generator->execute();

  $generator->close();
}

             
       ?>