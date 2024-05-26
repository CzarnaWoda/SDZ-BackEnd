<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class InformationController extends Controller
{

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:20',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255'
        ]);

        $information = Information::create([

            'user_id' => auth()->user()->id,
            'street' => $request->street,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName
        ]);

        return response()->json(['message' => 'Information created successfully', 'information' => $information], 201);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone_number' => 'required|string|max:20',
        ]);

        $information = $user->information()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'street' => $request->street,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'phone_number' => $request->phone_number,
            ]
        );

        return response()->json(['message' => 'Information updated successfully', 'information' => $information]);
    }

    public function get()
    {
        $user = auth()->user();

        $information = $user->information;

        if (!$information) {
            return response()->json(['message' => 'Information not found'], 404);
        }

        return response()->json(['information' => $information]);
    }
}
