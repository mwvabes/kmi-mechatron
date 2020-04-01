<?php
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once 'config/database.php';
include_once 'objects/application.php';

$database = new Database();
$db = $database->getConnection();

$application = new Application($db);

$data = json_decode(file_get_contents("php://input"));

$application->id = $data->id;

if (
    !empty($application->id) &&
    $application->remove()
) {
    http_response_code(200);
    echo json_encode(array("message" => "Application was removed."));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to remove application."));
}
