@extends('layouts.login')

@section('title', 'Bangboo')

@section('contents')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.R.E.S.H - Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container py-4">
            <h1 class="text-3xl font-bold text-gray-900 text-center">
                F.R.E.S.H
            </h1>
        </div>
    </header>
    <hr />

    <!-- Main Content -->
    <main class="container py-6 mt-3">
        <!-- Section: Inicio -->
        <section id="inicio" class="mb-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Bienvenidos a F.R.E.S.H</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lorem elit, gravida id lorem sed, ullamcorper luctus massa. Aenean lacus lacus, commodo id consectetur in, eleifend sit amet arcu.</p>
                </div>
                <div class="col-md-6">
                    <img src="/img/_5fc0f67c-c3ca-4751-99b3-5873ec1861e8.jpg" alt="Imagen Genérica" class="img-fluid rounded">
                </div>
            </div>
        </section>

        <!-- Section: Quiénes Somos -->
        <section id="quienes-somos" class="mb-5">
            <h2>Quiénes Somos</h2>
            <p>F.R.E.S.H es una empresa dedicada a brindar soluciones innovadoras para la gestión empresarial. Nuestra misión es mejorar la eficiencia y productividad de las organizaciones mediante el uso de tecnología avanzada y servicios personalizados.</p>
            <p>Vivamus sed quam eget orci ultricies auctor nec at odio. Vivamus posuere, lorem at faucibus molestie, lectus diam congue quam, non ullamcorper magna urna id est.</p>
        </section>

        <!-- Section: Contacto -->
        <section id="contacto" class="container mt-5">
            <div class="row">
                <!-- Columna de contenido -->
                <div class="col-md-6">
                    <h2>Contacto</h2>
                    <p>Para más información, contáctenos en:</p>
                    <ul>
                        <li>Teléfono: +123 456 7890</li>
                        <li><a href="mailto:aldorojas401@gmail.com" class="contact-link">aldorojas401@gmail.com</a></li>
                        <li>Dirección: Calle Ejemplo 123, Ciudad, País</li>
                    </ul>
                </div>
                <!-- Columna del mapa -->
                <div class="col-md-6">
                    <figure>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.123456789!2d-100.389888!3d20.588793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d35bcd12345678%3A0x123456789abcdef!2sQuerétaro%2C%20Qro.%2C%20México!5e0!3m2!1ses!2smx!4v1647608789441!5m2!1ses!2smx"
                            width="100%" height="300" loading="lazy" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                        </iframe>
                    </figure>
                </div>
            </div>
        </section>
    </main>

</body>

</html>

@endsection
