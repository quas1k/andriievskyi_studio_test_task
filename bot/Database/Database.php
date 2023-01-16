<?php

namespace Bot\Database;

use Bot\Config\Config;
use PgSql\Connection;

class Database
{
    /**
     * @var string $host
     */
    private string $host;
    /**
     * @var string $dbname
     */
    private string $dbname;
    /**
     * @var string $user
     */
    private string $user;
    /**
     * @var string $password
     */
    private string $password;

    /**
     * @var Connection|false $connection Connection to database
     */
    public Connection|false $connection;


    /**
     * Init connection with database
     */
    public function __construct()
    {
        $this->host = Config::get('host');
        $this->dbname = Config::get('dbname');
        $this->user = Config::get('user');
        $this->password = Config::get('password');

        try {
            $this->connection = pg_connect("host=$this->host dbname=$this->dbname user=$this->user password=$this->password");
        }
        catch (\Exception $e)
        {
            die("Error connecting to the database: " . $e->getMessage());
        }
    }

    /**
     * Insert data in table
     * @param string $table
     * @param array $data
     */
    public function insert(string $table, array $data): void
    {
        // Prepare the column names and values for the query
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", $data);

        // Create the query string
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";

        try {
            // Execute the query
            pg_query($this->connection, $query);
        } catch (\Exception $e) {
            die("Error inserting data into the table: " . $e->getMessage());
        }
    }

}