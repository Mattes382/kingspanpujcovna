<?php
session_start();
if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1 || $_SESSION['prava'] == 2){
  require_once('connect.php');

if(isset($_POST["produkt_id"]) && !empty($_POST["produkt_id"])){
    //Get all state data
    $con = Pripojit();
    
     $sql = "SELECT `nazevFirmy`, `ICO`, `DIC`, `Adresa`, `Mesto`, `ZIP`, `Jmeno`, `Prijmeni`, `Email`, `Telefon`, `prava_idprava`, `heslo` FROM `zakaznici` WHERE idzakaznici =".$_POST['produkt_id'];
$result = mysqli_query($con,$sql); 

 $users_arr = array();

 while( $row = mysqli_fetch_array($result) ){
  $nazevfirmy = $row['nazevFirmy'];
    $ico = $row['ICO'];
    $dic = $row['DIC'];
    $adresa = $row['Adresa'];
$mesto = $row['Mesto'];
$zip = $row['ZIP'];
$jmeno = $row['Jmeno'];
$prijmeni = $row['Prijmeni'];
$email = $row['Email'];
$telefon = $row['Telefon'];
$prava = $row['prava_idprava'];
$heslo = $row['heslo'];


  $users_arr[] = array("nazevfirmy" => $nazevfirmy, "ico" => $ico, "dic" => $dic, "adresa" => $adresa, "mesto" => $mesto, "zip" =>$zip, "jmeno" => $jmeno, "prijmeni" => $prijmeni, "email" => $email, "telefon" => $telefon, "prava" => $prava, "heslo" => $heslo);
 }

 echo json_encode($users_arr);
 exit;
}
}