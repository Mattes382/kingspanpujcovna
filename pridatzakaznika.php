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
                     <h2>Přidat zákazníka</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px; overflow: auto;'>
<form accept-charset="UTF-8" action='pridatzakaznikaajax.php' role="form" method='post' id='myForm'>

  <div class="row" style='width: 800px;'>
    <div class="col-sm-6">

    <div class="form-group input-group">
 <input name="jmeno" class="form-control" placeholder="Jméno" type="text" required>
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="prijmeni" class="form-control" placeholder="Příjmení" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="firma" class="form-control" placeholder="Název firmy" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="ico" class="form-control" placeholder="IČO" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="dic" class="form-control" placeholder="DIČ" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="adresa" class="form-control" placeholder="Adresa" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
<input name="mesto" class="form-control" placeholder="Město" type="text">
</div> <!-- form-group end.// -->

    </div>
    <div class="col-sm-6">

<div class="form-group input-group">
<input name="psc" class="form-control" placeholder="PSČ" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input name="telefon" class="form-control" placeholder="Telefon" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input name="email" class="form-control" placeholder="E-mail" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group"> 
<input name="heslo" class="form-control" placeholder="Heslo" type="text">
</div> <!-- form-group end.// -->

<div class="form-group input-group">
 
 <select class="form-control" name='pravo'>
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
    <button type="submit" class="btn btn-primary btn-block" id='odesilacibutton' name='odeslat' style='font-weight: 100;'>Přidat zákazníka</button>
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
                } else if($(':input[name="heslo"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                }else if($(':input[name="heslo2"]').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else {
                    $(':input[type="submit"]').prop('disabled', false); 
                }

            });


 $("#myForm").ajaxForm(function() { 
                alert("Zákazník byl přidán"); 
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