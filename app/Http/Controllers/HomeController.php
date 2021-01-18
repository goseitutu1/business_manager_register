<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       /* $ads = Advert::query()->whereHas('status', function ($row) {
            $row->where('is_published', true);
        })->get();*/
        return view('home.index');
    }


    public function adverts()
    {
        dd("Hehehe");
    }
}
