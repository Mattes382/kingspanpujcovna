<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 session_start(); require_once('connect.php'); ?>
<!DOCTYPE html>
<html lang="cs-CZ">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="fonts/KingspanFont/stylesheet.css" rel="stylesheet">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Podmínky k užití</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Links -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/camera.css" rel="stylesheet">
    <link href="css/google-map.css" rel="stylesheet">

    <!--JS-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>


    <!--[if lt IE 9]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src='js/device.min.js'></script>

    <style>
        .drp-selected{
            color: black;  
        }
    .calendar-table{
        color: black;
    }
            input[type=radio] {
              position: absolute;
              visibility: hidden;
              display: none;
            }
            form a:hover {
              text-decoration: underline;
            }
            
            label {
              color: #25292e;
              display: inline-block;
              cursor: pointer;
              font-weight: 100;
              padding: 10px 20px;
              width: 170px;
              margin-bottom: 0px;
              transition: 0.2s ease-in-out;
            }
            
            input[type=radio]:checked + label{
              color: white;
              background: #20519D;
            }
            input[type=radio]:disabled + label{
              color: #25292e;
              background: grey;
            }
            
            label + input[type=radio] + label {
              border-left: solid #25292e;
            }
            .radio-group {
              border: solid #25292e;
              display: inline-block;
              margin: 20px;
              
              border-radius: 10px;
              overflow: hidden;
            }
            form{
                width: 100%;
                margin-left: 20px;
            }
            @media only screen and (max-width: 650px) {
            label {
            
                color: #25292e;
                display: inline-block;
                cursor: pointer;
               
                
                margin-bottom: 0px;
                transition: 0.2s ease-in-out;
                text-align: center;
                width: 250px;
            
            display: table;
            
            }
            label + input[type="radio"] + label {
                border-left: 0px;
            }
            }
            form{
                width: auto;
                margin-left: 20px;
                margin-right: 20px;
                text-align: center;
                
            }
                </style>
</head>
<body>
<?php if(isset($_SESSION['prihlaseni'])){?>
<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->
    <header>




        <div id="stuck_container" class="stuck_container">
            <nav class="navbar navbar-default navbar-static-top ">
                <div class="container">
                    <div class="navbar-header">
                        <h1 class="navbar-brand">
<img src="images/logo.png" alt="logo" style="max-height: 60px;">
                        </h1>
                    </div>
                   
                    <ul class="navbar-nav sf-menu" data-type="navbar">
                        <li class="active">
                            <a href="rezervace.php">Rezervace</a>
                        </li>
                        <li>
                            <a href="https://www.kingspan.com/cz/cs-cz" style="font-family: Kingspan Brown TT">O nás</a>
                        </li>
                        <li>
                            <a href="odhlasit.php" style="font-family: Kingspan Brown TT">Odhlásit</a>
                        </li>
                    </ul>
                   

                </div>
            </nav>
        </div>
<section class="well-lg bg-light" style="height: 1000px;">
    <div class="d-flex justify-content-center">
<h2 style="text-align: center; margin-top: 60px; padding-top: 10px;">Podmínky k užití</h2>
<h6 style="text-align: center; margin-top: 60px; padding-top: 10px;">Tato stránka tvoří automaticky generovaný dokument</h6>
<?php
require 'vendor/phpmailer/PHPMailer/src/Exception.php';
require 'vendor/phpmailer/PHPMailer/src/PHPMailer.php';
require 'vendor/phpmailer/PHPMailer/src/SMTP.php';
require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);
$enazevfirmy;
$eICO;
$eDIC;
$eAdresa;
$emesto;
$ePSC;
$ejmeno;
$eprijmeni;
$eemail;
$etelefon;

$con = Pripojit();
$iduzivatele = $_SESSION['iduzivatele'];
$stmnt = "SELECT `nazevFirmy`, `ICO`, `DIC`, `Adresa`, `Mesto`, `ZIP`, `Jmeno`, `Prijmeni`, `Email`, `Telefon` FROM `zakaznici` WHERE idzakaznici = $iduzivatele";
$generator = $con->prepare($stmnt);
$generator->bind_result($nazevfirmy, $ICO, $DIC, $adresa, $mesto, $PSC, $jmeno, $prijmeni, $email, $telefon);
$generator->execute();
while($generator->fetch()){
    $enazevfirmy = $nazevfirmy;
    $eICO = $ICO;
    $eDIC = $DIC;
    $eAdresa = $adresa;
    $emesto = $mesto;
    $ePSC = $PSC;
    $ejmeno = $jmeno;
    $eprijmeni = $prijmeni;
    $eemail = $email;
    $etelefon = $telefon;

}
$generator->close();
// Creating the new document...
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Word/template.docx');
 
$jmenoaprijmeni = $ejmeno." ".$eprijmeni;
$templateProcessor->setValue('nazevfirmy', $enazevfirmy);
$templateProcessor->setValue('adresaaulice', $adresa);
$templateProcessor->setValue('mesto', $mesto);
$templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
$celystring = "Word/DOHODA_O_ZAPUJCENI_ZDVIHACIHO_ZARIZENI_ROTA_BOY_PRO_FIRMU_$enazevfirmy.docx";
 
$templateProcessor->saveAs($celystring);
?>
    </div>
</section>
    
    </header>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<?php }else{?>
    <div class="d-flex justify-content-center" style='position: absolute;top: 50%;left: 50%; margin-left: -150px; margin-top: -170px; '>
    <div style='text-align: center;'>
    <div class="d-flex justify-content-center">
    <img src='images/lionerror.png' alt='lev' style='width: 300px; display: block; padding-bottom: 30px;'>
    </div>
<h5 style='color: black; font-weight: 100; display: unset; text-transform: none;'>Stránka není přístupná</h5>
</div>
</div>
<?php }?>
</body>
</html>
