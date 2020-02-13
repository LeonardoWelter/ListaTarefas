<?php

// Classe responsável pela realização de todas as operações
// envolvendo os dados da aplicação;
class TarefaService {
	private $conexao;
	private $tarefa;

	// Recebe na instância um Objeto Conexao e um Objeto Tarefa
	// e atribui esses valores a si mesmo;
	public function __construct(Conexao $conexao, Tarefa $tarefa) {
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	// Insere dados na tabela tb_tarefas
	public function inserir() {
		$query = 'INSERT INTO tb_tarefas (tarefa) values (:tarefa)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->getTarefa());
		$stmt->execute();
	}

	// Recupera as tarefas de tb_tarefas, e o status (string) de tb_status
	// utilizando um LEFT JOIN
	public function recuperar() {
		$query = 'SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t
				  LEFT JOIN tb_status AS s ON (t.idStatus = s.id)';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	// Atualiza uma tarefa de tb_tarefas
	public function atualizar() {
		$query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':tarefa', $this->tarefa->getTarefa());
		$stmt->bindValue(':id', $this->tarefa->getId());
		return $stmt->execute();
	}

	// Remove uma tabela de tb_tarefas
	public function remover() {
		$query = "DELETE FROM tb_tarefas WHERE id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->tarefa->getId());
		$stmt->execute();
	}

	// Atualiza o status de uma tarefa para realizado
	public function concluir() {
		$query = "UPDATE tb_tarefas SET idStatus = :idStatus WHERE id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':idStatus', $this->tarefa->getIdStatus());
		$stmt->bindValue(':id', $this->tarefa->getId());
		return $stmt->execute();
	}

	// Recupera somente as tarefas com status PENDENTE
	public function recuperarPendentes() {
		$query = 'SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t
				  LEFT JOIN tb_status AS s ON (t.idStatus = s.id) WHERE t.idStatus = :idStatus';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':idStatus', $this->tarefa->getIdStatus());
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}