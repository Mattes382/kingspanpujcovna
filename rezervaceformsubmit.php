<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
ob_start();
if(isset($_SESSION['iduzivatele'])){


require_once('connect.php');
$con = Pripojit();

require 'vendor/autoload.php';


require("vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("vendor/phpmailer/phpmailer/src/SMTP.php");
require("vendor/phpmailer/phpmailer/src/Exception.php");

$mail = new PHPMailer(true);

$carlstahl;
$zehlicka;
$rotaboy;
$jmenozpusobudoruceni;
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
$ecena;
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



$typroduktu = mysqli_escape_string($con, $_POST['selector']);
$datumod = mysqli_escape_string($con, $_POST['od']);
$datumdo = mysqli_escape_string($con, $_POST['do']);
//dva dny navic
$datumdooo = date('Y-m-d', strtotime($datumdo. ' + 3 days'));
//dva dny navic
$adresaformular = mysqli_escape_string($con, $_POST['adresa']);
$mestoformular = mysqli_escape_string($con, $_POST['mesto']);
$telefonformular = mysqli_escape_string($con, $_POST['telefon']);
$emailformular = mysqli_escape_string($con, $_POST['email']);
$fakturacniudaje = mysqli_escape_string($con, $_POST['selector3']);
$zpusobdoruceni = mysqli_escape_string($con, $_POST['selector2']);
$idproduktu = mysqli_escape_string($con, $_POST['idproduktu']);
$templatestring;
if($typroduktu == "2"){
    $templatestring = "Word/template.docx";
    $rotaboy = true;
} else {
    $rotaboy = false;
}
if($typroduktu == "1"){
    $templatestring = "Word/template2.docx";
    $zehlicka = true;
} else {
    $zehlicka = false;
}
if($typroduktu == "3"){
    $templatestring = "Word/template3.docx";
    $carlstahl = true;
} else {
    $carlstahl = false;
}


$statement = "SELECT cena FROM cenanastavenazakaznikovi WHERE typproduktu_idtypproduktu = $typroduktu AND zakaznici_idzakaznici = $iduzivatele";
$generator = $con->prepare($statement);
$generator->bind_result($cena);
$generator->execute();
while($generator->fetch()){

$ecena = $cena;


}
$generator->close();

$statementt = "SELECT `zpusobdoruceni` FROM `zpusobdoruceni` WHERE `idzpusobdoruceni` = $zpusobdoruceni";
$generator = $con->prepare($statementt);
$generator->bind_result($ejmenozpusobudoruceni);
$generator->execute();
while($generator->fetch()){

$jmenozpusobudoruceni = $ejmenozpusobudoruceni;


}
$generator->close();

$nazevproduktu;

$statementtt = "SELECT `typproduktu` FROM `typproduktu` WHERE `idtypproduktu` = $typroduktu";
$generator = $con->prepare($statementtt);
$generator->bind_result($etypproduktku);
$generator->execute();
while($generator->fetch()){

$nazevproduktu = $etypproduktku;


}
$generator->close();
if($nazevproduktu == "ŽEHLIČKY"){
$nazevproduktu = "montážní přípravek na čedičové panely";
} else if($nazevproduktu == "ROTA BOY"){
$nazevproduktu = "montážní přípravek na střešní panely X-Dek (rotaboy)";
} else if($nazevproduktu == "CARLSTAHL"){
$nazevproduktu = "montážní přípravek na střešní panely RW/FF (carlstahl)";
} else {

}

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatestring);

$jmenoaprijmeni = $ejmeno." ".$eprijmeni;
$celystring;
$celystring2;
$datumood = date("d. m. Y", strtotime($datumod));
$datumdoo = date("d. m. Y", strtotime($datumdo));
$dnesnidatum = date("d. m. Y");
    if($rotaboy == true && $fakturacniudaje == "2"){
        $templateProcessor->setValue('adresaaulice', $eAdresa);
        $templateProcessor->setValue('mesto', $emesto);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_ZDVIHACIHO_ZARIZENI_ROTA_BOY_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
    if($rotaboy == true && $fakturacniudaje == "1"){
        $templateProcessor->setValue('adresaaulice', $adresaformular);
        $templateProcessor->setValue('mesto', $mestoformular);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_ZDVIHACIHO_ZARIZENI_ROTA_BOY_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
    if($zehlicka == true && $fakturacniudaje == "1"){
        $templateProcessor->setValue('adresaaulice', $adresaformular);
        $templateProcessor->setValue('mesto', $mestoformular);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $templateProcessor->setValue('cena', $ecena);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_MONTAZNIHO_PRIPRAVKU_PRO_PANELY_FRaFH_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
    if($zehlicka == true && $fakturacniudaje == "2"){
        $templateProcessor->setValue('adresaaulice', $eAdresa);
        $templateProcessor->setValue('mesto', $emesto);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $templateProcessor->setValue('cena', $ecena);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_MONTAZNIHO_PRIPRAVKU_PRO_PANELY_FRaFH_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
    if($carlstahl == true && $fakturacniudaje == "1"){
        $templateProcessor->setValue('adresaaulice', $adresaformular);
        $templateProcessor->setValue('mesto', $mestoformular);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $templateProcessor->setValue('cena', $ecena);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_MONTAZNIHO_PRIPRAVKU_PRO_PANELY_FRaFH_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
    if($carlstahl == true && $fakturacniudaje == "2"){
        $templateProcessor->setValue('adresaaulice', $eAdresa);
        $templateProcessor->setValue('mesto', $emesto);
        $templateProcessor->setValue('nazevfirmy', $enazevfirmy);
        $templateProcessor->setValue('jmenoaprijmeni', $jmenoaprijmeni);
        $templateProcessor->setValue('denzapujceni', $datumood);
        $templateProcessor->setValue('denvraceni', $datumdoo);
        $templateProcessor->setValue('dnesnidatum', $dnesnidatum);
        $templateProcessor->setValue('cena', $ecena);
        $celystring = "Word/DOHODA_O_ZAPUJCENI_MONTAZNIHO_PRIPRAVKU_PRO_PANELY_FRaFH_PRO_FIRMU_$enazevfirmy.docx";
        $templateProcessor->saveAs($celystring);
    }
$adresaa;
$mestooo;

    if($fakturacniudaje == "2"){
       $adresaaa = $eAdresa;
       $mestooo = $emesto;
    }else if($fakturacniudaje == "1"){
        $adresaaa = $adresaformular;
        $mestooo = $mestoformular;
    }


if(isset($_POST['odeslat'])){
        //poslat email
        try {
            $mail->CharSet = 'UTF-8'; 
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.forpsi.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'postmaster@kingspanpujcovna.cz';                     // SMTP username
            $mail->Password   = 'hB@uVC8xqN';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('postmaster@kingspanpujcovna.cz', 'Kingspan půjčovna');
            if($fakturacniudaje == "1"){
                $mail->addAddress($emailformular);  
            } else {
                $mail->addAddress($eemail);  
            }
               
                      
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');  
            if($rotaboy == true){
                $mail->addAttachment($celystring);   
    
            }
            if($zehlicka == true){
                $mail->addAttachment($celystring);
                $mail->addAttachment("Word/NÁVOD K OBSLUZE prostřeku - Montážní přípravky pro panel FR, FH.pdf");
                $mail->addAttachment("Word/Příloha č.1 Postup instalace zařízení na panel.pdf");
                $mail->addAttachment("Word/ZÁKAZ POUŽÍVÁNÍ NÁSTROJŮ A OBRÁCENÉ MONTÁŽE.pdf");  
            }
            if($carlstahl == true){
                $mail->addAttachment($celystring);   
                $mail->addAttachment("Word/Návod CarlStahl DE.pdf");
            }
            
        
            // Content
            $mail->isHTML(true);   
                                      
            $mail->Subject = 'Zapůjčení produktu';
            $mail->Body    = 'Dobrý den,<br>
            tímto potvrzujeme Vaši rezervaci na '.$nazevproduktu.' v době od '.$datumood.' do '.$datumdoo.' - zápůjční cena '.$ecena.' Kč za den.<br>
            Vámi zvolený způsob přepravy '.$nazevproduktu.': '.$jmenozpusobudoruceni.'. Doručovací adresa: '.$adresaaa.' '.$mestooo.' '.$jmenoaprijmeni.' '.$enazevfirmy.'.<br>
            Žádáme Vás o vrácení Vámi zapůjčeného '.$nazevproduktu.' v termínu.<br>
            <br>
            Děkujeme <br>
            <br>
            Kingspan a.s.<br>
            Vážní 465<br>
            500 03 Hradec Králové<br>
            <br>
            Telefon: +420 495 866 150 nebo +420 800 119 911<br>
            Web: panely.kingspan.cz<br>
            E-mail: techinfo@kingspan.cz';
            $mail->AltBody = 'Dobrý den,<br>
            tímto potvrzujeme Vaši rezervaci na '.$nazevproduktu.' v době od '.$datumood.' do '.$datumdoo.' - zápůjční cena '.$ecena.' Kč za den.<br>
            Vámi zvolený způsob přepravy '.$nazevproduktu.': '.$jmenozpusobudoruceni.'. Doručovací adresa: '.$adresaaa.' '.$mestooo.' '.$jmenoaprijmeni.' '.$enazevfirmy.'.<br>
            Žádáme Vás o vrácení Vámi zapůjčeného '.$nazevproduktu.' v termínu.<br>
            <br>
            Děkujeme <br>
            <br>
            Kingspan a.s.<br>
            Vážní 465<br>
            500 03 Hradec Králové<br>
            <br>
            Telefon: +420 495 866 150 nebo +420 800 119 911<br>
            Web: panely.kingspan.cz<br>
            E-mail: techinfo@kingspan.cz';
        
            $mail->send();
            echo 'Message has been sent';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    echo $iduzivatele;
    $statement = "INSERT INTO `objednavky`(`produkty_idprodukty`, `zakaznici_idzakaznici`, `od`, `do`, `Jmeno`, `Prijmeni`, `Email`, `Telefon`,`AdresaDoruceni`, `MestoDoruceni`, `zpusobdoruceni_idzpusobdoruceni`, `cenazaden`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    if($fakturacniudaje == "2"){


        $query = $con->prepare($statement);
    $query->bind_param("iissssssssii", $idproduktu, $iduzivatele, $datumod, $datumdooo, $ejmeno, $eprijmeni, $eemail, $etelefon, $eAdresa, $emesto, $zpusobdoruceni, $ecena);
 

    } else if($fakturacniudaje == "1"){



        $query = $con->prepare($statement);
    $query->bind_param("iissssssssii", $idproduktu, $iduzivatele, $datumod, $datumdooo, $ejmeno, $eprijmeni, $emailformular, $telefonformular, $adresaformular, $mestoformular, $zpusobdoruceni, $ecena);

     

    }
    if($query->execute()){
        header("Location: uspesnarezervace.php");
    }
     $query->close();



}


}
?>