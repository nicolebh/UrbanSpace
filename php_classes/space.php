<?php
class Space {
    private $host  = 'mtacloud.co.il';
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
    
    public function getAllRows($condition = '')
    {
        if($condition)
            $sql_query = "select * from " . $this->main_table . " where " . $condition;
        else 
            $sql_query = "select * from " . $this->main_table;
        $result = $this->dbConnect->query($sql_query);
        $generateHTML = '<div class="container">';
        $rowCounter = 0;
        $colCounter = 0;
        if ($result->num_rows > 0) {
          // output data of each row
//row 1 2 3 end row , row
            while($row = $result->fetch_assoc()) {
                if($colCounter === 0) {
                    $generateHTML .= '<div class="row">';
                }
                    $address = $row['address'] . ', ' . $row['city'];
                    $generateHTML .= '
                    <div class="col-sm">
                        <div class="card">
                            <img src="'.$row['image'].'" class="card-img-top" alt="..."> 
                            <div class="card-body">
                            <h5 class="card-title">'.$row['name'].'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">'.$row['address'].', '.$row['city'].'</h6>
                            <h6 class="card-subtitle mb-2 text-muted"><strong>Type:</strong> '.$row['sport_type'].'</strong></h6>
                            <h6 class="card-subtitle mb-2 text-muted"><strong>Num of players: '.$row['num_of_players'].'</strong></h6>
                            <a href="order_details.php?spaceID='.$row['id'].'" class="card-link">Order</a>
                            <a href="space-details.php?spaceID='.$row['id'].'" class="card-link">Details</a>
                            </div>
                        </div>
                    </div>
                    ';
                $colCounter += 1;
                if( $colCounter > 2 ) {
                    $generateHTML .= '</div>';
                    $colCounter = 0;
                }
                else if ($rowCounter >= $result->num_rows - 1 ) {
                    for($i = $colCounter ; $i < 3 ; $i++){
                        $generateHTML .= '<div class="col-sm"></div>';
                    }
                    $generateHTML .= '</div>';
                    $colCounter = 0;
                }
                $rowCounter += 1;
            }
        } else {
            $generateHTML = '<div class="d-flex justify-content-center">Sorry. No spaces found! </div>';
        }
        $this->dbConnect->close();
        return $generateHTML;
    }
    
    public function getFilters($filterField)
    {
        $filterField = trim($filterField,' ');
        $sql_query = "SELECT DISTINCT ".$filterField." FROM " . $this->main_table . " Order By ".$filterField." ASC";
        $result = $this->dbConnect->query($sql_query);
        $generateHTML = '';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $generateHTML .= '<a class="dropdown-item" id="filter-button" name="'.$filterField.'_'.$row[$filterField].'" href="javascript:void(0)" onclick="filterResults(\''.$filterField.'\',\''.$row[$filterField].'\')">'.$row[$filterField].'</a>';
            }
        }
        else {
            $generateHTML = '<a class="dropdown-item" href="#">No Records Found!</a>';
        }
        $this->dbConnect->close();
        return $generateHTML;
    }

    public function getNewSpaces()
    {
        $filterField = trim($filterField,' ');
        $sql_query = "SELECT * from spaces order by id desc limit 3";
        $result = $this->dbConnect->query($sql_query);
        $generateHTML = '<div class="container">';
        $rowCounter = 0;
        $colCounter = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($colCounter === 0) {
                    $generateHTML .= '<div class="row">';
                }
                    $address = $row['address'] . ', ' . $row['city'];
                    $generateHTML .= '
                    <div class="col-sm">
                        <div class="card">
                            <img src="'.$row['image'].'" class="card-img-top" alt="..."> 
                            <div class="card-body">
                            <h5 class="card-title">'.$row['name'].'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">'.$row['address'].', '.$row['city'].'</h6>
                            <h6 class="card-subtitle mb-2 text-muted"><strong>Type:</strong> '.$row['sport_type'].'</strong></h6>
                            <h6 class="card-subtitle mb-2 text-muted"><strong>Num of players: '.$row['num_of_players'].'</strong></h6>
                            <a href="#" class="card-link">Order</a>
                            </div>
                        </div>
                    </div>
                    ';
                $colCounter += 1;
                if( $colCounter > 2 ) {
                    $generateHTML .= '</div>';
                    $colCounter = 0;
                }
                else if ($rowCounter >= $result->num_rows - 1 ) {
                    for($i = $colCounter ; $i < 3 ; $i++){
                        $generateHTML .= '<div class="col-sm"></div>';
                    }
                    $generateHTML .= '</div>';
                    $colCounter = 0;
                }
                $rowCounter += 1;
            }
        }
        else {
            $generateHTML = 'No Records Found!';
        }
        $this->dbConnect->close();
        return $generateHTML;
    }
}

$space = new Space();
if(isset($_POST["action"])){
    if(isset($_POST["filter"]))
        $html = $space->getFilters($_POST["filter"]);
    else if (isset($_POST["condition"]))
        $html = $space->getAllRows($_POST["condition"]);
    else if (isset($_POST["newInDB"]))
        $html = $space->getNewSpaces();
    else
        $html = $space->getAllRows();
    $data = array(
        "html" => $html,
    );
    echo json_encode($data);
}

?>