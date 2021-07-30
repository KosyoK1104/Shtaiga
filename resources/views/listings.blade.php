@extends('templates.layout')
@section('content')
<div class="container">
    <div class="row mt-4 ms-5">
        <div class="col">
            <a class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                Филтри
            </a>
        </div>
        <form action="/listings">

            <div class="row collapse mt-3 " id="collapseFilter">
                 <div class="card card-body ms-1">
                     <div class="row">
                        <div class="col-3">
                            <label class="form-label" for="model">Марка</label>
                            <select name="make" class="form-select" id="makes">
                                <option selected value="">Изберете марка</option>
                            @foreach(DB::table('cars')->select('make')->distinct()->get() as $make)
                                <option value="{{$make->make}}">{{$make->make}}</option>
                            @endforeach
                            </select>
                        </div>
                         <div class="col-3">
                             <label class="form-label" for="make">Модел</label>
                             <select name="model" class="form-select" id="models">
                                 <option selected value=""></option>
                             </select>
                         </div>
                         <div class="col-3">
                             <label class="form-label" for="min_price">Минимална цена</label>
                             <div class="input-group">
                                 <input class="form-control" type="number" id="min_price" name="min_price" step="100">
                                 <span class="input-group-text">лв.</span>
                             </div>
                         </div>
                         <div class="col-3">
                             <label class="form-label" for="max_price">Максимална цена</label>
                             <div class="input-group">
                                 <input class="form-control" type="number" id="max_price" name="max_price" step="100">
                                 <span class="input-group-text">лв.</span>
                             </div>
                         </div>
                     </div>
                     <div class="row mt-2">
                         <div class="col-3">
                             <label class="form-label" for="year_from">Година на производство от</label>
                             <select class="form-select" name="year_from" id="year_from">
                                 <option value=""></option>
                                 @for($i = 2021; $i >=1960; $i--)
                                     <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                             </select>
                         </div>
                         <div class="col-3">
                             <label class="form-label" for="year_to">Година на производство до</label>
                             <select class="form-select" name="year_to" id="year_to">
                                 <option value=""></option>
                                 @for($i = 2021; $i >=1960; $i--)
                                     <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                             </select>
                         </div>
                         <div class="col">
                             <label class="form-label" for="min_hp">Конски сили</label>
                             <div class="input-group">
                                 <input class="form-control" type="number" id="min_hp" name="min_hp">
                                 <span class="input-group-text">-</span>
                                 <input class="form-control" type="number" id="max_hp" name="max_hp">
                                 <span class="input-group-text">к.с</span>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-3">
                             <label class="form-label" for="fuel">Гориво</label>
                             <select class="form-select" name="fuel" id="fuel">
                                 <option value=""></option>
                                 @foreach(DB::table('fuels')->get() as $fuel)
                                     <option value="{{$fuel->id}}">{{$fuel->fuel_name}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-3">
                             <label class="form-label" for="gearbox">Скоростна кутия</label>
                             <select class="form-select" name="gearbox" id="gearbox">
                                 <option value=""></option>
                                 @foreach(DB::table('gearboxes')->get() as $gearbox)
                                     <option value="{{$gearbox->id}}">{{$gearbox->gearbox_type}}</option>
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-3"></div>
                         <div class="col-3 align-self-end">
                             <label for="filter"></label>
                             <button name="filter" type="submit" class="form-control btn btn-success">Филтрирай</button>
                         </div>
                     </div>
                </div>
            </div>
        </form>
    </div>
    @if(count($listings)>0)
    @foreach($listings->chunk(3) as $chunk)
        <div class="d-flex justify-content-evenly">
        @foreach($chunk as $listing)
        <div class="col-4 mt-5 d-flex justify-content-center">
            <div class="card" style="width: 22rem;">
                @if(!empty($listing->image))
                    <img src="images/listing_images/{{$listing->image[0]}}" style="object-fit: cover;" class="card-img-top" alt="...">
                @else
                    <img src="images/carousel2.jpg" class="card-img-top" alt="...">
                @endif                <div class="card-body">
                    <h5 class="card-title">{{$listing->title}}</h5>
                    <span>
                        {{Carbon\Carbon::parse($listing->created_at)->formatLocalized("%A %d %B %Y")}}
                    </span>
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
        <div class="row" style="margin-bottom: 200px">
            <h3 class="text-center mt-5 mb-5">Няма заредени обяви</h3>
        </div>
    @endif
    <div class="row mt-4">
        {{ $listings->links() }}
    </div>

</div>
<script type="text/javascript">

$('#makes').change(function(){
var make = $(this).val();
if(make){
$.ajax({
    type:"GET",
    url:"{{route('models')}}?make="+make,
    success:function(res){
        if(res){
            let data = JSON.parse(JSON.stringify(res))

            $("#models").empty();
            $("#models").append("<option value=''>Изберете модел</option>");
            $.each(data['models'],function(i, value){
                $("#models").append('<option value="'+value['model']+'">'+value['model']+'</option>');
            });

        }else{
            $("#models").empty();
        }
    }
});
}else{
$("#models").empty();
}
});

</script>
<script>
$('form').submit(function() {
$(':input', this).each(function() {
this.disabled = !($(this).val());
});
});
</script>

@endsection
