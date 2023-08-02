<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Jetstream\Jetstream;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;

class AuthController extends Controller
{
    use PasswordValidationRules;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.'
            ], 400);
        }
     
        return response()->json([
            'success' => true,
            'access_token' => $user->createToken($request->device_name)->plainTextToken
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'Member',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful, login to continue!',
            'user' => new UserResource($user),
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'member' => new UserResource($request->user())
        ], 200);
         
        
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
 
        $user = User::where('email', $request->email)->first();
        $user->sendPasswordResetCode();

        return response()->json([
            'success' => true,
            'message' => 'Password reset code successfully sent to registered email'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => $this->passwordRules(),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        if ($request->code == $user->password_reset_code) {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'password_reset_code' => null,
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));

            return response()->json([
                'success' => true,
                'message' => 'Password successfully updated'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid password reset code'
        ], 400);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'age' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$user->id],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'sailing_experience' => ['required', 'string', 'in:Beginner,Intermediate,Experienced'],
            'preferred_type' => ['required'],
            'household_income' => ['required', 'string', 'max:255'],
            'is_sailboat_owner' => ['required', 'in:0,1'],
            'vendor_id' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:16000']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        if ($request->hasFile('profile_picture')) {
            $user->updateProfilePhoto($request->profile_picture);
        }

        $user->forceFill([
            'name' => $request->name,
            'email' => $request->email,
        ])->save();

        UserProfile::updateOrCreate([
            'user_id' => $user->id
        ],[
            'gender' => $request->gender,
            'age' => $request->age,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'sailing_experience' => $request->sailing_experience,
            'preferred_type' => $request->preferred_type,
            'household_income' => $request->household_income,
            'is_sailboat_owner' => $request->is_sailboat_owner,
            'vendor_id' => $request->vendor_id,
        ]);

        return response()->json([
            'success' => true,
            'member' => new UserResource($user),
            'message' => 'User profile successfully updated'
        ], 200);
    }
}
