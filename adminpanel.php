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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Administrátorský panel</title>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" rel="stylesheet" >
    <link src='fontawesome/css/fontawesome.css' rel="stylesheet">
    <link src='fontawesome/css/all.css' rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
  <link href="/fontawesome/css/brands.css" rel="stylesheet">
  <link href="/fontawesome/css/solid.css" rel="stylesheet">
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
    #hlavninadpis {
  padding: 20px 20px 20px 70px;
}
.form-control{
  padding: 10px 10px;
  height: auto;
}
.form-group{
  width: 300px;
}
#contentstranky{
  
  transition: 0.2s ease-in-out;
}
        @keyframes swing {
  0% {
    transform: rotate(0deg);
  }
  10% {
    transform: rotate(10deg);
  }
  30% {
    transform: rotate(0deg);
  }
  40% {
    transform: rotate(-10deg);
  }
  50% {
    transform: rotate(0deg);
  }
  60% {
    transform: rotate(5deg);
  }
  70% {
    transform: rotate(0deg);
  }
  80% {
    transform: rotate(-5deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

@keyframes sonar {
  0% {
    transform: scale(0.9);
    opacity: 1;
  }
  100% {
    transform: scale(2);
    opacity: 0;
  }
}
body {
  font-size: 0.9rem;
}
h2{
  line-height: 1.5em;
}
.page-wrapper .sidebar-wrapper,
.sidebar-wrapper .sidebar-brand > a,
.sidebar-wrapper .sidebar-dropdown > a:after,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
.sidebar-wrapper ul li a i,
.page-wrapper .page-content,
.sidebar-wrapper .sidebar-search input.search-menu,
.sidebar-wrapper .sidebar-search .input-group-text,
.sidebar-wrapper .sidebar-menu ul li a,
#show-sidebar,
#close-sidebar {
  -webkit-transition: all 0.3s ease;
  -moz-transition: all 0.3s ease;
  -ms-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

/*----------------page-wrapper----------------*/

.page-wrapper {
  height: 100vh;
}
span {
  font-size: 1.5em;
}

.page-wrapper .theme {
  width: 40px;
  height: 40px;
  display: inline-block;
  border-radius: 4px;
  margin: 2px;
}

.page-wrapper .theme.chiller-theme {
  background: #1e2229;
}

/*----------------toggeled sidebar----------------*/

.page-wrapper.toggled .sidebar-wrapper {
  left: 0px;
}

@media screen and (max-width: 450px) {
h2 {
  font-size: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.form-group{
  width: 100%;
}

#hlavninadpis {
  padding: 30px 20px 30px 70px;
}

}

@media screen and (min-width: 768px) {
  .page-wrapper.toggled .page-content {
    padding-left: 260px;
  }
}
/*----------------show sidebar button----------------*/
#show-sidebar {
    position: fixed;
    z-index: 998;
left: 0;

top: 16px;

border-radius: 0 4px 4px 0px;

width: 55px;

transition-delay: 0.3s;

background-color: #20519D;

color: white;
}
.page-wrapper.toggled #show-sidebar {
  left: -40px;
}
/*----------------sidebar-wrapper----------------*/

.sidebar-wrapper {
  width: 260px;
  height: 100%;
  max-height: 100%;
  position: fixed;
  top: 0;
  left: -300px;
  z-index: 999;
}

.sidebar-wrapper ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar-wrapper a {
  text-decoration: none;
}

/*----------------sidebar-content----------------*/

.sidebar-content {
  max-height: calc(100% - 30px);
  height: calc(100% - 30px);
  overflow-y: auto;
  position: relative;
}

.sidebar-content.desktop {
  overflow-y: hidden;
}

/*--------------------sidebar-brand----------------------*/

.sidebar-wrapper .sidebar-brand {
  padding: 10px 20px;
  display: flex;
  align-items: center;
}

.sidebar-wrapper .sidebar-brand > a {
  text-transform: uppercase;
  font-weight: bold;
  flex-grow: 1;
}

.sidebar-wrapper .sidebar-brand #close-sidebar {
  cursor: pointer;
  font-size: 20px;
}
/*--------------------sidebar-header----------------------*/

.sidebar-wrapper .sidebar-header {
  padding: 20px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic {
  float: left;
  width: 60px;
  padding: 2px;
  border-radius: 12px;
  margin-right: 15px;
  overflow: hidden;
}

.sidebar-wrapper .sidebar-header .user-pic img {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

.sidebar-wrapper .sidebar-header .user-info {
  float: left;
}

.sidebar-wrapper .sidebar-header .user-info > span {
  display: block;
}

.sidebar-wrapper .sidebar-header .user-info .user-role {
  font-size: 12px;
}

.sidebar-wrapper .sidebar-header .user-info .user-status {
  font-size: 11px;
  margin-top: 4px;
}

.sidebar-wrapper .sidebar-header .user-info .user-status i {
  font-size: 8px;
  margin-right: 4px;
  color: #5cb85c;
}

/*-----------------------sidebar-search------------------------*/

.sidebar-wrapper .sidebar-search > div {
  padding: 10px 20px;
}

/*----------------------sidebar-menu-------------------------*/

.sidebar-wrapper .sidebar-menu {
  padding-bottom: 10px;
}

.sidebar-wrapper .sidebar-menu .header-menu span {
  font-weight: bold;
  font-size: 14px;
  padding: 15px 20px 5px 20px;
  display: inline-block;
}

.sidebar-wrapper .sidebar-menu ul li a {
  display: inline-block;
  width: 100%;
  text-decoration: none;
  position: relative;
  padding: 8px 30px 8px 20px;
}

.sidebar-wrapper .sidebar-menu ul li a i {
  margin-right: 10px;
  font-size: 12px;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  border-radius: 4px;
}

.sidebar-wrapper .sidebar-menu ul li a:hover > i::before {
  display: inline-block;
  
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown > a:after {
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  content: "\f105";
  font-style: normal;
  display: inline-block;
  font-style: normal;
  font-variant: normal;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  font-size: 1.5em;
  background: 0 0;
  position: absolute;
  right: 15px;
  top: 14px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
  padding: 5px 0;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
  padding-left: 25px;
  font-size: 13px;
}
.fa:before{
  font-size: larger;
}
.fas:before{
  font-size: larger;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {
  content: "\f111";
  font-family: "Font Awesome 5 Free";
  font-weight: 400;
  font-style: normal;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin-right: 10px;
  font-size: 8px;
}

.sidebar-wrapper .sidebar-menu ul li a span.label,
.sidebar-wrapper .sidebar-menu ul li a span.badge {
  float: right;
  margin-top: 8px;
  margin-left: 5px;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
.sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
  float: right;
  margin-top: 0px;
}

.sidebar-wrapper .sidebar-menu .sidebar-submenu {
  display: none;
}

.sidebar-wrapper .sidebar-menu .sidebar-dropdown.active > a:after {
  transform: rotate(90deg);
  right: 17px;
}

/*--------------------------side-footer------------------------------*/

.sidebar-footer {
  position: absolute;
  width: 100%;
  bottom: 0;
  display: flex;
}

.sidebar-footer > a {
  flex-grow: 1;
  text-align: center;
  height: 30px;
  line-height: 32px;
  position: relative;
}

.sidebar-footer > a .notification {
  position: absolute;
  top: 2px;
}

.badge-sonar {
  display: inline-block;
  background: #980303;
  border-radius: 50%;
  height: 8px;
  width: 8px;
  position: absolute;
  top: 0;
}

.badge-sonar:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  border: 2px solid #980303;
  opacity: 0;
  border-radius: 50%;
  width: 100%;
  height: 100%;
  animation: sonar 1.5s infinite;
}

/*--------------------------page-content-----------------------------*/

.page-wrapper .page-content {
  display: inline-block;
  width: 100%;
  padding-left: 0px;
  padding-top: 20px;
}

.page-wrapper .page-content > div {
  padding: 20px 40px;
}

.page-wrapper .page-content {
  overflow-x: hidden;
}

/*------scroll bar---------------------*/

::-webkit-scrollbar {
  width: 5px;
  height: 7px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #525965;
  border: 0px none #ffffff;
  border-radius: 0px;
}
::-webkit-scrollbar-thumb:hover {
  background: #525965;
}
::-webkit-scrollbar-thumb:active {
  background: #525965;
}
::-webkit-scrollbar-track {
  background: transparent;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: transparent;
}
::-webkit-scrollbar-track:active {
  background: transparent;
}
::-webkit-scrollbar-corner {
  background: transparent;
}


/*-----------------------------chiller-theme-------------------------------------------------*/

.chiller-theme .sidebar-wrapper {
    background: #31353D;
}

.chiller-theme .sidebar-wrapper .sidebar-header,
.chiller-theme .sidebar-wrapper .sidebar-search,
.chiller-theme .sidebar-wrapper .sidebar-menu {
    border-top: 1px solid #3a3f48;
}

.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    border-color: transparent;
    box-shadow: none;
}

.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text,
.chiller-theme .sidebar-wrapper .sidebar-brand>a,
.chiller-theme .sidebar-wrapper .sidebar-menu ul li a,
.chiller-theme .sidebar-footer>a {
    color: #818896;
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li:hover>a,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
.chiller-theme .sidebar-wrapper .sidebar-header .user-info,
.chiller-theme .sidebar-wrapper .sidebar-brand>a:hover,
.chiller-theme .sidebar-footer>a:hover i {
    color: #ffffff;
}

.page-wrapper.chiller-theme.toggled #close-sidebar {
    color: #bdbdbd;
}

.page-wrapper.chiller-theme.toggled #close-sidebar:hover {
    color: #ffffff;
}

.chiller-theme .sidebar-wrapper ul li:hover a i,
.chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
    color: #ffffff;
   
}

.chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
.chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
.chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
.chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
    background: #3a3f48;
}

.chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span {
    color: #6c7b88;
}

.chiller-theme .sidebar-footer {
    background: #3a3f48;
    box-shadow: 0px -1px 5px #282c33;
    border-top: 1px solid #464a52;
}

.chiller-theme .sidebar-footer>a:first-child {
    border-left: none;
}

.chiller-theme .sidebar-footer>a:last-child {
    border-right: none;
}






        .drp-selected{
            color: black;  
        }
        .rotate{
    -moz-transition: all 0.2s linear;
    -webkit-transition: all 0.2s linear;
    transition: all 0.2s linear;
    display: inline-block;
}

.rotate.down{
    -ms-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
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
            .fa-angle-down{
                margin-left: 10px;
              
            }

            form{
                width: 100%;
              
            }
            #labelcheck{
                padding: 0px 0px 15px;
            }
            .formatext{
                width: 340px;
            }
            #drzakvyberu{
            background-color: #20519D;

            color:white;
            }
            .drzak{
                display: inline-block;
                width: 25%;
                text-align: center;
                padding-top: 1em;
                padding-bottom: 1em;
                cursor: pointer;
            }


            #drzakdva{
                color: #20519D;
                background-color:white;

            display: none;
            }
            @media only screen and (max-width: 991px) {
            .velkejdrzak{
                margin-top: 145px;
            }
            }
            @media only screen and (max-width: 767px){
                body{
                    padding: 0px;
                }
                .drzak{
                    display: block;
                    width: 100%;
                    padding-top: 0.5em;
                    padding-bottom: 0.5em;
                }
                #drzakvyberu {
                    padding-top: 0px;
                    padding-bottom: 0px;
                }
                .velkejdrzak{
                margin-top: 80px;
            }
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
<?php if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){?>

<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->
   





        <div class="page-wrapper chiller-theme">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
              <i class="fas fa-bars" style='margin-top: 4px;'></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
              <div class="sidebar-content">
                <div class="sidebar-brand">
                 <a href="#" style="font-size: 1.5em;"></a>
                  <div id="close-sidebar" style="height: 25px;">
                    <i class="fas fa-times"></i>
                  </div>
                </div>

            
           
                <div class="sidebar-menu">
                  <ul>
                    <li class="header-menu">
                      <span>Administrace</span>
                    </li>
                    <li class="sidebar-dropdown">
                      <a href="#" id='default'>
                        <i class="fa fas fa-list-ul"></i>
                        <span>Objednávky</span>
                       <!--<span class="badge badge-pill badge-warning">New</span>--> 
                      </a>
                      <div class="sidebar-submenu">
                        <ul>
                          <li>
                            <a href="seznamobjednavek" id='default2'>Seznam objednávek</a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li class="sidebar-dropdown">
                      <a href="#">
                        <i class="fas fa-user-tie"></i>
                        <span>Zákazníci</span>
                        <!--<span class="badge badge-pill badge-danger">3</span>-->
                      </a>
                      <div class="sidebar-submenu">
                        <ul>
                          <li>
                            <a href="pridatzakaznika">Přidat zákazníka</a>
                          </li>
                          <li>
                            <a href="upravitudaje">Upravit údaje</a>
                          </li>
                          <li>
                            <a href="nastavitcenu">Nastavit cenu produktů</a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li class="sidebar-dropdown">
                      <a href="#"><i class="fas fa-dolly-flatbed"></i><span>Produkty</span>
                      </a>
                      <div class="sidebar-submenu">
                        <ul>
                          <li>
                            <a href="pridatprodukt">Přidat produkt</a>
                          </li>
                          <li>
                            <a href="pridattypproduktu">Přidat typ produktu</a>
                          </li>
                          <li>
                            <a href="sklad">Sklad</a>
                          </li>
                        </ul>
                      </div>
                    </li>


                    <li class="header-menu">
                      <span>Odkazy</span>
                    </li>
                    <li>
                      <a href="https://www.kingspan.com/cz/cs-cz/produkty/izolacni-sendvicove-panely">
                        <i class="fa fa-book"></i>
                        <span>O nás</span>
                      </a>
                    </li>
                    <li>
                      <a href="rezervace.php">
                        <i class="fa fa-calendar"></i>
                        <span>Rezervace</span>
                      </a>
                    </li>
                    <li>
                      <a href="odhlasit.php">
                        <i class="fa fa-power-off"></i>
                        <span>Odhlásit</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- sidebar-menu  -->
              </div>
              <!-- sidebar-content  
              <div class="sidebar-footer" style='font-size: 1.5em;'>
                <a href="#">
                  <i class="fa fa-bell"></i>
                  <span class="badge badge-pill badge-warning notification">3</span>
                </a>
                <a href="#">
                  <i class="fa fa-envelope"></i>
                  <span class="badge badge-pill badge-success notification">7</span>
                </a>
                <a href="#">
                  <i class="fa fa-cog"></i>
                  <span class="badge-sonar"></span>
                </a>
                <a href="#">
                  <i class="fa fa-power-off"></i>
                </a>
              </div> -->
            </nav>
            <main id='ajaxcontent' class="page-content" style="background-color: #f3f3f3; padding-top: 0px;">
                    <div id='hlavninadpis' class="container-fluid" style='background-color: white;'>
                     <h2>Administrační panel</h2>
                    </div>
                   
                    <section id='contentstranky' style='background-color: #f3f3f3; margin-left: 20px; margin-right: 20px; margin-top: 20px;'>

</section>
                  </main>
                

<!--zmena produktu-->
    </div>
    



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {
 
  
  $('.sidebar-submenu ul li a').click(function(){
    var page = $(this).attr('href');
    $('.sidebar-submenu ul li a').css('color', '#818896');
    $(this).css('color', 'white');
    $('#ajaxcontent').load(page +'.php');
return false;
  });

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});
$('#default').trigger('click');
$('#default2').trigger('click');

  if ($(window).width() < 960) {
    $('#hlavninadpis').css('padding', '20px 20px 20px 70px');
   // $('#contentstranky').css('margin-left', '20px');
   
  $(".page-wrapper").removeClass("toggled");
}
else {
  $('#hlavninadpis').css('padding', '20px 0px');
  //$('#contentstranky').css('margin-left', '0px');
  $('#hlavninadpis').css('padding-left', '20px');
  $(".page-wrapper").addClass("toggled");
}


$("#close-sidebar").click(function() {
    $('#hlavninadpis').css('padding', '20px 20px 20px 70px');
   
  //  $('#contentstranky').css('margin-left', '20px');
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
    $('#hlavninadpis').css('padding', '20px 0px');
    $('#hlavninadpis').css('padding-left', '20px');
  //  $('#contentstranky').css('margin-left', '0px');
  $(".page-wrapper").addClass("toggled");
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
