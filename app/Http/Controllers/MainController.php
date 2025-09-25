<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class MainController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {

        return Inertia::render('main/MainPage');
    }
}
