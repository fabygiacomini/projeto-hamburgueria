<?php

$operacao = $_GET; // guarda em formato de array os parametros que foram enviados na url
// $_GET['operacao'] = 'mostrarTudo'; ->> isso equivale ao $_GET da linha superior e está armazenado em $operacao (como um array)
$parametroDoCorpoDaUrl = $_POST; // guarda em formato de array os parametros que foram enviados no corpo da requisicao post
// var_dump($parametroDoCorpoDaUrl);
// echo '<pre>';
// var_dump($operacao);
// echo json_encode($teste, true);



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


function recuperaProdutos() 
{
  $conexao = criaConexao();
  $consulta = $conexao->prepare('SELECT * FROM produto');
  $consulta->execute();

  return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

// var_dump(recuperaProdutos());

if ($operacao['operacao'] == 'mostrarTudo') {
  $resultado = recuperaProdutos();
  echo json_encode($resultado);
}
