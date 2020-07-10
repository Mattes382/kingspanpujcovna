<?php session_start(); require_once('connect.php'); 


 if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
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
	 </style>
<div id='hlavninadpis' class="container-fluid" style='background-color: white; padding-left: 20px;'>
                     <h2>Přidat typ produktu</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px;'>
<form accept-charset="UTF-8" action='pridattypproduktuajax.php' role="form" method='post' id='myForm'>


    <div class="form-group input-group">
 
	<input name="jmeno" class="form-control" placeholder="Zadejte název" type="text">
</div> <!-- form-group end.// -->
<div class="form-group input-group">
<label for="fileToUpload">Vyberte obrázek...</label>
 <input name="fileToUpload" id='fileToUpload' class="form-control" placeholder="Vyberte obrázek" type="file">
</div> <!-- form-group end.// -->
                                   
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" id='odesilacibutton' name='odeslat' style='font-weight: 100;'>Přidat typ produktu</button>
    </div> <!-- form-group// -->      
                                                                 
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
            var prvni = false;
            var druhy = false;
           
            $(':input[name="jmeno"]').on("change paste keyup", function() {
                if($(':input[name="jmeno"]').val() !== ''){
                    prvni = true;
                } else {
                    prvni = false;
                }
                if(prvni === true && druhy === true){
                    $(':input[type="submit"]').prop('disabled', false); 
                } else {
                    $(':input[type="submit"]').prop('disabled', true); 
                }
            });
            $(':input[name="fileToUpload"]').change(function() {
                if($(':input[name="fileToUpload"]').val() !== ''){
                    druhy = true;
                } else {
                    druhy = false;
                }
                if(prvni === true && druhy === true){
                    $(':input[type="submit"]').prop('disabled', false); 
                } else {
                    $(':input[type="submit"]').prop('disabled', true); 
                }
            });

            
$('#myForm').ajaxForm(function() { 
                alert("Typ produktu byl přidán"); 
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