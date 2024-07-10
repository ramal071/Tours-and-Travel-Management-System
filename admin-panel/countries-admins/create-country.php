<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>


<?php

// after user login, user cannot view register page
if(!isset($_SESSION["adminname"])) {
  header("location: ".APPURL."");
}

if(isset($_POST['submit'])) {
  if(empty($_POST['name']) OR 
    empty($_POST['province']) OR empty($_POST['population']) OR
    empty($_POST['territory']) OR empty($_POST['description']) 
    ){
    echo"<script>alert('empty_input');</script>";
  } else {
    $name = $_POST['name'];
    $province = $_POST['province'];
    $population = $_POST['population'];
    $territory = $_POST['territory'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    $dir = "images-countries/" . basename($image);

    $insert = $conn->prepare("INSERT INTO towns (name, province, population,
    territory, description, image)
    VALUES (:name, :province, :population,:territory, :description, :image)");

    $insert->execute([
      ":name" => $name,
      ":province" => $province,
      ":population" => $population,
      ":territory" => $territory,
      ":description" => $description,
      ":image" => $image,
    ]);

    if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)){
      header("location: show-country.php");
    }
  }
}
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Town</h5>
          <form method="POST" action="create-country.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" />
                 
                </div>  
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="province" id="form2Example1" class="form-control" placeholder="province" />
                 
                </div> 
                 <div class="form-outline mb-4 mt-4">
                  <input type="text" name="population" id="form2Example1" class="form-control" placeholder="population" />
                 
                </div>  <div class="form-outline mb-4 mt-4">
                  <input type="text" name="territory" id="form2Example1" class="form-control" placeholder="territory" />
                 
                </div> 
                <div class="form-floating">
                  <textarea name="description" class="form-control" placeholder="description" id="floatingTextarea2" style="height: 100px"></textarea>
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