<?php
include 'database.php';

$sql = "SELECT name, comment, image FROM comments WHERE approved = TRUE";
$result = $conn->query($sql);
$approved_comments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $approved_comments[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volta ao Mundo Canada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Canada</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Pagina Inicial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="turismo.html">Dicas de turismo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gastronomia.html">Dicas de Gastronomia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Painel Administrativo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/vancouver-canucks-1024x563.jpg" class="d-block" alt="">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item">
                <img src="img/pexels-vincent-albos-1750754.jpg" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item">
                <img src="img/pexels-daniel-joseph-petty-756790.jpg" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md col-lg-6 float-start p-5">
                <p class="fs-5 m-0">Descobrindo Tesouros Naturais </p>
                <h4 class="display-6">Uma Jornada pelos Parques Nacionais do Canadá</h4>
                <hr>
                <p>Em um vasto e exuberante cenário de beleza selvagem, os Parques Nacionais do
                    Canadá aguardam para revelar seus segredos. Junte-se a nós em uma jornada de
                    descoberta através dessas maravilhas naturais:</p>
                <p>Em um país conhecido por sua vastidão e beleza selvagem, os Parques Nacionais do Canadá destacam-se
                    como verdadeiros tesouros naturais. Prepare-se para uma jornada emocionante através dessas áreas
                    protegidas, onde
                    a natureza se revela em sua forma mais majestosa:</p>
            </div>
            <div class="col-12 col-sm-12 col-md col-lg-6 float-start p-2">
                <video width="100%" height="100%" autoplay muted loop>
                    <source src="img/10 Best National Parks In Canada.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card-group mt-5">
            <div class="card">
                <img src="img/banf_resized.jpg" class="card-img-top" alt="..">
                <div class="card-body">
                    <h5 class="card-title">Parque Nacional Banff</h5>
                    <p class="card-text">Localizado nas majestosas Montanhas Rochosas, o Parque Nacional Banff é
                        conhecido por suas paisagens de tirar o fôlego, que incluem picos nevados, lagos cristalinos
                        e florestas exuberantes. O Lago Moraine e o Lago Louise, com suas águas azul-turquesa cercadas
                        por montanhas imponentes,
                        são dois dos destaques imperdíveis deste parque</p>
                </div>
            </div>
            <div class="card">
                <img src="img/jaspe_resized.jpg" class="card-img-top" alt="..">
                <div class="card-body">
                    <h5 class="card-title">Parque Nacional Jasper</h5>
                    <p class="card-text">Também situado nas Montanhas Rochosas, o Parque Nacional Jasper oferece
                        uma beleza natural intocada, com uma variedade de glaciares, cachoeiras, lagos e picos de
                        montanhas. O
                        Columbia Icefield, o Lago Maligne e as Miette Hot Springs são apenas algumas das atrações
                        impressionantes deste parque</p>
                </div>
            </div>
            <div class="card">
                <img src="img/Lago Louise.jpg" class="card-img-top" alt="..">
                <div class="card-body">
                    <h5 class="card-title">Ilha de Vancouver e Costa Oeste</h5>
                    <p class="card-text">Esta região é famosa por sua diversidade de paisagens, que incluem florestas
                        temperadas exuberantes, praias intocadas, montanhas escarpadas e uma abundância de vida
                        selvagem.
                        Destaques incluem a cidade de Vancouver, com sua mistura de vida urbana e natureza deslumbrante,
                        a Ilha de Vancouver, conhecida por suas trilhas cênicas e observação de baleias, e a Pacific Rim
                        National Park Reserve, que oferece praias impressionantes e trilhas na floresta tropical</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Seção para exibir comentários -->
    <div class="container mt-5">
        <h2>Comentarios</h2>
        <div class="row" id="commentsList">
            <?php foreach ($approved_comments as $comment) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($comment['name']); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo htmlspecialchars($comment['comment']); ?>
                            </p>
                            <?php if ($comment['image']) : ?>
                                <img src="<?php echo htmlspecialchars($comment['image']); ?>" class="card-img-top" alt="Imagem do Comentário">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Seção para enviar comentários -->
    <div class="container mt-5">
        <h2>Enviar Comentários</h2>
        <form action="submit_comment.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comentário:</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Anexar Imagem:</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>



    <footer class="footer mt-auto py-3 bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li>Email: ricardojacutinga2014@gmail.com</li>
                        <li>Telefone: 35-999175737</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5>Siga-nos</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/Ricardo-Oliveir" class="text-light" target="_blank">GitHub</a>
                        </li>
                        <li><a href="https://www.linkedin.com/in/luiz-ricardo-de-oliveira-458393120/" class="text-light" target="_blank">Linkedin</a></li>
                        <li><a href="https://www.instagram.com/ricardooliveiramg/" class="text-light" target="_blank">Instagram</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>© 2024 Volta ao Mundo Canada. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>