
<?php

require "conexaoMySql.php";
$pdo = mysqlConnect();

try {

    $sql = <<<SQL
    SELECT 
        ms_evento.data_evento, ms_evento.custo_venda,
        ms_tema.nome as nome_tema, 
        ms_servico.tipo_servico, 
        ms_pacoteEvento.nome as nome_pacote,
        ms_endereco.cep, ms_endereco.logradouro, ms_endereco.nro, ms_endereco.bairro, ms_endereco.cidade, ms_endereco.estado
    FROM ms_evento 
    join ms_tema on ms_evento.id_tema = ms_tema.id
    join ms_servico on ms_evento.id_servico = ms_servico.id
    join ms_pacoteEvento on ms_pacoteEvento.id = ms_evento.id_pacote
    join ms_local on ms_evento.id_local = ms_local.id
    join ms_endereco on ms_endereco.id = ms_local.id_endereco
    SQL;
  
    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }

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
        <h3>Eventos Cadastrados</h3>
        <table class="table table-striped table-hover">
        <tr>
            <th>Data</th>
            <th>Local</th>
            <th>Tema</th>
            <th>Pacote</th>
            <th>Serviço adicional</th>
            <th>Custo</th>
        </tr>

        <?php
        while ($row = $stmt->fetch()) {

            $data = new DateTime($row['data_evento']);
            $dataFormatoDiaMesAno = $data->format('d-m-Y');
            
            $cep = $row['cep'];
            $logradouro = $row['logradouro'];
            $nro = $row['nro'];
            $bairro = $row['bairro'];
            $cidade = $row['cidade'];
            $estado = $row['estado'];

            $nome_tema = $row['nome_tema'];
            $nome_pacote = $row['nome_pacote'];
            $tipo_servico = $row['tipo_servico'];
            $custo_evento = $row['custo_venda'];

            echo <<<HTML
            <tr>
                <td>$dataFormatoDiaMesAno</td> 
                <td>$cep $logradouro, $nro $bairro $cidade - $estado</td>
                <td>$nome_tema</td>
                <td>$nome_pacote</td>
                <td>$tipo_servico</td>
                <td>$custo_evento</td>
            </tr>      
            HTML;

        }
        ?>

        </table>
    </div>

</body>
</html>