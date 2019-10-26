<?php
session_start();
class spaceDetails {
    private $host  = 'localhost';
    private $user  = 'nimrodba_admin';
    private $password   = 'RIcr13!W?A';
    private $database  = 'nimrodba_urbanspace';
	private $main_table = 'spaces';
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

    public function get_space_details($space_id)
    {
        $sql = "select * from spaces where id='" . $space_id . "'";
        $result = $this->dbConnect->query($sql);
		$generateHTML = '<div class="container">';
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $address = $row['address'] . ', ' . $row['city'];

            $generateHTML .= '
                 <div class="row text-center">
                    <div class="col">
                        <h1 class="display-4 p-5">'.$row['name'].'</h1>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <img src="'.$row['image'].'" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-sm">
                        <h5>'.$row['address'].', '.$row['city'].'</h5>
                        <h5><strong>Type:</strong> '.$row['sport_type'].'</h5>
                        <h5><strong>Num of players:</strong> '.$row['num_of_players'].'</h5>
                        <h5><strong>Features:</strong> '.$row['features'].'</h5>
                        <iframe frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe>
                        <a href="order.php?username='.$_SESSION["username"].'&spaceID='.$row["id"].'" class="btn btn-success btn-block">Order</a>
                    </div>
                </div>
                ';
        }
        else {
            $generateHTML = '<div class="d-flex justify-content-center">Sorry. No spaces found! </div>';
        }
		$this->dbConnect->close();
        return $generateHTML;
    }
}

$spaceDetails = new spaceDetails();
if(isset($_POST["action"])){
	$html= $spaceDetails->get_space_details($_POST['spaceId']);
   
	$data = array(
        "html" => $html,
    );
    echo json_encode($data);
}

?>