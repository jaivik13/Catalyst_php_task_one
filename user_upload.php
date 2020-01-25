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

// --file command
$cadfile = getopt(null, ["file:"]);
$caddry = getopt(null, ["dry_run:"]);
if (isset($cadfile['file']) || isset($caddry['dry_run'])) {
    $i = 0;
    if (($handle = fopen($cadfile['file'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            if ($i == 0) {
                $i++;
                continue;
            }
            for ($c = 0; $c < $num; $c++) {
                $data[$c];
                echo $data[$c] . "\n";
            }
            $i++;
        }
        fclose($handle);
    }
}


// --insert command for insert data in DB
$cadinsert = getopt(null, ["insert:"]);

if (isset($cadinsert['insert'])) {
    // Create connection
    $conn = new mysqli($cad['h'], $cad['u'], '');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error . "\n\n");
    }
    $importData_arr = array();
    $i = 0;
    if (($handle = fopen($cadinsert['insert'], "r")) !== FALSE) {

        $conn = new mysqli($cad['h'], $cad['u'], '', 'user');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "\n\n");
        }

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

            $num = count($data);
            if ($i == 0) {
                $i++;
                continue;
            }

            for ($c = 0; $c < $num; $c++) {

                $importData_arr[$i][] = $data[$c];
                $name =  ucwords(strtolower(($data[0])));
                $surname = ucwords(strtolower(($data[1])));

                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-15-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $data[2])) {
                    $email = strtolower($data[2]);
                } else {
                    $stdout = fopen('php://stdout', 'w');
                    file_put_contents("php://filter/write/resource=errors_log.csv", "Invalid Email Id Format: " . $data[2]);
                }
                $qry = "INSERT into users (name,surname,email) values ('" . $name . "','" . $surname . "','" . $email . "')";
                mysqli_query($conn, $qry);
            }
            $i++;
        }
        fclose($handle);
        echo "Users Data Inserted Successful";
        exit();
    }
}
