<?php
require dirname(dirname(__FILE__)) . '/inc/Connection.php';

class Prozigzig
{
    private $probus;

    public function __construct($probus = null)
    {


        $this->probus = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->probus->connect_error) {
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
        } else {
            return -1;
        }
    }
    public function licensevalidate(): int
    {
        return 1;
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
        } else {
            return -1;
        }
    }

   
    public function fetchData($query)
    {
        // Assuming $this->conn is your database connection
        $result = mysqli_query($this->probus, $query);

        if (!$result) {
            // Handle error - maybe return false or throw exception
            return false;
        }

        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return 0; 
        }
    }
    public function executeQuery($query) {
        $this->probus->set_charset("utf8mb4");
        $result = $this->probus->query($query);
        
        if (!$result) {
            return 0;
        }
        
        return $result->num_rows;
    }

    public function fetchDataQuery()
    {
        $this->probus->set_charset("utf8mb4");
        $query = "SELECT * FROM printouts ORDER BY id DESC LIMIT 1";
        $result = $this->probus->query($query);
        
        if (!$result) {
            return ['data' => ''];
        }
        
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
        
        return ['data' => ''];
    }
    

    public function queryfire($query) {
        $this->probus->set_charset("utf8mb4");
        $result = $this->probus->query($query);
        if (!$result) {
            return false;
        }
        return $result;
    }
}
