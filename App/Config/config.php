<?php 
class Database
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "Lowkey2002";
  private $dbname = "rico";
  protected $conn;
  public function setConnection()
  {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
  }

  public function closeConnection()
  {
    $this->conn = null;
  }

}


?>