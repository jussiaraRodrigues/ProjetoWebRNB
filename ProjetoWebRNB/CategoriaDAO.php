<?php
include_once 'db_config.php';
include_once 'CategoriaVO.php';

class CategoriaDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(CategoriaVO $categoria) {
        $query = 'INSERT INTO categoria SET acao=:acao, horror=:horror, fantasia=:fantasia, cyberpunk=:cyberpunk';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':acao', $categoria->getAcao());
        $stmt->bindParam(':horror', $categoria->getHorror());
        $stmt->bindParam(':fantasia', $categoria->getFantasia());
        $stmt->bindParam(':cyberpunk', $categoria->getCyberpunk());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = 'SELECT * FROM categoria';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = 'SELECT * FROM categoria WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(CategoriaVO $categoria) {
        $query = 'UPDATE categoria SET acao = :acao, horror = :horror, fantasia = :fantasia, cyberpunk = :cyberpunk WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $categoria->getId());
        $stmt->bindParam(':acao', $categoria->getAcao());
        $stmt->bindParam(':horror', $categoria->getHorror());
        $stmt->bindParam(':fantasia', $categoria->getFantasia());
        $stmt->bindParam(':cyberpunk', $categoria->getCyberpunk());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = 'DELETE FROM categoria WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
