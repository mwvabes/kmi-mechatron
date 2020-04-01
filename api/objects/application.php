<?php

class Application
{
    private $conn;
    private $table_name = "application";

    public $id;
    public $user_id;
    public $authors;
    public $affiliation;
    public $title;
    public $category;
    public $regulations;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
            SET
                user_id = :user_id,
                authors = :authors,
                affiliation = :affiliation,
                title = :title,
                category = :category,
                regulations = :regulations,
                status = 'złożone'";

        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->authors = htmlspecialchars(strip_tags($this->authors));
        $this->affiliation = htmlspecialchars(strip_tags($this->affiliation));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->regulations = htmlspecialchars(strip_tags($this->regulations));

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':authors', $this->authors);
        $stmt->bindParam(':affiliation', $this->affiliation);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':regulations', $this->regulations);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function remove()
    {
        $query = "DELETE FROM " . $this->table_name . "
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
