    @extends('templates.layout')
    @section('content')
    <div id="carouselIndex" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/carousel2.jpg" class="d-block w-100 vh-100" alt="..."
                     style=" object-fit: cover; filter: brightness(0.5)">
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col d-flex justify-content-center mt-5">
                <h1>Нови обяви</h1>
            </div>
        </div>
        @if(!empty($listings))
        @foreach($listings->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $listing)
                        <div class="col-4 mt-5 d-flex justify-content-center">
                            <div class="card" style="width: 22rem;">
                                @if(!empty($listing->image))
                                    <img src="images/listing_images/{{$listing->image[0]}}" style="object-fit: cover;" class="card-img-top" alt="...">
                                @else
                                    <img src="images/carousel2.jpg" class="card-img-top" alt="...">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$listing->title}}</h5>
                                    {{Carbon\Carbon::parse($listing->created_at)->formatLocalized("%A %d %B %Y")}}
                                    <div style="font-size: small">
                                    <div class="row">
                                        <div class = col>
                                            <i class="bi bi-calendar-event"></i>
                                            <span>{{$listing->year}}</span>
                                        </div>
                                        <div class="col">
                                            <i class="bi bi-speedometer2"></i>
                                            <span>{{$listing->mileage}}</span>
                                        </div>
                                    </div>

                                        <div class="row">
                                            <div class = col>
                                                <img src="https://img.icons8.com/wired/18/000000/engine.png"/>
                                                <span>{{$listing->cubic}} cm<sup>3</sup></span>
                                            </div>
                                            <div class="col">
                                                <i class="bi bi-gear-fill"></i>
                                                <span>{{$listing->gearbox_type}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class = col>
                                                <i class="fas fa-gas-pump"></i>
                                                <span>{{$listing->fuel_name}}</span>
                                            </div>
                                            <div class="col">
                                                <i class="bi bi-paint-bucket"></i>
                                                <span>{{$listing->colour}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class = col>
                                                <img src="https://img.icons8.com/material-outlined/18/000000/turbocharger.png"/>
                                                <span>{{$listing->hp}} к.с.</span>
                                            </div>
                                            <div class="col">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('listing.show', ['slug' => $listing->slug]) }}" class="btn btn-primary mt-3">{{$listing->price}} лв.</a>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        @else
            <div class="row">
                <h4 class="text-center mt-4">Няма нови обяви</h4>
            </div>
        @endif

    </div>
    @endsection


