<?php session_start(); ?>
<!DOCTYPE html>
<html lang="cs-CZ">
        <link href="fonts/KingspanFont/stylesheet.css" rel="stylesheet">
     
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Login | Kingspan Půjčovna</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Links -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/camera.css" rel="stylesheet">
    

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
@media only screen and (min-width : 991px) {
    #marginzde {
        margin-top: 100px;
    }
}
</style>
</head>

<body style="color: white; background-color: white; font-weight: 100;">
<?php
define('SITE_KEY', '6LdhLrgUAAAAAO4Kq0DGQDDfUD6aCE27Z_ZXRrJO');
define('SECRET_KEY', '6LdhLrgUAAAAAMyyo-ZT5QdItF1CbcLbUlb9w7Li');


      require_once('connect.php');
      $outputprihlaseni = "";
      $con = Pripojit();
      

               if(isset($_POST['login'])){
                function getCaptcha($SecretKey){
                    $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
                    $Return = json_decode($Response);
                    return $Return;
                }
                $Return = getCaptcha($_POST['g-recaptcha-response']);
                //var_dump($Return);
                if($Return->success == true && $Return->score > 0.5){
                    if($_POST['email']==""){$outputprihlaseni = "Nebyl zadán E-mail.";}
             
                    else if($_POST['heslo']==""){$outputprihlaseni = "Nebylo zadáno heslo.";}
                    else {
                        
                        $query = $con->prepare("SELECT idzakaznici, Email, heslo, Jmeno, prava_idprava FROM zakaznici");
                        $query->bind_result($id, $email, $heslo, $jmeno, $admin);
                        $query->execute();
                        
                        
                        while ($query->fetch()){
                            
                        if(($_POST['email'] == $email) && password_verify($_POST['heslo'], $heslo) == true){
                           
                            $_SESSION['prihlaseni'] = true;
                            $_SESSION['uzivatel'] = $jmeno;
                            $_SESSION['iduzivatele'] = $id;
                            $_SESSION['prava'] = $admin;
                            header("Location: rezervace.php");
                            break;
                        } else {
                            $outputprihlaseni = "Údaje nebyli zadány správně";
                        }
                        
                        }
                        $query->close();
                    }
                }else{
                    $outputprihlaseni = "reCAPTCHA Váš pokus o přihlášení detekovala jako 'nelidský'";
                }

               }
            
        ?>
<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->
    <header>




        <div id="stuck_container" class="stuck_container">
            <nav class="navbar navbar-default navbar-static-top ">
                <div class="container">
                    <div class="navbar-header">
                        <h1 class="navbar-brand">
<img src="images/logo.png" alt="logo" style="max-height: 60px;">
                        </h1>
                    </div>
                    <!--
                    <ul class="navbar-nav sf-menu" data-type="navbar">
                        <li class="active">
                            <a href="./">Úvod</a>
                        </li>
                        <li>
                            <a href="o-nas.html" style="font-family: Kingspan Brown TT">O nás</a>
                        </li>
                        <li>
                            <a href="zakladni-typy-domu.html">Základní typy domů</a>
                        </li>
                                                                                                <li>
                            <a href="cenik.html">Ceník</a>
                        </li>
                        <li>
                            <a href="postup-stavby.html">Postup stavby</a>
                        </li>

                        <li>
                            <a href="kontakty.html">Kontakty</a>
                        </li>
                    </ul>
                    -->

                </div>
            </nav>
        </div>
    </header>


    <!--========================================================
                              CONTENT
    =========================================================-->


    <main>


        <section id='marginzde' class="well2">
                <div class="container">
                        <div class="row vertical-offset-100">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h3 class="panel-title" style="font-family: Kingspan Brown TT; font-weight: 100; color: #20519D; padding-top: 5px;font-size: 20px;">Přihlášení</h3>
                                     </div>
                                      <div class="panel-body">
                                        <form accept-charset="UTF-8" role="form" method='post'>
                                        <fieldset>
                                              <div class="form-group">
                                                <input class="form-control" placeholder="E-mail" name="email" type="text">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Heslo" name="heslo" type="password" value="">
                                            </div>
                                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                                            <div class="checkboxwow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s" style="text-align: center; margin-bottom: 15px;">
                                                    <a style="color: red;"><?php echo $outputprihlaseni; ?></a>
                                                </div>
                                            <input class="btn btn-lg btn-success btn-block" style="font-weight: 100; margin-top: 0px;" name='login' type="submit" value="Přihlásit">
                                        </fieldset>
                                          </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>


        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY;?>"></script>
  <script>
  grecaptcha.ready(function() {
      grecaptcha.execute('<?php echo SITE_KEY;?>', {action: 'homepage'}).then(function(token) {
        document.getElementById('g-recaptcha-response').value=token;
      });
  });
  </script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/tm-scripts.js"></script>
<!-- </script> -->


</body>
</html>
