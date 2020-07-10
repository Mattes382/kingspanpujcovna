<?php
session_start();
             require_once('connect.php');
             if(isset($_SESSION['prihlaseni']) && $_SESSION['prava'] == 1){
             $con = Pripojit();


                $statement = "INSERT INTO `produkty`(`typproduktu_idtypproduktu`, `typpanelu_idtyppanelu`, `typtloustky_idtyptloustky`) VALUES (?,?,?)";
                $query = $con->prepare($statement);
                $query->bind_param("iii", $_POST['typproduktu'], $_POST['typpanelu'], $_POST['typtloustky']);
                if($query->execute()){
                 
                }
                $query->close();
            
            }
       ?>