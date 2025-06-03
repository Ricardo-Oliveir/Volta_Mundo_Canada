<?php
session_start(); // Add session_start() at the beginning
include 'database.php';

// Select image_path instead of the old image blob column
$sql = "SELECT name, comment, image_path FROM comments WHERE approved = TRUE";
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
    <header>
        <nav class="navbar navbar-expand-lg"> <!-- Removed navbar-light and bg-light, new CSS will handle it -->
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
                        <a class="nav-link" href="login.php">Painel Administrativo</a> <!-- Updated link -->
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
                <img src="img/vancouver-canucks-1024x563.jpg" class="d-block w-100" alt="Vancouver Canucks Hockey Game">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Explore o Canadá Vibrante</h5>
                    <p>Das luzes da cidade aos esportes emocionantes, uma aventura espera por você.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/pexels-vincent-albos-1750754.jpg" class="d-block w-100" alt="Natureza Selvagem Canadense">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Belezas Naturais Intocadas</h5>
                    <p>Descubra paisagens de tirar o fôlego e a rica vida selvagem.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/pexels-daniel-joseph-petty-756790.jpg" class="d-block w-100" alt="Aurora Boreal no Canadá">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Céus Mágicos e Noites Estreladas</h5>
                    <p>Maravilhe-se com fenômenos como a Aurora Boreal.</p>
                </div>
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
    </header>

    <main>
        <section class="container mt-3"> <!-- Flash message container, kept for now -->
            <?php
            if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']); // Clear the message after displaying
            $alert_type = $message['type'] === 'error' ? 'danger' : 'success';
            echo "<div class='alert alert-{$alert_type} alert-dismissible fade show' role='alert'>";
            echo htmlspecialchars($message['text']);
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }
        ?>
        </section>

        <section class="video-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <p class="fs-5 m-0 text-secondary">Descobrindo Tesouros Naturais </p>
                        <h2 class="display-5">Uma Jornada pelos Parques Nacionais do Canadá</h2>
                        <hr class="border-primary">
                        <p>Em um vasto e exuberante cenário de beleza selvagem, os Parques Nacionais do
                            Canadá aguardam para revelar seus segredos. Junte-se a nós em uma jornada de
                            descoberta através dessas maravilhas naturais.</p>
                        <p>Em um país conhecido por sua vastidão e beleza selvagem, os Parques Nacionais do Canadá destacam-se
                            como verdadeiros tesouros naturais. Prepare-se para uma jornada emocionante através dessas áreas
                            protegidas, onde a natureza se revela em sua forma mais majestosa.</p>
                    </div>
                    <div class="col-lg-6">
                        <video width="100%" height="auto" autoplay muted loop class="rounded shadow-lg">
                            <source src="img/10 Best National Parks In Canada.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </section>

        <section class="parques-section section-padding bg-light"> <!-- Added bg-light for visual separation -->
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5">Parques Nacionais em Destaque</h2>
                    <p class="lead text-muted">Explore algumas das joias da coroa do sistema de parques do Canadá.</p>
                </div>
                <div class="row"> <!-- Changed card-group to row for better responsive stacking with new card styles -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100"> <!-- Added h-100 for equal height cards -->
                            <img src="img/banf_resized.jpg" class="card-img-top" alt="Parque Nacional Banff">
                            <div class="card-body">
                                <h5 class="card-title">Parque Nacional Banff</h5>
                                <p class="card-text">Localizado nas majestosas Montanhas Rochosas, o Parque Nacional Banff é
                                    conhecido por suas paisagens de tirar o fôlego, que incluem picos nevados, lagos cristalinos
                                    e florestas exuberantes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="img/jaspe_resized.jpg" class="card-img-top" alt="Parque Nacional Jasper">
                            <div class="card-body">
                                <h5 class="card-title">Parque Nacional Jasper</h5>
                                <p class="card-text">Também situado nas Montanhas Rochosas, o Parque Nacional Jasper oferece
                                    uma beleza natural intocada, com uma variedade de glaciares, cachoeiras, lagos e picos de
                                    montanhas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="img/Lago Louise.jpg" class="card-img-top" alt="Ilha de Vancouver e Costa Oeste">
                            <div class="card-body">
                                <h5 class="card-title">Ilha de Vancouver e Costa Oeste</h5>
                                <p class="card-text">Esta região é famosa por sua diversidade de paisagens, que incluem florestas
                                    temperadas exuberantes, praias intocadas e montanhas escarpadas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="comments-display-section section-padding">
            <div class="container">
                <h2 class="text-center mb-5 display-5">Comentários da Comunidade</h2>
                <div class="row" id="commentsList">
                    <?php if (empty($approved_comments)) : ?>
                        <div class="col">
                            <p class="text-center text-muted">Ainda não há comentários. Seja o primeiro a comentar!</p>
                        </div>
                    <?php endif; ?>
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
                                    <?php if (!empty($comment['image_path'])) : ?>
                                        <img src="<?php echo htmlspecialchars($comment['image_path']); ?>" class="img-fluid rounded mt-2" alt="Imagem do Comentário" style="max-height: 200px; object-fit: cover;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="comment-form-section section-padding bg-light"> <!-- Added bg-light for visual separation -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-center mb-4 display-5">Deixe seu Comentário</h2>
                        <form action="submit_comment.php" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-white">
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
                                <textarea class="form-control" name="comment" id="comment" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Anexar Imagem (opcional):</label>
                                <input class="form-control" type="file" name="image" id="image">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Enviar Comentário</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer text-light"> <!-- Removed bg-dark, new CSS will handle it -->
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i>Email: ricardojacutinga2014@gmail.com</li>
                        <li><i class="fas fa-phone me-2"></i>Telefone: 35-999175737</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5>Navegação</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Pagina Inicial</a></li>
                        <li><a href="turismo.html">Dicas de turismo</a></li>
                        <li><a href="gastronomia.html">Dicas de Gastronomia</a></li>
                        <li><a href="login.php">Painel Administrativo</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Siga-nos</h5>
                    <div class="social-icons">
                        <a href="https://github.com/Ricardo-Oliveir" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/luiz-ricardo-de-oliveira-458393120/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/ricardooliveiramg/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-3">
            <div class="text-center">
                <p class="mb-0">© <?php echo date("Y"); ?> Volta ao Mundo Canada. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button HTML -->
    <a href="#" id="scrollToTopBtn" class="scroll-to-top-btn" title="Go to top"><i class="fas fa-arrow-up"></i></a>

    <!-- Font Awesome for social icons (already present, good) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom-scripts.js"></script> <!-- Include custom scripts -->
</body>

</html>