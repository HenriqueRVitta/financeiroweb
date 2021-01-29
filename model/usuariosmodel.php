<?php

class usuarios {
	
	private $senha;
	private $nome;
	private $ativo;
	private $perfil;
	private $id;
	private $email;
	private $unidade;
	private $sobrenome;
	private $solicitasenha;
	
	/**
	 * ...
	 * getters e setters
	 * ...
	 *
	 */

	  // $senha
	  public function getSenha() {
	    return $this->senha;
	  }
	  public function setSenha($senha) {
	    $this->senha = $senha;
	  }
	
	  // $nome
	  public function getNome() {
	    return $this->nome;
	  }
	  public function setNome($nome) {
	    $this->nome= $nome;
	  }

	  // $ativo
	  public function getAtivo() {
	  	return $this->ativo;
	  }
	  public function setAtivo($ativo) {
	  	$this->ativo = $ativo;
	  }

	  // $perfil
	  public function getPerfil() {
	    return $this->perfil;
	  }
	  public function setPerfil($perfil) {
	    $this->perfil = $perfil;
	  }	  
	  
	  // $perfil
	  public function getId() {
	    return $this->id;
	  }
	  public function setId($id) {
	    $this->id = $id;
	  }	  
	  
	  // $unidade
	  public function getUnidade() {
	    return $this->unidade;
	  }
	  
	  public function setUnidade($unidade) {
	    $this->unidade = $unidade;
	  }
	  
	  // $email
	  public function getEmail() {
	    return $this->email;
	  }	  
	  public function setEmail($email) {
	    $this->email = $email;
	  }
	  
	  	  
	  // $sobrenome
	  public function getSobrenome() {
	    return $this->sobrenome;
	  }
	  public function setSobrenome($sobrenome) {
	    $this->sobrenome = $sobrenome;
	  }

	  // $solicitasenha
	  public function getSolicitasenha() {
	    return $this->solicitasenha;
	  }
	  
	  public function setSolicitasenha($solicitasenha) {
	    $this->solicitasenha = $solicitasenha;
	  }

	  
	public function save() {
	 // logica para salvar cliente no banco
	 }
	  
	 public function update() {
	 // logica para atualizar cliente no banco
	 }
	  
	 public function remove() {
	 // logica para remover cliente do banco
	 }
	  
	 public function listAll() {
	 // logica para listar toodos os clientes do banco
	 }
	  
	 /**
	 * ...
	 * outros métodos de abstração de banco
	 * ...
	 *
	 */
	 	  
}

?>
