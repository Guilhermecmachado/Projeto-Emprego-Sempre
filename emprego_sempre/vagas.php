<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}
$usuario = $_SESSION['user_id'];

$sqlTipo = "SELECT * FROM area_vagas";

$resTipo = mysqli_query($conn, $sqlTipo);

$sqlUsuario = "SELECT * FROM cadastro_vagas";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['btnCadastrar'])) {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : $_POST[''];
        $email = isset($_POST['email']) ? $_POST['email'] : $_POST[''];
        $desc = isset($_POST['desc']) ? $_POST['desc'] : $_POST[''];
        $area = isset($_POST['area']) ? $_POST['area'] : $_POST[''];
        $status = isset($_POST['stat']) ? $_POST['stat'] : $_POST[''];




        $sql = "INSERT INTO cadastro_vagas (nome_vagas,email_envio,desc_vagas,id_area,id_usuario,status)
        VALUES ('$nome','$email','$desc','$area','$usuario',$status)";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Cadastro efetuado!')</script>";
            echo "<script>location.href='indexempresa.php'</script>";
        } else {
            echo "Erro: " . mysqli_error($conn);
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
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/vagas.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="sb-nav-fixed">
    <?php include('navempresa.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid ">
                <div class="container">
                    <h1 class="mt-5 pt-5 text-center text-white">Cadastre a Vaga da Empresa</h1>
                    <ol class="breacrumb mb-4">
                    </ol>
                </div>
                <div class="container col-lg-12  ">
                    <form method="POST" class="row needs-validation">
                        <div class="col-lg-5">
                            <label class="form-label text-success">Nome da vaga</label>
                            <input type="text" name="nome" id="nome" required class="my-1 form-control">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label text-success">Insira o email do RH</label>
                            <input type="email" name="email" id="email" required class="my-1 form-control">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label text-success ">Informações</label>
                            <textarea class="form-control" id="desc" name="desc"></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label class="form-label text-success ">Area de atuação</label>
                            <select class="form-select" name="area" id="area" aria-label="Default select example">
                                <?php while ($linha = mysqli_fetch_assoc($resTipo)) { ?>
                                    <option class="text-dark" value="<?php echo $linha['id_area']; ?>"><?php echo $linha['nome_area']; ?> </option>
                                <?php } ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-check my-1 mx-3 text-success">
                            <input class="form-check-input" type="checkbox" value="1" name="stat" id="stat">
                            <label class="form-check-label" for="flexCheckChecked">
                                status
                            </label>
                        </div>

                        <div class="col-lg-12 my-1">
                            <button type="submit" name="btnCadastrar" class="btn btn-success">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <div class="container-fluid bg-primary fixed-bottom">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 ">
                <div class="col mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <p class="text">© Guilherme Campos Machado 2022</p>
                </div>


                <div class="col">
                    <h5>Ajuda</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="#" class="nav-link p-0 text">Fale conosco</a></li>
                        <li class="nav-item"><a href="#" class="nav-link p-0 text">Precisa de ajuda?</a></li>

                    </ul>
                </div>

                <div class="col mb-3 ">
                    <h5>Redes sociais</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item  heigth"><a href="../https://www.facebook.com/" class="nav-link p-0 text"><img src="img/img-original/face-removebg-preview.png" style="height: 25px;"></a></li>
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