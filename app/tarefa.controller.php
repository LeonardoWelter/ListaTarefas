<?php

	// Imports da dependências
	require 'tarefa.model.php';
	require 'tarefa.service.php';
	require 'conexao.php';

	// Verifica se uma ação foi passada via GET,
	// se não foi, busca a ação na página de origem
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	// Decide a operação que será realizada com base na ação recebida,
	// Instancia uma Tarefa e uma Conexão, para poder instanciar
	// TarefaService, que realiza as operações da aplicação.
	if ($acao == 'inserir') {
		$tarefa = new Tarefa();
		$tarefa->setTarefa($_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();

		header('Location: novaTarefa.php?inclusao=1');
	} else if($acao == 'recuperar') {

		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();
	} else if($acao == 'atualizar') {
		$tarefa = new Tarefa();
		$tarefa->setId($_POST['id']);
		$tarefa->setTarefa($_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->atualizar()) {
			if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('Location: index.php');
			} else {
				header('Location: todasTarefas.php');
			}
		}
	} else if($acao == 'remover') {

		$tarefa = new Tarefa();
		$tarefa->setId($_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();

		if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('Location: index.php');
		} else {
			header('Location: todasTarefas.php');
		}

	} else if($acao == 'concluir') {

		$tarefa = new Tarefa();
		$tarefa->setId($_GET['id']);
		$tarefa->setIdStatus(2);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->concluir();

		if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('Location: index.php');
		} else {
			header('Location: todasTarefas.php');
		}

	} else if ($acao == 'recuperarPendentes') {

		$tarefa = new Tarefa();
		$tarefa->setIdStatus(1);
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperarPendentes();
	}