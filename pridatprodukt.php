<?php session_start(); require_once('connect.php'); 


 if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
     $con = Pripojit();

     ?>
<div id='hlavninadpis' class="container-fluid" style='background-color: white; padding-left: 20px;'>
                     <h2>Přidat produkt</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px;'>
<form accept-charset="UTF-8" action='pridatproduktajax.php' role="form" method='post' id='myForm'>

    <div class="form-group input-group">
 
		<select class="form-control" name='typproduktu'>
        <option selected="" value='0'>Prosím vyberte typ produktu</option>
        <?php
        $statement = "SELECT * FROM typproduktu";
        $generator = $con->prepare($statement);
        $generator->bind_result($id, $typ, $obrazek);
        $generator->execute();
        while($generator->fetch()){
        echo "<option value='$id'>$typ</option>";
        }
        $generator->close();
        ?>
			
		</select>
	</div> <!-- form-group end.// -->

    <div class="form-group input-group">
 
 <select class="form-control" name='typpanelu'>
 <option selected="" value='0'>Prosím vyberte typ panelu</option>
 <?php
 $statement = "SELECT * FROM typpanelu";
 $generator = $con->prepare($statement);
 $generator->bind_result($id, $typ);
 $generator->execute();
 while($generator->fetch()){
 echo "<option value='$id'>$typ</option>";
 }
 $generator->close();
 ?>
     
 </select>
</div> <!-- form-group end.// -->
<div class="form-group input-group">
 
 <select class="form-control" name='typtloustky'>
 <option selected="" value='0'>Prosím vyberte typ tloušťky</option>
 <?php
 $statement = "SELECT * FROM typtloustky";
 $generator = $con->prepare($statement);
 $generator->bind_result($id, $typ);
 $generator->execute();
 while($generator->fetch()){
 echo "<option value='$id'>$typ</option>";
 }
 $generator->close();
 ?>
     
 </select>
</div> <!-- form-group end.// -->                                     
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" id='odesilacibutton' name='odeslat' style='font-weight: 100;'>Přidat produkt</button>
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
            var treti = false;
            $(':input[name="typproduktu"]').change(function() {
                if($(':input[name="typproduktu"]').val() !== '0'){
                    prvni = true;
                } else {
                    prvni = false;
                }
                if(prvni === true && druhy === true && treti === true){
                    $(':input[type="submit"]').prop('disabled', false); 
                } else {
                    $(':input[type="submit"]').prop('disabled', true); 
                }
            });
            $(':input[name="typpanelu"]').change(function() {
                if($(':input[name="typpanelu"]').val() !== '0'){
                    druhy = true;
                } else {
                    druhy = false;
                }
                if(prvni === true && druhy === true && treti === true){
                    $(':input[type="submit"]').prop('disabled', false); 
                } else {
                    $(':input[type="submit"]').prop('disabled', true); 
                }
            });
            $(':input[name="typtloustky"]').change(function() {
                if($(':input[name="typtloustky"]').val() !== '0'){
                    treti = true;
                } else {
                    treti = false;
                }
                if(prvni === true && druhy === true && treti === true){
                    $(':input[type="submit"]').prop('disabled', false); 
                } else {
                    $(':input[type="submit"]').prop('disabled', true); 
                }
            });
            
$('#myForm').ajaxForm(function() { 
                alert("Produkt byl přidán"); 
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