<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;


class PageController extends Controller
{
    public function contact(){
        $faker = Faker::create();
        return view('pages.contact', compact('faker'));
    }
}
