<?php 
    class DbOperations{

        private $con;

        function __construct()
        {
            require_once dirname(__FILE__).'/DbConnect.php';

            $db = new DbConnect();

            $this->con = $db->connect(); 
        }

        public function createUser($student_id,$password,$student_name,$student_course) {
            if($this->isUserExist($student_id)) {
                return 0;
            }else {
                $stmt = $this->con->prepare("INSERT INTO `users` (`id`, `student_id`, `password`, `student_name`, `student_course`) VALUES (NULL, ?, ?, ?, ?);");
                $stmt->bind_param("ssss",$student_id,$password,$student_name,$student_course);

                if($stmt->execute()) {
                    return 1;
                } else
                    return 2;
            }
        }

        public function userLogin($student_id,$password){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE student_id = ? AND password =?");
            $stmt->bind_param("ss",$student_id,$password);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
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