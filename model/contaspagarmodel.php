<?php

class contaspagar {

  private $id;
  private $datainclusao;
  private $usuarioinclusao;
  private $fornecedor;
  private $historico;
  private $datavencto;
  private $datapagto;
  private $valor;
  private $documento;
  private $formapagto;
  private $nrodocumento;
  private $unidade;
  private $tipodocumento;
  
	/**
	 * ...
	 * getters e setters
	 * ...
	 *
	 */

	  // $id
	  public function getId() {
	    return $this->id;
	  }
	  public function setId($id) {
	    $this->id = $id;
	  }
	
	  // $Datainclusao
	  public function getDatainclusao() {
	    return $this->datainclusao;
	  }
	  public function setDatainclusao($datainclusao) {
	    $this->datainclusao = $datainclusao;
	  }

	  // $usuarioinclusao
	  public function getUsuarioinclusao() {
	    return $this->usuarioinclusao;
	  }
	  public function setUsuarioinclusao($usuarioinclusao) {
	    $this->usuarioinclusao = $usuarioinclusao;
	  }
	  
	  // $fornecedor
	  public function getFornecedor() {
	    return $this->fornecedor;
	  }
	  public function setFornecedor($fornecedor) {
	    $this->fornecedor = $fornecedor;
	  }
	  
	  // $historico
	  public function getHistorico() {
	    return $this->historico;
	  }
	  public function setHistorico($historico) {
	    $this->historico = $historico;
	  }
	  
	  // $datavencto
	  public function getDatavencto() {
	    return $this->datavencto;
	  }
	  public function setDatavencto($datavencto) {
	    $this->datavencto = $datavencto;
	  }
	  
	  // $datapagto
	  public function getDatapagto() {
	    return $this->datapagto;
	  }
	  public function setDatapagto($datapagto) {
	    $this->datapagto = $datapagto;
	  }
	  
	  // $valor
	  public function getValor() {
	    return $this->valor;
	  }
	  public function setValor($valor) {
	    $this->valor = $valor;
	  }
	  
	  // $documento - arquivo anexado
	  public function getDocumento() {
	    return $this->documento;
	  }
	  public function setDocumento($documento) {
	    $this->documento = $documento;
	  }
	  
	  // $formapagto
	  public function getFormapagto() {
	    return $this->formapagto;
	  }
	  public function setFormapagto($formapagto) {
	    $this->formapagto = $formapagto;
	  }

	  // $nrodocumento
	  public function getNrodocumento() {
	    return $this->nrodocumento;
	  }
	  public function setNrodocumento($nrodocumento) {
	    $this->nrodocumento = $nrodocumento;
	  }
	  	  
	  // $unidade
	  public function getUnidade() {
	    return $this->unidade;
	  }
	  public function setUnidade($unidade) {
	    $this->unidade = $unidade;
	  }
	  
	  // $tipodocumento
	  public function getTipodocumento() {
	    return $this->tipodocumento;
	  }
	  public function setTipodocumento($tipodocumento) {
	    $this->tipodocumento = $tipodocumento;
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
