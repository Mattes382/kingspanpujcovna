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
                     <h2>Nastavit cenu produktů</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px; overflow: auto;'>
<form accept-charset="UTF-8" action='ajaxnastavitcenu.php' role="form" method='post' id='myForm'>


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
 
 <select id='typproduktu' class="form-control" name='typproduktu'>
 <option value="" disabled selected>Prosím vyberte typ produktu</option>
 <?php
 $statement = "SELECT `idtypproduktu`, `typproduktu` FROM `typproduktu`";
 $generator = $con->prepare($statement);
 $generator->bind_result($id, $typproduktu);
 $generator->execute();
 while($generator->fetch()){

        echo "<option value='$id'>$typproduktu</option>";
     

 }
 $generator->close();
 ?>
 </select>
</div> <!-- form-group end.// -->

            <div class="form-group input-group"> 
<input id='cena' name="cena" class="form-control" placeholder="Cena za typ produktu (Kč/den)" type="text">
</div> <!-- form-group end.// -->

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block" id='odesilacibutton' name='odeslat' style='font-weight: 100;'>Nastavit cenu</button>
</div> <!-- form-group// -->  


 

                                                                 
</form>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script> 
 
    <script> 
        // wait for the DOM to be loaded 
        function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  });
}
setInputFilter(document.getElementById("cena"), function(value) {
  return /^\d*$/.test(value); });
        $(document).ready(function() {
            $(':input[type="submit"]').prop('disabled', true);

           
            $(':input[type="text"]').on("change paste keyup", function() {
                if($('#uzivatel').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                }  else if($('#typproduktu').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($('#cena').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else {
                    $(':input[type="submit"]').prop('disabled', false); 
                }

            });
            $('select').on("change", function() {
                if($('#uzivatel').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                }  else if($('#typproduktu').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else if($('#cena').val() === ''){
                    $(':input[type="submit"]').prop('disabled', true);
                } else {
                    $(':input[type="submit"]').prop('disabled', false); 
                }

            });

                       



 $("#myForm").ajaxForm(function() { 
                alert("Cena byla nastavena"); 
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
<?php }?>s