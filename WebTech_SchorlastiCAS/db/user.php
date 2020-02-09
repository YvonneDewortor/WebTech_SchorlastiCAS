<?php
    include_once("utilities/db_access_helper.php");

    class user extends DatabaseAccessHelper {
        private $id = null;
        private $user_name = null;
        private $user_password = null;
        private $first_name = null;
        private $last_name = null;
        private $gender = null;
        private $date_of_birth = null;
        private $nationality = null;
        private $address = null;
        private $user_email = null;
        private $contact_number = null;
        private $create_query = "INSERT INTO user (User_Name, User_Password, First_Name, Last_Name, Gender, Date_of_Birth, Nationality, Address, Email_Address, Contact_Number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        private $select_query = "SELECT * FROM user WHERE User_Name = ? AND User_Password = ?";
        private $select_query_byusername = "SELECT * FROM user WHERE User_Name = ?";
        private $select_query_byemail = "SELECT * FROM user WHERE Email_Address = ?";

        function __construct($user_name='none', $user_password='none', $first_name='none', $last_name='none', $gender='none', $date_of_birth='none', $nationality='none', $address='none', $user_email='none', $contact_number='none'){
            parent::__construct();
			$this->user_name = $user_name;
            $this->user_password = $user_password;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->gender = $gender;
            $this->date_of_birth = $date_of_birth;
            $this->nationality =$nationality;
            $this->address = $address;
            $this->user_email = $user_email;
            $this->contact_number = $contact_number;
            $this->connect();
        }

        function create(){
            $query_statement = mysqli_prepare($this->connection, $this->create_query);

            if ($query_statement) {
                
                $query_statement->bind_param("ssssssssss", $this->user_name, $this->user_password, $this->first_name, $this->last_name, $this->gender, $this->date_of_birth, $this->nationality, $this->address, $this->user_email, $this->contact_number);
                
                $ret_val = $query_statement->execute();
                
                $this->id = $this->recently_generated_id();
                
                $query_statement->close();
                return $ret_val;

            } else {
                return "Error during insertion";
            }
        }

        function get_user() {
            $query_statement = mysqli_prepare($this->connection, $this->select_query);

            if ($query_statement) {

                $query_statement->bind_param("ss", $this->user_name, $this->user_password);

                $query_statement->execute();

                $ret_val = $query_statement->get_result();

                $ret_val = $ret_val->num_rows;

                $query_statement->close();

                return $ret_val;
            } else {
                return "Error during selection";
            }

        }

        function get_user_byusername($user_name) {
            $query_statement = mysqli_prepare($this->connection, $this->select_query_byusername);

            if ($query_statement) {

                $query_statement->bind_param("s", $user_name);

                $query_statement->execute();

                $ret_val = $query_statement->get_result();

                $ret_val = $ret_val->num_rows;

                $query_statement->close();

                return $ret_val;
            } else {
                return "Error during selection";
            }


        }

        function get_user_byemail($user_email) {
            $query_statement = mysqli_prepare($this->connection, $this->select_query_byemail);

            if ($query_statement) {

                $query_statement->bind_param("s", $user_email);

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