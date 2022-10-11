<?php
include("conn.php");
session_start();

$sqlTipo = "SELECT * FROM area_vagas";

$resTipo = mysqli_query($conn, $sqlTipo);

$sqlUsuario = "SELECT * FROM usuario_empresa WHERE email ";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['btnCadastrar'])) {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : $_POST[''];
        $email = isset($_POST['email']) ? $_POST['email'] : $_POST[''];
        $senha = isset($_POST['senha']) ? $_POST['senha'] : $_POST[''];

        $checkemail = "SELECT * FROM usuario_empresa WHERE email = '$email'";
        $run = mysqli_query($conn, $checkemail);
        $data = mysqli_fetch_array($run, MYSQLI_NUM);

        if ($data[0] > 0) {
            echo "<script>alert('Esse email já existe')</script>";
            echo "<script>location.href='usuario.php'</script>";
            exit();
            
            } else {
                $sql = "INSERT INTO usuario_empresa (nome_empresa,email,senha)
                VALUES ('$nome','$email', MD5('$senha'))";
        
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Cadastro efetuado!')</script>";
                    echo "<script>location.href='login.php'</script>";
                } else {
                    echo "Erro: " . mysqli_error($conn);
                }
            }            

       
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" type="image/x-icon" href="img/icone.ico">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Emprego_sempre</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/usuempresa.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <?php include('navempresa.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid my-5 py-5  ">
                <h1 class=" text-center text-white">Cadastre a sua empresa</h1>
                <ol class="breacrumb ">
                </ol>
                <div class="container col-lg-12 my-5">
                    <form method="POST" class="row needs-validation">
                        <div class="col-lg-5">
                            <label class="form-label text-white ">Nome da empresa</label>
                            <input type="text" name="nome" id="nome" required class="my-1 form-control">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label text-white">Email da empresa</label>
                            <input type="email" name="email" id="email" required class="my-1 form-control">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="form-label text-white">Crie sua senha</label>
                            <input type="password" name="senha" id="senha" required class="my-1 form-control">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-12 my-1">
                            <button type="submit" name="btnCadastrar" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <div class="container-fluid bg-primary fixed-bottom">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 ">
                <div class="col mb-3">
                    <p class="text">© Guilherme Campos Machado 2022</p>
                </div>

                <div class="col">

                </div>

                <div class="col ">
                    <h5>Ajuda</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="#" class="nav-link p-0 text">Fale conosco</a></li>
                        <li class="nav-item"><a href="#" class="nav-link p-0 text">Precisa de ajuda?</a></li>

                    </ul>
                </div>

                <div class="col">
                    <h5>Redes sociais</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item heigth"><a href="../https://www.facebook.com/" class="nav-link p-0 text"><img src="img/img-original/face-removebg-preview.png" style="height: 25px;"></a></li>
                        <li class="nav-item  heigth"><a href="../https://twitter.com/" class="nav-link p-0 text"><img src="img/img-original/twit.png" style="height: 27px;"></a></li>
                        <li class="nav-item  heigth"><a href="#" class="nav-link p-0 text"><img src="img/img-original/iconewhats.png" style="height: 27px;"></a></li>

                    </ul>
                </div>

            </footer>
        </div>
    </div>
    </div>



    <script>
        validacao = document.getElementById('')
    </script>




    <script src="js/valid.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>