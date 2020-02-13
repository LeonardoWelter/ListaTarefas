<?php

// Classe responsável pela instância da conexão com o SGBD;
class Conexao {

	// Dados da conexão com o SGBD
	private $HOST = 'localhost';   // Hostname
	private $DBNAME = 'DBNAME';  // Schema ou Database
	private $USUARIO = 'USUARIO'; // Usuário
	private $SENHA = 'SENHA*';      // Senha

	// Função responsável pela conexão com o SGBD, utilizando os dados inseridos anteriormente
	// Retorna a conexão ou caso dê algum erro, mostra uma mensagem de erro.
	public function conectar() {
		try {
			// Utiliza o DSN do SGBD MySQL, podendo ser livremente alterado;
			$conexao = new PDO(
				"mysql:host=$this->HOST;dbname=$this->DBNAME",
				"$this->USUARIO",
				"$this->SENHA");

			return $conexao;
		} catch (PDOException $e) {
			echo '<p>'.$e.getMessage().'</p>';
		}
	}
}