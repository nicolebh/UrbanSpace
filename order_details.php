<!DOCTYPE html>
<html>
<head>
  <title>
    Order Details
  </title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/order_details_style.css">
</head>
<body>
<?php include('header.php');?>
<div class="row">
  <div class="col-100">
    <h2>Order Details</h2>
    <div class="container">
      <form action="/php_classes/insert_new_order.php" method="POST">
        <div class="row">
          <div class="col-50">
            <h3>User Details</h3>
            <label for="fname"><i class="fa fa-user"></i>First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John">
            <label for="fname"><i class="fa fa-user"></i>Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="M. Doe">
            <label for="phone"><i class="fa fa-phone"></i>Phone</label>
            <input type="tel" id="phone" name="phone" placeholder="052-333-44-55">
            <label for="email"><i class="fa fa-envelope"></i>Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="date"><i class="fa fa-date"></i>Date</label>
            <input type="date" id="sdate" name="date">
            <div class="row">
              <div class="col-50">
                <label for="start"></i>Start Time</label>
                <input type="time" id="stime" name="stime">
              </div>
              <div class="col-50">
                <label for="finish"></i>Finish Time</label>
                <input type="time" id="ftime" name="ftime">
              </div>
            </div>
                

            <!-- To get the space id in insert_new_order.php -->
            <input type="hidden" id="hidden_id" name="space_id" value="<?php echo $_GET['spaceID'];?>"/>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-diners-club" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <input type="submit" value="Submit" class="btn">
      </form>
    </div>
  </div>
</div>
<footer class="page-footer font-small mdb-color darken-3 pt-4">
        <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
          <a href="/index.php"> UrbanSpaces.com</a>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
