<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
    public function get()
    {
        $roles = DB::table('roles')->get();

        return response()->json($roles);
    }


}
