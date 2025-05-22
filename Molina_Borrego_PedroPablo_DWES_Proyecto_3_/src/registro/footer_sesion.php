

<style>
    .nav-link {
        text-decoration: none;
        color: #f8f9fa;
        position: relative;
        font-size: 16px;
    }

    .nav-link:hover::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 2px;
        background-color: #f8f9fa;
        transition: width 0.3s ease-in-out;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 0;
        height: 2px;
        background-color: #f8f9fa;
        transition: width 0.3s ease-in-out;
    }

    footer {
        background-color: #007bff;
        color: #f8f9fa;
        padding: 2px 0;
    }

    footer .nav-item {
        margin-right: 20px;
    }

    footer .nav-item:last-child {
        margin-right: 0;
    }

    footer .nav-item a {
        font-size: 16px;
       
        text-decoration: none;
    }

    footer .nav-item a:hover {
        background-color: #0056b3;
        border-radius: 4px;
        color: white;
    }

    footer .social-links a {
        color: #f8f9fa;
        margin: 0 10px;
        font-size: 20px;
        text-decoration: none;
    }

    footer .social-links a:hover {
        color: #007bff;
    }
    
</style>

<footer class="d-flex flex-wrap justify-content-between align-items-center border-top">
    <p class="col-md-4 mb-0 text-light">© 2025 Pixel Library, Inc</p>

    <a href="/" class="col d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="../../index.php" class="nav-link px-2 text-light">Inicio</a></li><br>
        <li class="nav-item"><a href="../plantillas/preguntas_nosotros.php" class="nav-link px-2 text-light">Preguntas</a></li><br>
        <li class="nav-item"><a href="../plantillas/sobre_nosotros.php" class="nav-link px-2 text-light">Sobre Nosotros</a></li><br>
    </ul>
</footer>

  