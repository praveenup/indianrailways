<?php
//	$json_train_name_url = file_get_contents('json\autocomplete.json');
//	$data = json_decode($json_train_name_url);

$user ="praveenk";
$pass ="praveen";
$server ="localhost";
$db = "rail";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_GET['term'])) {
    $query = $_GET['term'];
    $sql = 'SELECT trainName, trainNo FROM trainname WHERE trainNo LIKE "%'.$query.'%"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = array( 'label' => $row['trainName'].'('.$row['trainNo'].')' , 'value' => $row['trainNo'] );
        }
        //RETURN JSON ARRAY
        echo json_encode ($array);
    }
}

/*ini_set('max_execution_time', 300);
for( $i=0; $i<$data->total; $i++ ) {
    $no = $data->trains[$i]->number;
    $name = (string)$data->trains[$i]->name;
    $sql = "insert into trainname (trainNo,trainName)values('$no','$name')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}*/

?>