<?php
try {
//host
define("HOST","localhost");

//db
define("DBNAME","ceylon_travel");

//username
define("USER", "root");

//pass
define("PASS","");

$conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// if($conn == true) {
//     echo "ok";
// } else {
//     echo "error";
// }
}
catch( PDOException $Exception ) {
    echo $Exception->getMessage();    
}
?>