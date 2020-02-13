<?php

// Script que realiza a criação das tabelas necessárias para a execução da aplicação,
// é necessário que haja um Schema criado previamente, visto que usa a classe Conexao
// para conectar-se ao SGBD;

// Import da classe conexao
require 'conexao.php';
// Instância da classe Conexao
$conexao = new Conexao();

// tb_status tabela que mantém os possíveis status das tarefas;
$tb_status = '
create table tb_status (
	id int auto_increment
		primary key,
	status varchar(25) not null)';

// tb_tarefas mantém as tarefas em sim, id, idStatus e dataCadastrado são preenchidos automaticamente;
$tb_tarefas = 'create table tb_tarefas(
	id int auto_increment
		primary key,
	idStatus int default 1 not null,
	tarefa text not null,
	dataCadastrado datetime default CURRENT_TIMESTAMP not null,
	constraint tb_tarefas_ibfk_1
		foreign key (idStatus) references tb_status (id))';

// index id_Status
$index_status = 'create index idStatus	on tb_tarefas (idStatus)';

// Inserção dos status utilizados na aplicação
$insertStatus = 'insert into tb_status(status)values("pendente"), ("realizado")';

// Realiza a conexão com o SGBD
$stmt = $conexao->conectar();

// Realiza a execução das querys e cria as tabelas.
$stmt->exec($tb_status);
$stmt->exec($tb_tarefas);
$stmt->exec($index_status);
$stmt->exec($insertStatus);