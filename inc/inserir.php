<?php 
header ('Content-type: text/html; charset=utf-8');
/* Seta configuração para não dar timeout */
ini_set('max_execution_time','-1');

/* Require com a classe de importação construída */
require 'ImportaPlanilha.class.php';

/* Instância conexão PDO com o banco de dados */
//$pdo = new PDO('mysql:host=localhost;dbname=videoke', 'root');

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'octoberfest';
 
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(PDOException $e){
    echo $e->getMessage();
}	



//$arquivo = $_FILES['file']['name'];
$arquivo = 'lista_videoke.xlsx';

/* Instância o objeto importação e passa como parâmetro o caminho da planilha e a conexão PDO */
$obj = new ImportaPlanilha($arquivo, $pdo);

/* Chama o método que retorna a quantidade de linhas */
echo 'Quantidade de Linhas na Planilha ' , $obj->getQtdeLinhas(), '<br>';

/* Chama o método que retorna a quantidade de colunas */
echo 'Quantidade de Colunas na Planilha ' , $obj->getQtdeColunas(), '<br>';

/* Chama o método que inseri os dados e captura a quantidade linhas importadas */
$linhasImportadas = $obj->insertDados();

/* Imprime a quantidade de linhas importadas */
echo 'Foram importadas ', $linhasImportadas, ' linhas';

?>


