<?php

class Car{
    // Properties
    private $make;
    private $model;
    private $year;
    private $color;
    private $price;
    private $image;
    private $description;
    private $id;
    private $conn;

    // Constructor
    public function __construct($make, $model, $year, $color, $price, $image, $description, $id, $conn){
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->color = $color;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->id = $id;
        $this->conn = $conn;
    }

    // Getters
    public function getMake(){
        return $this->make;
    }

    public function getModel(){
        return $this->model;
    }

    public function getYear(){
        return $this->year;
    }

    public function getColor(){
        return $this->color;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getImage(){
        return $this->image;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getId(){
        return $this->id;
    }

    // Setters
    public function setMake($make){
        $this->make = $make;
    }

    public function setModel($model){
        $this->model = $model;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setId($id){
        $this->id = $id;
    }

    // Methods
    public function create() {
        // Define the query
        $sql = "INSERT INTO cars (make, model, year, color, price, image, description) VALUES (:make, :model, :year, :color, 
        :price, :image, :description)";

        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            // Bind parameters to the placeholders
            $stmt->bindParam(':make', $this->make);
            $stmt->bindParam(':model', $this->model);
            $stmt->bindParam(':year', $this->year);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':description', $this->description);

            // Execute the prepared statement
            $stmt->execute();
        } catch (Exception $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }

    public function read() {
        // Define the query
        $sql = "SELECT * FROM cars";
    
        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);
    
            // Execute the prepared statement
            $stmt->execute();
    
            // Fetch the results
            $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Return the results
            return $cars;
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }

    public function readById(){
        // Define the query
        $sql = "SELECT * FROM cars WHERE id = :id";

        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            // Bind parameters to the placeholder
            $stmt->bindParam(':id', $this->id);

            // Execute the prepared statement
            $stmt->execute();

            // Fetch the results
            $car = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the results
            return $car;
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function update(){
        // Define the query
        $sql = "UPDATE cars SET make = :make, model = :model, year = :year, color = :color, price = :price, image = :image, 
        description = :description WHERE id = :id";
    
        try{
            // prepare statement
            $stmt = $this->conn->prepare($sql);
    
            // bind parameters to placeholders
            $stmt->bindParam(':make', $this->make);
            $stmt->bindParam(':model', $this->model);
            $stmt->bindParam(':year', $this->year);
            $stmt->bindParam(':color', $this->color);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':id', $this->id);
    
            // Execute prepared statement
            $stmt->execute();
        } catch (Exception $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function delete(){
        // define the query
        $sql = "DELETE FROM cars WHERE id = :id";
    
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