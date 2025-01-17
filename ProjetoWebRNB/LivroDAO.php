<?php
include_once 'db_config.php';
include_once 'LivroVO.php';

class LivroDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function insert(LivroVO $livro) {
        $query = 'INSERT INTO livro SET nome=:nome, valor=:valor, curtida=:curtida, site=:site, categoria=:categoria, descricao=:descricao, comentario=:comentario';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':nome', $livro->getNome());
        $stmt->bindParam(':valor', $livro->getValor());
        $stmt->bindParam(':curtida', $livro->getCurtida());
        $stmt->bindParam(':site', $livro->getSite());
        $stmt->bindParam(':categoria', $livro->getCategoria());
        $stmt->bindParam(':descricao', $livro->getDescricao());
        $stmt->bindParam(':comentario', $livro->getComentario());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAll() {
        $query = 'SELECT * FROM livro';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = 'SELECT * FROM livro WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(LivroVO $livro) {
        $query = 'UPDATE livro SET nome = :nome, valor = :valor, curtida = :curtida, site = :site, categoria = :categoria, descricao = :descricao, comentario = :comentario WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $livro->getId());
        $stmt->bindParam(':nome', $livro->getNome());
        $stmt->bindParam(':valor', $livro->getValor());
        $stmt->bindParam(':curtida', $livro->getCurtida());
        $stmt->bindParam(':site', $livro->getSite());
        $stmt->bindParam(':categoria', $livro->getCategoria());
        $stmt->bindParam(':descricao', $livro->getDescricao());
        $stmt->bindParam(':comentario', $livro->getComentario());

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = 'DELETE FROM livro WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
