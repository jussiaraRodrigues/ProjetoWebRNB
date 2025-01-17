<?php
include_once 'db_config.php';
include_once 'SiteVO.php';

class SiteDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(SiteVO $site) {
        $query = 'INSERT INTO site SET link=:link, livros=:livros';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':link', $site->getLink());
        $stmt->bindParam(':livros', $site->getLivros());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = 'SELECT * FROM site';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = 'SELECT * FROM site WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(SiteVO $site) {
        $query = 'UPDATE site SET link = :link, livros = :livros WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $site->getId());
        $stmt->bindParam(':link', $site->getLink());
        $stmt->bindParam(':livros', $site->getLivros());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = 'DELETE FROM site WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
