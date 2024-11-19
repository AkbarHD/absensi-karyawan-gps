<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemen = DB::table('departemen')->paginate(12);
        return view('departemen.index', compact('departemen'));
    }
}
