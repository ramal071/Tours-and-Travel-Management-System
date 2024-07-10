<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php

// after user login, user cannot view register page
if(!isset($_SESSION["adminname"])) {
  header("location: ".APPURL."");
}

if(isset($_POST['submit'])) {
  if(empty($_POST['name']) OR empty($_POST['trip_days']) OR
    empty($_POST['price']) OR empty($_POST['town_id']) 
    ){
    echo"<script>alert('empty_input');</script>";
  } else {
    $name = $_POST['name'];
    $trip_days = $_POST['trip_days'];
    $price = $_POST['price'];
    $town_id = $_POST['town_id'];
    $image = $_FILES['image']['name'];

    $dir = "images_cities/" . basename($image);

    $insert = $conn->prepare("INSERT INTO cities (name, trip_days, price,
    town_id, image)
    VALUES (:name, :trip_days, :price,:town_id, :image)");

    $insert->execute([
      ":name" => $name,
      ":trip_days" => $trip_days,
      ":price" => $price,
      ":town_id" => $town_id,
      ":image" => $image,
    ]);

    if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)){
      header("location: show-cities.php");
    }
  }
} 

$towns = $conn->query("SELECT * FROM towns");
$towns->execute();
$allTowns = $towns->fetchAll(PDO::FETCH_OBJ);

?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Cities</h5>
          <form method="POST" action="create-cities.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control"  />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="trip_days" id="form2Example1" class="form-control" placeholder="trip_days" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">

                  <select name="town_id" class="form-select  form-control" aria-label="Default select example">
                    <option selected>Choose Country</option>
                    <?php foreach($allTowns as $town) : ?>
                     <option value="<?php echo $town->id; ?>"><?php echo $town->name; ?></option>
                    <?php endforeach; ?>              
                  </select>
                </div>

                <br>
              

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>