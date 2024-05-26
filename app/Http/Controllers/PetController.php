<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

use App\Http\Resources\PetResource;
use App\Http\Resources\PetCollection;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PetCollection(Pet::paginate());
    }

    public function all(){

        $user = auth()->user();
        $isAdmin = $user->roles()->where('name', 'admin')->exists();

        if(!$isAdmin){
            return response()->json(['message' => 'You are not authorized to access this resource'], 403);
        }
        return new PetCollection(Pet::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'race' => 'required|string|max:255',
            'gender' => 'required|string|in:MALE,FEMALE',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pets', 'public');
            $validated['image'] = $imagePath;


            $pet = new Pet();
            $pet->name = $validated['name'];
            $pet->race = $validated['race'];
            $pet->gender = $validated['gender'];
            $pet->age = $validated['age'];
            $pet->description = $validated['description'];
            $pet->image = $validated['image'];
            $pet->save();

            return response()->json(['message' => 'Pet added successfully', 'pet' => $pet], 201);
        }else{
            return response()->json(['message' => 'Image is required'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
