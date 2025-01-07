<?php
    require('config/conexao.php');

     //VERIFICAR SE TEM AUTORIZAÇÃO
     $sql = $pdo->prepare("SELECT * FROM usuarios WHERE token=? LIMIT 1");
     $sql->execute(array($_SESSION['TOKEN']));
     $usuario = $sql->fetch(PDO::FETCH_ASSOC);

     //SE NÃO ENCONTRAR USUÁRIO
     if(!$usuario){
         header('location: index.php');
     }else{
         echo "<h1> SEJA BEM-VINDO <b style='color: red'>".$usuario['nome']."!</b>";
         echo "<br><br><a style='padding: 10px; background: green; color: white; text-decoration: none; border-radius: 5px' href='logout.php'>Sair do sistema</a>";
     }

     
    // //VERIFICAÇÃO DE AUTENTICAÇÃO
    // $user = auth($_SESSION['TOKEN']);
    // if($user){
    //     echo "<h1> SEJA BEM-VINDO <b style='color: red'>".$user['nome']."!</b>";
    //     echo "<br><br><a style='padding: 10px; background: green; color: white; text-decoration: none; border-radius: 5px' href='logout.php'>Sair do sistema</a>";
    // }else{
    //     header('location: index.php');
    // }