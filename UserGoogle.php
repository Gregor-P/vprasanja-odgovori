<?php
include_once './session.php';

class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "vprasanja-odgovori";
    private $userTbl    = 'users';
	
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
	
	function checkUser($userData, PDO $pdo){
        if(!empty($userData)){
            //Check whether user data already exists in database
            $stmt = $pdo->prepare("SELECT * FROM users "
                                . "WHERE oauth_provider = ? "
                                . "AND oauth_uid = ?;");
            $stmt->execute([$userData['oauth_provider'], $userData['oauth_uid']]);
            $row = $stmt->fetchI();
            if($row){
                //Update user data if already exists
                $stmt = "UPDATE users "
                      . "SET first_name = ?, last_name = ?, email = ? WHERE oauth_provider = ? AND oauth_uid = ?;";
                
            }else{
                //Insert user data
                
                $stmt = $pdo->prepare("INSERT INTO users(oauth_provider, oauth_uid, first_name, last_name, email) "
                        . "VALUES (?,?,?,?,?)");
                $stmt->execute([$userData['oauth_provider'], $userData['oauth_uid'], $userData['first_name'], $userData['last_name'], $userData['email']]);
            }
            
            //Get user data from the database
            //$result = $this->db->query($prevQuery);
            //$userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
		//SQL stavek da dobiš id od emajla!
		//$_SESSION[''] = $row['user_id'];
    }
}
?>