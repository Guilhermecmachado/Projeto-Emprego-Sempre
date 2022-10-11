<?php
include("conn.php");
session_start();
if (!isset($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}

$usuario = $_SESSION['user_id'];

$sql = "SELECT e.id_ensino,e.nome_ensino,u.id_usuario_curri,u.nome,u.id_zona,u.desc_usuario,z.nome_zona,u.id_usuario_curri,u.email_usuario
FROM usuario_curri AS u
INNER JOIN zona AS z ON z.id_zona = u.id_zona
INNER JOIN escolaridade as e on e.id_ensino = u.id_ensino";

$rescandi = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $idzona = $_POST['filzona'];
    $idensino = $_POST['filensino'];

    if (isset($_POST['btnfil'])) {
        if ($idzona != 0 && $idensino != 0) {
            echo '<script></script>';
            $sql = "SELECT e.id_ensino,e.nome_ensino,u.id_usuario_curri,u.nome,u.id_zona,u.desc_usuario,z.nome_zona,u.id_usuario_curri,u.email_usuario
        FROM usuario_curri AS u
        INNER JOIN zona AS z ON z.id_zona = u.id_zona
        INNER JOIN escolaridade as e on e.id_ensino = u.id_ensino WHERE u.id_zona = $idzona AND u.id_ensino = $idensino";

            $rescandi = mysqli_query($conn, $sql);
        } else {

            if ($idzona == 0 && $idensino == 0) {
                $sql = "SELECT e.id_ensino,e.nome_ensino,u.id_usuario_curri,u.nome,u.id_zona,u.desc_usuario,z.nome_zona,u.id_usuario_curri,u.email_usuario
                FROM usuario_curri AS u
                INNER JOIN zona AS z ON z.id_zona = u.id_zona
                INNER JOIN escolaridade as e on e.id_ensino = u.id_ensino";

                $rescandi = mysqli_query($conn, $sql);
            } else {
                $sql = "SELECT e.id_ensino,e.nome_ensino,u.id_usuario_curri,u.nome,u.id_zona,u.desc_usuario,z.nome_zona,u.id_usuario_curri,u.email_usuario
                FROM usuario_curri AS u
                INNER JOIN zona AS z ON z.id_zona = u.id_zona
                INNER JOIN escolaridade as e on e.id_ensino = u.id_ensino WHERE u.id_ensino = $idensino OR u.id_zona = $idzona";

                $rescandi = mysqli_query($conn, $sql);
            }
        }
    }
}





$sqlzona = "SELECT * FROM zona";
$reszona = mysqli_query($conn, $sqlzona);

$sqlensino = "SELECT * FROM escolaridade";
$resensino = mysqli_query($conn, $sqlensino);



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
    <title>Vagas</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/indexempresa.css" rel="stylesheet" />
    <link href="css/card.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary container-fluid fixed-top">

        <a class="navbar-brand" href="#"><img src="img/icon.ico" style="height: 50px;"></a>
        <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="indexempresa.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="usuario.php">Cadastro da empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="vagas.php">Cadastro das vagas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" aria-current="page" href="candidatos.php">Candidatos</a>
                </li>
            </ul>
        </div>
        <form method="POST">
            <div class="d-flex mb-2">
                <button class="btn btn-success" name="btnfil" id="btnfil" type="submit"><img src="img/lupin.ico" style="height: 20px ;" alt=""></button>
                <select class="form-select" name="filzona" id="filzona" aria-label="Default select example">
                    <?php while ($linhazona = mysqli_fetch_assoc($reszona)) { ?>
                        <option class="text-dark" value="<?php echo $linhazona['id_zona']; ?>"><?php echo $linhazona['nome_zona']; ?> </option>
                    <?php } ?>
                    <option class="text-dark" selected value="0">Todos </option>
                </select>
                <select class="form-select" name="filensino" id="filensino" aria-label="Default select example">
                    <?php while ($linhaensino = mysqli_fetch_assoc($resensino)) { ?>
                        <option class="text-dark" value="<?php echo $linhaensino['id_ensino']; ?>"><?php echo $linhaensino['nome_ensino']; ?> </option>
                    <?php } ?>
                    <option class="text-dark" selected value="0">Todos </option>
                </select>
            </div>
        </form>
    </nav>
    <div id="layoutSidenav_content">
        <main class=>
            <br><br><br><br><br>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

            <div class="section_our_solution h-100">
                <div class="row px-0 mx-0">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="our_solution_category">
                            <div class="solution_cards_box">


                                <?php while ($linha = mysqli_fetch_assoc($rescandi)) { ?>
                                    <div class="solution_card opacity-75">
                                        <div class="hover_color_bubble"></div>
                                        <div class="so_top_icon">
                                            <svg id="Layer_1" enable-background="new 0 0 512 512" height="50" viewBox="0 0 512 512" width="40" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <g>
                                                            <g>
                                                                <path d="m47.478 452.317 295.441 19.76c5.511.369 10.277-3.8 10.645-9.31l28.393-424.517c.369-5.511-3.8-10.276-9.31-10.645l-295.441-19.76c-5.511-.369-10.276 3.8-10.645 9.31l-28.394 424.517c-.368 5.511 3.8 10.277 9.311 10.645z" fill="#fae19e" />
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <g>
                                                                                <path d="m17.5 504.177h226.14l79.96-79.605v-355.86c0-5.523-4.477-10-10-10h-296.1c-5.523 0-10 4.477-10 10v425.466c0 5.522 4.477 9.999 10 9.999z" fill="#fff9e9" />
                                                                            </g>
                                                                            <path d="m313.601 58.712h-40c5.523 0 10 4.477 10 10v355.861l-.258 40.078 40.258-40.078v-355.861c0-5.523-4.477-10-10-10z" fill="#fff4d6" />
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <path d="m243.64 504.177v-70.253c0-5.523 4.477-10 10-10h69.96z" fill="#ffeec2" />
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <path d="m468.636 248.58-33.372.165v-50.826c0-9.183 7.463-16.662 16.673-16.708h.007c9.217-.046 16.693 7.371 16.693 16.562v50.807z" fill="#fed23a" />
                                                            <path d="m451.96 504.177c-10.362-10.277-16.196-24.263-16.208-38.857l-.062-73.973c0-.644.524-1.169 1.171-1.173l30.038-.149c.647-.003 1.171.517 1.171 1.161l.062 74.079c.012 14.531-5.749 28.472-16.015 38.756z" fill="#54b1ff" />
                                                            <path d="m451.959 469.333h-.01c-14.434.072-26.14-11.542-26.14-25.935v-213.527c0-6.778 5.477-12.283 12.255-12.316l27.626-.137c6.826-.034 12.378 5.49 12.378 12.316v213.436c0 14.38-11.687 26.091-26.109 26.163z" fill="#fdf385" />
                                                            <path d="m465.69 217.417-23.769.118c6.037.79 10.708 5.94 10.708 12.198v213.437c0 9.823-5.455 18.397-13.507 22.87 3.79 2.115 8.164 3.317 12.826 3.293h.01c14.422-.072 26.109-11.783 26.109-26.163v-213.436c.001-6.826-5.551-12.351-12.377-12.317z" fill="#faee6e" />
                                                            <path d="m491.274 247.925-71.615.355c-7.305.036-13.226 5.968-13.226 13.248 0 7.281 5.921 13.153 13.226 13.117l58.389-.29v77.489c0 7.281 5.921 13.153 13.226 13.117 7.305-.036 13.226-5.968 13.226-13.248v-90.672c0-7.28-5.922-13.152-13.226-13.116z" fill="#54b1ff" />
                                                            <g>
                                                                <path d="m491.274 247.925-38.441.188-.167 26.311 25.381-.067v77.489c0 7.281 5.921 13.153 13.226 13.117 7.305-.036 13.226-5.968 13.226-13.248v-90.672c.001-7.282-5.921-13.154-13.225-13.118z" fill="#3da7ff" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                    <g fill="#060606">
                                                        <path d="m373.147 20.122-295.44-19.761c-9.631-.638-17.984 6.665-18.629 16.293l-2.311 34.557h-39.267c-9.649 0-17.5 7.851-17.5 17.5v425.466c0 9.649 7.851 17.5 17.5 17.5h226.141c1.96 0 3.902-.801 5.292-2.185l34.138-33.987c.347.074.701.133 1.065.157l58.282 3.898c9.302.614 18.005-6.952 18.629-16.293l28.393-424.515c.639-9.528-6.766-17.993-16.293-18.63zm-122.006 465.902v-52.1c0-1.378 1.122-2.5 2.5-2.5h51.9zm94.939-23.757c-.244 1.51-1.131 2.286-2.66 2.327l-46.28-3.096 31.752-31.611c1.414-1.407 2.209-3.32 2.209-5.315v-355.86c0-9.649-7.851-17.5-17.5-17.5h-77.993c-9.697 0-9.697 15 0 15h77.993c1.379 0 2.5 1.122 2.5 2.5v347.712h-62.46c-9.649 0-17.5 7.851-17.5 17.5v62.753h-218.641c-1.378 0-2.5-1.122-2.5-2.5v-425.465c0-1.378 1.122-2.5 2.5-2.5h178.168c9.697 0 9.697-15 0-15h-123.868l2.244-33.556c.244-1.511 1.131-2.286 2.661-2.327l295.44 19.76c1.511.244 2.287 1.131 2.328 2.661z" />
                                                        <path d="m267.827 237.047h-204.553c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h204.553c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z" />
                                                        <path d="m267.827 289.332h-204.553c-4.142 0-7.5 3.358-7.5 7.5s3.358 7.5 7.5 7.5h204.553c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z" />
                                                        <path d="m55.774 192.262c0 4.142 3.358 7.5 7.5 7.5h204.553c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-204.553c-4.142 0-7.5 3.358-7.5 7.5z" />
                                                        <path d="m91.807 139.977c0 4.142 3.358 7.5 7.5 7.5h132.487c4.142 0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-132.487c-4.142 0-7.5 3.358-7.5 7.5z" />
                                                        <path d="m194.755 438.787c-13.489.036-26.978.065-40.467.086-4.534.007-9.067.013-13.6.016-8.215.006-13.75-1.643-15.59-10.679-1.556-7.64-12.364-6.613-14.464 0-5.19 16.337-13.774 9.936-18.582-1.053-4.797-10.963-6.027-23.233-8.122-34.9-1.54-8.573-14.506-6.17-14.732 1.994-.298 10.751-1.302 21.331-4.031 31.758-2.815 10.758-7.034 21.097-11.222 31.376-3.651 8.961 10.867 12.816 14.464 3.988 3.711-9.108 7.427-18.266 10.193-27.714 5.14 12.36 15.774 26.34 30.927 18.101 2.819-1.533 5.452-3.712 7.763-6.253 7.88 9.106 19.609 8.388 30.584 8.375 15.627-.02 31.254-.054 46.881-.095 9.649-.025 9.667-15.025-.002-15z" />
                                                        <path d="m505.932 246.439c-3.897-3.878-9.255-5.867-14.695-6.014l-5.668.028v-10.719c0-6.529-3.878-13.427-9.433-16.862v-15.098c0-31.069-48.372-30.934-48.372.146v15.1c-5.659 3.498-9.455 9.741-9.455 16.852v10.982c-24.966 1.7-25.037 39.745.028 41.232.16 33.575.152 66.6-.028 100.737-.049 9.414 14.949 9.966 15 .079.18-34.166.188-67.22.029-100.823l37.211-.185s-.048 110.848-.048 160.784c0 24.338-37.219 24.5-37.219-.253l.013-13.677c.585-9.68-14.387-10.583-14.973-.904v12.834c0 11 3.402 20.316 9.988 26.869.586 15.693 7.198 30.878 18.369 41.956 3.205 3.18 7.642 2.208 10.744-.182 11.365-11.385 17.769-26.394 18.169-42.414 4.951-4.931 9.908-9.896 9.908-26.896l.006-68.351c12.97 3.689 26.494-6.348 26.494-19.946v-90.672c0-5.523-2.155-10.709-6.068-14.603zm-72.623-5.727v-10.841c0-2.219 1.523-4.08 3.573-4.633l30.025-.149c.84.208 1.615.605 2.243 1.231.915.911 1.419 2.123 1.419 3.414v10.794zm18.671-52c4.604 0 9.155 4.514 9.155 9.062v12.166l-18.372.091v-12.111c.001-5.053 4.133-9.183 9.217-9.208zm-.011 303.901c-3.487-4.942-6.009-10.531-7.417-16.406 2.322.503 4.674.765 7.027.765 2.627 0 5.253-.326 7.839-.957-1.374 5.964-3.892 11.587-7.449 16.598zm45.031-140.899c0 7.101-11.452 7.66-11.452.131 0 0 .013-70.974.021-77.48.005-4.196-3.483-7.509-7.558-7.509l-58.389.29c-7.242 0-7.073-11.331.074-11.366l71.615-.355c3.463.295 5.359 2.168 5.688 5.617v90.672z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="solu_title">
                                            <div class="text">Nome do candidato: <h4 class="text " value="<?php echo $linha['id_usuario_curri']; ?>"><?php echo $linha['nome']; ?></h4>
                                            </div>
                                            <div class="text">Nivel de escolaridade: <h6 class="text " value="<?php echo $linha['id_ensino']; ?>"><?php echo $linha['nome_ensino']; ?></h6>
                                            </div>
                                        </div>
                                        <div class="solu_description">

                                            <div class="text">Descrição do candidato: <p class="text " value="<?php echo $linha['id_usuario_curri']; ?>"><?php echo $linha['desc_usuario']; ?></p>
                                            </div>
                                            <div class="text">Email: <p class="text " value="<?php echo $linha['id_usuario_curri']; ?>"><?php echo $linha['email_usuario']; ?></p>
                                            </div>
                                            <div class="text">Região: <p class="text " value="<?php echo $linha['id_zona']; ?>"><?php echo $linha['nome_zona']; ?></p>
                                            </div>

                                        </div>
                                        <div class="col-12 my-1">
                                            <a href=""><button type="button" name="btn-att" id="btn-att" class="btn btn-success">Enviar email</button></a>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </main>

        <div class="container-fluid bg-primary">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 ">
                <div class="col mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <p class="text">© Guilherme Campos Machado 2022</p>
                </div>


                <div class="col mb-3 py-3">
                    <h5>Ajuda</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text">Fale conosco</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text">Precisa de ajuda?</a></li>

                    </ul>
                </div>

                <div class="col mb-3 py-3">
                    <h5>Redes sociais</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2 heigth"><a href="../https://www.facebook.com/" class="nav-link p-0 text"><img src="img/img-original/face-removebg-preview.png" style="height: 25px;"></a></li>
                        <li class="nav-item mb-2 heigth"><a href="../https://twitter.com/" class="nav-link p-0 text"><img src="img/img-original/twit.png" style="height: 27px;"></a></li>
                        <li class="nav-item mb-2 heigth"><a href="#" class="nav-link p-0 text"><img src="img/img-original/iconewhats.png" style="height: 27px;"></a></li>

                    </ul>
                </div>

            </footer>

        </div>
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