<?php
/*

// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:stellantis.database.windows.net,1433; Database = SGE", "Adm", "Stellantis@2023");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "Adm", "pwd" => "Stellantis@2023", "Database" => "SGE", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:stellantis.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
    //aqui é só um exemplo para não rodar o script abaixo sem necessidade
    //if ((isset($_POST['causal']))&&(!empty($_POST['causal']))){
    
    //porta, usuário, senha, nome data base
    //caso não consiga conectar mostra a mensagem de erro mostrada na conexão
    //$conexao = mysqli_connect("stellantis.database.windows.net", "Adm", "Stellantis@2023", "SGE") or die("Erro na conexão com banco de dados " . mysqli_error($conexao));

    // PHP Data Objects(PDO) Sample Code:
    $servername = "stellantis.database.windows.net";
    $username = "Adm";
    $password = "Stellantis@2023";
    $dbname = "SGE";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão bem-sucedida";
    } catch(PDOException $e) {
        echo "Falha na conexão: " . $e->getMessage();
    }

    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');

    function inserirDados($id, $TestCell, $causal, $hora_inicio, $hora_final, $obs, $date) {
        global $conn;
    
        $stmt = $conn->prepare("INSERT INTO tabela (id, TestCell, causal, hora_inicio, hora_final, obs, date) 
                               VALUES (:id, :TestCell, :causal, :hora_inicio, :hora_final, :obs, :date)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':TestCell', $TestCell);
        $stmt->bindParam(':causal', $causal);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_final', $hora_final);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':date', $date);
    
        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso";
        } else {
            echo "Falha ao inserir dados";
        }
    }
    
    // Exemplo de uso da função
    $id = 1;
    $TestCell = "Valor TestCell";
    $causal = "Valor causal";
    $hora_inicio = "Valor hora_inicio";
    $hora_final = "Valor hora_final";
    $obs = "Valor obs";
    $date = "Valor date";

    inserirDados($id, $TestCell, $causal, $hora_inicio, $hora_final, $obs, $date);
*/

//CONEXAO AZURE
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "stellantis.mysql.database.azure.com", "nadvxertwb", "Stellantis@2023", "sge", 3306, MYSQLI_CLIENT_SSL);
//porta, usuário, senha, nome data base
//caso não consiga conectar mostra a mensagem de erro mostrada na conexão
//$conexao = mysqli_connect("stellantis.mysql.database.azure.com", "nadvxertwb", "Stellantis@2023", "sge") or die("Erro na conexão com banco de dados " . mysqli_error($conexao));

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');

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
}

$conexao -> close();

?>

<link rel="stylesheet" href="./botao_return.css">
<html>
    <div>
        <a href="./teste.html" class="button" style="font-size: 50px;">Registrar outro causal</a>
    </div>
</html>
