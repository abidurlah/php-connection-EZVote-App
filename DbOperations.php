<?php 
    class DbOperations{

        private $con;

        function __construct()
        {
            require_once dirname(__FILE__).'/DbConnect.php';

            $db = new DbConnect();

            $this->con = $db->connect(); 
        }

        public function QRinfo($QRInfo) {
            $stmt = $this->con->prepare("INSERT INTO `qrcode` (`candidate_name`) VALUES (?);");
            $stmt->bind_param("s",$QRInfo);
            if($stmt->execute()) {
                return 1;
            } else{
                return 2;
            }
        }

        public function createUser($student_id,$password,$student_name,$student_course) {
            if($this->isUserExist($student_id)) {
                return 0;
            }else {
                $stmt = $this->con->prepare("INSERT INTO `users` (`id`, `student_id`, `password`, `student_name`, `student_course`, `status`) VALUES (NULL, ?, ?, ?, ?, 1);");
                $stmt->bind_param("ssss",$student_id,$password,$student_name,$student_course);

                if($stmt->execute()) {
                    return true;
                } else
                    return false;
            }
        }

        public function userLogin($student_id,$password){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE student_id = ? AND password =? OR status= 1 OR status =0");
            $stmt->bind_param("ss",$student_id,$password);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        public function userStatus($status) {
            $stmt = $this->con->prepare("SELECT id FROM users WHERE status = 1 OR status = 2");
            $stmt->execute();
            $stmt->bind_result($status);
            $arrayStatus = array();

            while($stmt->fetch()){
                $temp = array();
                $temp['status'] = $status;
                array_push($arrayStatus,$temp);
            }
            return json_encode($arrayStatus);
        }

        public function getUserById($student_id){
            $stmt = $this->con->prepare("SELECT * FROM users WHERE student_id = ?");
            $stmt->bind_param("s",$student_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        private function isUserExist($student_id) {
            $stmt = $this->con->prepare("SELECT id FROM users WHERE student_id = ?");
            $stmt->bind_param("s",$student_id);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
    }