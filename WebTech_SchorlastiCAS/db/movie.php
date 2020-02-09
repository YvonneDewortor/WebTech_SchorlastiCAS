<?php
    include_once("utilities/db_access_helper.php");

    class Movie extends DatabaseAccessHelper{
        private $id = null;
        private $movie_title = null;
        private $movie_genre = null;
        private $movie_about = null;
        private $movie_cover = null;
        private $create_query = "INSERT INTO movie (Movie_Title, Movie_Genre, About_Movie, Movie_Cover) VALUES(?, ?, ?, ?)";
        private $update_query = "UPDATE movie SET Movie_Title=?, Movie_Genre=?, About_Movie=?, Movie_Cover=? WHERE Movie_ID=?";
        private $delete_query = "DELETE FROM movie WHERE Movie_ID=?";


        function __construct($movie_title='none', $movie_about = 'none', $movie_genre = 'none', $movie_cover = 'none'){
            parent::__construct();
            $this->movie_title = $movie_title;
            $this->movie_about = $movie_about;
            $this->movie_genre = $movie_genre;
            $this->movie_cover = $movie_cover;
        }

        function all_movies(){
            $queryString = "SELECT * from movie";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function all_movies_by_genre($genre){
            $queryString = "SELECT * FROM movie WHERE Movie_Genre='$genre'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }

        function get_movie($id){
            $queryString = "SELECT * FROM movie WHERE Movie_ID='$id'";

            $this->execute_query($queryString);

            return $this->get_query_result();
        }
        
        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);
            if ($query_statement) {
                $query_statement->bind_param("ssss", $this->movie_title, $this->movie_genre, $this->movie_about, $this->movie_cover);

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

        function update($m_id = 'none'){
            if ($m_id == 'none'){
                $m_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->update_query);
            if ($query_statement) {
                $query_statement->bind_param("ssssi", $this->movie_title, $this->movie_genre, $this->movie_about, $this->movie_cover, $m_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during movie update.";
            }
        }

        function delete($m_id = 'none'){
            if ($m_id == 'none'){
                $m_id = $this->id;
            }
            $query_statement = mysqli_prepare($this->connection, $this->delete_query);
            if ($query_statement) {
                $query_statement->bind_param("i", $m_id);

                $ret_val = $query_statement->execute();
                
                $query_statement->close();
                return $ret_val;
            }
            else {
                return "Error during movie update.";
            }
        }
    }
    
?>