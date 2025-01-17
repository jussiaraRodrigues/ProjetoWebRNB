<?php
class LivroVO {
    private $id;
    private $nome;
    private $valor;
    private $curtida;
    private $site;
    private $categoria;
    private $descricao;
    private $comentario;

    public function __construct($id, $nome, $valor, $curtida, $site, $categoria, $descricao, $comentario) {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->curtida = $curtida;
        $this->site = $site;
        $this->categoria = $categoria;
        $this->descricao = $descricao;
        $this->comentario = $comentario;
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getValor() { return $this->valor; }
    public function getCurtida() { return $this->curtida; }
    public function getSite() { return $this->site; }
    public function getCategoria() { return $this->categoria; }
    public function getDescricao() { return $this->descricao; }
    public function getComentario() { return $this->comentario; }

    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setValor($valor) { $this->valor = $valor; }
    public function setCurtida($curtida) { $this->curtida = $curtida; }
    public function setSite($site) { $this->site = $site; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function setComentario($comentario) { $this->comentario = $comentario; }
}
?>
