<?php
    error_reporting(E_WARNING);
    require_once('php_classes/config.php');
    session_start();
    
    $name = $image = $date_of_create = $street = $city = '';
    
    if(isset($_GET['spaceID']))
    {
        $spaceId = $_GET['spaceID'];
        $query = "SELECT * from spaces WHERE id=$spaceId LIMIT 1";
        $result = mysqli_query($db, $query);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $image = $row['image'];
        $street = $row['address'];
        $city = $row['city'];
        $type = $row['sport_type'];
        $num_of_players = $row['num_of_players'];
    }
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <title>
        Urban Space - Order
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>
    <?php
      include('header.php');
    ?>
    <main>
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h1 class="display-4 p-5">Your space is almost ready..</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <img src="<?php echo $image; ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3><?php echo $name; ?></h3>
                <h6><?php echo $street . ", " . $city; ?></h6>
                <h6><?php echo $type; ?></h6>
                <h6>Players: <?php echo $num_of_players; ?></h6>
                <br>
                <h3>Book from</h3>
                <input type="date" id="book_date" class="form-control py-1 pl-2 w-100" min="<?php echo date("Y-m-d"); ?>">
                <h3 class="pt-4">Hour</h3>
                <div class="card h-auto" id="card_hours_list">
                    <div class="card-body" id="hours_list">
                        <div class="spinner-border text-success" id="loading_spin" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <button type="button" class="btn btn-primary">08:00-10:00</button>
                        <button type="button" class="btn btn-primary">10:00-12:00</button>
                    </div>
                </div>
                <h3 class="pt-4 pb-3">Payment</h3>
                <img src="include/paypal.jpg" class="img-fluid" alt="Paypal">
            </div>
        </div>
    </div>
    </main>
    <footer class="page-footer font-small mdb-color darken-3 pt-4">
        <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
          <a href="index.php"> UrbanSpaces.com</a>
        </div>
    </footer>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-firestore.js"></script>
    <script src="components/Firebase/auth.js"></script>
    <script>
        CheckIfLoggedIn();
    </script>
    <script src="js/space_order.js"></script>
</body>
</html>
