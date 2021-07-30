@extends('templates.layout')
@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="row mt-3" >
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            </div>
            <div class="row mt-2">
        @else
            <div class="row mt-5">
            @endif
            <div class="col-6">
                <div class="row">
                    <h1>{{$listing->title}}</h1>
                </div>
                <div class="row mt-3">
                    <h3>Цена: {{$listing->price}} лв.</h3>
                </div>
                <div class="row mt-2" style="font-size: small">
                    <div class="col">
                        <i class="bi bi-person"></i>
                        <span>Име: {{$listing->first_name}} {{$listing->last_name}}</span>
                    </div>
                </div>
                <div class="row mt-1" style="font-size: small">
                    <div class="col">
                        <i class="bi bi-telephone-fill"></i>
                        <span>Телефонен номер: {{$listing->telephone}}</span>
                    </div>
                    <div class="col">
                        <i class="bi bi-building"></i>
                        <span>Град: {{$listing->town}}</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <h4>Характеристики:</h4>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <i class="bi bi-speedometer2"></i>
                        <span>Километри: </span>
                        <span>{{$listing->mileage}}</span>
                    </div>
                    <div class="col">
                        <i class="bi bi-calendar-event"></i>
                        <span>Година: </span>
                        <span> {{$listing->year}}</span>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <i class="fas fa-gas-pump"></i>
                        <span>Гориво: </span>
                        <span>{{$listing->fuel_name}}</span>
                    </div>
                    <div class="col">
                        <img src="https://img.icons8.com/material-outlined/18/000000/turbocharger.png" alt="..."/>
                        <span>Мощност: </span>
                        <span> {{$listing->hp}} к.с.</span>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <img src="https://img.icons8.com/wired/18/000000/engine.png" alt="..."/>
                        <span>Кубатура: </span>
                        <span>{{$listing->cubic}} см<sup>3</sup></span>
                    </div>
                    <div class="col">
                        <i class="bi bi-gear-fill"></i>
                        <span>Скоростна кутия: </span>
                        <span>{{$listing->gearbox_type}}</span>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <i class="bi bi-paint-bucket"></i>
                        <span>Цвят: </span>
                        <span>{{$listing->colour}}</span>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <h4>Описание:</h4>
                    </div>
                </div>
                @if($listing->description)
                    <div class="row mt-2">
                        <div class="col" style="font-size: small">
                            {{$listing->description}}
                        </div>
                    </div>
                @else
                    <div class="row mt-2">
                        <div class="col" style="font-size: small">
                            Няма описание
                        </div>
                    </div>
                @endif

            </div>
            <div class="col-6 mt-5">
                <div id="carouselListing" class="carousel carousel-dark slide mt-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if(empty($listing->image))
                            <div class="carousel-item active">
                                <img src="{{url('images/carousel.jpg')}}" class="d-block w-100" alt="...">
                                @else
                                    <div class="carousel-item active">
                                        <img src="{{url('images/listing_images/' . $listing->image[0])}}"
                                             class="d-block w-100" alt="...">
                                    </div>
                                    @for($i = 1; $i < (count($listing->image));$i++)
                                        <div class="carousel-item">
                                            <img src="{{url('images/listing_images/' . $listing->image[$i])}}"
                                                 class="d-block w-100" alt="...">
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
