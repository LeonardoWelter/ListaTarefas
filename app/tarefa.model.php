<?php


// Classe responsável pela instanciação de tarefas,
// contém os mesmos atributos da Tabela e seus métodos getters e setters;
class Tarefa {
	private $id;
	private $idStatus;
	private $tarefa;
	private $dataCadastro;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id): void
	{
		$this->id = $id;
	}

	public function getIdStatus()
	{
		return $this->idStatus;
	}

	public function setIdStatus($idStatus): void
	{
		$this->idStatus = $idStatus;
	}

	public function getTarefa()
	{
		return $this->tarefa;
	}

	public function setTarefa($tarefa): void
	{
		$this->tarefa = $tarefa;
	}

	public function getDataCadastro()
	{
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro): void
	{
		$this->dataCadastro = $dataCadastro;
	}


}