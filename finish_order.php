<?php
if(isset($_GET["order_id"])){
    require_once('php_classes/config.php');
    $order_id = mysqli_real_escape_string($db, $_GET["order_id"]);
    $query = "
    SELECT orders.`order_id`,orders.`username`,orders.`space_id`,orders.`date`,orders.`start_time`,orders.`duration`, orders.`finish_time`,orders.`created_time`,spaces.`name`, spaces.`image`
    FROM orders
    INNER JOIN spaces ON orders.`space_id`=spaces.`id`
    WHERE orders.order_id=$order_id
    ";
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    if(!$row) {
        header("location: index.php");
    }
    $space_name = $row['name'];
    $start_date = $row['date'] . " " . $row['start_time'] . ":00";
    $duration = $row['duration'];
    $image = $row['image'];
}
else{
    header("location: index.php");
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <title>
        Urban Space - Order Summary
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta property="og:url"           content="http://nimrodba.mtacloud.co.il/urbanspace/finish_order.php?order_id=<?php echo $order_id;?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Urban Space" />
    <meta property="og:description"   content="Ultimate Sports Experience For All." />
    <meta property="og:image"         content="http://nimrodba.mtacloud.co.il/urbanspace/include/logo.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>
    <?php
      include('header.php');
    ?>
    <main>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h1 class="display-4 p-5">We hope you will enjoy :)</h1>
                <h3 class="pb-5">Your booking has <span class="text-success">confirmed</span></h3>
                <hr>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm">
                <img src="<?php echo $image; ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3 class="pb-2">The space "<?php echo $space_name; ?>" is booked</h3>
                <h4>From: <?php echo $start_date; ?><h4>
                <h4>For: <?php echo $duration; ?> hour<h4>
                <hr>
                <h4 class="py-3">Share your space</h4>
                <div class="fb-share-button" data-href="http://nimrodba.mtacloud.co.il/urbanspace/finish_order.php?order_id=<?php echo $order_id;?>" data-size="large" data-layout="button"></div><br>
                <a href="whatsapp://send" data-text="We are playing today!!" data-href=""><button type="button" class="btn btn-whatsapp btn-sm"><i class="fa fa-facebook fa-2"></i>What'sApp</button></a>
            </div>
        </div>
    </div>
    </main>
    <footer class="page-footer font-small mdb-color darken-3 pt-4">
        <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
          <a href="index.php"> UrbanSpaces.com</a>
        </div>
    </footer>
</body>
</html>
