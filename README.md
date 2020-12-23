# ecommerce-project-php
A simple ecommerce project php

## Installation
The recommended way to install:


```sh
git clone https://github.com/ajazsaif/ecommerce-project-php

```

<p align="center">
    <a href="https://github.com/ajazsaif/ecommerce-project-php/blob/main/remond.png" target="_blank">
        <img src="https://github.com/ajazsaif/ecommerce-project-php/blob/main/remond.png" width="800" alt="ecommerce-project-php" />
    </a>
</p>

## Setup Project
Step 1: - create a dillionecom databse and go to database folder and import dillionecom.sql file
Step 2: - goto includes/dbcontroller.php class and change your $dbName = 'yourdbname'
Step 3:- after complete step1 and step 2 now you can acess your project

## Project Url

http://localhost/ecommerce-project-php



```php
<?php
// dbcontroller.php

class DBController{
    private $host   = "localhost";
    private $root   =  "root";
    private $pass   =   "";
    private $dbName =   "dillionecom"; //database name
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

```

## Configuration Project
go to includes/top.php and change your domain name or project root path and site name

```php
<?php
// top.php

session_start();
//session_regenerate_id();
error_reporting(0);
define('__WEBROOT__', "http://localhost/ecommerce-project-php"); // your project root path
define('__ROOT__', dirname(dirname(__FILE__)));  
require_once(__ROOT__.'/includes/dbcontroller.php');
require_once(__ROOT__.'/includes/function.php');
$db_handle      =  new DBController();
$page_title = "dillionecom"; //site name

```

## Admin Part

```sh
http://localhost/ecommerce-project-php/admin

login details:-

username:- admin
password:- 1234

```

<p align="center">
    <a href="https://github.com/ajazsaif/ecommerce-project-php/blob/main/remond-admin.png" target="_blank">
        <img src="https://github.com/ajazsaif/ecommerce-project-php/blob/main/remond-admin.png" width="800" alt="ecommerce-project-php" />
    </a>
</p>

## Admin Url Configuration
go to admin/includes/config.php and change your admin path and site name

```php
<?php
// admin/includes/config.php

error_reporting(0);
session_name('medicare_admin');
session_start();
session_regenerate_id();
define('__WEBROOT__', "http://localhost/ecommerce-project-php/admin"); //admin path
if(empty($_SESSION["admin-email"])){
        header("location:".__WEBROOT__."/login.php");
    
    //redirect_page_url($baseurl."/login.php");
    }
include_once('dbcontroller.php');
include_once('function.php');
$page_title='dillionecom'; //admin dashbord Name

```

## Admin Dashbord database configuration class
go to admin/includes/dbcontroller.php database class and change your databse name $dbName

```php
<?php
// dbcontroller.php

class DBController{
    private $host   = "localhost";
    private $root   =  "root";
    private $pass   =   "";
    private $dbName =   "dillionecom"; //database name
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

```
