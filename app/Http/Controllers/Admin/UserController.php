<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Tables\AdminUsersTable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = (new AdminUsersTable())->setup();
    
        return view('admin.user.index')->with('table', $table);
    }
}
