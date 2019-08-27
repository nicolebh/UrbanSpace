<!-- <nav class="navbar navbar-expand-lg navbar-light space-navbar" style="background-color:white;">
            <a class="navbar-brand" href="#">
                <img src="http://nimrodba.mtacloud.co.il/include/logo.png" width="110px" height="70px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="http://nimrodba.mtacloud.co.il">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="search.php">Book a space</a>
                    <a class="nav-item nav-link" href="#feature-section">Features</a>
                    <a class="nav-item nav-link btn btn-outline-info" href="components/Panel/login.html">Login</a>
                </div>
            </div>
</nav> -->
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#"><img src="http://nimrodba.mtacloud.co.il/include/logo.png" width="110px" height="70px"></a>
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
      <li class="nav-item">
        <u><a class="nav-item nav-link" href="search.php">Book a space</a></u>
      </li>
    </ul>
    <span class="navbar-text">
        <a class="nav-item nav-link btn btn-outline-info" href="components/Panel/login.html">Login / Sign up</a>
        <div class="btn-group">
          <button type="button" class="btn btn-info btn-md dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administration
          </button>
          <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Add-Space-Modal">Add Space</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Remove-Space-Modal">Remove/Shut Space</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Reported-issues-Modal">Reported issues</a>
          </div>
        </div>
    </span>
  </div>
</nav>

<!-- Add Space Modal -->
<div class="modal fade" id="Add-Space-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new space</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="space_name">Name</label>
            <input type="text" class="form-control" id="space_name" placeholder="Enter a title for the space">
          </div>
          <div class="form-group">
            <label for="space_address">Address</label>
            <input type="text" class="form-control" id="space_address" placeholder="Example: Negba St 7">
          </div>
          <div class="form-group">
            <label for="space_city">City</label>
            <input type="text" class="form-control" id="space_city" placeholder="Example: Tel-Aviv">
          </div>
          <div class="form-group">
            <label for="space_sport_type">Type of sport</label>
            <input type="text" class="form-control" id="space_sport_type" placeholder="Example: Football">
          </div>
          <div class="form-group">
            <label for="space_num_players">Amount of players</label>
            <input type="number" class="form-control" id="space_num_players" placeholder="Example: Football">
          </div>
          <div class="form-group">
            <label for="space_features">Features (select many)</label>
            <select multiple class="form-control" id="space_features">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="space_image">Image</label>
            <input type="file" class="form-control" id="space_image">
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
        <ul class="list-unstyled">
          <li class="media">
            <img src="..." class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0 mb-1">List-based media object</h5>
              Street
              <br>
              <a class="btn btn-danger btn-sm" href="#" role="button">Remove Space</a>
              <a class="btn btn-warning btn-sm" href="#" role="button">Shut Space</a>
            </div>
          </li>
          <hr>
          <li class="media">
            <img src="..." class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0 mb-1">List-based media object</h5>
              street
              <br>
              <a class="btn btn-danger btn-sm" href="#" role="button">Remove Space</a>
              <a class="btn btn-warning btn-sm" href="#" role="button">Shut Space</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
        <ul class="list-unstyled">
          <li class="media">
            <img src="..." class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0 mb-1">Issue Num: #1</h5>
              <h5 class="mt-0 mb-1">Date:</h5>
              <p>Issue Description</p>
              <br>
              <a class="btn btn-success btn-sm" href="#" role="button">Resolve Issue</a>
              <a class="btn btn-warning btn-sm" href="#" role="button">Shut Space</a>
            </div>
          </li>
          <hr>
          <li class="media">
            <img src="..." class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0 mb-1">Issue Num: #1</h5>
              <h5 class="mt-0 mb-1">Date:</h5>
              <p>Issue Description</p>
              <br>
              <a class="btn btn-success btn-sm" href="#" role="button">Resolve Issue</a>
              <a class="btn btn-warning btn-sm" href="#" role="button">Shut Space</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>