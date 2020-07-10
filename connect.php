<?php
function Pripojit() {
   // $con = new mysqli("db.mp.spse-net.cz", "pospisma", "bupybocorufe", "pospisma_1");
$con = new mysqli("localhost", "root", "", "f122341");
$con->set_charset("utf8");

    return $con;
}



