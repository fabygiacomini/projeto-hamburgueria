<?php

/**
 * Cria a conexão com o banco de dados
 * 
 * @return PDO instância de conexão ao banco de dados
 */
function criaConexao() 
{
  $user = 'root';
  $password = 'root';
  $db = 'banco_hamburgueria';
  $host = 'localhost';
  $port = 8889;

  try {
    $conexao = new PDO("mysql:host=$host;dbname=$db", $user, $password);
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }
  return $conexao;
}


/**
 * Recupera todos os pedidos já feitos (histórico)
 * @return array 
 */
function recuperaPedidos() // historico
{
  $conexao = criaConexao();
  $consulta = $conexao->prepare(
    "SELECT c.nome AS nomeCliente, p.nome AS nomeProd, i.quantidade, ped.*, DATE_FORMAT(ped.data, \"%d-%m-%Y\") AS dataFormatada
     FROM 
      cliente c
      JOIN
      pedido ped ON c.id_cli = ped.id_cli
      JOIN
      itens i ON ped.id_pedido = i.id_pedido
      JOIN
      produto p ON i.id_prod = p.id_prod
      ORDER BY id_pedido;"
  );
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Insere o pedido realizado no banco de dados
 * @param array $itensDoPedido itens do pedido transferidos do js
 * @param int $idDoCliente id do cliente atualmente comprando
 * @return array mensagem de sucesso ou falha
 */
function insereNovoPedido($itensDoPedido, $idCliente)
{

  try {
    $conexao = criaConexao();

    $totalDoPedido = 0;

    foreach ($itensDoPedido as $item) {
      $totalDoPedido += $item['preco'] * $item['quantidade'];
    }

    $criaPedido = $conexao->prepare("INSERT INTO pedido (id_cli, total) VALUES ($idCliente, $totalDoPedido)");
    $criaPedido->execute();
  
    $idDoNovoPedidoInserido = $conexao->lastInsertId();
  
    // registra os itens do pedido na tabela itens bd
    foreach ($itensDoPedido as $item) {
      $sqlDeInsercaoNaTabelaItens = "INSERT INTO itens (id_pedido, id_prod, quantidade) 
        VALUES ($idDoNovoPedidoInserido, " . $item['id_prod'] . ", " . $item['quantidade'] . ")";

      $criaRegistroEmItens = $conexao->prepare($sqlDeInsercaoNaTabelaItens);
      $criaRegistroEmItens->execute();
    }
  } catch(Exception $e) {
    return ['mensagem' => 'houve uma falha ao salvar: ' . $e->getMessage()];
  }

  return [
    'mensagem' => 'Pedido salvo com sucesso!',
    'id_pedido' => $idDoNovoPedidoInserido,
  ];
}

/**
 * mostra todos os produtos disponíveis para a tela inicial
 * @return array
 */
function recuperaProdutos() 
{
  $conexao = criaConexao();
  $consulta = $conexao->prepare('SELECT * FROM produto');
  $consulta->execute();

  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Pega os dados do pedido atual
 * @param int $idPedido id do pedido
 * @return array
 */
function acompanharPedido($idPedido)
{
  $conexao = criaConexao();
  $consulta = $conexao->prepare(
    "SELECT ped.id_pedido, c.nome, p.nome, i.id_item, p.preco, ped.status
    FROM 
      cliente c
      JOIN
      pedido ped ON c.id_cli = ped.id_cli
      JOIN
      itens i ON ped.id_pedido = i.id_pedido
      JOIN
      produto p ON i.id_prod = p.id_prod
      WHERE ped.id_pedido = $idPedido"
  );
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC); 
}


/**
 * Filtra os pedidos que foram realizados em uma determinada data
 * @param string $dataBuscada data informada no formato 'yyyy-mm-dd'
 * @return array
 */
function pedidosPorData($dataBuscada)
{
  $conexao = criaConexao();
  $consultaData = 
    "SELECT c.nome AS nomeCliente, p.nome AS nomeProd, i.quantidade, ped.*, DATE_FORMAT(ped.data, \"%d-%m-%Y\") AS dataFormatada
    FROM 
      cliente c
      JOIN
      pedido ped ON c.id_cli = ped.id_cli
      JOIN
      itens i ON ped.id_pedido = i.id_pedido
      JOIN
      produto p ON i.id_prod = p.id_prod
    WHERE ped.data LIKE \"%$dataBuscada%\"";

  $consulta = $conexao->prepare($consultaData);
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Cadastra um cliente no banco de dados
 * @param array $dadosDoFormdados inseridos no formulário de cadastro
 * @return array mensagem de sucesso ou falha
 */
function cadastrarNovoCliente($dadosDoForm)
{

  try {

    $conexao = criaConexao();
    $sqlInsercaoDdeNovoCliente = "INSERT INTO cliente (nome, endereco, cidade, telefone, email, senha) VALUES (:nome, :endereco, :cidade, :telefone, :email, :senha)";
    // OU
    // $sqlInsercaoDdeNovoCliente = "INSERT INTO cliente (nome, endereco, cidade, telefone, email, senha) VALUES (" . $dadosDoForm['nome'] . "," . $dadosDoForm['endereco'] . "," . $dadosDoForm['cidade'] . "," . $dadosDoForm['telefone'] . ","  . $dadosDoForm['email'] . "," . $dadosDoForm['senha'] . ")";

    $cadastrarCliente = $conexao->prepare($sqlInsercaoDdeNovoCliente);

    // parâmetros: placeholder, valor a ser substituído no placeholder e o tipo de dado (nesse caso string) - medida de segurança
    $cadastrarCliente->bindParam(':nome', $dadosDoForm['nome'], PDO::PARAM_STR);
    $cadastrarCliente->bindParam(':endereco', $dadosDoForm['endereco'], PDO::PARAM_STR);
    $cadastrarCliente->bindParam(':cidade', $dadosDoForm['cidade'], PDO::PARAM_STR);
    $cadastrarCliente->bindParam(':telefone', $dadosDoForm['telefone'], PDO::PARAM_STR);
    $cadastrarCliente->bindParam(':email', $dadosDoForm['email'], PDO::PARAM_STR);
    $cadastrarCliente->bindParam(':senha', $dadosDoForm['senha'], PDO::PARAM_STR);
    $cadastrarCliente->execute();

  } catch(Exception $e) {
    return ['mensagem' => 'Houve uma falha ao cadastrar cliente: ' . $e->getMessage()];
  }

  return [
    'mensagem' => 'Cliente cadastrado com sucesso!',
  ];
}

/**
 * Recupera todos os clientes já cadastrados
 * @return array
 */
function recuperaClientes()
{
  $conexao = criaConexao();
  $consulta = $conexao->prepare("SELECT * FROM cliente ORDER BY nome");
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Deleta cliente cadastrado do banco
 * @param integer $idClienteADeletar número de identificação do cliente a ter seu cadastro deletado
 * @return array mensagem de sucesso ou falha
 */
function deletarCliente ($idClienteADeletar)
{
  try {
    $conexao = criaConexao();
    $deletaCliente = $conexao->prepare("DELETE FROM cliente WHERE id_cli = $idClienteADeletar;");
    $deletaCliente->execute();
  } catch(Exception $e) {
    return ['mensagem' => 'Houve uma falha ao deletar cliente: ' . $e->getMessage()];
  }

  return [
    'mensagem' => 'Cliente removido com sucesso!',
  ]; 
}

/**
 * Busca cliente por nome na tabela clientes
 * @param string $nomeCliente nome do cliente inserido no formulário de busca
 * @return array
 */
function buscarClientePorNome($nomeCliente)
{ 
  $conexao = criaConexao();
  $consulta = $conexao->prepare("SELECT * FROM cliente WHERE nome LIKE \"%$nomeCliente%\" ORDER BY nome;");
  $consulta->execute();
  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}


$postJson = file_get_contents('php://input');
$operacao = $_GET;

// VERIFICACOES: verifica qual operacao foi passada pelo javascript através do parametro na URL
// para definir o que vai fazer

if ($operacao['operacao'] == 'mostrarTudo') {
  $resultado = recuperaProdutos();
  echo json_encode($resultado);
}


if ($operacao['operacao'] == 'novoPedido') {
  $informacoesDosItens = json_decode($postJson, true);
  $idDoCliente = $_GET['id_cli'];
  $resultado = insereNovoPedido($informacoesDosItens, $idDoCliente);
  echo json_encode($resultado);
}


if ($operacao['operacao'] == 'listarTodosPedidos') {  // historico
  $resultado = recuperaPedidos();
  echo json_encode($resultado);
}


if ($operacao['operacao'] == 'acompanharPedido') {
  $idDoPedido = $_GET['idPedido'];
  $resultado = acompanharPedido($idDoPedido); 
  echo json_encode($resultado);
}


if ($operacao['operacao'] == 'filtrar') {
  $dataBuscada = $_GET['dataFormatada'];
  $resultado = pedidosPorData($dataBuscada); 
  echo json_encode($resultado);
}

if ($operacao['operacao'] == 'cadastrarClientes') {
  $dadosDoForm = $_POST;
  $resultado = cadastrarNovoCliente($dadosDoForm);
  echo json_encode($resultado);
}

if ($operacao['operacao'] == 'listarClientes') {
  $resultado = recuperaClientes();
  echo json_encode($resultado);
}

if ($operacao['operacao'] == 'deletarCliente') {
  $idClienteADeletar = $_GET['id_cli'];
  $resultado = deletarCliente($idClienteADeletar);
  echo json_encode($resultado);
}

if ($operacao['operacao'] == 'buscarClienteNome') {
  $nomeCliente = $_GET['nomeCliente'];
  $resultado = buscarClientePorNome($nomeCliente);
  echo json_encode($resultado);
}