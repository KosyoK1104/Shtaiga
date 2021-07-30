<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Щайга</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/aceb2f85be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3d5a80">
        <div class="container mt-2 mb-2">
            <a href="{{ URL::to('/') }}">
                <img src="{{ URL::to('/') }}/images/logo_shtaiga.png"  class="pe-2" style="height: 3rem;width: auto" alt="">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/') }}">Начало</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('/listings')}}">Обяви</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('/contacts')}}">Контакти</a>
                    </li>
                </ul>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

                   <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="btn btn-danger" href="{{route('listing.create')}}">Създай обява</a>
                        </li>
                    </ul>


                </div>

            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="mt-5 text-white" style="background-color: #293241">
        <div class="container pt-5">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="" style="  text-align: justify;">Щайга е проект по Информационни технологии към Нов Български Университет с ръководител гл. асистент д-р Марияна Райкова. Темата на проекта е автокаталог. Сайта съдържа функции за зареждана не обяви по последно добавени и да се създават обяви. Към проекта ще се вложи още работа за направата на филтри и за добавянето на още опции за обявите.</p>
                </div>
                <div class="col-xs-6 col-md-3 text-light">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a class="text-decoration-none" href="{{URL::to('/')}}">Начало</a></li>
                        <li><a class="text-decoration-none" href="{{URL::to('/listings')}}">Обяви</a></li>
                        <li><a class="text-decoration-none" href="{{URL::to('/contacts')}}">Контакти</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-evenly pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-facebook-f"></i
                    ></a>

                <!-- Twitter -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-twitter"></i
                    ></a>

                <!-- Google -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-google"></i
                    ></a>

                <!-- Instagram -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
                    ></a>

                <!-- Linkedin -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-linkedin"></i
                    ></a>
                <!-- Github -->
                <a
                    class="btn btn-link btn-floating btn-lg text-light m-1"
                    href="#!"
                    role="button"
                    data-mdb-ripple-color="dark"
                ><i class="fab fa-github"></i
                    ></a>
            </section>
            <!-- Section: Social media -->
        </div>
    </footer>

</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>

</html>
