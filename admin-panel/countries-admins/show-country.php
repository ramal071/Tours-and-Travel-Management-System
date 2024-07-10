<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

if(!isset($_SESSION["adminname"])){
  header("location: ".ADMINURL."");
}

$towns = $conn->query("SELECT * FROM towns");
$towns->execute();
$allTowns = $towns->fetchAll(PDO::FETCH_OBJ);
?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Countries</h5>
             <a  href="<?php echo ADMINURL; ?>/countries-admins/create-country.php" class="btn btn-primary mb-4 text-center float-right">Create Country</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">province</th>
                    <th scope="col">population</th>
                    <th scope="col">territory</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allTowns as $town) : ?>
                  <tr>
                    <th scope="row"><?php echo $town->id; ?></th>
                    <td><?php echo $town->id; ?></td>
                    <td><?php echo $town->name; ?></td>
                    <td><?php echo $town->province; ?></td>
                    <td><?php echo $town->population; ?></td>
                    <td><?php echo $town->territory; ?></td>
                    <td><a href="delete-country.php?id=<?php echo $town->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>