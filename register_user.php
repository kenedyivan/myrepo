<?php
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

/*test data
* $username = 'otim';
* $email = 'otim@gmail.com';
* $password = '12345';
*/

// check for required fields
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) &&
    (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]))) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $date = date("Y-d-m");

    // include db connect class
    require_once __DIR__ . '/php_includes/DB_CONNECT.php';

    // connecting to db
    $db = new DB_CONNECT();
    $connection = $db->connect();

    // mysql inserting a new row
    $result = mysqli_query($connection,"INSERT INTO user(username, email, password,date_joined) VALUES('$username', '$email', '$password','$date')");
    $userId = mysqli_insert_id($connection);

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["userId"] = $userId;
        $response["success"] = 1;
        $response["message"] = "user registered successfully.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";

        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}