<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Administrators;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\Administrators  $model
     * @return \Illuminate\View\View
     */
    public function index(Administrators $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
}
