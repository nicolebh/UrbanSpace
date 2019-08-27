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
                <h1 class="display-4 p-5">Report an issue</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <img src="include/Gammy_space.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-sm">
                <h3 class="pb-2">Space name</h3>
                <h6><?php $mydate=getdate(date("U")); echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]"; ?></h6>
                <form>
                    <div class="form-group">
                    <label for="issue_desc">Issue Description</label>
                        <textarea class="form-control" id="issue_desc" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="issue_image">Image</label>
                        <input type="file" class="form-control" id="issue_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Report</button>
                </form>
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
