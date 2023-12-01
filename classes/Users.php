<?php
class User
{
    //  properties -----------------------------------------
    protected $firstname;
    protected $lastname;
    protected $password;
    protected $email;
    protected $phone;
    protected $createdat;
    protected $role;
    private $conn;
    
    // functions ------------------------------------------------
    
    // constructor
    public function __construct($firstname=NULL, $lastname=NULL, $password=NULL, $email=NULL, $phone=NULL, $createdat=NULL, $role=NULL, $conn=NULL)
    {
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->password=$password;
        $this->email=$email;
        $this->phone=$phone;
        $this->createdat=$createdat;
        $this->role=$role;
        $this->conn=$conn;
    }
    
    // setters
    public function set_firstname($firstname)
    {
        $this->firstname=$firstname;
    }
    public function set_lastname($lastname)
    {
        $this->lastname=$lastname;
    }
    public function set_password($password)
    {
        $this->password=$password;
    }
    public function set_email($email)
    {
        $this->email=$email;
    }
    public function set_phone($phone)
    {
        $this->phone=$phone;
    }
    public function set_createdat($createdat)
    {
        $this->createdat=$createdat;
    }
    public function set_role($role)
    {
        $this->role=$role;
    }
    
    // getters
    public function get_username()
    {
        return $this->username;
    }
    
    public function get_firstname()
    {
        return $this->firstname;
    }
    public function get_lastname()
    {
        return $this->lastname;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_phone()
    {
        return $this->phone;
    }
    public function get_createdat()
    {
        return $this->createdat;
    }
    public function get_role()
    {
        return $this->role;
    }
    
    // crud methods ------------------------------------------------------
    
    public function createUser() // create a user
    {
        try {
            require "dbh.php";
            
            // get inputs, make variables out of them
            $id = NULL; // auto inc.
            $firstname = $this->get_firstname();
            $lastname = $this->get_lastname();
            $password = $this->get_password();
            $email = $this->get_email();
            $phone = $this->get_phone();
            
            // check if email is taken already
            $stmt = $conn->prepare("
                                  SELECT email
                                  FROM users
                                  WHERE email = :email
                              ");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // if email in use, give warning and redirect to ../index (gotta be changed)
                echo '' ?>
		        <script type="text/javascript">
                    window.open("index.php","_self");
                    alert("Email is already taken!");
                </script>
                <?php ;
		    } else {
		        // prepare statement to insert into database
		        $sql = $conn->prepare("
                                         INSERT INTO users (id, firstname, lastname, password, email, phone)
                                         VALUES (:id, :firstname, :lastname, :password, :email, :phone)
                                     ");
		        // put variables into statement and execute
		        $sql->bindParam(":id", $id);
		        $sql->bindParam(":firstname", $firstname);
		        $sql->bindParam(":lastname", $lastname);
		        $sql->bindParam(":password", $password);
		        $sql->bindParam(":email", $email);
		        $sql->bindParam(":phone", $phone);
		        $sql->execute();
		        
		        // notify successful creation + redirect to ../index
		        echo '' ?>
		        <script type="text/javascript">
                    window.open("login.php","_self");
                    alert("Account registered! You can now login!");
                </script>
                <?php 
                ;
		    }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function readUser()
    {
        try {
            require "dbh.php";
            //if logged in, continue
            
            $sesuser = $_SESSION['email'];
            // create statement to select info from the database based on session's email
            $sql = $conn->prepare("
                                         SELECT id, firstname, lastname, email, phone, role, createdat
                                         FROM users
                                         WHERE email = :email
                                     ");
            $sql->bindParam(":email", $sesuser);
            $sql->execute();
            
            // Retrieve the user record from the database
            $user = $sql->fetch(PDO::FETCH_ASSOC);
            
            {
                if ($user['role'] == 0){
                    $role = "Owner";
                }
                else if ($user['role'] == 1){
                    $role = "Admin";
                }
                else {
                    $role = "Client";
                }
                echo ''?>
			<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">
            <div>
              <label for="name">Profile ID</label><br>
              <input value="<?php echo $user['id']?>" readonly type="text" id="id" name="id" placeholder="User ID" required="">
            </div>
            <br>
            <div>
              <label for="name">First Name</label><br>
              <input value="<?php echo $user['firstname']?>" type="text" id="firstname" name="firstname" placeholder="Front Name" required="">
            </div>
            <br>
            <div>
              <label for="name">Last Name</label><br>
              <input value="<?php echo $user['lastname']?>"type="text" id="lastname" name="lastname" placeholder="Last Name" required="">
            </div>
            <br>
            <div>
              <label for="password">New Profile Password</label><br>
              <input value=""type="password" id="password" name="password" placeholder="User Password" required="">
            </div>
            <br>
            <div>
              <label for="email">Email</label><br>
              <input value="<?php echo $user['email']?>" type="email" id="email" name="email" placeholder="Email" required="">
            </div>
            <br>
            <div>
              <label for="phone">Phone Number</label><br>
              <input value="<?php echo $user['phone']?>" type="text" id="phone" name="phone" placeholder="Phone Number" required="">
            </div>
            <br>
            <div>
              <label for="date">Created At</label><br>
              <input value="<?php echo $user['createdat']?>" readonly id="createdat" name="createdat" placeholder="Created At" required="" type="text">
            </div>
            <br>
            <div>
              <label for="name">Role</label><br>
              <input value="<?php echo $role ?>" readonly id="role" name="role" placeholder="Role" required="" type="text">
            </div>
            <br>
              <input type="submit" value="Update: this will log you out!">
            </form>
          <br>
			<form action="deleteUser.php" method="delete">
			<input type="submit" value="Delete Account">
		  </form>
				<?php
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function readUsers() {
        // define the query
        $sql = "SELECT * FROM users";

        try {
            // prepare the statement
            $stmt = $this->conn->prepare($sql);

            // execute the prepared statement
            $stmt->execute();

            // fetch the results
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // return the results
            return $users;
        } catch (PDOException $e) {
            // handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUserRole($id, $new_role) {
        // define the query
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        try{
            // prepare the statement
            $stmt = $this->conn->prepare($sql);

            // bind parameters to the placeholder
            $stmt->bindParam(":role", $new_role);
            $stmt->bindParam(":id", $id);

            // execute the prepared statement
            $stmt->execute();
        } catch (PDOException $e) {
            // handle exceptions
            echo "Error: " . $e->getMessage();
        }
    }
    

    public static function getUserByEmail($email) {
        require "dbh.php";
    
        $sql = $conn->prepare("
            SELECT id, firstname, lastname, password, email, phone, role
            FROM users
            WHERE email = :email
        ");
        $sql->bindParam(":email", $email);
        $sql->execute();
    
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function updateUser($id)
    {
        try {
        require "dbh.php";
        // gegevens uit het object in variabelen zetten
        $firstname = $this->get_firstname();
        $lastname = $this->get_lastname();
        $password = $this->get_password();
        $email = $this->get_email();
        $phone = $this->get_phone();
        
        // statement maken
        $sql = $conn->prepare("
									 UPDATE users
                                     SET firstname=:firstname, lastname=:lastname, password=:password, email=:email, phone=:phone
									 WHERE id=:id
								 ");
        // variabelen in de statement zetten
        // $passwordhash = password_hash($password, PASSWORD_DEFAULT); // hashes the password
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":password", $password);//hash);
        $sql->bindParam(":email", $email);
        $sql->bindParam(":phone", $phone);
        $sql->bindParam(":id", $id);
        $sql->execute();
        header("location: logout.php");
        /*
         echo '<script type="text/javascript">
         window.open("checkuser.php","_self");
         </script>';
         */
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function deleteUser($email)
    {
        try {
            require "dbh.php";
            // statement maken
            $sql = $conn->prepare("
									 DELETE from users
									 WHERE email = :email
								 ");
            // variabele in de statement zetten
            $sql->bindParam(":email", $email);
            $sql->execute();
            header("location: logout.php");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>