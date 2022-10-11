<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}
$usuario = $_SESSION['user_id'];



$sqlarea = "SELECT * FROM area_vagas";
$resarea = mysqli_query($conn, $sqlarea);

$id = $_GET['id'];


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['btnatt'])) {
        $area = $_POST['area'];
        $email = $_POST['email'];
        $nome_vaga = $_POST['nome_vaga'];
        $desc = $_POST['descri'];

        if (isset($_POST['stat'])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $sqlup = "UPDATE cadastro_vagas c
        SET c.nome_vagas = '$nome_vaga', c.email_envio = '$email', c.id_area = '$area', c.desc_vagas = '$desc', c.status = '$status' WHERE c.id_cadastro_vagas = '$id';";
        if (mysqli_query($conn, $sqlup)) {
            echo ' <script> alert("atualizado") </script>';
        } else {
            echo ("error");
        }
    }
}

$sql = "SELECT *
FROM cadastro_vagas AS c
INNER JOIN area_vagas AS a ON a.id_area = c.id_area where id_cadastro_vagas ='$id'";
$res = mysqli_query($conn, $sql);

while ($linha = mysqli_fetch_assoc($res)) {
    $nome_vaga = $linha['nome_vagas'];
    $email = $linha['email_envio'];
    $area = $linha['nome_area'];
    $desc = $linha['desc_vagas'];
    $status = $linha['status'];
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
    <title>Emprego sempre</title>
    <link rel="icon" type="image/x-icon" href="img/icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/editar.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

    <?php include('navempresa.php'); ?>

    <main>

        <div id="layoutSidenav_content">
            <div class="container-fluid  ">
                <div class="container  ">
                    <form method="POST" class="row mt-editar">
                        <h2 class="text-white text-center">Atualize os dados da vaga</h2>
                        <div class="col-lg-4 pt-5 ">
                            <label class="form-label text-white">Alterar nome da vaga</label>
                            <input type="text" name="nome_vaga" id="nome_vaga" value="<?php echo $nome_vaga ?>" required class="my-1 form-control">
                        </div>
                        <div class="col-lg-4 pt-5 ">
                            <label class="form-label text-white">Alterar email do RH</label>
                            <input type="email" name="email" id="email" value="<?php echo $email ?>" required class="my-1 form-control">
                        </div>
                        <div class="col-lg-5 pt-5">
                            <label class="form-label text-white ">Informações da vaga</label>
                            <textarea class="form-control" id="descri" name="descri"><?php echo $desc ?></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-4 pt-5">
                            <label class="form-label text-white ">Altere a area da vaga</label>
                            <select class="form-select" name="area" id="area" aria-label="Default select example">
                                <?php while ($linha = mysqli_fetch_assoc($resarea)) { ?>
                                    <option class="text-dark" <?php echo ($area == $linha['nome_area']) ? "selected" : ""; ?> value="<?php echo $linha['id_area'] ?>"><?php echo $linha['nome_area'] ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-check my-1 mx-3">
                            <input class="form-check-input" type="checkbox" value="1" name="stat" id="stat" <?php if ($status == "1") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Ativa/Inativa
                            </label>
                        </div>
                        <div class="col-md-12 my-1">
                            <button type="submit" name="btnatt" id="btnatt" class="btn btn-success">Atualizar</button>
                        </div>


                    </form>

                </div>
            </div>
            
    </main>


    <div class="container-fluid bg-primary fixed-bottom ">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5">
            <div class="col">
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
                    <li class="nav-item "><a href="#" class="nav-link p-0 text">Fale conosco</a></li>
                    <li class="nav-item "><a href="#" class="nav-link p-0 text">Precisa de ajuda?</a></li>

                </ul>
            </div>

            <div class="col ">
                <h5>Redes sociais</h5>
                <ul class="nav flex-column">
                    <li class="nav-item  heigth"><a href="../https://www.facebook.com/" class="nav-link p-0 text"><img src="img/img-original/face-removebg-preview.png" style="height: 25px;"></a></li>
                    <li class="nav-item  heigth"><a href="../https://twitter.com/" class="nav-link p-0 text"><img src="img/img-original/twit.png" style="height: 27px;"></a></li>
                    <li class="nav-item  heigth"><a href="#" class="nav-link p-0 text"><img src="img/img-original/iconewhats.png" style="height: 27px;"></a></li>

                </ul>
            </div>

        </footer>
    </div>


    




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</body>

</html>