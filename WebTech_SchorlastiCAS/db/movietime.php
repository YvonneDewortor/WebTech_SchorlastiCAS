<?php
    include_once("utilities/db_access_helper.php");

    class MovieTime extends DatabaseAccessHelper{
        private $id = null;
        private $movie_id = null;
        private $movie_time = null;
        private $showingdate_start = null;
        private $showingdate_end = null;
        private $theatre_id = null;
        private $create_query = "INSERT INTO movie_time (Movie_ID, Movie_Time, ShowingDate_Start, ShowingDate_End, Theatre_ID) VALUES(?, ?, ?, ?, ?)";
        private $update_query = "UPDATE movie_time SET Movie_ID=?, Movie_Time=?, ShowingDate_Start=?, ShowingDate_End=?, Theatre_ID=? WHERE Movie_Time_ID=?";
        private $delete_query = "DELETE FROM movie_time WHERE Movie_Time_ID=?";


        function __construct($movie_id='none', $movie_time = 'none', $showingdate_start = 'none', $showingdate_end = 'none', $theatre_id = 'none'){
            parent::__construct();
            $this->movie_id = $movie_id;
            $this->movie_time = $movie_time;
            $this->showingdate_start = $showingdate_start;
            $this->showingdate_end = $showingdate_end;
            $this->theatre_id = $theatre_id;
        }

        function all_movie_times(){
            $queryString = "SELECT * from movie_time";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function all_movie_times_by_theatre($theatre_id){
            $queryString = "SELECT * FROM movie_time WHERE Theatre_ID='$theatre_id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function all_movie_times_by_movie($movie_id){
            $queryString = "SELECT * FROM movie_time WHERE Movie_ID='$movie_id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function get_movie_time($id){
            $queryString = "SELECT * FROM movie_time WHERE Movie_Time_ID='$id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }
        
        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);
            if ($query_statement) {
                $query_statement->bind_param("isssi", $this->movie_id, $this->movie_time, $this->showingdate_start, $this->showingdate_end, $this->theatre_id);

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

        function update($mt_id = 'none'){
            if ($mt_id == 'none'){
                $mt_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->update_query);
            if ($query_statement) {
                $query_statement->bind_param("isssii", $this->movie_id, $this->movie_time, $this->showingdate_start, $this->showingdate_end, $this->theatre_id, $mt_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during movieTime update.";
            }
        }

        function delete($mt_id = 'none'){
            if ($mt_id == 'none'){
                $mt_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->delete_query);
            if ($query_statement) {
                $query_statement->bind_param("i", $mt_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during movieTime update.";
            }
        }
    }
    
?>