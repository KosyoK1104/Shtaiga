@extends('templates.layout')
@section('content')
<div class="container">
    <div class="row text-center mt-5 mb-5">
        <h1>Контакти</h1>
    </div>
    <div class="row">
        <div class="col-7">
            <div class="row">
                <div class="col-6">
                    <label class="form-label" for="email">E-mail адрес</label>
                    <input name="email"class="form-control" type="text" placeholder="adress@shtaiga.com">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label class="form-label" for="theme">Тема</label>
                    <input name="theme" type="text" class="form-control" placeholder="">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label" for="body">Съобщение</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-left mt-5">
                <button class="btn btn-dark btn-secondary">Изпрати</button>
            </div>
        </div>
        <div class="col ms-4">
            <div class="row">
                <p>Адрес: <br>
                гр. София, кв. Овча купел 2, ул. Монтевидео 21</p>
            </div>
            <div class="row">
                <p>Email адрес: <br>
                contact@shtaiga.com</p>
            </div>
            <div class="row">
                <p>Телефонни номера: <br>
                    +359 89 888 8888 <br>
                    02/888 8888</p>
            </div>
            <div class="row">
                <iframe width="600" height="250" style="border:0" loading="lazy" allowfullscreen
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJBUCxQyWbqkAR3q6iccoGjuo&key=AIzaSyBDArLz-SvV5Oww2oUjd0RKlL9KbKxHLnE"></iframe>
            </div>
        </div>
    </div>
</div>



@endsection
