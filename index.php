<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php
$towns = $conn->query("SELECT towns.id AS id, 
towns.name AS name, towns.image AS image, 
towns.population AS population, towns.territory AS territory, 
towns.province AS province, 
towns.description AS description, 
AVG(cities.price) AS avg_price FROM towns JOIN cities 
ON towns.id = cities.town_id GROUP BY(cities.town_id);");
$towns->execute();

$allTowns = $towns->fetchAll(PDO::FETCH_OBJ);
?>

  <!-- ***** Main Banner Area Start ***** -->
  <section id="section-1">
    <div class="content-slider">
      <?php foreach($allTowns as $towns) : ?>
        <input type="radio" id="banner<?php echo $towns->id; ?>" class="sec-1-input" name="banner" checked>
      <?php endforeach; ?>
      <div class="slider">

      <?php foreach($allTowns as $towns) : ?>
        <div id="top-banner-<?php echo $towns->id; ?>" class="banner">
          <div class="banner-inner-wrapper header-text">
            <div class="main-caption">
              <h2>Take a Glimpse Into The Beautiful Country Of:</h2>
              <h1><?php echo $towns->name; ?> </h1>
              <div class="border-button"><a href="about.php?id=<?php echo $towns->id; ?>">Go There</a></div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="more-info">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-user"></i>
                        <h4><span>Population:</span><br><?php echo $towns->population; ?> M</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-globe"></i>
                        <h4><span>Territory:</span><br><?php echo $towns->territory; ?> KM<em>2</em></h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-home"></i>
                        <h4><span>AVG Price:</span><br>Rs.<?php echo $towns->avg_price; ?></h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <div class="main-button">
                          <a href="about.php?id=<?php echo $towns->id; ?>">Explore More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      </div>
      <nav>
        <div class="controls">
          <?php foreach($allTowns as $towns) : ?>
            <label for="banner<?php echo $towns->id; ?>"><span class="progressbar"><span class="progressbar-fill"></span></span><span class="text"><?php echo $towns->id; ?></span></label>
          <?php endforeach; ?>
        </div>
      </nav>
    </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
  
  <div class="visit-country">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <h2>Visit One Of Our Countries Now</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="items">
            <div class="row">
     
              <?php foreach($allTowns as $towns) : ?>
              <div class="col-lg-12">
                <div class="item">
                  <div class="row">
                    <div class="col-lg-4 col-sm-5">
                      <div class="image">
                        <img src="assets/images/<?php echo $towns->image; ?>" alt="">
                      </div>
                    </div>
                    <div class="col-lg-8 col-sm-7">
                      <div class="right-content">
                        <h4><?php echo $towns->name; ?></h4>
                        <span><?php echo $towns->province; ?></span>
                        <div class="main-button">
                          <a href="about.php?id=<?php echo $towns->id; ?>">Explore More</a>
                        </div>
                        <p>
                        <?php echo $towns->description; ?>
                        </p>
                        <ul class="info">
                          <li><i class="fa fa-user"></i> <?php echo $towns->population; ?> Mil People</li>
                          <li><i class="fa fa-globe"></i> <?php echo $towns->territory; ?> km2</li>
                          <li><i class="fa fa-home"></i> Rs.<?php echo $towns->avg_price; ?></li>
                        </ul>
                        <div class="text-button">
                          <a href="about.php?id=<?php echo $towns->id; ?>">Need Directions ? <i class="fa fa-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>

              
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="side-bar-map">
            <div class="row">
              <div class="col-lg-12">
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth" width="100%" height="550px" frameborder="0" style="border:0; border-radius: 23px; " allowfullscreen=""></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require "includes/footer.php"; ?>