<?php session_start(); require_once('connect.php'); 


 if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
     $con = Pripojit();

     ?>
     <style>
         html, body{
             overflow: auto;
         }
     table{
         color: black;
         font-size: 16px;
        font-weight: 100;
        
     }
     .table-responsive{
height: 80vh;
overflow: auto;
     }

.view{
    text-align: center;
    width: 100%;
    font-weight: 100;
}

     .label {
     display: inherit;
     padding: inherit; 
    font-size: inherit; 
    font-weight: bold;
    line-height: 1;
    color: #ffffff;
    width: 100%;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
label{
    width: auto;
}
     </style>
<div id='hlavninadpis' class="container-fluid" style='background-color: white; padding-left: 20px;'>
                     <h2>Znemožnit objednávky</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px;'>
                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th># Objednávky</th>
                                            <th>Datum</th>
                                            <th>Cena</th>
                                            <th>Status</th>
                                            <th>Doba zapůjčení</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $odpocitavadlo = 0;
                                        $barva;
                                                $statement = "SELECT `idbjednavky`, `produkty_idprodukty`, `zakaznici_idzakaznici`, `od`, `do`, `Jmeno`, `Prijmeni`, `Email`, `Telefon`, `AdresaDoruceni`, `MestoDoruceni`, `zpusobdoruceni_idzpusobdoruceni`, `cenazaden`, `DenZapisu`, objednavky.Status, statusy.status FROM `objednavky` JOIN `Statusy` ON objednavky.Status = statusy.idStatusu ORDER BY `idbjednavky` DESC";
                                                $generator = $con->prepare($statement);
                                                $generator->bind_result($id, $idproduktu, $idzakaznika , $od , $do , $jmeno , $prijmeni , $mail , $telefon , $Adresadoruceni , $mestodoruceni , $zpusobdoruceni , $cenazaden, $zapis,$cislostatusu, $status);
                                                $generator->execute();
                                                while($generator->fetch()){
                                                    $formatzapis = date("d.m. Y G:i", strtotime($zapis));
                                                    $formatod = date("d.m. Y", strtotime($od));
                                                    $formatdo = date("d.m. Y", strtotime($do));
                                                if($cenazaden == 0){
                                                    $cenazaden = "ZDARMA";
                                                }
                                                switch($odpocitavadlo){
                                                    case 0: $barva = "#4ACAD5";
                                                    $odpocitavadlo++;
                                                    break;
                                                    case 1: $barva = "#F44236";
                                                    $odpocitavadlo++;
                                                    break;
                                                    case 2: $barva = "#D8C860";
                                                    $odpocitavadlo++;
                                                    break;
                                                    case 3: $barva = "#63CD54";
                                                    $odpocitavadlo = 0;
                                                    break;
                                                }
                                                switch($cislostatusu){
                                                    case 1: $barva2 = "#4ACAD5";

                                                    break;
                                                    case 2: $barva2 = "#63CD54";
                                                    
                                                    break;
                                                    case 3: $barva2 = "#F44236";
                                                    
                                                    break;
                                                    case 4: $barva2 = "#D8C860";
                                                    
                                                    break;
                                                    case 5: $barva2 = "#49009c";
                                                    
                                                    break;
                                                }

                                                echo "<tr>";
                                            echo "<td># $id</td>";
                                            echo "<td>$formatzapis</td>";
                                            echo "<td>";
                                                echo "<label class='label label-danger' style='background-color: $barva; font-weight: 100;'>$cenazaden</label>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<label class='label label-danger' style='font-weight: 100; background-color: $barva2;'>$status</label></td>";
                                            echo "<td>$formatod - $formatdo</td>";
                                            echo "<td> <a href='detailobjednavky.php?id=$id' target=”_blank” rel='noopener noreferrer' class='btn btn-xs btn-primary view'  >Zobrazit</a> </td>";
                                        echo "</tr>";
                                                
                                                
                                                
                                                }
                                                $generator->close();
                                        ?>

                                    </tbody>
                                </table>
                            </div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() {
 


        }); 
    </script> 
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