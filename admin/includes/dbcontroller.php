<?php 
  //database class  
class DBController{
    private $host   = "localhost";
    private $root   =  "root";
    private $pass   =   "";
    private $dbName =   "dillionecom";
    private $conn;
    //constructor function
    public function __construct(){
        // At instantiation of the class/object, we will connect to our database.
        $this->connectDB();
    }
    //database connect function
    private function connectDB(){
        $this->conn = mysqli_connect($this->host,$this->root,$this->pass,$this->dbName);
        if(!$this->conn){
           die("Connection failed: " . mysqli_connect_error()); 
        }
    }
    //escape string input function
    public function escapeString($input){
        $escapedString = mysqli_real_escape_string($this->conn,$input);
        return $escapedString;
    }
    //insert Query function
    public function insertQuery($table,$query){
        $fields         = array_keys($query); 
        $values         = array_values($query);
        $insert_query   =  "INSERT INTO $table (".implode(",",$fields).") VALUES ('".implode("','", $values )."')";
        $result         =   mysqli_query($this->conn,$insert_query);
        return $result;
    }
    //email alreday exits function
    public function EmailExits($table,$email){
        $query = "select email from $table where email = '".$email."'";
        $result = mysqli_query($this->conn,$query);
        if(mysqli_num_rows($result)>0){
           return true; 
        }
    }
    
    //check num of rows function
    public function numRows($query){
        $result     = mysqli_query($this->conn,$query);
        $RowCount   = mysqli_num_rows($result); 
        return $RowCount;
    }
    //check run query function
    public function RunQuery($query){
        $result     = mysqli_query($this->conn,$query);
        while($row  = mysqli_fetch_assoc($result)){
            $resultset[] = $row;
        }
        if(!empty($resultset)){
            return $resultset;
        }
    }
    //update query function
    public function updateQuery($table,$fields,$where){
        $sql = " UPDATE ".$table." SET ";
        foreach($fields as $key=> $value){
            $data[$key] = " $key = '".$value."' ";
        }
        $sql.= implode(" , ",array_values($data))." where ".$where.";"; 
        $result = mysqli_query($this->conn,$sql);
        if(!$result){
            die("invalid query:".mysqli_error());
        }
        else{
        return $result;
        }
    }
    //delete query function
    public function deleteQuery($table,$condition){
        $query = "DELETE FROM ".$table." WHERE ".$condition;
        $result = mysqli_query($this->conn,$query);
        if(!$result){
            die("invalid query:".mysqli_error());
        }
        else{
        return $result;
        }
    }
    //mail send function
    public function MailSend($email,$token,$link){
        $toEmail = $email;
        $subject = "User Registration Activation Email";
        $content =  "Click this link to activate your account. <a href='" . $link . "'>" . $link . "</a>";
        $mailHeaders = "From: Billingbooks\r\n";
        if(mail($toEmail, $subject, $content, $mailHeaders)){
            return true;
        }
    }
    //close connection function
    public function Close(){
        mysqli_close($this->conn);
    }

    public function last_insert_id(){
        $last_id = mysqli_insert_id($this->conn);
        return $last_id;
    }
}

?>