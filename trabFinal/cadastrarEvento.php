<?php

require "conexaoMySql.php";
$pdo = mysqlConnect();


$localValor = $_POST["localValor"] ?? "";
$temaValor = $_POST["temaValor"] ?? "";
$pacoteValor = $_POST["pacoteValor"] ?? "";
$servicoValor = $_POST["servicoValor"] ?? "";

$custoPrimario = $localValor + $temaValor + $pacoteValor + $servicoValor;
$custoFinal = $custoPrimario + (0.3*$custoPrimario);

$local = $_POST["local"] ?? "";
$idLocal = explode("_", $local)[1];

$dataEvento = $_POST["dataEvento"] ?? "";

$tema = $_POST["tema"] ?? "";
$idTema = explode("_", $tema)[1];

$pacoteEvento = $_POST["pacoteEvento"] ?? "";
$idPacote = explode("_", $pacoteEvento)[1];

$servico = $_POST["servico"] ?? "";
$idServico = explode("_", $servico)[1];

try {

  $sql = <<<SQL
  -- Repare que a coluna Id foi omitida por ser auto_increment
  INSERT INTO ms_evento (data_evento, custo_venda, id_tema, id_servico, id_pacote, id_local)
  VALUES (?, ?, ?, ?, ?, ?)
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois precisamos
  // cadastrar dados fornecidos pelo usuário 
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $dataEvento, $custoFinal, $idTema, $idServico, $idPacote, $idLocal
  ]);

  header("location: index.html");
  exit();
} 
catch (Exception $e) {  
  //error_log($e->getMessage(), 3, 'log.php');
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

