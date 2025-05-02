<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="articulos.html">
                <img src="../images/iconos/logo.png" alt="Logo Revista Digital" height="40" width="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contacto/contacto.html">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../nosotros/nosotros.html">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="articulos.php">Catálogo</a>
                    </li>
                    <button class="btn btn-outline-dark position-relative ms-3" data-bs-toggle="modal" data-bs-target="#carritoModal">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="carrito-contador">0</span>
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="text-center my-4">
        <div class="container">
            <img src="https://images.cooltext.com/5726671.png" class="img-fluid mb-3" alt="Catálogo de Productos">
            <div class="search-bar">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchBar" placeholder="Buscar productos...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Productos -->
    <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4" id="productosContainer">
            <?php
            include 'conexion/conexion.php'; // tu archivo de conexión a MySQL

            $sql = "SELECT * FROM productos";
            $resultado = $conexion->query($sql);

            while ($producto = $resultado->fetch_assoc()) {
            ?>
                <div class="col">
                    <div class="card product-card h-100">
                        <img src="<?= $producto['imagen'] ?>" class="card-img-top product-img" alt="<?= $producto['nombre'] ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $producto['nombre'] ?>
                            </h5>
                            <p class="card-text text-success fw-bold">$
                                <?= number_format($producto['precio'], 2) ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100 detalles-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#productoModal"
                                data-name="<?= $producto['nombre'] ?>"
                                data-price="$<?= number_format($producto['precio'], 2) ?>"
                                data-img="<?= $producto['imagen'] ?>">
                                Ampliar <i class="fas fa-arrow-right ms-2"></i>
                            </button>

                            <button class="btn btn-success w-100 mt-2 agregar-carrito-btn"
                                data-name="<?= $producto['nombre'] ?>"
                                data-price="$<?= $producto['precio'] ?>"
                                data-img="<?= $producto['imagen'] ?>">
                                Agregar al carrito <i class="fas fa-cart-plus ms-2"></i>
                            </button>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

        </div>

        <!-- Botones Ver Más/Ver Menos -->
        <div class="text-center mt-4">
            <button id="verMasBtn" class="btn btn-outline-primary load-more me-2">
                <i class="fas fa-plus-circle me-2"></i>Ver más
            </button>
            <button id="verMenosBtn" class="btn btn-outline-secondary load-more">
                <i class="fas fa-minus-circle me-2"></i>Ver menos
            </button>
        </div>
    </section>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="productoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Detalles del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modal-image" src="" class="modal-product-img img-fluid mb-3" alt="Imagen del producto">
                    <h4 id="modal-title" class="mb-2"></h4>
                    <h5 id="modal-price" class="text-success mb-3"></h5>
                    <p id="modal-description" class="text-muted">Producto Garantizado</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Añadir al carrito
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Catálogo de Productos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Modal Carrito -->
    <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="carrito-lista"></ul>
                    <div class="mt-3 text-end fw-bold">
                        Total: $<span id="carrito-total">0.00</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-success">Finalizar Compra</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Script/script.js"></script>
</body>

</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Special+Gothic+Condensed+One&family=Special+Gothic+Expanded+One&display=swap');

    body {
        font-family: "Special Gothic Condensed One", sans-serif;
    }

    .navbar {
        background-color: #a7e1f7;
        border-radius: 0 0 5px 5px;
        /* Solo abajo */
        box-shadow: #333 0 0 10px;
    }

    .navbar-brand {
        margin-left: -40px;
    }

    .navbar-nav {
        margin-right: -50px;
    }

    .collapse ul li a {
        margin-left: 15px;
        font-style: normal;
        color: #0d6efd;
        font-size: 18px;
    }

    .nav-link.active {
        color: rgb(0, 0, 0) !important;
        /* el !important ayuda a sobreescribir estilos de Bootstrap */
    }

    .search-bar {
        max-width: 500px;
        margin: 20px auto;
    }

    .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .load-more {
        margin: 30px auto;
        display: block;
    }

    .modal-product-img {
        max-height: 300px;
        width: auto;
        margin: 0 auto;
        display: block;
    }

    @media (max-width: 768px) {

        .navbar-brand {
            margin-left: 20px;
        }

        .collapse ul li a {
            text-align: center;
            margin-left: -25px;
            background-color: #e9e9e962;
            box-shadow: #333 0 0 2px;
        }
    }
</style>