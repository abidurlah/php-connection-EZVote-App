<?php 
require_once '../DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['student_id']) and isset($_POST['password'])){
        $db = new DbOperations();
        if($db->userLogin($_POST['student_id'],$_POST['password'])){
           $user = $db->getUserById($_POST['student_id']);
           $response['error'] = false;
           $response['id'] = $user['id'];
           $response['student_id'] = $user['student_id'];
           $response['password'] = $user['password'];
        }else{
            $response['error'] = true;
            $response['message'] = "Invalid id or course";        
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
}

echo json_encode($response);

?>