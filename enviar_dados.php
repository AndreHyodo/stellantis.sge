<?php
    //aqui é só um exemplo para não rodar o script abaixo sem necessidade
    if ((isset($_POST['causal']))&&(!empty($_POST['causal']))){
    
    //porta, usuário, senha, nome data base
    //caso não consiga conectar mostra a mensagem de erro mostrada na conexão
    //$conexao = mysqli_connect("stellantis.database.windows.net", "Adm", "Stellantis@2023", "SGE") or die("Erro na conexão com banco de dados " . mysqli_error($conexao));

    // PHP Data Objects(PDO) Sample Code:
    try {
        $conexao = new PDO("sqlsrv:server = tcp:stellantis.database.windows.net,1433; Database = SGE", "Adm", "Stellantis@2023");
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
    
    if(!empty($_POST)) {
        try {
        $TestCell = $_POST['TestCell']; 
        $causal = $_POST['causal'];
        $obs = $_POST['obs'];
        $data = date ("Y/m/d");
        $hora = date("H:i:s");
        $data = date();
        // Insert data
        $sql_insert = "INSERT INTO " . $TestCell . " (id, TestCell, causal, hora_incio, hora_final, obs, `date`) VALUES (null, '$TestCell', '$causal', '$hora', '', '$obs', '$data')";
    
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(2, $causal);
        $stmt->bindValue(3, $data);
        $stmt->bindValue(4, $hora);
        $stmt->bindValue(5, $hora);
        $stmt->bindValue(6, $obs);
        $stmt->bindValue(7, $TestCell);
        $stmt->execute();
        }
        catch(Exception $e) {
        die(var_dump($e));
        }
        echo "<h3>Your're registered!</h3>";
    }


    /*
    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "Adm", "pwd" => "Stellantis@2023", "Database" => "SGE", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:stellantis.database.windows.net,1433";
    $conexao = sqlsrv_connect($serverName, $connectionInfo);
        
    
    
    //Abaixo atribuímos os valores provenientes do formulário pelo método POST
    $TestCell = $_POST['TestCell']; 
    $causal = $_POST['causal'];
    $obs = $_POST['obs'];
    $data = date ("Y/m/d");
    $hora = date("H:i:s");

    $sql = "INSERT INTO " . $TestCell . " (id, TestCell, causal, hora_incio, hora_final, obs, `date`) VALUES (null, '$TestCell', '$causal', '$hora', '', '$obs', '$data')";
    
    $resultado = $conexao->query($sql) or trigger_error($conexao->error);

    if($resultado==true){
        echo "dados inseridos com sucesso";
    }else{
        echo "erro";
    }*/

    $conexao -> close();
    }
?>

<link rel="stylesheet" href="./botao_return.css">
<html>
    <div>
        <a href="./teste.html" class="button" style="font-size: 50px;">Registrar outro causal</a>
    </div>
</html>
