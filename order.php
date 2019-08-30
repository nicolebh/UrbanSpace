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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                <img src="include/Gammy_space.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3>Space name</h3>
                <h6>Street</h6>
                <h6>Type</h6>
                <h6>Num of players</h6>
                <br>
                <h3>Book from</h3>
                <input id="datepicker_start" width="270" />
                <h3 class="pt-4">To</h3>
                <input id="datepicker_end" width="270" />
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

    <script>
        $('#datepicker_start').datetimepicker({ footer: true, modal: true });
        $('#datepicker_end').datetimepicker({ footer: true, modal: true });
    </script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-firestore.js"></script>
    <script src="components/Firebase/auth.js"></script>
    <script>
        CheckIfLoggedIn();
    </script>
</body>
</html>
