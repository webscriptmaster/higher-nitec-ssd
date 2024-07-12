<?php

require_once "config.php";

class DatabaseUtil
{
    // Method to get the database connection
    public function getConnection()
    {
        // Create a new mysqli connection instance
        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    // Method to close the database connection
    public function closeConnection($conn){
        $conn->close();
    }

    // Method to get query result
    public function getQueryResult($conn, $sql)
    {
        // Attempt to execute the query
        $result = $conn->query($sql);

        // Check if the query was successful
        if (!$result) {
            // Handle error - you could also log this or handle it differently
            die("Error executing query: " . $conn->error);
        }

        return $result;
    }

    // Method to insert data
    public function insertData($conn, $sql)
    {
        if (mysqli_query($conn, $sql)) {
            return mysqli_affected_rows($conn);
        } else {
            echo "Insert error: " . mysqli_error($conn);
            return false;
        }
    }

    // Method to update data
    public function updateData($conn, $sql)
    {
        if (mysqli_query($conn, $sql)) {
            return mysqli_affected_rows($conn);
        } else {
            echo "Update error: " . mysqli_error($conn);
            return false;
        }
    }

    // Method to delete data
    public function deleteData($conn, $sql)
    {
        if (mysqli_query($conn, $sql)) {
            return mysqli_affected_rows($conn);
        } else {
            echo "Delete error: " . mysqli_error($conn);
            return false;
        }
    }
}
