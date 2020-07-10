<?php session_start(); require_once('connect.php'); 

?>
<!DOCTYPE html>
<html lang="cs-CZ">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="fonts/KingspanFont/stylesheet.css" rel="stylesheet">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Rezervace produktů</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Links -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/camera.css" rel="stylesheet">
    <link href="css/google-map.css" rel="stylesheet">

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
        .drp-selected{
            color: black;  
        }
    .calendar-table{
        color: black;
    }
    .btn:hover[disabled]:hover{
        background-color: #25292e;
border-color: #25292e;
color: white;
text-shadow: none;
    }
            input[type=radio] {
              position: absolute;
              visibility: hidden;
              display: none;
            }
            form a:hover {
              text-decoration: underline;
            }
            
            label {
              color: #25292e;
              display: inline-block;
              cursor: pointer;
              font-weight: 100;
              padding: 10px 20px;
              width: 170px;
              margin-bottom: 0px;
              transition: 0.2s ease-in-out;
            }
            
            input[type=radio]:checked + label{
              color: white;
              background: #20519D;
            }
            input[type=radio]:disabled + label{
              color: #25292e;
              background: grey;
            }
            
            label + input[type=radio] + label {
              border-left: solid #25292e;
            }
            .radio-group {
              border: solid #25292e;
              display: inline-block;
              margin-top: 20px;
              margin-bottom: 20px;
              
              border-radius: 10px;
              overflow: hidden;
            }
            form{
                width: 100%;
                margin-left: 20px;
            }
            #labelcheck{
                padding: 0px 0px 15px;
            }
            .formatext{
                width: 340px;
            }
            @media only screen and (max-width: 650px) {
            label {
            
                color: #25292e;
                display: inline-block;
                cursor: pointer;
               
                
                margin-bottom: 0px;
                transition: 0.2s ease-in-out;
                text-align: center;
                width: 250px;
            
            display: table;
            
            }
            #rightcheck{
                max-height: 150px;
            }
            .formatext{
                width: 100%;
            }

            label + input[type="radio"] + label {
                border-left: 0px;
            }
            #labelcheck{
                display: unset;
                
            }
            }
            form{
                width: auto;
                margin-left: 20px;
                margin-right: 20px;
                text-align: center;
                
            }
            @media only screen and (max-width: 350px) {
                .radio-group{
                    width: 100%;
                }
            }
                </style>
</head>
<body>
<?php if(isset($_SESSION['prihlaseni'])){?>
<div class="page">
<div id="stuck_container" class="stuck_container">
            <nav class="navbar navbar-default navbar-static-top ">
                <div class="container">
                    <div class="navbar-header">
                        <h1 class="navbar-brand">
<img src="images/logo.png"  alt="logo" style="max-height: 60px;">
                        </h1>
                    </div>
                   
                    <ul class="navbar-nav sf-menu" data-type="navbar">
                        <li class="active">
                            <a href="rezervace.php">Rezervace</a>
                        </li>
                        <?php
                        if($_SESSION['prava'] == 1){
echo "<li><a href='adminpanel.php' style='font-family: Kingspan Brown TT'>Administrátorský panel</a></li>";
                        } else if ($_SESSION['prava'] == 2){
echo "<li><a href='obchodnikpanel.php' style='font-family: Kingspan Brown TT'>Obchodníkův panel</a></li>";
                        }
                        ?>
                        <li>
                            <a href="https://www.kingspan.com/cz/cs-cz" style="font-family: Kingspan Brown TT">O nás</a>
                        </li>
                        <li>
                            <a href="odhlasit.php" style="font-family: Kingspan Brown TT">Odhlásit</a>
                        </li>
                    </ul>
                   

                </div>
            </nav>
        </div>
    <!--========================================================
                              HEADER
    =========================================================-->
    <header>
    <div class="d-flex justify-content-center" style='padding: 20px;'>
    <div style='text-align: center; margin-top: 20vh;'>
    <div class="d-flex justify-content-center">
    <img src='images/uspech.png' id='rightcheck' alt='lev' style='height: 200px; display: block; padding-bottom: 30px; margin: 0 auto;'>
    </div>
<h4 style='color: black; font-weight: 100;  display: unset; text-transform: none;'>Vaše rezervace byla úspěšná</h4>
<h5 style='color: black; font-weight: 100; margin-top: 15px; text-transform: none;'>Podrobnosti byly zaslány na Váš Email</h5>
</div>
</div>
    </header>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {
    var dateRanges = [
                { 'start': moment('2017-10-25'), 'end': moment('2017-10-27') },
                { 'start': moment('2017-10-29'), 'end': moment('2017-10-30') }
            ];

var idproduktu;

function cykluss(){
    var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
  $('input[name="daterange"]').daterangepicker({
    opens: 'center',
    "minDate": today,
    isInvalidDate: function(date) {
        return dateRanges.reduce(function(bool, range) {
                return bool || (date >= range.start && date <= range.end);
            }, false);
        },       "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Potvrdit",
        "cancelLabel": "Zrušit",
        "fromLabel": "Od",
        "toLabel": "Do",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Ne",
            "Po",
            "Út",
            "St",
            "Čt",
            "Pá",
            "So"
        ],
        "monthNames": [
            "Leden",
            "Únor",
            "Březen",
            "Duben",
            "Květen",
            "Červen",
            "Červenec",
            "Srpen",
            "Září",
            "Říjen",
            "Listopad",
            "Prosinec"
        ],
        "firstDay": 1
    },
    autoUpdateInput: false,
    "singleDatePicker": false,
  }, function(start, end, label) {
    this.autoUpdateInput = true;
  });
  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
   
    console.log("A new date selection was made: " + picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.startDate.format('YYYY-MM-DD'));
    $("#od").prop('value', picker.startDate.format('YYYY-MM-DD'));
    $("#do").prop('value', picker.endDate.format('YYYY-MM-DD'));
    $( "#adresa").slideDown( "fast", function() {
                $( "#adresanadpis" ).slideDown( "slow", function() {
                });
            });
});
}




    var hodnotaproduktu;
    

    var prvnidatum = null;
    var druhedatum = null;
    $("#option-1").prop('checked', false);
  
    $("#option-2").prop('checked', false);
  
    $("#option-3").prop('checked', false);

    $("#option2-1").prop('checked', false);
  
    $("#option2-2").prop('checked', false);

    $("#option3-1").prop('checked', false);
  
  $("#option3-2").prop('checked', false);

var efektaktiv = "false";





var firsttimeprodukt1 = true;

    $('input[type=radio][name=selector]').change(function() {
        hodnotaproduktu = this.value;

        if(hodnotaproduktu === "2"){

            $("#odesilacicudl").attr("disabled", true);

        } else {
            $("#odesilacicudl").attr("disabled", false); 
        }   
        
        if(firsttimeprodukt1 === true){
        firsttimeprodukt1 = false;
     } else {
        $("#zmenaproduktu").slideUp( "slow", function() {
                });
     }


        $.ajax({
            url: 'hlavnistrankaajax.php',
            type: 'POST',
            data: {var1: hodnotaproduktu},
            success: function(html) {
             
                $("#cenaprozakaznika").html(html);
                
            }
        });
        $.ajax({
            url: 'generovatproduktyrezervace.php',
            type: 'POST',
            data: {var1: hodnotaproduktu},
            success: function(html) {
             
                $("#produkttt").html(html);
                
            }
        });
        $( "#produktt").slideDown( "fast", function() {
                $( "#produkttnadpis" ).slideDown( "slow", function() {
                });
            });


            efektaktiv = "true";
            if(hodnotaproduktu === "2"){
$('#podminka').html("<input type='checkbox' name='souhlasim' style='margin: 0px 10px;' class='form-check-input' id='podminky'><label class='form-check-label' id='labelcheck' style='width: auto;' for='podminky'>Souhlasím s obchodními podmínkami o zapůjčení zařízení rota boy</label>");
cyklus();
            } else {
                $('#podminka').html("");
            }
  });

//CUSTOM DATUMY
var firsttimeprodukt = true;
  $('#produkttt').change(function() {
     idproduktu = this.value;
     if(firsttimeprodukt === true){
        firsttimeprodukt = false;
     } else {
        $("#zmenaproduktu").slideDown( "fast", function() {
                });
     }
    
     $.ajax({
            url: 'ajaxkalendar.php',
            type: 'POST',
            async: false,
            data: {var1: idproduktu},
            dataType: "JSON",
            success: function(data) {

            let final = new Array();
             for (let row of data) {
                
                let obj = new Object();
                obj.start = moment(row["start"]);
                obj.end = moment(row["end"]);
                final.push(obj);
             }
            
             dateRanges = final;
             cykluss();     
            }
        });
     
    $( "#datum").slideDown( "fast", function() {
                $( "#dobarezervace" ).slideDown( "slow", function() {
                });
            });
        });


  $('input[type=radio][name=selector2]').change(function() {
        rozmer = this.value;
        $( "#vasecena").slideDown( "fast", function() {
                $( "#vasecenanadpis" ).slideDown( "slow", function() {
                });
            });
        });

function cyklus(){
        //checkbox
        $('#podminky').change(function() {
            
            $("#odesilacicudl").prop('disabled', !$('#podminky:checked').length);
});

}


            $('input[type=radio][name=selector3]').change(function() {
        rozmer = this.value;
if(rozmer === "1"){
    $( "#fakturacniudaje").slideDown( "fast", function() {
                $( "#fakturacniudajenadpis" ).slideDown( "slow", function() {
                });
            });
} else {
    $( "#fakturacniudaje").slideUp( "fast", function() {
                $( "#fakturacniudajenadpis" ).slideUp( "slow", function() {
                });
            });
}
            $( "#doruceni").slideDown( "fast", function() {
                $( "#doruceninadpis" ).slideDown( "slow", function() {
                });
            });
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
</body>
</html>
