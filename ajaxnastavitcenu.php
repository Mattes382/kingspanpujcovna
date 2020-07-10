<?php
session_start();
             require_once('connect.php');
             if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1 || $_SESSION['prava'] == 2){
             $con = Pripojit();
             $jizexistuje = false;

 $statement = "SELECT `typproduktu_idtypproduktu`, `zakaznici_idzakaznici` FROM `cenanastavenazakaznikovi`";
 $generator = $con->prepare($statement);
 $generator->bind_result($idproduktu, $idzakaznici);
 $generator->execute();
 while($generator->fetch()){

        if($idproduktu == $_POST['typproduktu'] && $idzakaznici == $_POST['uzivatel']){
$jizexistuje = true;
        }
     

 }
 $generator->close();
 

if($jizexistuje == true){

    $statement = "UPDATE `cenanastavenazakaznikovi` SET `typproduktu_idtypproduktu`=?,`zakaznici_idzakaznici`=?,`cena`=? WHERE typproduktu_idtypproduktu = ? AND zakaznici_idzakaznici = ?";
    $query = $con->prepare($statement);
    
    $query->bind_param("iiiii", $_POST['typproduktu'], $_POST['uzivatel'], $_POST['cena'], $_POST['typproduktu'], $_POST['uzivatel']);
    if($query->execute()){
     
    }
    $query->close();

} else {
    $statement = "INSERT INTO `cenanastavenazakaznikovi`(`typproduktu_idtypproduktu`, `zakaznici_idzakaznici`, `cena`) VALUES (?,?,?)";
    $query = $con->prepare($statement);
    
    $query->bind_param("iii", $_POST['typproduktu'], $_POST['uzivatel'], $_POST['cena']);
    if($query->execute()){
     
    }
    $query->close();
}


            
            }
       ?>