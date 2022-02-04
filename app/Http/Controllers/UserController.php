<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use App\Traits\Users\UsersTrait;
use LVR\CountryCode\Two;
use DB;

class UserController extends Controller
{
    private $messages = [
        'required'  => 'The :attribute is required.',
        'string'    => 'The :attribute must be of type string.',
        'email'     => 'The :attribute must be of type email,',
        'unique'    => 'The :attribute is already registered.',
    ];

    private $attributes = [
        'firstName' => 'First Name',
        'lastName'  => 'Last Name',
        'email'     => 'Email',
        'password'  => 'Password',
        'country'   => 'Country',
    ];

    use UsersTrait;

    public function __construct()
	{
	    $this->middleware('auth');
	}

    public function index(Request $request)
    {
        return response()->json($request->user());
    }

    public function store (Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'firstName' => 'required',
                'lastName'  => 'required',
                'email'     => 'required|string|email|unique:users',
                'password'  => 'required|string',
                'country'   => ['required', new Two]
            ];
    
            $request->validate($rules, $this->messages, $this->attributes);
            
            $user = User::create($request->toArray());
    
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully User Created!',
                'user'      => $user
            ], 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Error Create User!'
            ], 201);
        }
    }

    public function update(Request $request, User $user){
        try {
            DB::beginTransaction();

            $rules = [
                'firstName' => 'required',
                'lastName'  => 'required',
                'email'     => 'required|string|email|unique:users,email,'.$user->id,
                'password'  => 'required|string',
                'country'   => ['required', new Two]
            ];
    
            $request->validate($rules, $this->messages, $this->attributes);
    
            if ( !$user->update($request->toArray()) ) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error Update User!'
                ]);
            }
            
            DB::commit();
    
            return response()->json([
                'success' => true, 
                'message' => 'Successfully User Update!'
            ], 201);
        } catch (\Exceptiom $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Error Update User!'
            ], 201);
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            
            if (! $user->delete() ) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error Delete User!'
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Successfully User Deleted!'
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false, 
                'message' => 'Error Deleted User!'
            ], 201);
        }
        

    }
}
