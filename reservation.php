<?php 
require "includes/header.php"; 
require "config/config.php"; 

if(!isset($_SESSION["username"])) {
  header("location: ".APPURL."");
}

if(isset($_GET['id'])) {

  $id = $_GET['id'];

  $city = $conn->prepare("SELECT * FROM cities WHERE id=:id");
  $city->execute([':id' => $id]);

  $getCity = $city->fetch(PDO::FETCH_OBJ);

  if(isset($_POST['submit'])) {
    if(empty($_POST['name']) OR empty($_POST['phone_number']) OR empty($_POST['number_of_guests']) 
      OR empty($_POST['checkin_date'])) {
        echo "<script>alert('Some inputs are empty');</script>";
    } else {

      $name = $_POST['name'];
      $phone_number = $_POST['phone_number']; // Changed to varchar in database
      $number_of_guests = $_POST['number_of_guests'];
      $checkin_date = $_POST['checkin_date'];
      $destination = $_POST['destination']; // This should be a hidden field if needed

      // Check if user_id is set in session
      $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
      if (!$user_id) {
        echo "<script>alert('User session not found');</script>";
        exit();
      }

      $status = "Pending";
      $city_id = $id;

      $payment = $number_of_guests * $getCity->price;

      if(date("Y-m-d") < $checkin_date) {
        $insert = $conn->prepare("INSERT INTO bookings (name, phone_number, number_of_guests,
        checkin_date, destination, status, city_id, user_id, payment, created_at)
        VALUES (:name, :phone_number, :number_of_guests, :checkin_date, :destination, :status,
        :city_id, :user_id, :payment, NOW())");

        $insert->execute([
          ":name" => $name,
          ":phone_number" => $phone_number,
          ":number_of_guests" => $number_of_guests,
          ":checkin_date" => $checkin_date,
          ":destination" => $destination,
          ":status" => $status,
          ":city_id" => $city_id,
          ":user_id" => $user_id,
          ":payment" => $payment,
        ]);

        header("location: pay.php");

        $_SESSION['payment']=$payment;

        echo "<script>alert('Reservation made successfully');</script>";
      }else {
          echo "<script>alert('invalid date, pick starting from tomorrow');</script>";

      }
    }
  }

} else {
  header("location: 404.php");
}
?>

<div class="second-page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h4>Book Prefered Deal Here</h4>
          <h2>Make Your Reservation</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt uttersi labore et dolore magna aliqua is ipsum suspendisse ultrices gravida</p>
        </div>
      </div>
    </div>
  </div>

  <div class="more-info reservation-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-phone"></i>
            <h4>Make a Phone Call</h4>
            <a href="#">+123 456 789 (0)</a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-envelope"></i>
            <h4>Contact Us via Email</h4>
            <a href="#">company@email.com</a>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="info-item">
            <i class="fa fa-map-marker"></i>
            <h4>Visit Our Offices</h4>
            <a href="#">24th Street North Avenue London, UK</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Your HTML form code -->
<div class="reservation-form">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <form id="reservation-form"  method="POST" role="search" action="reservation.php?id=<?php echo $id; ?>">
          <div class="row">
            <div class="col-lg-12">
              <h4>Make Your <em>Reservation</em> Through This <em>Form</em></h4>
            </div>
            <div class="col-lg-6">
              <fieldset>
                <label for="Name" class="form-label">Your Name</label>
                <input type="text" name="name" class="Name" placeholder="Ex. John Smithee" autocomplete="on">
              </fieldset>
            </div>
            <div class="col-lg-6">
              <fieldset>
                <label for="Number" class="form-label">Your Phone Number</label>
                <input type="text" name="phone_number" class="Number" placeholder="Ex. +xxx xxx xxx" autocomplete="on">
              </fieldset>
            </div>
            <div class="col-lg-6">
              <fieldset>
                <label for="chooseGuests" class="form-label">Number Of Guests</label>
                <select name="number_of_guests" class="form-select" aria-label="Default select example" id="chooseGuests">
                  <option selected disabled>Select number of guests</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4+">4+</option>
                </select>
              </fieldset>
            </div>
            <div class="col-lg-6">
              <fieldset>
                <label for="Number" class="form-label">Check In Date</label>
                <input type="date" name="checkin_date" class="date">
              </fieldset>
            </div>
            <!-- Hidden field to store destination -->
            <input type="hidden" name="destination" value="<?php echo $getCity->name; ?>">

            <div class="col-lg-12">
              <fieldset>
                <button name="submit" type="submit" class="main-button">Make Your Reservation Now</button>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require "includes/footer.php"; ?>
