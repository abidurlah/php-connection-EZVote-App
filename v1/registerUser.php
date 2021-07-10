<?php 

require_once '../DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['student_id']) and isset($_POST['password']) and isset($_POST['student_name']) and isset($_POST['student_course'])){
        $db = new DbOperations();

        $result = $db->createUser($_POST['student_id'], $_POST['password'], $_POST['student_name'],$_POST['student_course']);

        if($result == 1){
            $response['error'] = false;
            $response['message'] = "User registered successfully";
        }elseif($result == 2) {
            $response['error'] = true;
            $response['message'] = "User registered failed";
        }elseif($result == 0) {
            $response['error'] = true;
            $response['message'] = "The users already existed in the database";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }


}else {
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}

echo json_encode($response);