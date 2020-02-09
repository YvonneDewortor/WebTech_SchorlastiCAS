<?php
    include_once("utilities/db_access_helper.php");

    class Theatre extends DatabaseAccessHelper{
        private $id = null;
        private $theatre_name = null;
        private $cinema_id = null;
        private $create_query = "INSERT INTO theatre (Theatre_Name, Cinema_ID) VALUES (?, ?)";
        private $update_query = "UPDATE theatre SET Theatre_Name=?, Cinema_ID=? WHERE Theatre_ID=?";
        private $delete_query = "DELETE FROM theatre WHERE Theatre_ID=?";

        function __construct($theatre_name='none', $cinema_id='none'){
            parent::__construct();
			$this->theatre_name = $theatre_name;
            $this->cinema_id = $cinema_id;
        }

        function all_theatre(){
            $queryString = "SELECT * from theatre";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function get_theatre($id){
            $queryString = "SELECT * FROM theatre WHERE Theatre_ID='$id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }
        
        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);
            if ($query_statement) {
                $query_statement->bind_param("si", $this->theatre_name, $this->cinema_id);

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

        function update($t_id = 'none'){
            if ($t_id == 'none'){
                $t_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->update_query);
            if ($query_statement) {
                $query_statement->bind_param("sii", $this->theatre_name, $this->cinema_id, $t_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during theatre update.";
            }
        }

        function delete($t_id = 'none'){
            if ($t_id == 'none'){
                $t_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->delete_query);
            if ($query_statement) {
                $query_statement->bind_param("i", $t_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during theatre update.";
            }
        }
    }
    
?>