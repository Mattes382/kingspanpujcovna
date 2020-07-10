<?php session_start(); 
$idd = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="cs-CZ">
        <link href="fonts/KingspanFont/stylesheet.css" rel="stylesheet">
     
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Objednávka #<?php echo $idd; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Links -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/camera.css" rel="stylesheet">
    

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
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
</head>

<body style="color: white; background-color: white; font-weight: 100;">
<?php

      
     
      

               if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
                require_once('connect.php');
                
                $con = Pripojit();
                
                $generator2;
?>
 <!--========================================================
                              CONTENT
    =========================================================-->

    <div class="container" style='color: black;'>


            <?php
                                        $odpocitavadlo = 0;
                                        $barva;
$statement = "SELECT `idbjednavky`, `produkty_idprodukty`, `zakaznici_idzakaznici`, `od`, `do`, objednavky.Jmeno, objednavky.Prijmeni, objednavky.Email, objednavky.telefon, `AdresaDoruceni`, `MestoDoruceni`, `zpusobdoruceni_idzpusobdoruceni`, `cenazaden`, `DenZapisu`, objednavky.Status, statusy.status, zpusobdoruceni.zpusobdoruceni, zakaznici.nazevFirmy, zakaznici.Adresa, zakaznici.Mesto, zakaznici.ZIP, objednavky.VracenoPoskozeno, objednavky.Vyfakturovano, objednavky.CisloBaliku FROM `objednavky` JOIN `statusy` ON objednavky.Status = statusy.idStatusu JOIN `zakaznici` ON objednavky.zakaznici_idzakaznici = zakaznici.idzakaznici JOIN `zpusobdoruceni` ON objednavky.zpusobdoruceni_idzpusobdoruceni = zpusobdoruceni.idzpusobdoruceni WHERE idbjednavky=? ORDER BY `idbjednavky` DESC";

                                                $generator = $con->prepare($statement);
                                                $generator->bind_param("i", $idd);
                                                $generator->bind_result($id, $idproduktu, $idzakaznika , $od , $do , $jmeno , $prijmeni , $mail , $telefon , $Adresadoruceni , $mestodoruceni , $zpusobdoruceni , $cenazaden, $zapis,$cislostatusu, $status, $zdoruceni, $nazevfirmy, $adresafirmy, $mestofirmy, $psc, $poskozene, $fakturovano, $cislobaliku);
                                                $generator->execute();
                                                while($generator->fetch()){
                                                    $formatzapis = date("d.m. Y G:i", strtotime($zapis));
                                                    $formatod = date("d.m. Y", strtotime($od));
                                                    $formatdo = date("d.m. Y", strtotime($do));
                                                if($cenazaden == 0){
                                                    $cenazaden = "ZDARMA";
                                                }

                                                ?>
                                                    <div class="row">
        <div class="col-xs-12" style='margin-top: 50px;'>
    		<div class="invoice-title">
            <h2 class="navbar-brand"><img src="images/logo.png" alt="logo" style="max-height: 60px;"></h2><h3 class="pull-right">Objednávka # <?php echo $idd;?></h3>
            </div>
<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Informace o zákazníkovi:</strong><br>
                    <?php echo $jmeno." ".$prijmeni;?><br>
                    <?php echo $nazevfirmy;?><br>
                    <?php echo $adresafirmy;?><br>
                    <?php echo $mestofirmy;?><br>
                    <?php echo $psc;?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Fakturační údaje:</strong><br>
                    <?php echo $Adresadoruceni;?><br>
                    <?php echo $mestodoruceni;?><br>
                    <?php echo $mail;?><br>
                    <?php echo $telefon;?><br>
    				</address>
    			</div>
    		</div>
            <div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Objednaný produkt:</strong><br>
                        <?php
                                                $con2 = Pripojit();
                                                $statementtt = "SELECT typproduktu.typproduktu, typpanelu.typpanelu, typtloustky.tloustka FROM `produkty` JOIN typproduktu ON produkty.typproduktu_idtypproduktu = typproduktu.idtypproduktu JOIN typpanelu ON produkty.typpanelu_idtyppanelu = typpanelu.idtyppanelu JOIN typtloustky ON produkty.typtloustky_idtyptloustky = typtloustky.idtyptloustky WHERE idprodukty=?";
                                                
                                                $generator2=$con2->prepare($statementtt);
                                                $generator2->bind_param('i', $idproduktu);
                                                $generator2->bind_result($ttypproduktu, $ttyppanelu, $typptloustky);
                                                $generator2->execute();
                                                while($generator2->fetch()){
                        
                                                
                                                if($typptloustky != "NaN"){
                                                    echo $ttypproduktu." ".$ttyppanelu." ".$typptloustky."mm";
                                                } else {
                                                    echo $ttypproduktu." ".$ttyppanelu;
                                                }
                        
                                                }
                                                $generator2->close();
                        ?>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Přeprava:</strong><br>
    					<?php echo $zdoruceni;?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Datum Objednávky:</strong><br>
    					<?php echo $formatzapis;?><br><br>
    				</address>
    			</div>
            </div>
            <div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Datum rezervace:</strong><br>
    					<?php echo "od ".$formatod." do ".$formatdo;?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Cena za den půjčení:</strong><br>
                        <?php
                        if($cenazaden == 0){
                            echo $cenazaden;
                        } else {
                            echo $cenazaden." Kč";
                        }
                         
                         ?><br><br>
    				</address>
    			</div>
    		</div>

            <div class="row">
    			<div class="col-xs-6" style='margin-top: 10px;'>
    				<address>
    					<strong>Stav objednávky:</strong><br>
                        <select style='padding: 10px; margin-top: 10px;' name='stav' id='stavv'>
                        <?php
                        $con2 = Pripojit();
                        $statementtt = "SELECT `idStatusu`, `status` FROM `statusy`";
                        $generator2=$con2->prepare($statementtt);
                        $generator2->bind_result($idss, $ss);
                        $generator2->execute();
                        while($generator2->fetch()){

                        if($idss == $cislostatusu){
                            echo "<option value='$idss' selected>$ss</option>";
                        } else {
                            echo "<option value='$idss'>$ss</option>";  
                        }

                        }
                        $generator2->close();
                        ?>
                        </select>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right" style='margin-top: 10px;'>
    				<address>
    					<strong>Bylo zboží vráceno poškozeno?</strong><br>
                        <select name='poskozene' style='padding: 10px; margin-top: 10px;' id='poskozenee'>
                        <?php
                        if(is_null($poskozene)){
                            echo "<option value='NULL' selected>Neurčeno</option>";
                            echo "<option value='1' >Ano</option>";
                            echo "<option value='0' >Ne</option>";
                        } else if($poskozene == 1){
                            echo "<option value='NULL'>Neurčeno</option>";
                            echo "<option value='1' selected>Ano</option>";
                            echo "<option value='0'>Ne</option>";
                        } else if($poskozene == 0){
                            echo "<option value='NULL' >Neurčeno</option>";
                            echo "<option value='1' >Ano</option>";
                            echo "<option value='0' selected>Ne</option>"; 
                        }
                         
                         ?>
                         </select>
    				</address>
    			</div>
            </div>
            <div class="row" style='margin-bottom: 50px;'>
    			<div class="col-xs-6" style='margin-top: 10px;'>
    				<address>
    					<strong>Číslo balíku:</strong><br>
                        <input type="text" id='cislobalicku'  style='padding: 10px; margin-top: 10px;' value='<?php echo $cislobaliku; ?>'>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right" style='margin-top: 10px;'>
    				<address>
    					<strong>Fakturováno:</strong><br>
                        <select name='fakturovano' style='padding: 10px; margin-top: 10px;' id='fakturovano'>
                        <?php
                        if($fakturovano == 1){
                            echo "<option value='1' selected>Ano</option>";
                            echo "<option value='0'>Ne</option>";
                        } else if($fakturovano == 0){
                            echo "<option value='1' >Ano</option>";
                            echo "<option value='0' selected>Ne</option>"; 
                        }
                         
                         ?>
                         </select>
    				</address>
    			</div>
            </div>
    	</div>
    </div>
                                                
                                                
                                                <?php
                                                }
                                                $generator->close();
                                        ?>

    
                <script>
        $(function() {

                $('#stavv').change(function() {
                    let a = this.value;
                    
                    $.ajax({
            url: 'ajaxzmenitstatus.php',
            type: 'POST',
            data: {var1: a, var2: <?php echo $id; ?>},
            dataType: "JSON",
            success: function(data) {
   
            }
        });
                });


                $('#poskozenee').change(function() {
                    let a = this.value;
                    $.ajax({
            url: 'ajaxzmenitposkozeni.php',
            type: 'POST',
            data: {var1: a, var2: <?php echo $id; ?>},
            dataType: "JSON",
            success: function(data) {
            }
        });
                    
                });

                $('#fakturovano').change(function() {
                    
                    let a = this.value;
                    $.ajax({
            url: 'ajaxfakturovano.php',
            type: 'POST',
            data: {var1: a, var2: <?php echo $id; ?>},
            dataType: "JSON",
            success: function(data) {
   
            }
        });
                });


                $('#cislobalicku').on("change paste keyup", function() {
                    
                    let b = $('#cislobalicku').val();
                   
                    $.ajax({
            url: 'ajaxzmenitcislobaliku.php',
            type: 'POST',
            data: {var1: b, var2: <?php echo $id; ?>},
            success: function(data) {
               
            }
        });
                    
                });


            }); 
                </script>

<?php
} else { ?>
    <div class="d-flex justify-content-center" style='position: absolute;top: 50%;left: 50%; margin-left: -150px; margin-top: -170px; '>
    <div style='text-align: center;'>
    <div class="d-flex justify-content-center">
    <img src='images/lionerror.png' alt='lev' style='width: 300px; display: block; padding-bottom: 30px;'>
    </div>
<h5 style='color: black; font-weight: 100; display: unset; text-transform: none;'>Stránka není přístupná</h5>
</div>
</div>
<?php
}
?>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<!-- </script> -->


</body>
</html>
