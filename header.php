<?php
session_start();

if(isset($_SESSION["fullname"])){
  $fullname = $_SESSION["fullname"];
  $mgmt_btn = '<button type="button" id="user-menu" class="btn btn-info btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hello, '. substr($fullname, 0, strrpos($fullname, ' ')).'&nbsp</button>';
  $login_btn = "";
}
else {
  $mgmt_btn = '';
  $login_btn = '<a class="nav-item nav-link btn btn-outline-info" style="float:left;" id="login-btn" href="components/Panel/login.html">Login / Sign up</a>';
}
?>
<nav class="navbar navbar-expand-lg navbar-light" id="header_menu">
  <a class="navbar-brand" href="#"><img src="/urbanspace/include/logo.png" width="110px" height="70px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <?php 
        if(isset($_SESSION["role"]) && $_SESSION["role"] == "user"){ ?>
              <li class="nav-item">
                <u><a class="nav-item nav-link" href="search.php">Book a space</a></u>
              </li>
        <?php 
            } else if(!isset($_SESSION["role"])) {?>
                <li class="nav-item">
                <u><a class="nav-item nav-link" href="search.php">Book a space</a></u>
              </li>
            <?php } ?>
    </ul>
    <span class="navbar-text" style="display: inline;">
        <?php echo $login_btn; ?>
        <div class="btn-group">
        <?php echo $mgmt_btn; ?>
          <div class="dropdown-menu dropdown-menu-right">
          <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == "supplier") { ?>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Add-Space-Modal">Add Space</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Remove-Space-Modal">Remove/Shut Space</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Reported-issues-Modal">Reported issues</a>
          <?php } ?>
          <a class="dropdown-item" href="#" id="logout">Log off</a>
          </div>
        </div>
    </span>
  </div>
</nav>

<!-- Add Space Modal -->
<div class="modal fade" id="Add-Space-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new space</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/urbanspace/php_classes/spaces_mgmt.php" id="addNewSpace-form" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="space_name">Name</label>
            <input type="text" class="form-control" name="space_name" id="space_name" placeholder="Enter a title for the space" required>
          </div>
          <div class="form-group">
            <label for="space_address">Address</label>
            <input type="text" class="form-control" name="space_address" id="space_address" placeholder="Example: Negba St 7" required>
          </div>
          <div class="form-group">
            <label for="space_city">City</label>
            <input type="text" class="form-control" name="space_city" id="space_city" placeholder="Example: Tel-Aviv" required>
          </div>
          <div class="form-group">
            <label for="space_sport_type">Type of sport</label>
            <input type="text" class="form-control" name="space_sport_type" id="space_sport_type" placeholder="Example: Football" required>
          </div>
          <div class="form-group">
            <label for="space_num_players">Amount of players</label>
            <input type="number" class="form-control" name="space_num_players" id="space_num_players" placeholder="Example: 5 players" required>
          </div>
          <div class="form-group" id="space_features_box">
            <!-- Generated from spaces_mgmt.php -->
          </div>
          <div class="form-group">
            <label for="space_image">Image</label>
            <input type="file" class="form-control" id="space_image" name="space_image" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Remove Space Modal -->
<div class="modal fade" id="Remove-Space-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove a space</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled" id="space_list">

        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Reported Issues Modal -->
<div class="modal fade" id="Reported-issues-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>Reported Issues</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled" id="issue_list">
          <!-- Content generated from spaces_mgmt.php -->
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.4.2/firebase-firestore.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#config-web-app -->

<script>
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyCjXXJ6cjN7EjvPIfiaUj6EC1KzpYQA-_I",
    authDomain: "urbanspace-c98eb.firebaseapp.com",
    databaseURL: "https://urbanspace-c98eb.firebaseio.com",
    projectId: "urbanspace-c98eb",
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const auth = firebase.auth();
const db = firebase.firestore();

// update firestore setting
db.settings({timestampsInSnapshots: true})
</script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
    <script src="components/Firebase/auth.js"></script>
    <script src="/urbanspace/js/spaces_mgmt.js"></script>