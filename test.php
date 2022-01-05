<?php
$url ="http://192.168.239.2:8080/cricketfarm/teampadd.php".$_GET["file"]."?";
foreach ($_GET as $key => $value) {
          $url = $url.$key."=".$val."&";
        }
        echo $url;
header("location:$url");
 ?>
