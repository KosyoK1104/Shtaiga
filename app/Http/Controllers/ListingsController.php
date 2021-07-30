<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Listings;
use App\Models\ImageUpload;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ListingsController extends Controller
{
    protected $table = 'listings';
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $data['listings'] = Listings::leftJoin('fuels', 'listings.fuel_id', '=', 'fuels.id')
            ->leftJoin('gearboxes', 'listings.gearbox_id', '=', 'gearboxes.id')
            ->leftJoin('image_uploads', 'listings.slug', '=', 'image_uploads.listing_slug')
            //->latest()
            ->orderByDesc('listings.created_at')
            ->limit(6)
            ->get();

        for ($i = 0; $i < $data['listings']->count(); $i++){
            $data['listings'][$i]['image'] = json_decode($data['listings'][$i]['image']);
        }

        //ddd($data);

//json_decode($data['listings'][0]['image']);
        //ddd($data['listing_images']);
        //$data['listings']['image'] = \GuzzleHttp\json_decode($data['listings']['image']);
        //return $data;
        return view("index", $data);
    }

    public function allListings(Request $request){

        //$data['listings'] = DB::table('listings');

        /*
         if ($request->has('make') && $request->make != null){
             //$data['listings']->whereRaw('`make` = ' . '\'' . $request->make . '\'');
             $data['listings']->where('`make`', $request->make);
             //ddd($data['listings']);
        }

        if ($request->has('model') && $request->model != null){
            $data['listings']->whereRaw('`model` = ' . '\'' . $request->model . '\'');
            //ddd($data['listings']->toSql());
        }

        if (($request->has('min_price') && $request->min_price != null)){
            $data['listings']->whereRaw('price >= ' . '\'' . $request->min_price . '\'');
            //ddd($filter);
        }

        if ($request->has('max_price') && $request->max_price != null){
            $data['listings']->whereRaw('price <= ' . '\'' . $request->max_price . '\'');
            //ddd($data['listings']->toSql());
        }

        if ($request->has('year_from') && $request->year_from != null){
            $data['listings']->whereRaw('year >= ' . '\'' . $request->year_from . '\'');

            //ddd($filter);
        }

        if ($request->has('year_to') && $request->year_to != null){
            $data['listings']->whereRaw('year <= ' . '\'' . $request->year_to . '\'');
            //ddd($filter);
        }

        if ($request->has('min_hp') && $request->min_hp != null){
            $data['listings']->whereRaw('hp >= ' . '\'' . $request->min_hp . '\'');
            //ddd($filter);
        }

        if ($request->has('max_hp') && $request->max_hp != null){
            $data['listings']->whereRaw('hp <= ' . '\'' . $request->max_hp . '\'');
            //ddd($filter);
        }

        if ($request->has('fuel') && $request->fuel != null){
            $data['listings']->whereRaw('`fuel_id` = ' . '\'' . $request->fuel . '\'');
            //ddd($filter);
        }

        if ($request->has('gearbox') && $request->gearbox != null){
            $data['listings']->whereRaw('`gearbox_id` = ' . '\'' . $request->gearbox . '\'');
            //ddd($filter);
        }
        */

        if(!empty($request->query())){
            //ddd($filter);
            $data['listings'] = Listings::
            leftJoin('fuels', 'listings.fuel_id', '=', 'fuels.id')
                ->leftJoin('gearboxes', 'listings.gearbox_id', '=', 'gearboxes.id')
                ->leftJoin('image_uploads', 'listings.slug', '=', 'image_uploads.listing_slug')
                ->orderByDesc('listings.created_at')
                //->latest()
                ->paginate(15);
            //ddd($data['listings']->toSql());
            //ddd($request);

            //ddd($data['listings']);

        } else {
            //ddd($results);
            $data['listings'] = Listings::
                leftJoin('fuels', 'listings.fuel_id', '=', 'fuels.id')
                ->leftJoin('gearboxes', 'listings.gearbox_id', '=', 'gearboxes.id')
                ->leftJoin('image_uploads', 'listings.slug', '=', 'image_uploads.listing_slug')
                ->orderByDesc('listings.created_at')
                //->latest()
                ->paginate(15);

        }

        for ($i = 0; $i < $data['listings']->count(); $i++){
            $data['listings'][$i]['image'] = json_decode($data['listings'][$i]['image']);
        }
        //dd($data['listings']);
        //dd($data['listings']->count());
        return view('listings', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        //

        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $rules = array(
            'make' => 'required',
            'model' => 'required',
            'year' => 'required | gt:1950 | lt:2021',
            'price' => 'required | gt:0',
            'cubic' => 'required | gt:0',
            'mileage' => 'required | gt:0',
            'fuel' => 'required',
            'gearbox' => 'required',
            'colour' => 'required | string',
            'hp' => 'required | gt:0',
            'first_name' => 'required | string',
            'last_name' => 'required | string',
            'telephone' => 'required',
            'town' => 'required',
            'image' => 'max:15',
            'image.*' => 'image | mimes:jpeg,jpg | max:10240'
        );

        //ddd($request);
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect('/create')
                ->withErrors($validator)
                ->withInput();
        }
        $title = $request->make . " " . $request->model . " " . number_format(round($request->cubic/1000,1));
        $slug = Str::slug($title . "-" . uniqid());

        //ddd($request->description);

        $listing = new Listings;
        $listing->title = $title;
        $listing->make = $request->make;
        $listing->model = $request->model;
        $listing->year = $request->year;
        $listing->slug = $slug;
        $listing->price = $request->price;
        $listing->cubic = $request->cubic;
        $listing->mileage = $request->mileage;
        $listing->fuel_id = $request->fuel;
        $listing->gearbox_id = $request->gearbox;
        $listing->colour = $request->colour;
        if($request->has('description')){
            $listing->description = $request->description;
        }
        $listing->hp = $request->hp;
        $listing->first_name = $request->first_name;
        $listing->last_name = $request->last_name;
        $listing->telephone = $request->telephone;
        $listing->town = $request->town;
        $listing->save();

        if($request->hasfile('image'))
        {

            foreach($request->file('image') as $image)
            {
                $name=uniqid('img_') . '.' . $image->extension();
                $image->move(public_path().'/images/listing_images', $name);
                $imgArr[] = $name;
            }

            $imageUpload = new ImageUpload();
            $imageUpload->listing_slug = $slug;
            $imageUpload->image = json_encode($imgArr, true);

            $imageUpload->save();
        }

        //session()->put('success', 'Успешно създадохте обявата!');

        //Session::flash('message', 'Успешно създадохте обявата');
        //$request->session()->flash('message', 'Успешно създадохте обявата');
        return redirect('listing/'. $slug)->with('success', 'Успешно създадохте обявата!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show($slug)
    {
        $data['listing'] = DB::table('listings')
            ->whereRaw('`listings`.`slug` = ' . '\'' . $slug . '\'')
            ->leftJoin('fuels', 'listings.fuel_id', '=', 'fuels.id')
            ->leftJoin('gearboxes', 'listings.gearbox_id', '=', 'gearboxes.id')
            ->leftJoin('image_uploads', 'listings.slug', '=', 'image_uploads.listing_slug')
            ->first();

        if(!empty($data['listing']->image)){
                $data['listing']->image = json_decode($data['listing']->image);
        }

        if(empty($data['listing'])){
            abort(404);
        }

        return view("listing", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
