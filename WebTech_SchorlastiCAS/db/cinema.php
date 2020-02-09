<?php
    include_once("utilities/db_access_helper.php");

    class Cinema extends DatabaseAccessHelper{
        private $id = null;
        private $cinema_name = null;
        private $cinema_address = null;
        private $cinema_telephone = null;
        private $cinema_email = null;
        private $create_query = "INSERT INTO cinema (Cinema_Name, Cinema_Address, Cinema_Telephone, Cinema_Email) VALUES (?, ?, ?, ?)";
        private $update_query = "UPDATE cinema SET Cinema_Name=?, Cinema_Address=?, Cinema_Telephone=?, Cinema_Email=? WHERE Cinema_ID=?";
        private $delete_query = "DELETE FROM cinema WHERE Cinema_ID=?";

        function __construct($cinema_name='none', $cinema_address='none', $cinema_telephone='none', $cinema_email='none'){
            parent::__construct();
			$this->cinema_name = $cinema_name;
            $this->cinema_address = $cinema_address;
            $this->cinema_telephone = $cinema_telephone;
            $this->cinema_email = $cinema_email;
        }

        function all_cinema(){
            $queryString = "SELECT * from cinema";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function get_cinema($id){
            $queryString = "SELECT * FROM cinema WHERE Cinema_ID='$id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }
        
        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);
            if ($query_statement) {
                $query_statement->bind_param("ssss", $this->cinema_name, $this->cinema_address, $this->cinema_telephone, $this->cinema_email);

                $ret_val = $query_statement->execute();
                $this->id = $this->recently_generated_id();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during insertion";
            }
            
        }
        
        function read(){

        }

        function update($c_id = 'none'){
            if ($c_id == 'none'){
                $c_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->update_query);
            if ($query_statement) {
                $query_statement->bind_param("ssssi", $this->cinema_name, $this->cinema_address, $this->cinema_telephone, $this->cinema_email, $c_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during cinema update.";
            }
        }

        function delete($c_id = 'none'){
            if ($c_id == 'none'){
                $c_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->delete_query);
            if ($query_statement) {
                $query_statement->bind_param("i", $c_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during cinema delete.";
            }
        }
    }
    
?>