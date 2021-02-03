<?php

class Unidade {
	
	private $id;
	private $nome;
	private $cnpj;
	private $enderecc;
	private $bairro;
	private $cep;
	private $cidade;
	private $fone;
	private $celular;
	private $email;
	private $responsavel;
	private $situacao; // Ativo ou Inativo
	
	/**
	 * ...
	 * getters e setters
	 * ...
	 *
	 */

	// $nome
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}	

	// $cnpj
	public function getCnpj(){
		return $this->cnpj;
	}
	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}

	// $endereco
	public function getEndereco(){
		return $this->endereco;
	}
	public function  setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	// $bairro
	public function getBairro(){
		return $this->bairro;
	}
	public function setBairro($bairro){
		$this->bairro = $bairro;
	}
	
	// $cep
	public function getCep(){
		return $this->cep;
	}
	public function setCep($cep){
		$this->cep = $cep;
	}
	
	// $cidade
	public function getCidade(){
		return $this->cidade;
	}
	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
		
	// $fone
	public function getFone(){
		return $this->fone;
	}
	public function setFone($fone){
		$this->fone = $fone;
	}
	
	// $celular
	public function getCelular(){
		return $this->celular;
	}
	public function setCelular($celular){
		$this->celular = $celular;
	}

	// $email
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}

	// $responsavel
	public function getResponsavel(){
		return $this->responsavel;
	}
	public function setResponsavel($responsavel){
		$this->responsavel = $responsavel;
	}

	// $situacao
	public function getSituacao(){
		return $this->situacao;
	}
	public function setSituacao($situacao){
		$this->situacao = $situacao;
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
	 * outros m�todos de abstra��o de banco
	 * ...
	 *
	 */
	 	
}
?>