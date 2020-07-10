<?php
session_start();
             require_once('connect.php');
             $var1 = $_POST['var1']; 
             
             $var2 = $_SESSION['iduzivatele']; 
             
            $con = Pripojit();
            $statement = "SELECT cena FROM cenanastavenazakaznikovi WHERE typproduktu_idtypproduktu = $var1 AND zakaznici_idzakaznici = $var2";
             $generator = $con->prepare($statement);
             $generator->bind_result($cena);
             $generator->execute();
             while($generator->fetch()){
           
              if($cena == 0){
                echo "<h6 style='margin-top: 30px; margin-bottom: 30px; font-weight: bold;'>ZDARMA</h6>";
              } else {
                echo "<h6 style='margin-top: 30px; margin-bottom: 30px; font-weight: bold;'>$cena Kč/den</h6>";
              }

     
             }
             $generator->close();
             
       ?>