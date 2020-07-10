<?php
session_start();
             require_once('connect.php');
             if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
             $id = $_POST['id'];


             $con = Pripojit();
             $con2 = Pripojit();
             $statement = "DELETE FROM `produkty` WHERE produkty.idprodukty=?";

             $generator = $con->prepare($statement);
             $generator->bind_param("i", $id);
             $generator->execute();
             
             $generator->close();
             ?>
             <div class="table-responsive">
             <table class="table table-striped table-bordered table-hover">
                 <thead>
                     <tr>
                         <th># Produktu</th>
                         <th>Typ produktu</th>
                         <th>Typ panelu</th>
                         <th>Typ tloušťky</th>
                         <th>Je právě zapůjčen?</th>
                         <th>Datumy objednávek</th>
                         <th>Smazat</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
//SELECT `idprodukty`, typproduktu.typproduktu, typpanelu.typpanelu, typtloustky.tloustka FROM `produkty` JOIN typproduktu ON produkty.typproduktu_idtypproduktu = typproduktu.idtypproduktu JOIN typpanelu ON produkty.typpanelu_idtyppanelu = typpanelu.idtyppanelu JOIN typtloustky ON produkty.typtloustky_idtyptloustky = typtloustky.idtyptloustky
                     $odpocitavadlo = 0;
                     $barva;

                             $statement = "SELECT `idprodukty`, typproduktu.typproduktu, typpanelu.typpanelu, typtloustky.tloustka FROM `produkty` JOIN typproduktu ON produkty.typproduktu_idtypproduktu = typproduktu.idtypproduktu JOIN typpanelu ON produkty.typpanelu_idtyppanelu = typpanelu.idtyppanelu JOIN typtloustky ON produkty.typtloustky_idtyptloustky = typtloustky.idtyptloustky ORDER BY `idprodukty` DESC";
                             $generator = $con->prepare($statement);
                             $generator->bind_result($id, $typproduktu, $typpanelu, $typtloustky);
                             $generator->execute();
                             while($generator->fetch()){
                                $jetam = "NE";
                                $datumy = "";
                                $statement2 = "SELECT `od`, `do` FROM `objednavky` WHERE objednavky.produkty_idprodukty= ?";
                                $generator2 = $con2->prepare($statement2);
                                $generator2->bind_param("i", $id);
                                $generator2->bind_result($od, $do);
                                $generator2->execute();
                                while($generator2->fetch()){
                                    $paymentDate = date('Y-m-d');
                                    $paymentDate=date('Y-m-d', strtotime($paymentDate));
                                    //echo $paymentDate; // echos today! 
                                    $contractDateBegin = date('Y-m-d', strtotime($od));
                                    $contractDateEnd = date('Y-m-d', strtotime($do));
                                    $contractDateBegin2 = date('d.m. Y', strtotime($od));
                                    $contractDateEnd2 = date('d.m. Y', strtotime($do));
                                    $datumy = $datumy.$contractDateBegin2." - ".$contractDateEnd2."<br>";
                                    
                                    if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
                                        $jetam = "ANO";
                                    }
                                }
                                $generator2->close();




                             switch($typproduktu){
                                 case "CARLSTAHL": $barva = "#4ACAD5";
                                 
                                 break;
                                 case "ŽEHLIČKY": $barva = "#D8C860";
                                 
                                 break;
                                 case "ROTA BOY": $barva = "#F44236";
                                 
                                 break;
                             }


                             echo "<tr>";
                         echo "<td># $id</td>";
                         echo "<td><label class='label label-danger' style='background-color: $barva; font-weight: 100;'>$typproduktu</label></td>";
                         echo "<td>$typpanelu</td>";
                         echo "<td>$typtloustky</td>";
                         echo "<td>$jetam</td>";
                         echo "<td> <a class='btn btn-xs btn-primary view zobrazitdatum' data-id='$datumy' data-cisloproduktu='$id' data-toggle='modal' data-target='#seznamobjednaavek'>Zobrazit</a> </td>";
                                           
                         echo "<td style='text-align: center;'><div class='smazatprodukt' data-id='$id' data-toggle='modal' data-target='#confirm-delete'><a style='vertical-align: text-top; font-size: larger;'>&#x2716;</a></div></td>";
                         
                     echo "</tr>";
                             
                             
                             
                             }
                             $generator->close();
                     ?>

                 </tbody>
             </table>
         </div>
         <?php
            }
       ?>