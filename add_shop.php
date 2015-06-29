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

/*$user_id = 3;
$shopName = "test name";
$district = "jinja";
$description = "lorem ipsum dolor sit amet";
$mobile_no = 1234567890;
$category_id = 1;
*/

// check for required fields
if (($_POST["user_id"])&& isset($_POST["shopName"]) && isset($_POST["district"]) && isset($_POST["description"]) && isset($_POST["mobile_no"]) && isset($_POST["category_id"]) &&
    (!empty($_POST["user_id"]) && !empty($_POST["shopName"]) && !empty($_POST["district"]) && !empty($_POST["description"]) && !empty($_POST["mobile_no"]) && !empty($_POST["category_id"]))){

    $user_id = $_POST["user_id"];
    $shopName = $_POST["shopName"];
    $district = $_POST["district"];
    $description = $_POST["description"];
    $mobile_no = $_POST["mobile_no"];
    $category_id = $_POST["category_id"];

    // include db connect class
    require_once __DIR__ . '/php_includes/DB_CONNECT.php';

    // connecting to db
    $db = new DB_CONNECT();
    $connection = $db->connect();

    // mysql inserting a new row
    $result = mysqli_query($connection,"INSERT INTO shop(user_id,shop_name, district, description,mobile_no,category)
VALUES('$user_id','$shopName', '$district', '$description','$mobile_no','$category_id')") or die(mysqli_error($connection));

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "shop successfully created";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
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