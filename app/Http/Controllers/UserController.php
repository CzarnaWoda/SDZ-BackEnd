<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\userCollection;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;



class UserController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $isAdmin = $user->roles()->where('name', 'admin')->exists();

        if(!$isAdmin){
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
        return new userCollection(User::all());
    }

    public function show(Invoice $invoice)
    {
        return new UserResource($invoice);
    }
}
