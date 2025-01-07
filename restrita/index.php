<?php
require_once('../class/config.php');
require_once('../autoload.php');
require_once('../db/conexao.php');

$login = new Login();
$login->isAuth($_SESSION['TOKEN']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restrita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        nav {
            box-shadow: 0 3px 0.4px rgb(237, 236, 236);
        }


        table{
            border-collapse: collapse;
            width: 100%;
            border-radius:5px;
        }

        th, td{
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
            
        }

        input{
            border-radius:5px;
        }

        a{
            text-decoration:none;
        }

        a:hover{
            text-decoration:underline;
        }

        footer {
            margin-top:40px;
            border-top: 1px solid gray;
        }

        .oculto{
            display:none;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Navegação -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-cursor"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Portfólio</a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-person-lines-fill"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-person"></i> Conta</button>
                                </li>
                                <li><a class="dropdown-item" href="../saindo.php"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="mt-5 text-center">
            <h1>
                <?php echo "Seja bem-vindo à área restrita $login->nome!"; ?>
            </h1>
        </div>
        <hr>
        <form id="form_salva" method="post" class="text-center">
            <label class="fs-4" style="color:gray;">Adicionar Cliente <i class="bi bi-arrow-right"></i> </label>
            <input type="text" name="nome" placeholder="Nome do cliente" required>
            <input type="email" name="email" placeholder="Email do cliente" required>
            <button type="submit" style="border-radius:5px;" name="salvar"><i class="bi bi-plus-circle-dotted"></i> Adicionar</button>
        </form>

        <form id="form-atualiza" class="oculto" method="post">
            <input type="hidden" id="id_editado" name="id_editado" placeholder="ID" required>
            <input type="text" id="nome_editado" name="nome_editado" placeholder="Editar Nome" required>
            <input type="email" id="email_editado" name="email_editado" placeholder="Editar Email" required>
            <button type="submit" name="atualizar"><i class='bi bi-arrow-repeat'></i> Atualizar</button>
            <button type="button" id="cancelar" name="cancelar"><i class="bi bi-x-octagon"></i> Cancelar</button>
        </form>

        <form id="form-deleta" class="oculto" method="post">
            <input type="hidden" id="id_deleta" name="id_deleta" placeholder="ID" required>
            <input type="hidden" id="nome_deleta" name="nome_deleta" placeholder="Editar Nome" required>
            <input type="hidden" id="email_deleta" name="email_deleta" placeholder="Editar Email" required>
            <b>Tem certeza que quer deletar cliente <span id="cliente"></span>?</b>
            <button type="submit" name="deletar"><i class="bi bi-trash3"></i> Deletar</button>
            <button type="button" id="cancelar_delete" name="cancelar_delete"><i class="bi bi-x-octagon"></i> Cancelar</button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Informações de Cadastro</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo "Aqui estão as informações sobre sua conta, $login->nome:"; ?>
                        <div class="row mt-3 mb-3">

                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Cadastro</th>
                            </tr>

                            <tr>
                                <td><?php echo "'$login->nome'"; ?></td>
                                <td><?php echo "'$login->email'"; ?></td>
                                <td><?php echo "'$login->data'"; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar <i class="bi bi-x-square"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php //INSERIR DADOS
        //INSERIR DADOS NO BANCO (modo simples)

        // $sql = $pdo->prepare("INSERT INTO clientes VALUES (null, 'André', 'teste@teste.com', '17-12-2024')");
        // $sql->execute();

        //SQL INJECTION (modo correto anti-sql_Injection) !!

        if( isset($_POST['salvar']) && isset($_POST['nome']) && isset($_POST['email']) ){
            $nome = limparPost($_POST['nome']);
            $email = limparPost($_POST['email']);
            $data = date('d-m-Y');

            //VALIDAÇÃO CAMPO VAZIO
            if($nome == "" || $nome == null){
                echo "<b style='color:red'>Por favor, informe um Nome</b>";
                exit();
            } 
            
            if($nome == "" || $nome == null){
                echo "<b style='color:red'>Por favor, informe um Email</b>";
                exit();
            }

            //VALIDAÇÕES NOME E EMAIL
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
                echo "<b style='color:red'>Apenas letras e espaços em branco são permitidos</b>";
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<b style='color:red'>Formato de email Inválido!</b>";
                exit();
            }


            $sql = $pdo->prepare("INSERT INTO clientes VALUES (null, ?, ?, ?)");
            $sql->execute(array($nome, $email, $data));

            echo "<b style='color:green'>Cliente inserido com sucesso</b>";
        }
    ?>

    <?php //ATUALIZAR
        //PROCESSO DE ATUALIZAÇÃO
        if(isset($_POST['atualizar']) && isset($_POST['id_editado']) && isset($_POST['nome_editado']) && isset($_POST['email_editado'])){
            $id = limparPost($_POST['id_editado']);
            $nome = limparPost($_POST['nome_editado']);
            $email = limparPost($_POST['email_editado']);

            //VALIDAÇÃO CAMPO VAZIO
            if($nome == "" || $nome == null){
                echo "<b style='color:red'>Por favor, informe um Nome</b>";
                exit();
            } 
            
            if($nome == "" || $nome == null){
                echo "<b style='color:red'>Por favor, informe um Email</b>";
                exit();
            }

            //VALIDAÇÕES NOME E EMAIL
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
                echo "<b style='color:red'>Apenas letras e espaços em branco são permitidos</b>";
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<b style='color:red'>Formato de email Inválido!</b>";
                exit();
            }
            //COMANDO PARA ATUALIZAR BANCO


            $sql = $pdo->prepare("UPDATE clientes SET nome=?, email = ? WHERE id=?");
            $sql->execute(array($nome,$email,$id));
            echo "Atualizado ".$sql->rowCount()." registros.";
        }
    ?>

   <?php //DELETAR
    //DELETAR INFORMAÇÃO
        if(isset($_POST['deletar']) && isset($_POST['id_deleta']) && isset($_POST['nome_deleta']) && isset($_POST['email_deleta'])){
                $id = limparPost($_POST['id_deleta']);
                $nome = limparPost($_POST['nome_deleta']);
                $email = limparPost($_POST['email_deleta']);

                //COMANDO PARA DELETAR
                $sql = $pdo->prepare("DELETE FROM clientes WHERE id=? AND nome = ? AND email = ?");
                $sql->execute(array($id, $nome, $email));

                echo "Cliente deletado com sucesso!";

            }
   ?>

    <?php //SELECIONAR OS DADOS
        //SELECIONAR DADOS DA TABELA
        $sql = $pdo->prepare("SELECT * FROM clientes");
        $sql -> execute();
        $dados = $sql->fetchAll();

        //EXEMPLO COM FILTRAGEM
        /*
        $sql = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $email = 'teste@teste.com';
        $sql -> execute(array($email));
        $dados = $sql->fetchAll();
        */
    ?>

    <?php //TABELA

        if(count($dados)>0){
            echo " <br><br>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>";

                foreach($dados as $chave => $valor){
                    echo " <tr>
                                <td>".$valor['id']."</td>
                                <td>".$valor['nome']."</td>
                                <td>".$valor['email']."</td>
                                <td>".$valor['data_cadastro']."</td>
                                <td><a href='#' class='btn-atualizar' data-id='".$valor['id']."' data-nome='".$valor['nome']."' data-email='".$valor['email']."'><i class='bi bi-arrow-repeat'></i> Atualizar</a> | <a href='#' class='btn-deletar' data-id='".$valor['id']."' data-nome='".$valor['nome']."' data-email='".$valor['email']."'>Deletar <i class='bi bi-x-circle'></i></a></td>
                           </tr>";
                }
            
            echo "</table>";
        }else{
            echo "<p style='color:red;' class='animate__animated animate__headShake text-center mt-3'>Nenhum Cliente Cadatrado!</p>";
        }

    ?>

     <!-- Rodapé -->
     <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 container">
        <div class="col-md-4 d-flex align-items-center">
            <a href="#" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <i class="bi bi-droplet-half"></i>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2025 - ASC - Todos os Direitos Reservados | <a href="#home">Termos</a></span>
        </div>
        <ul class="nav justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-instagram"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><i class="bi bi-facebook"></i></a></li>
        </ul>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script> //CLIQUES DOS BOTÕES
        $(".btn-atualizar").click(function(){
            var id = $(this).attr('data-id');
            var nome = $(this).attr('data-nome');
            var email = $(this).attr('data-email');

            $('#form_salva').addClass('oculto');
            $('#form-atualiza').removeClass('oculto');
            $('#form-deleta').addClass('oculto');

            $("#id_editado").val(id);
            $("#nome_editado").val(nome);
            $("#email_editado").val(email);

        });

        $(".btn-deletar").click(function(){
            var id = $(this).attr('data-id');
            var nome = $(this).attr('data-nome');
            var email = $(this).attr('data-email');

            $("#id_deleta").val(id);
            $("#nome_deleta").val(nome);
            $("#email_deleta").val(email);
            $("#cliente").html(nome);
           

            $('#form_salva').addClass('oculto');
            $('#form-atualiza').addClass('oculto');
            $('#form-deleta').removeClass('oculto');

        });

        $('#cancelar').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form-atualiza').addClass('oculto');
            $('#form-deleta').addClass('oculto');
        });

        $('#cancelar_delete').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form-atualiza').addClass('oculto');
            $('#form-deleta').addClass('oculto');
        });
    </script>

</body>

</html>
