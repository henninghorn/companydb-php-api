<?php

namespace App\Http\Controllers;

use App\Person;

class PersonController extends Controller
{
    public function index() {
        return [
            'data' => Person::all()
        ];
    }
}
