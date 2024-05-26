<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $roleUser = Role::where('name', 'user')->first();
        $user->roles()->attach($roleUser);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 600000,
            'user' => auth()->user()
        ]);
    }
    public function me()
    {
        $user = auth()->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function validate(){
        return response()->json([
            'message' => "Token is valid"
        ]);
    }
    public function isAdmin()
    {
        $user = auth()->user();

        $isAdmin = $user->roles()->where('name', 'admin')->exists();

        return response()->json([
            'message' => ($isAdmin ? 'Admin access' : 'No admin access'),
            'is_admin' => $isAdmin,
        ]);
    }
    public function grantAdmin(Request $request)
    {
        $authUser = auth()->user();

        $isAdmin = $authUser->roles()->where('name', 'admin')->exists();
        if(!$isAdmin){
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $userId = $request->input('userId');

        $user = User::find($userId);

        if($user){
            $isAdmin = $user->roles()->where('name', 'admin')->exists();
            if($isAdmin){
                return response()->json(['error' => 'User is already an admin.'], 200);
            }
            $adminRole = Role::where('name', 'admin')->first();


            if($adminRole){
                $user->roles()->attach($adminRole);
                return response()->json(['message' => 'User granted admin rights.'], 200);
            }else{
                return response()->json(['error' => 'Admin role not found.'], 404);
            }
        }else{
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
    public function removeAdmin(Request $request)
    {
        $authUser = auth()->user();

        $isAdmin = $authUser->roles()->where('name', 'admin')->exists();
        if(!$isAdmin){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $userId = $request->input('userId');

        if($authUser->id == $userId){
            return response()->json(['error' => 'You can\'t remove admin rights from yourself.'], 401);
        }

        $user = User::find($userId);

        if($user){
            $adminRole = Role::where('name', 'admin')->first();

            if($adminRole){
                $user->roles()->detach($adminRole);
                return response()->json(['message' => 'Admin rights removed from user.'], 200);
            }else{
                return response()->json(['error' => 'Admin role not found.'], 404);
            }
        }else{
            return response()->json(['error' => 'User not found.'], 404);
        }
    }
    public function removeUser(Request $request)
{
    $authUser = auth()->user();

    $isAdmin = $authUser->roles()->where('name', 'admin')->exists();
    if(!$isAdmin){
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $userId = $request->input('userId');

    if($authUser->id == $userId){
        return response()->json(['error' => 'User cannot delete self.'], 400);
    }

    $user = User::find($userId);

    if($user){
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }else{
        return response()->json(['error' => 'User not found.'], 404);
    }
}
}
