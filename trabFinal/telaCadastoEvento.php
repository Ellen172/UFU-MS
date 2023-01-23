
<?php

require "conexaoMySql.php";
$pdo = mysqlConnect();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Gestão de eventos</title>
</head>
<body>
  <div class="container">
    <form action="cadastrarEvento.php" method="POST">
        
      <h1>Criar evento</h1>

        <p class="escolha">Escolha o local:</p>
        <div class="form-check form-check-inline">        
            <?php

              try {

                $sql = <<<SQL

                SELECT ms_local.custo_venda, ms_endereco.cep, ms_endereco.logradouro, ms_endereco.nro, 
                  ms_endereco.bairro, ms_endereco.cidade, ms_endereco.estado, ms_local.url_img, ms_local.id
                FROM ms_local join ms_endereco on ms_local.id_endereco = ms_endereco.id; 
                SQL;

                $stmt = $pdo->query($sql);
              } 
              catch (Exception $e) {
                exit('Ocorreu uma falha: ' . $e->getMessage());
              }

            while ($row = $stmt->fetch()) {
              $cep = htmlspecialchars($row['cep']);
              $logradouro = htmlspecialchars($row['logradouro']);
              $nro = htmlspecialchars($row['nro']);
              $bairro = htmlspecialchars($row['bairro']);
              $cidade = htmlspecialchars($row['cidade']);
              $estado = htmlspecialchars($row['estado']);
              $custoLocal = $row['custo_venda'];
              $imgLocal = $row['url_img'];

              $idLocal = $row['id'];

              $stringLocal = "local_" . $idLocal;

              echo <<<HTML
                <div class="form-check form-check-inline">
                    <input type="hidden" name="localValor" value=$custoLocal>
                    <input class="form-check-input" type="radio" name="local" id=$stringLocal value=$stringLocal>
                    <label class="form-check-label" for=$stringLocal>
                      <p><img src=$imgLocal class="imageRadio"></p>
                      $cep<br>$logradouro, $nro<br>$bairro<br>$cidade - $estado<br> Valor: R$ $custoVenda 
                    </label>
                </div>
              HTML;

            }

            ?>
        </div>  

        <div class="form-group row">
          <label for="dataEvento" class="col-sm-4 col-form-label">Escolha a data do evento:</label>
          <div class="col-sm-10">
            <input type="date" class="form-control-plaintext" id="dataEvento" name="dataEvento">
          </div>
        </div>

        <p class="escolha">Escolha o seu tema:</p>   
        <div class="form-check form-check-inline">
            <?php

              try {

                $sql1 = <<<SQL

                select ms_tema.id as idTema, ms_tema.nome as nomeTema, ms_tema.custo_pacote as custoTema, ms_tema.url_img as imgTema
                from ms_tema;
                SQL;

                $stmt1 = $pdo->query($sql1);
              
              } 
              catch (Exception $e) {
                exit('Ocorreu uma falha: ' . $e->getMessage());
              }

              
              while ($row = $stmt1->fetch()) {

                $nomeTema = htmlspecialchars($row['nomeTema']);
                $custoTema = htmlspecialchars($row['custoTema']);
                $idTema = htmlspecialchars($row['idTema']);
                $imgTema = htmlspecialchars($row['imgTema']);

                $stringTema = "local_" . $idTema;
  
                echo <<<HTML
                  <div class="form-check form-check-inline">
                    <input type="hidden" name="temaValor" value=$custoTema>
                    <input class="form-check-input" type="radio" name="tema" id=$stringTema value=$stringTema >
                      <label class="form-check-label" for=$stringTema>
                        <p><img src=$imgTema class="imageRadio"></p>
                        $nomeTema por R$$custoTema
                    
                HTML;

                  try {

                    $sql2 = <<<SQL

                    SELECT ms_tema_produto.qtd_produto as qtdProduto, ms_produto.nome as nomeProduto
                    FROM ms_tema_produto join ms_produto 
                    on ms_produto.id = ms_tema_produto.id_produto 
                    WHERE ms_tema_produto.id_tema= "{$idTema}"; 
                    SQL;

                    $stmt2 = $pdo->query($sql2);
                  } 
                  catch (Exception $e) {
                    exit('Ocorreu uma falha: ' . $e->getMessage());
                  }

                  while ($row = $stmt2->fetch()) {
                    $qtdProduto = htmlspecialchars($row['qtdProduto']);
                    $nomeProduto = htmlspecialchars($row['nomeProduto']);

                    echo <<<HTML
                          <br>$qtdProduto qtd(s) de $nomeProduto  
                    HTML;

                  }
                  
                  echo <<<HTML
                    </label></div>  
                  HTML;
              }

            ?>
        </div>

        <p class="escolha">Escolha o seu pacote:</p>   
        <div class="form-group">
            <?php
                try {

                  $sql3 = <<<SQL

                  SELECT id, nome, custo_venda 
                  FROM `ms_pacoteEvento` 
                  SQL;

                  $stmt3 = $pdo->query($sql3);

                } 
                catch (Exception $e) {
                  exit('Ocorreu uma falha: ' . $e->getMessage());
                }

                while ($row = $stmt3->fetch()) {

                  $idPacoteEvento = htmlspecialchars($row['id']);
                  $nomePacoteEvento = htmlspecialchars($row['nome']);
                  $custoPacote = htmlspecialchars($row['custo_venda']);

                  $stringPacote = "local_" . $idPacoteEvento;

                  echo <<<HTML
                    <div class="form-check">
                      <input type="hidden" name="pacoteValor" value=$custoPacote>
                      <input class="form-check-input" type="radio" name="pacoteEvento" id=$stringPacote value=$stringPacote>
                        <label class="form-check-label" for=$stringPacote>
                          $nomePacoteEvento por R$$custoPacote

                  HTML;

                    try {

                      $sql4 = <<<SQL

                      SELECT ms_pacoteEvento_produto.qtd_produto, ms_produto.nome as nomeProduto
                      FROM ms_pacoteEvento_produto join ms_produto 
                      on ms_produto.id = ms_pacoteEvento_produto.id_produto 
                      where ms_pacoteEvento_produto.id_pacoteEvento = "{$idPacoteEvento}"; 
                      SQL;

                      $stmt4 = $pdo->query($sql4);
                    } 
                    catch (Exception $e) {
                      exit('Ocorreu uma falha: ' . $e->getMessage());
                    }

                    while ($row = $stmt4->fetch()) {
                      $qtdProdutoPacote = htmlspecialchars($row['qtdProduto']);
                      $nomeProduto = htmlspecialchars($row['nomeProduto']);

                      echo <<<HTML
                          <br>$qtdProdutoPacote qtd(s) de $nomeProduto  
                      HTML;

                    }

                    echo <<<HTML
                        </label></div>
                    HTML;

                }

                ?>
        </div>

        <p class="escolha">Escolha os serviços adicionais</p>
        <div class="form-group">        
            <?php

              try {

                $sql = <<<SQL

                SELECT id, tipo_servico, custo_venda FROM ms_servico
                SQL;

                $stmt = $pdo->query($sql);
              } 
              catch (Exception $e) {
                exit('Ocorreu uma falha: ' . $e->getMessage());
              }

            while ($row = $stmt->fetch()) {
              $idServico = $row['id'];
              $tipoServico = $row['tipo_servico'];
              $custoServico = $row['custo_venda'];

              $stringServico = "servico_" . $idServico;

              echo <<<HTML
                <div class="form-check form-check-inline">
                    <input type="hidden" name="servicoValor" value=$custoServico>
                    <input class="form-check-input" type="radio" name="servico" id=$stringServico value=$stringServico>
                    <label class="form-check-label" for=$stringServico>
                      $tipoServico por R$ $custoServico
                    </label>
                </div>
              HTML;

            }

            ?>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>

    </form>    

  </div>

    <?php
      mysqli_close($conn);
    ?>

</body>
</html>