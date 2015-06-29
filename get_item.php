<?php
/*
 * Following code will get single item details
 * An item is identified by item id (idItem)
 */

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/php_includes/DB_CONNECT.php';

// connecting to db
$db = new DB_CONNECT();
// check for post data
if (isset($_GET["itemid"])) {
    $idItem = $_GET["itemid"];

    // get a product from products table
    $result = mysqli_query($db->connect(),"SELECT *FROM item WHERE idItem = $idItem");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {

            $result = mysqli_fetch_array($result);

            $item = array();
            $item["idItem"] = $result["idItem"];
            $item["sub_category"] = $result["sub_category"];
            $item["shop"] = $result["shop"];
            $item["user"] = $result["user"];
            $item["item_name"] = $result["item_name"];
            $item["price"] = $result["price"];
            $item["item_image"] = $result["item_image"];
            $item["description"] = $result["description"];
            // success
            $response["success"] = 1;

            // user node
            $response["item"] = array();

            array_push($response["item"], $item);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No item found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No item found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}