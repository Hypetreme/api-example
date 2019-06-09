<?php
class Conn
{

    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    public $pdo = null;

    public function __construct()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=api", $this->username, $this->password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
