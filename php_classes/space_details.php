<?php
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
                    <div class="col-sm">
                        <div class="row">
                          <div class="card" style="text-align: center">
							<img src="'.$row['image'].'" class="card-img-top" alt="..."> 
							<div class="card-body">
								<h5 class="card-title">'.$row['name'].'</h5>
								<h6 class="card-subtitle mb-2 text-muted">'.$row['address'].', '.$row['city'].'</h6>
								<h6 class="card-subtitle mb-2 text-muted"><strong>Type:</strong> '.$row['sport_type'].'</strong></h6>
								<h6 class="card-subtitle mb-2 text-muted"><strong>Num of players: '.$row['num_of_players'].'</strong></h6>
								<iframe frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe><br>
								<a href="order_details.php" class="card-link">Order</a>
							</div>
                        </div>
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