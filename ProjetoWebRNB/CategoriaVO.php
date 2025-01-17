<?php
class CategoriaVO {
    private $id;
    private $acao;
    private $horror;
    private $fantasia;
    private $cyberpunk;

    public function __construct($id, $acao, $horror, $fantasia, $cyberpunk) {
        $this->id = $id;
        $this->acao = $acao;
        $this->horror = $horror;
        $this->fantasia = $fantasia;
        $this->cyberpunk = $cyberpunk;
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getAcao() { return $this->acao; }
    public function getHorror() { return $this->horror; }
    public function getFantasia() { return $this->fantasia; }
    public function getCyberpunk() { return $this->cyberpunk; }

    public function setId($id) { $this->id = $id; }
    public function setAcao($acao) { $this->acao = $acao; }
    public function setHorror($horror) { $this->horror = $horror; }
    public function setFantasia($fantasia) { $this->fantasia = $fantasia; }
    public function setCyberpunk($cyberpunk) { $this->cyberpunk = $cyberpunk; }
}
?>
