<?php
class SiteVO {
    private $id;
    private $link;
    private $livros;

    public function __construct($id, $link, $livros) {
        $this->id = $id;
        $this->link = $link;
        $this->livros = $livros;
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getLink() { return $this->link; }
    public function getLivros() { return $this->livros; }

    public function setId($id) { $this->id = $id; }
    public function setLink($link) { $this->link = $link; }
    public function setLivros($livros) { $this->livros = $livros; }
}
?>
