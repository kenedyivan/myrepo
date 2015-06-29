<?php
/*
 * Following code will list all the items
 */

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/php_includes/DB_CONNECT.php';

// connecting to db
$db = new DB_CONNECT();

// get all items from item table
$result = mysqli_query($db->connect(),"SELECT *FROM category") or die(mysql_error());

// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // item node
    $response["category"] = array();

    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $category = array();
        $category["idCategory"] = $row["idCategory"];
        $category["category_name"] = $row["category_name"];
        $category["cat_image"] = $row["cat_image"];

        // push single product into final response array
        array_push($response["category"], $category);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No items found";

    // echo no users JSON
    echo json_encode($response);
}