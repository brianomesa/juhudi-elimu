<?php
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class DbC{
	public $host, $database, $username, $password, $db;
	function __construct($host, $username, $password, $database) {

    $this->host = $host;
    $this->database = $database;
    $this->username = $username;
    $this->password = $password;

		$this->openConnection();
  }

	function openConnection() {
	    $this->db = new mysqli($this->host,$this->username,$this->password,$this->database);
	    if (!$this->db) {
	         die('MySQL Connection Error (' . mysqli_connect_errno() . ') '
	             . mysqli_connect_error());
	    }
	}
	function closeConnection() {
     $this->db->close();
   }

	function escape($string) {
	 return $this->db->real_escape_string($string);
 }

 function queryDb($query) {
    return $this->db->query($query);
  }

	function fetchResults($queryResult){
		return mysqli_fetch_array($queryResult);
	}


}


/*if(!$mysqli->select_db("register"))
{
	die('oops database selection problem ! --> '.mysqli_error());
}*/
define("SECURE", FALSE);

$dbhost_name = "localhost"; // Your host name
$database = "register";       // Your database name
$username = "root";            // Your login userid
$password = "";

try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>
