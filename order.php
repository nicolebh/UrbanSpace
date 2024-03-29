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
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <img src="<?php echo $image; ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3>Space: <?php echo $name; ?></h3>
                <h6><?php echo $street . ", " . $city; ?></h6>
                <h6><?php echo $type; ?></h6>
                <h6>Players: <?php echo $num_of_players; ?></h6>
                <br>
                <h3>* Book from</h3>
                <input type="date" onchange="getAvailableHours()" id="book_date" class="form-control py-1 pl-2 w-100" min="<?php echo date("Y-m-d"); ?>">
                <h3 class="mt-2">* Duration</h3>
                <select class="form-control" id="duration" onchange="getAvailableHours()">
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                </select>
                <h3 class="mt-2">* Choose Hours</h3>
                <div class="card h-auto" id="card_hours_list">
                    <div class="card-body" id="hours_list">
                        <div class="spinner-border text-success" id="loading_spin" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div id="hours_btns">
                        </div>
                        <div id="startTime_input" style="display:none"></div>
                        <div id="duration_input" style="display:none"></div>
                        <input type="hidden" id="username" value="<?php echo $_GET['username']; ?>" />
                        <input type="hidden" id="spaceID" value="<?php echo $_GET['spaceID']; ?>" />
                    </div>
                </div>
                <h3 class="pt-4">Payment</h3>
                <h6>* Choose all fields first</h6>
                <div id="paypal-button"></div>
                <div class="loading" id="page_loading" style="display:none">Loading&#8230;</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-firestore.js"></script>
    <script src="components/Firebase/auth.js"></script>
    <script>
        CheckIfLoggedIn();
    </script>
    <script src="js/space_order.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AbeFjnilEsMjJWUBQKKLZYno-HGrlbpYNTgfQ0_tf2FpbrEg7ahZZr6geT2ZtOqsayDWUYyHSV17D-G2'
    },
    presentation: {
    logo_image: "/urbanspace/include/logo.png"
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'large',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '20',
            currency: 'ILS'
          },
          description: 'Payment for booking a space'
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
            document.querySelector('#page_loading').style.display = "block";
            var space_id = document.querySelector('#spaceID').value;
            var username = document.querySelector('#username').value;
            var date = document.querySelector('#book_date').value;
            var start_time = document.querySelector('#startTime_input').innerHTML;
            var duration = document.querySelector('#duration_input').innerHTML;
            var finish_time = Number(start_time) + Number(duration);
            var d = new Date();
            var created_time = d.getHours() + ":" + d.getMinutes() + ":" + d.getUTCSeconds() + " " + d.getFullYear() + "-" + (Number(d.getMonth())+1) + "-" + d.getUTCDate();
            
            $.ajax({
                type: "POST",
                url: "/urbanspace/php_classes/space_order.php",		
                data: {
                    action: 'insert_new_order',
                    space_id:space_id,
                    username: username,
                    date: date,
                    start_time: start_time,
                    duration: duration,
                    finish_time: finish_time,
                    created_time: created_time
                },
                success: function(data){
                    location.replace("/urbanspace/finish_order.php?order_id="+data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error in ajax request <js/space_order.js>");
                    console.log(errorThrown);
                }
            });
      });
    }
  }, '#paypal-button');
    </script>
</body>
</html>
