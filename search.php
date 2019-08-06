<!DOCTYPE html> 
<html lang="en">
<head>
    <title>
        Urban Space
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/space_search.js"></script>
</head>
<body>
    <?php
      include('header.php');
    ?>
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Filter Spaces</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    City
                  </a>
                  <div class="dropdown-menu" id="cityDropdown" aria-labelledby="navbarDropdown">
                      <!-- Cities will be put here from DB -->
                  </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sport Type
                    </a>
                    <div class="dropdown-menu" id="sportTypeDropDown" aria-labelledby="navbarDropdown">
                      <!-- Sport Type will be put here from DB -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Participants
                    </a>
                    <div class="dropdown-menu" id="participantsDropDown" aria-labelledby="navbarDropdown">
                      <!-- Participants will be put here from DB -->
                    </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" onClick="displayNewSpaces()">New In</a>
                  <!-- Will display 3 last added spaces from DB -->
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" onClick="displayAllSpaces()">Clear</a>
                </li>
              </ul>
            </div>
        </nav>
        <div id="search-results">
            <!-- Here will be plent the fields we recieved from our DB -->
        </div>
    </main>
    <footer class="page-footer font-small mdb-color darken-3 pt-4">
        <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
          <a href="index.html"> UrbanSpaces.com</a>
        </div>
    </footer>
</body>
</html>
