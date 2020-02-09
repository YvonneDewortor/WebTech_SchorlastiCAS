<?php

    define('DB_HOST_ADMIN', 'localhost');
    define('DB_USERNAME_ADMIN', 'root');
    define('DB_PASSWORD_ADMIN', '');
    define('DB_NAME_ADMIN', 'ts2021_admin');

    class DatabaseAccessHelper_Admin{
		protected $connection=null;
		private $data=null;
		
		function __construct(){
			$this->connect();
		}

		function __destruct(){
			if($this->connection){
				$this->connection->close();
			}
		}
	
		function connect(){
			$this->connection = new mysqli(DB_HOST_ADMIN, DB_USERNAME_ADMIN, DB_PASSWORD_ADMIN, DB_NAME_ADMIN);
			
			if($this->connection->connect_errno){
				echo $this->connection->connect_errno;
				return false;
			}
				
			return true;
		}
		
		function execute_query($queryString){
			if(!$this->connect()){
				$this->connect();
			}
			
			$this->data = $this->connection->query($queryString);
			
			if(!$this->data){
				echo $this->connection->error;
				return false;
			}

			return true;
		}

		function get_query_result(){
			return $this->data;
		}
		
		function get_record(){
			if(!$this->data){
				return false;
			}
			
			return $this->data->fetch_assoc();
		}

		function recently_generated_id(){
			return mysqli_insert_id($this->connection);
		}
	}

    class Admin extends DatabaseAccessHelper_Admin {
        private $id = null;
        private $name = null;
        private $password = null;
        private $date_of_birth = null;
        private $address = null;
        private $email = null;
        private $contact_number = null;
        private $create_query = "INSERT INTO administrator (Name, Password, Date_of_Birth, Address, Email_Address, Contact_Number) VALUES (?, ?, ?, ?, ?, ?)";
        private $select_query = "SELECT * FROM administrator WHERE Name = ? AND Password = ?";

        function __construct($name='none', $password='none', $date_of_birth='none', $address='none', $email='none', $contact_number='none'){
            parent::__construct();
			$this->name = $name;
            $this->password = $password;
            $this->date_of_birth = $date_of_birth;
            $this->address = $address;
            $this->email = $email;
            $this->contact_number = $contact_number;
            $this->connect();
        }

        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);

            if ($query_statement) {
                
                $query_statement->bind_param("ssssss", $this->name, $this->password, $this->date_of_birth, $this->address, $this->email, $this->contact_number);
                
                $ret_val = $query_statement->execute();
                
                $this->id = $this->recently_generated_id();
                
                $query_statement->close();
                return $ret_val;

            } else {
                return "Error during insertion";
            }
        }

        function get_admin($admin_name, $admin_password) {
            $query_statement = mysqli_prepare($this->connection, $this->select_query);

            if ($query_statement) {

                $query_statement->bind_param("ss", $admin_name, $admin_password);

                $query_statement->execute();

                $ret_val = $query_statement->get_result();

                $ret_val = $ret_val->num_rows;

                $query_statement->close();

                return $ret_val;
            } else {
                return "Error during selection";
            }

        }
    }

?>