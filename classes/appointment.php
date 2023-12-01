<?php

class Appointment{
    // properties
    private $id;
    private $user_name;
    private $user_email;
    private $car_model;
    private $car_year;
    private $car_image;
    private $appointment_date;
    private $conn;

    // constructor
    public function __construct($id, $user_name, $user_email, $car_model, $car_year, $car_image, $appointment_date, $conn){
        $this->id = $id;
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->car_model = $car_model;
        $this->car_year = $car_year;
        $this->car_image = $car_image;
        $this->appointment_date = $appointment_date;
        $this->conn = $conn;
    }

    // getters
    public function getId(){
        return $this->id;
    }

    public function getUserName(){
        return $this->user_name;
    }

    public function getUserEmail(){
        return $this->user_email;
    }  

    public function getCarModel(){
        return $this->car_model;
    }

    public function getCarYear(){
        return $this->car_year;
    }  

    public function getCarImage(){
        return $this->car_image;
    }

    public function getAppointmentDate(){
        return $this->appointment_date;
    }

    // setters
    public function setId($id){
        $this->id = $id;
    }

    public function setUserName($user_name){
        $this->user_name = $user_name;
    }

    public function setUserEmail($user_email){
        $this->user_email = $user_email;
    }

    public function setCarModel($car_model){
        $this->car_model = $car_model;
    }

    public function setCarYear($car_year){
        $this->car_year = $car_year;
    }

    public function setCarImage($car_image){
        $this->car_image = $car_image;
    }

    public function setAppointmentDate($appointment_date){
        $this->appointment_date = $appointment_date;
    }

    // methods
    // create
    public function create(){
        $sql = "INSERT INTO appointments (user_name, user_email, model, year, image, appointment_date) VALUES (:user_name, :user_email, :model, 
        :year, :image, :appointment_date)";

        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            // Bind parameters to the placeholders
            $stmt->bindParam(':user_name', $this->user_name);
            $stmt->bindParam(':user_email', $this->user_email);
            $stmt->bindParam(':model', $this->car_model);
            $stmt->bindParam(':year', $this->car_year);
            $stmt->bindParam(':image', $this->car_image);
            $stmt->bindParam(':appointment_date', $this->appointment_date);

            // Execute the prepared statement
            $stmt->execute();
        } catch (Exception $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }

    // read all
    public function readAll(){
        $sql = "SELECT * FROM appointments";
    
        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);
    
            // Execute the prepared statement
            $stmt->execute();
    
            // Fetch the results
            $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Return the results
            return $appointments;
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
        
    }

    // read
    public function read() {
        $sql = "SELECT * FROM appointments WHERE user_name = :user_name";

        try {
            // prepare the statement
            $stmt = $this->conn->prepare($sql);

            // bind parameters to the placeholders
            $stmt->bindParam(':user_name', $this->user_name);

            // execute the prepared statement
            $stmt->execute();

            // fetch the results
            $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // return the results
            return $appointments;
        } catch (Exception $e) {
            // handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }

    public function readById() {
        $sql = "SELECT id FROM appointments WHERE id = :id";
        
        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);
    
            // Bind the parameter
            $stmt->bindParam(':id', $this->id);
    
            // Execute the prepared statement
            $stmt->execute();
    
            // Fetch the result
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $appointment;
        } catch (PDOException $e) {
            // Handle exceptions, e.g., by returning false
            return false;
        }
    }
    

    // delete
    public function delete(){
        $sql = "DELETE FROM appointments WHERE id = :id";
    
        try{
            // prepare the statement
            $stmt = $this->conn->prepare($sql);
    
            // bind parameters to the placeholders
            $stmt->bindParam(':id', $this->id);
    
            // Execute the prepared statement
            $stmt->execute();
        } catch (Exception $e) {
            // Handle any exceptions here
            echo "Error: " . $e->getMessage();
        }
    }    
}