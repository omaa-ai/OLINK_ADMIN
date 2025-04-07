<?php
require dirname( dirname(__FILE__) ).'/inc/Connection.php';

class Prozigzig
{
    private $probus;

    public function __construct($probus)
    {
        
		
		$this->probus = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->probus->connect_error);
        }
		if (!$this->probus->set_charset("utf8mb4")) {
            echo "Warning: Error loading character set utf8mb4: " . $this->probus->error;
        }
    }
    
	
	
	public function real_string($string)
    {
		$this->probus->set_charset("utf8mb4");
        return $this->probus->real_escape_string($string);
    }
	
    public function login(string $username, string $password, string $tblname): int
    {
		$this->probus->set_charset("utf8mb4");
		$licenseResult = $this->licensevalidate();
         if ($licenseResult == 1) {
			 
        $query = ($tblname == "admin") ?
            "SELECT * FROM admin WHERE username=? AND password=?" :
            "SELECT * FROM $tblname WHERE email=? AND password=?";
        $stmt = $this->probus->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();
        return $count;
		}
         else 
         {
          return -1;   
         }
    }
  
	
    public function insertData(array $fields, array $data, string $table): bool
    {
		$this->probus->set_charset("utf8mb4");
		$licenseResult = $this->licensevalidate();
         if ($licenseResult == 1) {
        $field_names = implode(",", $fields);
        $placeholders = rtrim(str_repeat("?,", count($fields)), ",");
        $sql = "INSERT INTO $table ($field_names) VALUES ($placeholders)";
        $stmt = $this->probus->prepare($sql);
        $stmt->bind_param(str_repeat("s", count($data)), ...$data);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
		}
         else 
         {
          return -1;   
         }
    }
  
}
?>