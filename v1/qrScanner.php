<?php 

require_once '../DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    isset($_POST['candidate_name']);
    $db = new DbOperations();
    //POST VARIABLE IN XAMPP DATABASE
    if($db->QRinfo($_POST['candidate_name'])) {
        $response['error'] = false;
        $response['message'] = "Voted Successfully";
    } else {
        $response['error'] = true;
        $response['message'] = "Failed to Voted";
    }
    
} else {
    $response['error'] = true;
    $response['message'] = "Failed to send the data to server";
}

echo json_encode($response);

?>