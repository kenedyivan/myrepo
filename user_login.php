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
if (isset($_POST["email"]) && isset($_POST["password"]) &&
    (!empty($_POST["email"]) && !empty($_POST["password"]))) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // include db connect class
    require_once __DIR__ . '/php_includes/DB_CONNECT.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysqli_query($db->connect(),"SELECT idUser,email,password FROM  user WHERE email = '$email' AND password = '$password' LIMIT 1");

    $count = mysqli_num_rows($result);

    if($count>0){
        // successfully inserted into database
        $data = mysqli_fetch_array($result);
        $userId = $data['idUser'];

        $response["userId"] = $userId;
        $response["success"] = 1;
        $response["message"] = "user login successful";

        // echoing JSON response
        echo json_encode($response);
    }else {
        // user login unsuccessful
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred";

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