<?php

function mysqlConnect()
{
  $db_host = "fdb33.awardspace.net"; // endereço do servido do MySQL
  $db_username = "4003175_bd1"; // usuario para acessar banco de dados
  $db_password = "]!UHp%)r9NR?!z2O"; // senha para acessar banco de dados
  $db_name = "4003175_bd1"; // nome do banco de dados ao qual se pretende acessar

  // dsn é apenas um acrônimo de database source name
  $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements (executam de forma nativa)
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // erros tratado atraves do lançamento de exceções    
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // altera o modo padrão do método fetch para FETCH_ASSOC
  ];

  try {
    $pdo = new PDO($dsn, $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
  }
}

/*
Executar MySql
  $pdo->prepare("Codigo SQL");
  $pdo->execute(...) ;
  // utilizado quando o código inclui dados fornecidos pelos usuario
  
  $pdo->exec("Código SQL"); 
  // utilizado quando a operação não devolve nenhum resultado, não há processamento do resultado
  $pdo->query("Código SQL");
  // há resultado para processamento
*/

?>