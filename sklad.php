<?php session_start(); require_once('connect.php'); 


 if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
     $con = Pripojit();
     $con2 = Pripojit();

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
     .smazatprodukt:hover{
        color: red;
        cursor: pointer;
     }
     .smazatprodukt a:hover{
        color: red;
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
.modal-content{
color: black;
}
.modal-header{
font-size: 3em;
}
.modal-body{
font-size: 2em;
}
.btn-danger{
background-color: red;
}
.modal-content .btn-danger:hover{
color: red;
background-color: white;
border-color: red;
}
.modal-content .btn-default:hover{
color: grey;

}
     </style>
<div id='hlavninadpis' class="container-fluid" style='background-color: white; padding-left: 20px;'>
                     <h2>Sklad</h2>
                    </div>

                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px;'>
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
                                           
                                            echo "<td style='text-align: center;'><div class='smazatprodukt' data-id='$id'  data-toggle='modal' data-target='#confirm-delete'><a style='vertical-align: text-top; font-size: larger;'>&#x2716;</a></div></td>";
                                            
                                            echo "</tr>";
                                                
                             
                                                
                                                }
                                                $generator->close();
                                        ?>

                                    </tbody>
                                </table>
                            </div>
</section>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Smazat produkt
            </div>
            <div class="modal-body">
                Jste si jisti, že chcete smazat produkt?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zrušit</button>
                <a id='smaznout' class="btn btn-danger btn-ok" data-dismiss="modal">Smazat</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="seznamobjednaavek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id='hlava'>
                Datumy objednávek
            </div>
            <div class="modal-body" id='telo'>
                Jste si jisti, že chcete smazat produkt?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zrušit</button>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(function() {
            
            
            function cyklus(){
               




$('#smaznout').on('click', function() {
    var idproduktuu = $(this).val();
    $.ajax({
                type:'POST',
                url:'smazatprodukt.php',
                data:'id='+idproduktuu,
                success:function(html){
                  
                    $('#contentstranky').html(html);
                    cyklus();
                    
                    }
                    });

});


$('.zobrazitdatum').on('click',function(){
                     var idproduktuc = $(this).data('id');
                     var produktyidd = $(this).data('cisloproduktu');
                     if(idproduktuc === ""){
                        idproduktuc = "Pro daný produkt nebyly nalezenzy žádné objednávky"
                     }
               $('#telo').html(idproduktuc);
               $('#hlava').html("Datumy objednávek pro produkt #"+produktyidd);
      


                });

                    $('.smazatprodukt').on('click',function(){
                     var idproduktu = $(this).data('id');
               $('#smaznout').val(idproduktu);
      


                });

        }      
        cyklus();
         /* $.ajax({
                type:'POST',
                url:'smazatprodukt.php',
                data:'id='+id,
                success:function(html){
                 
                    $('#contentstranky').html(html);
                    cyklus();
                    
                    }
                    }); */
            
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