<?php
/*
 * Following code will list all the items
 */

// array for JSON response
$response = array();

if(isset($_GET["cat_id"])) {

    $cat_id = $_GET["cat_id"];

// include db connect class
    require_once __DIR__ . '/php_includes/DB_CONNECT.php';

// connecting to db
    $db = new DB_CONNECT();

// get all items from item table
    $result = mysqli_query($db->connect(), "SELECT *FROM sub_category WHERE Category_idCategory= '$cat_id'") or die(mysql_error());

// check for empty result
    if (mysqli_num_rows($result) > 0) {
        // looping through all results
        // item node
        $response["sub_category"] = array();

        while ($row = mysqli_fetch_array($result)) {
            // temp user array
            $sub_category = array();
            $sub_category["idSub_category"] = $row["idSub_category"];
            $sub_category["sub_category_name"] = $row["sub_category_name"];
            $sub_category["sub_cat_image"] = $row["sub_cat_image"];

            // push single product into final response array
            array_push($response["sub_category"], $sub_category);
        }
        // success
        $response["success"] = 1;

        // echoing JSON response
        echo json_encode($response);
    } else {
        // no products found
        $response["success"] = 0;
        $response["message"] = "No sub categories found";

        // echo no users JSON
        echo json_encode($response);
    }
}else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "cat_id field required";

    // echo no users JSON
    echo json_encode($response);
}