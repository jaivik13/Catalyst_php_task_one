<?php

$cad = getopt("u:p:h:");
if ((isset($cad['h'])) && isset($cad['u']) && isset($cad['p'])) {

    // Create connection
    $conn = new mysqli($cad['h'], $cad['u'], $cad['p']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //  Create database
    $data = $argv;
    if ($data[1] != "--create_table") {
        $sql = "CREATE DATABASE user";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully DB name  : user";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    } else {
        //--create_table
        $cad = getopt(null, ["create_table:"]);
        if ($data[1] == "--create_table") {
            mysqli_select_db($conn, "user");
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            if (empty($result)) {
                $sql = "CREATE TABLE users (
                name varchar(255) NOt NULL,
                surname varchar(255) NOT NULL,
                email varchar(255) NOT NULL UNIQUE
                )";
                if ($conn->query($sql) === TRUE) {
                    echo "Table : users Created Successfully";
                } else {
                    echo "Error creating database: " . $conn->error;
                }
            }
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
}
