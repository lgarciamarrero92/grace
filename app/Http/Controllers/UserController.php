<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/users",
    *     summary="Mostrar usuarios",
    *     tags={"usuarios"},
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los usuarios."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        return User::all();
    }
    public function search(Request $request){
        if(!$request['query'])return;
        return User::whereRaw('lower(name) like ? ', '%' . strtolower($request['query']) . '%')->get();
    }
}
