@extends('templates.layout')
@section('content')
    <div class="container">
        <div class="row text-center mt-5 mb-5">
            <h1>Създай обява</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- if there are creation errors, they will show here -->

        {{ Form::open(array('url' => '/listing/create', 'files' => 'true')) }}
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="model">Марка</label>
                        <select name="make" class="form-select" id="makes">
                            <option selected value="">Изберете марка</option>
                            @foreach(DB::table('cars')->select('make')->distinct()->get() as $make)
                                <option value="{{$make->make}}">{{$make->make}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="make">Модел</label>
                        <select name="model" class="form-select" id="models">
                            <option selected value=""></option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="year">Година на производство</label>
                        <input class="form-control" type="number" name="year" id="year">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label class="form-label" for="price">Цена</label>
                        <input class="form-control" type="number" name="price" id="price">
                    </div>
                    <div class="col">
                        <label class="form-label" for="mileage">Километри</label>
                        <input class="form-control" type="number" name="mileage" id="mileage">
                    </div>
                    <div class="col">
                        <label class="form-label" for="hp">Конски сили</label>
                        <input class="form-control" type="number" name="hp" id="hp">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label class="form-label" for="fuel">Гориво</label>
                        <select class="form-select" name="fuel" id="fuel">
                            <option value=""></option>
                            @foreach(DB::table('fuels')->get() as $fuel)
                                <option value="{{$fuel->id}}">{{$fuel->fuel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="gearbox">Скоростна кутия</label>
                        <select class="form-select" name="gearbox" id="gearbox">
                            <option value=""></option>
                            @foreach(DB::table('gearboxes')->get() as $gearbox)
                                <option value="{{$gearbox->id}}">{{$gearbox->gearbox_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label" for="cubic">Кубични сантиметър</label>
                        <input class="form-control" type="number" name="cubic" id="cubic">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <label class="form-label" for="colour">Цвят</label>
                        <input class="form-control" type="text" name="colour" id="colour">
                    </div>
                </div>
                <div class=" row mt-2">
                    <div class="col">
                        <label class="form-label" for="">Описание</label>
                        <textarea class="form-control" rows="2" id="description" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="first_name">Име</label>
                        <input class="form-control" type="text" name="first_name" id="first_name">
                    </div>
                    <div class="col">
                        <label class="form-label" for="last_name">Фамилия</label>
                        <input class="form-control" type="text" name="last_name" id="last_name">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label class="form-label" for="telephone">Телефон</label>
                        <input class="form-control" type="text" name="telephone" id="telephone">
                    </div>
                    <div class="col">
                        <label class="form-label" for="town">Град</label>
                        <input class="form-control" type="text" name="town" id="town">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="form-group files">
                        <label class="form-label">Снимки</label>
                        <input type="file" class="form-control" enctype='multipart/form-data' multiple="multiple" name="image[]" accept="image/jpg, image/jpeg">
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ Form::submit('Създай', array('class' => 'btn btn-danger btn-lg')) }}
        </div>
        {{ Form::close() }}
    </div>
    <script type="text/javascript">

        $('#makes').change(function () {
            var make = $(this).val();
            if (make) {
                $.ajax({
                    type: "GET",
                    url: "{{route('models')}}?make=" + make,
                    success: function (res) {
                        if (res) {
                            let data = JSON.parse(JSON.stringify(res))

                            $("#models").empty();
                            $("#models").append("<option value=''>Изберете модел</option>");
                            $.each(data['models'], function (i, value) {
                                $("#models").append('<option value="' + value['model'] + '">' + value['model'] + '</option>');
                            });

                        } else {
                            $("#models").empty();
                        }
                    }
                });
            } else {
                $("#models").empty();
            }
        });

    </script>
@endsection
