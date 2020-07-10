<?php
session_start();
             require_once('connect.php');
             $var1 = $_POST['var1']; 
             
           
             echo "<option value='' disabled selected>Vyberte produkt</option>";
            $con = Pripojit();
            $statement = "SELECT `idprodukty`, `typpanelu_idtyppanelu`, `typtloustky_idtyptloustky`, typpanelu.typpanelu, typtloustky.tloustka FROM `produkty` JOIN typpanelu ON produkty.typpanelu_idtyppanelu = typpanelu.idtyppanelu JOIN typtloustky ON produkty.typtloustky_idtyptloustky = typtloustky.idtyptloustky WHERE typproduktu_idtypproduktu = $var1";
             $generator = $con->prepare($statement);
             $generator->bind_result($idproduktu, $typpanelu, $typtloustky, $paneltyp, $tloustka);
             $generator->execute();
             while($generator->fetch()){
                 if($tloustka == "NaN"){
$tloustka = "";
                 } else {
                    $tloustka = $tloustka."mm";
                 }
           echo "<option value='$idproduktu'>$paneltyp $tloustka</option>";

             }
             $generator->close();
             
       ?>