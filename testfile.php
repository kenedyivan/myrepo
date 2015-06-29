<?php

$response = array();

/*$jsonData = '{
    "u1":{ "user":"John", "age":22, "country":"United States" },
    "u2":{ "user":"Will", "age":27, "country":"United Kingdom" },
    "u3":{ "user":"Abiel", "age":19, "country":"Mexico" }
    }';*/

if(isset($_POST["user"])) {
    $file = fopen("test.txt", "w");

    $phpArray = json_decode($_POST["user"], true);
    foreach ($phpArray as $key => $value) {

        fwrite($file, "$key| $value");
        fwrite($file,"\r\n");
    }


    $response["success"] = 1;
    $response["message"] = "writing to file successful";
    echo json_encode($response);

    fclose($file);
}else {
    // failed to insert row
    $response["success"] = 0;
    $response["message"] = "field(s) required";

    // echoing JSON response
    echo json_encode($response);
}


