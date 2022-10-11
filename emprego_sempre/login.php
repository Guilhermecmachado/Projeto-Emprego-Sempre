<?php
session_start();
session_unset();
include("conn.php");
$usuario = "";
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST["senha"])) {
        $senha = $_POST["senha"];
        $usuario = $_POST["email"];

        $sql = "SELECT email,
                id_usuario,
                case when senha = MD5('$senha') then 1 ELSE 0 END AS status
                FROM usuario_empresa
                WHERE email = '$usuario'";

        $tabela = (mysqli_query($conn, $sql));
        $retorno = (mysqli_num_rows($tabela));
        if ($retorno == 0) {
            $mensagem = ("<div class='alert alert-warning my-2 p-1'> Usuário inválido </div>");
        } else {
            $linha = mysqli_fetch_assoc($tabela);
            if ($linha["status"] == 0) {
                $mensagem = ('<div class="alert alert-danger fw-bold my-2 p-1">Senha incorreta.</div>');
            } else {
                $_SESSION["user_id"] = $linha["id_usuario"];
                $_SESSION["user_name"] = $linha["nome"];
                $_SESSION["user_email"] = $linha["email"];
                header('location:indexempresa.php');
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
    <title>Emprego-sempre</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/logintemplate.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>



    <?php include('navempresa.php'); ?>
    <main>

        <div class="container">
            <div id="layoutSidenav_content">
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-6 my-5 px-5 ">
                            <div class=" py-2 my-3 rounded-3">
                                <div class="pb-5 ">
                                    <div class="container mt-5">
                                        <h1 class="mt-5 text-white text-center">Entrar</h1>

                                        <label class="form-label text-white">Email da empresa</label>
                                        <input type="text" name="email" id="email" class="form-control">

                                        <label class="form-label text-white  mt-4">Senha</label>
                                        <input type="password" name="senha" id="senha" class="form-control">

                                        <button type="submit" name="btnCadastrar" class="btn btn-success mt-4">Logar</button>
                                        <?php echo $mensagem ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <div class="container-fluid bg-primary fixed-bottom">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 ">
            <div class="col mb-3">
               
                <p class="text">© Guilherme Campos Machado 2022</p>
            </div>


            <div class="col mb-3 ">
                <h5>Ajuda</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text">Fale conosco</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text">Precisa de ajuda?</a></li>

                </ul>
            </div>

            <div class="col mb-3 ">
                <h5>Redes sociais</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2 heigth"><a href="../https://www.facebook.com/" class="nav-link p-0 text"><img src="img/img-original/face-removebg-preview.png" style="height: 25px;"></a></li>
                    <li class="nav-item mb-2 heigth"><a href="../https://twitter.com/" class="nav-link p-0 text"><img src="img/img-original/twit.png" style="height: 27px;"></a></li>
                    <li class="nav-item mb-2 heigth"><a href="#" class="nav-link p-0 text"><img src="img/img-original/iconewhats.png" style="height: 27px;"></a></li>

                </ul>
            </div>

        </footer>
    </div>

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