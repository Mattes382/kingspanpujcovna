<?php session_start(); require_once('connect.php'); 


 if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1 || $_SESSION['prava'] == 2){
     $con = Pripojit();

     ?>
	 <style>
	 
	 #fileToUpload {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
label{
	font-size: 20px;
	cursor: pointer;
	background-color: #20519D;
	border-radius: 8px;
	width: 100%;
	color: white;
}
@media (min-width: 768px){
    .col-sm-6 {
     width: auto; 
}
}

	 </style>
<div id='hlavninadpis' class="container-fluid" style='background-color: white; padding-left: 20px;'>
                     <h2>Upravit údaje</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px; overflow: auto;'>
<form accept-charset="UTF-8" action='upravitudajeajax.php' role="form" method='post' id='myForm'>

  <div class="row" style='width: 800px;'>
    <div class="col-sm-6">
    <div class="form-group input-group">
 
 <select id='uzivatel' class="form-control" name='uzivatel'>
 <option value="" disabled selected>Prosím vyberte zákazníka</option>
 <?php
 $statement = "SELECT `idzakaznici`, `nazevFirmy`, `Jmeno`, `Prijmeni` FROM `zakaznici`";
 $generator = $con->prepare($statement);
 $generator->bind_result($id, $firma, $jmeno, $prijmeni);
 $generator->execute();
 while($generator->fetch()){

        echo "<option value='$id'>$jmeno $prijmeni, $firma</option>";
     

 }
 $generator->close();
 ?>
     
 </select>
</div> <!-- form-group end.// -->

    <div class="form-group input-group">
 <input id='jmeno' name="jmeno" class="form-control" placeholder="Jméno" type="text" required>
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input id='prijmeni' name="prijmeni" class="form-control" placeholder="Příjmení" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input id='nazevfirmy' name="firma" class="form-control" placeholder="Název firmy" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input id='ico' name="ico" class="form-control" placeholder="IČO" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input id='dic' name="dic" class="form-control" placeholder="DIČ" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input id='adresa' name="adresa" class="form-control" placeholder="Adresa" type="text">
</div> <!-- form-group end.// -->



    </div>
    <div class="col-sm-6">
    <div class="form-group input-group">
<input id='mesto' name="mesto" class="form-control" placeholder="Město" type="text">
</div> <!-- form-group end.// -->
<div class="form-group input-group">
<input id='zip' name="psc" class="form-control" placeholder="PSČ" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input id='telefon' name="telefon" class="form-control" placeholder="Telefon" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input id='email' name="email" class="form-control" placeholder="E-mail" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input id='heslo' name="heslo" class="form-control" placeholder="Heslo (prázdné pole = stejné)" type="text">
</div> <!-- form-group end.// -->


<div class="form-group input-group">
 
 <select id='pravo' class="form-control" name='pravo'>
 <?php
 $statement = "SELECT * FROM prava";
 $generator = $con->prepare($statement);
 $generator->bind_result($id, $pravo);
 $generator->execute();
 while($generator->fetch()){
     if($id == 3){
        echo "<option value='$id' selected>$pravo</option>";
     } else{
        echo "<option value='$id'>$pravo</option>";
     }

 }
 $generator->close();
 ?>
     
 </select>
</div> <!-- form-group end.// -->
                               
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block" id='odesilacibutton' name='odeslat' style='font-weight: 100;'>Upravit zákazníka</button>
</div> <!-- form-group// -->  
</div>
  </div>

 

                                                                 
</form>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        $(document).ready(function() {
            $(':input[type="submit"]').prop('disabled', true);

           
            $(':input[type="text"]').on("change paste keyup", function() {
                if($(':input[name="jmeno"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                }  else if($(':input[name="prijmeni"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="firma"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="ico"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="dic"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="adresa"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="mesto"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="psc"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="telefon"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($(':input[name="email"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                }  else {
                    $(':input[type="submit"]').prop('disabled', false); 
                }

            });

                        $('#uzivatel').on('change',function(){
        var IDproduktu = $(this).val();
        
        if(IDproduktu){
            $.ajax({
                type:'POST',
                url:'fetchupravitzakaznika.php',
                data:'produkt_id='+IDproduktu,
                dataType: 'json',
                success:function(users_arr){
var nazevfirmy = users_arr[0]['nazevfirmy'];
var ico = users_arr[0]['ico'];
var dic = users_arr[0]['dic'];
var adresa = users_arr[0]['adresa'];
var mesto = users_arr[0]['mesto'];
var zip = users_arr[0]['zip'];
var jmeno = users_arr[0]['jmeno'];
var prijmeni = users_arr[0]['prijmeni'];
var email = users_arr[0]['email'];
var telefon = users_arr[0]['telefon'];
var prava = users_arr[0]['prava'];
var heslo = users_arr[0]['heslo'];
                    
                    $('#nazevfirmy').val(nazevfirmy);
                    $('#ico').val(ico);
                    $('#dic').val(dic);
                     $('#adresa').val(adresa);
                    $('#mesto').val(mesto);
                    $('#zip').val(zip);
                    $('#jmeno').val(jmeno);
                    $('#prijmeni').val(prijmeni);
                    $('#email').val(email);
                     $('#telefon').val(telefon);
                    $('#pravo').val(prava);
                    
                   
                    
                }
            }); 
        }
    });



 $("#myForm").ajaxForm(function() { 
                alert("Údaje zákazníka byli upraveny"); 
            }); 
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