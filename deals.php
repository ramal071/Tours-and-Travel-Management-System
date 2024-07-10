<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php

$cities = $conn->query("SELECT * FROM cities ORDER BY price ASC LIMIT 4");
$cities->execute();
$allCities = $cities->fetchAll(PDO::FETCH_OBJ);

// grapping countries

$towns = $conn->query("SELECT * FROM towns");
$towns->execute();

$allTowns = $towns->fetchAll(PDO::FETCH_OBJ);

?>

  <div class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h4>Discover Our Weekly Offers</h4>
          <h2>Amazing Prices &amp; More</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="search-form">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <form id="search-form" method="POST" role="search" action="search.php">
            <div class="row">
              <div class="col-lg-2">
                <h4>Sort Deals By:</h4>
              </div>
              <div class="col-lg-4">
                  <fieldset>
                      <select name="town_id" class="form-select" aria-label="Default select example" id="chooseLocation" onChange="this.form.click()">
                          <option selected>Destinations</option>
                          <?php foreach($allTowns as $town) : ?>
                           <option value="<?php echo $town->id; ?>"><?php echo $town->name; ?></option>
                          <?php endforeach; ?>
                      </select>
                  </fieldset>
              </div>
              <div class="col-lg-4">
                  <fieldset>
                      <select name="price" class="form-select" aria-label="Default select example" id="choosePrice" onChange="this.form.click()">
                          <option selected>Price Range</option>
                          <option value="1000">Less than Rs.1000</option>
                          <option value="2500">Less than Rs.2500</option>
                          <option value="5000">Less than Rs.5000</option>
                          <option value="10000">Less than Rs.10,000</option>
                          <option value="25000">Less than Rs.25,000</option>
                      </select>
                  </fieldset>
              </div>
              <!-- <div class="col-lg-4">
                  <fieldset>
                      <select name="price" class="form-select" aria-label="Default select example" id="choosePrice" onChange="this.form.click()">
                          <option selected>Price Range</option>
                          <option value="1000">Less than 1000</option>
                          <option value="2500">Less than 2500</option>
                          <option value="5000">Less than 5000</option>
                          <option value="10000">Less than 10000</option>
                          <option value="25000">Less than 25000</option>
                      </select>
                  </fieldset>
              </div> -->
              <div class="col-lg-2">                        
                  <fieldset>
                      <button type="submit" name="submit" class="border-button">Search Results</button>
                  </fieldset>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="amazing-deals">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading text-center">
            <h2>Best Weekly Offers In Each City</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
          </div>
        </div>
        
        <?php foreach($allCities as $city) : ?>
        <div class="col-lg-6 col-sm-6">
          <div class="item">
            <div class="row">
              <div class="col-lg-6">
                <div class="image">
                  <img src="assets/images/<?php echo $city->image; ?>" alt="">
                </div>
              </div>
              <div class="col-lg-6 align-self-center">
                <div class="content">
                  <span class="info">*Limited Offer Today</span>
                  <h4><?php echo $city->name; ?></h4>
                  <div class="row">
                    <div class="col-6">
                      <i class="fa fa-clock"></i>
                      <span class="list"><?php echo $city->trip_days; ?> Days</span>
                    </div>
                    <div class="col-6">
                      <i class="fa fa-map"></i>
                      <span class="list">Daily Places</span>
                    </div>
                  </div>
                  <p>Limited Price: Rs.<?php echo $city->price; ?> Per Person</p>
                  <?php if(isset($_SESSION['username'])) :?>
                  <div class="main-button">
                    <a href="reservation.php?id=<?php echo $city->id; ?>">Make a Reservation</a>
                  </div>
                  <?php else : ?>
                    <p>Log in plase for reserve !</p>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
       
      </div>
    </div>
  </div>


<?php require "includes/footer.php"; ?>