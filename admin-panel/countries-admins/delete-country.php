<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

if(!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $image_delete = $conn->query("SELECT * FROM towns WHERE id='$id'");
    $image_delete->execute();
    $getImage = $image_delete->fetch(PDO::FETCH_OBJ);

    unlink("images-countries/" . $getImage->image);

    // delete
    $deleteRecord = $conn->query("DELETE FROM towns WHERE id='$id'");
    $deleteRecord->execute();

    header("location: show-country.php");
}
?>
