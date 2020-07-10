<?php
session_start();
             require_once('connect.php');
             if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1 || $_SESSION['prava'] == 2){
             $con = Pripojit();

if(!empty($_POST['heslo'])){
    $statement = "UPDATE `zakaznici` SET `nazevFirmy`=?,`ICO`=?,`DIC`=?,`Adresa`=?,`Mesto`=?,`ZIP`=?,`Jmeno`=?,`Prijmeni`=?,`Email`=?,`Telefon`=?,`prava_idprava`=?,`heslo`=? WHERE idzakaznici = ?";
    $query = $con->prepare($statement);
    $hash = password_hash($_POST['heslo'], PASSWORD_DEFAULT); 
    
    $query->bind_param("ssssssssssisi", $_POST['firma'], $_POST['ico'], $_POST['dic'], $_POST['adresa'], $_POST['mesto'], $_POST['psc'], $_POST['jmeno'], $_POST['prijmeni'], $_POST['email'], $_POST['telefon'], $_POST['pravo'], $hash, $_POST['uzivatel']);
    if($query->execute()){
     
    }
    $query->close();
} else {
    $statement = "UPDATE `zakaznici` SET `nazevFirmy`=?,`ICO`=?,`DIC`=?,`Adresa`=?,`Mesto`=?,`ZIP`=?,`Jmeno`=?,`Prijmeni`=?,`Email`=?,`Telefon`=?,`prava_idprava`=? WHERE idzakaznici = ?";
    $query = $con->prepare($statement);
    
    $query->bind_param("ssssssssssii", $_POST['firma'], $_POST['ico'], $_POST['dic'], $_POST['adresa'], $_POST['mesto'], $_POST['psc'], $_POST['jmeno'], $_POST['prijmeni'], $_POST['email'], $_POST['telefon'], $_POST['pravo'], $_POST['uzivatel']);
    if($query->execute()){
     
    }
    $query->close();
}

            
            }
       ?>