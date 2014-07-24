<?php

class Mysql {

    private $db;
    private $host;
    private $port;
    private $username;
    private $password;
    private $dbName;
    private $statement;
    private $rowCount;
    private $errorInfo;
    private $errorCode;

    /**
     * Class constructor
     * Sets the required information to connect for the instance of this class
     * @param string $host The host to connect to
     * @param string $username Username for the database connection
     * @param string $password Password for the database connection
     * @param string $dbName The name of the database to use
     * @param int $port The port that the database server is listening on
     */
    public function __construct($host, $username, $password, $dbName, $port = 3306) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->port = $port;
    }

    /**
     * Connects to the database. Throws a PDOException if the connection fails
     */
    public function connect() {
        try {
            $this->db = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbName", $this->username, $this->password);
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    /**
     * Queries the database and optionally binds any parameters passed with the query
     * @param string $sql The SQL to be executed
     * @param array $parameters Optional parameters to be bound in the query
     * @return boolean Indicates whether or not the query succeeded
     */
    public function query($sql, $parameters = null) {
        $this->statement = $this->db->prepare($sql);
        if(isset($parameters) && is_array($parameters) && count($parameters) != 0) {
            foreach($parameters as $key => $value) {
                $this->statement->bindParam($key, $value);
            }
        }
        if($this->statement->execute()) {
            $this->rowCount = $this->statement->rowCount();
            return true;
        }
        else {
            $this->errorInfo = $this->statement->errorInfo();
            $this->errorCode = $this->statement->errorCode();
            return false;
        }
    }

    /**
     * Returns all records from the last executed query
     * @return object An object containing all of the records
     */
    public function fetchAllRecords() {
        return $this->statement->fetchAll();
    }

    /**
     * Returns the next row from the last executed query
     * @return object An object containing all of the columns of a row
     */
    public function fetchRecord() {
        return $this->statement->fetch();
    }

    /**
     * Returns the error message as an array if it exists
     * @return array Error message associated with the last operation
     */
    public function getErrorMessage() {
        return $this->errorInfo;
    }

    /**
     * Returns the SQLSTATE associated with the last operation
     * @return string The five character alphanumeric SQLSTATE
     */
    public function getErrorCode() {
        return $this->errorCode;
    }

}

?>