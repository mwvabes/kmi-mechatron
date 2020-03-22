<?php

class Application
{
    private $conn;
    private $table_name = "application";

    public $id;
    public $email;
    public $name;
    public $surname;
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
                email = :email,
                name = :name,
                surname = :surname,
                authors = :authors,
                affiliation = :affiliation,
                title = :title,
                category = :category,
                regulations = :regulations";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->authors = htmlspecialchars(strip_tags($this->authors));
        $this->affiliation = htmlspecialchars(strip_tags($this->affiliation));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->regulations = htmlspecialchars(strip_tags($this->regulations));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
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
}
