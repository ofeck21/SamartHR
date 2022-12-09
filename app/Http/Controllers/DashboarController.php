<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboarController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('/content/dashboard', ['pageConfigs' => $pageConfigs]);
    }
}
