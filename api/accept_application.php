<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

$sts = 'zaakceptowane';
$id = $data->id;

$query = "UPDATE application SET status = :sts WHERE id = :id";

$stmt = $db->prepare($query);
$stmt->bindParam(':sts', $sts);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo json_encode(array("message" => "Updated."));
    http_response_code(200);
} else {
    echo json_encode(array("message" => "Error."));
    http_response_code(401);
}
