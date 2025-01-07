<?php 
//CONFIGURAÇÕES GERAIS
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "primeiro_banco";

    //CONEXÃO
    try{
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $erro){
        echo "Falha ao se conectar com o banco!";
    }
    

    //FUNÇÃO PARA LIMPAR ENTRADAS
    function limparPost($dado){
        $dado = trim($dado);
        $dado = stripcslashes($dado);
        $dado = htmlspecialchars($dado);
        return $dado;
    }
?>