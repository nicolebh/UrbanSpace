<?php
class Order {
    private $host  = 'localhost';
    private $user  = 'nimrodba_admin';
    private $password   = 'RIcr13!W?A';
    private $database  = 'nimrodba_urbanspace';
	private $main_table = 'orders';
    private $dbConnect = false;
    
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
			}
        }
    }

    public function sendOrder($fname, $lname, $phone, $email, $date, $stime, $ftime)
    {
        $sql_query = "insert into orders (f_name, l_name, phone, email, date, start_time, finish_time) values ('" . $fname . "', '" . $lname . "', '" . $phone . "', '" . $email . "', '" . $date . "', '" . $stime . "', '" . $ftime . "')";
        $this->dbConnect->query($sql_query);
        $id = $this->dbConnect->insert_id;
        return $id;
    }

    public function queryOrder($id)
    {
        $sql_query = "select f_name, l_name, phone, email, date, start_time, finish_time from orders where order_id = '" . $id . "'";
        $result = $this->dbConnect->query($sql_query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        else {
            $row = NULL;
        }
        
        return $row;

    }

    public function closeDBConnection()
    {
        $this->dbConnect->close();
    }
}

$order = new Order();
$order_id = $order->sendOrder($_POST["firstname"], $_POST["lastname"], $_POST["phone"], $_POST["email"], $_POST["date"], $_POST["stime"], $_POST["ftime"]);
?>

<head>
    <title>
        Urban Space - OrderDetails
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>
    <?php
      include('../header.php');
    ?>
</body>

<?php
$details = $order->queryOrder($order_id);
 
$order->closeDBConnection();

$ordername = $details['f_name']. ' '. $details['l_name'];
$time = $details['start_time']. ' - '. $details['finish_time'];

echo '
<body>
        <div class="col-sm">
            <div class="card" style="width: 60rem;">
                <div class="card-body">
                    <h5 class="card-title"><strong>Order Details:</strong></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Order Name:</strong> '.$ordername.'</strong></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Date:</strong> '.$details['date'].'</strong></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Duration:</strong> '.$time.'</strong></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Phone number: '.$details['phone'].'</strong></h6>
                    <h6 class="card-subtitle mb-2 text-muted"><strong>Email:</strong> '.$details['email'].'</strong></h6>
                </div>
            </div>
        </div>
        <footer class="page-footer font-small mdb-color darken-3 pt-4">
                <div class="footer-copyright text-center py-3 space">© 2019 Copyright:
                <a href="/index.php"> UrbanSpaces.com</a>
                </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
        '
;
?>