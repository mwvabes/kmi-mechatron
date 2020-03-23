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

$application->email = $data->email;
$application->name = $data->name;
$application->surname = $data->surname;
$application->authors = $data->authors;
$application->affiliation = $data->affiliation;
$application->title = $data->title;
$application->category = $data->category;
$application->regulations = $data->regulations;

if (
    !empty($application->email) &&
    !empty($application->name) &&
    !empty($application->surname) &&
    !empty($application->affiliation) &&
    !empty($application->title) &&
    !empty($application->category) &&
    !empty($application->regulations) &&
    $application->create()
) {
    http_response_code(200);
    echo json_encode(array("message" => "Application was created."));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create application."));
}
