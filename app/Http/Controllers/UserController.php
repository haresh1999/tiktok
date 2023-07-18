<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    ForgetPasswordRequest,
    LoginRequest,
    ProfileRequest,
    RegisterRequest,
};

use App\Mail\ForgetPasswordMail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->validated();

        $input['password'] = bcrypt($input['password']);

        User::create($input);

        return response()
            ->json([
                'message' => 'User successfully register!',
                'data' => [],
                'response' => true
            ], 200);
    }

    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        $username = filter_var($input['username'], FILTER_SANITIZE_EMAIL);

        $key = !filter_var($username, FILTER_VALIDATE_EMAIL) === false ? 'email' : 'username';

        if (auth()->attempt([$key => $input['username'], 'password' => $input['password']])) {

            $user = auth()->user();

            $token = $user->createToken('MyApp')->plainTextToken;

            return response()
                ->json([
                    'message' => 'User successfully login!',
                    'data' => ['token' => $token],
                    'response' => true
                ], 200);
        }
        return response()
            ->json([
                'message' => 'Username or password is wrong!',
                'data' => [],
                'response' => false
            ], 200);
    }

    public function userDetails()
    {
        $user  = auth()->user();

        return response()
            ->json([
                'message' => 'User details!',
                'data' => $user,
                'response' => true
            ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'message' => 'User logout successfully!',
                'data' => [],
                'response' => true
            ], 200);
    }

    public function userProfileUpdate(ProfileRequest $request)
    {
        $input = $request->validated();

        $user = auth()->user();

        if (isset($input['password'])) {

            $user->password = bcrypt($input['password']);
        }

        if (isset($v['profile_image'])) {

            $user->profile_image = Storage::disk('public')
                ->put('user_profile_image', $input['profile_image']);

            if (Storage::disk('public')->exists($user->profile_image)) {

                Storage::disk('public')->delete($user->profile_image);
            }
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->username = $input['username'];
        $user->mobile = $input['mobile'];

        $user->save();

        return response()
            ->json([
                'message' => 'User profile updated successfully!',
                'data' => [],
                'response' => true
            ], 200);
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $input = $request->validated();

        $username = filter_var($input['username'], FILTER_SANITIZE_EMAIL);

        $key = !filter_var($username, FILTER_VALIDATE_EMAIL) === false ? 'email' : 'username';

        $password = Str::random(9);

        $user = User::where($key, $input['username'])->first();

        $user->update(['password' => bcrypt($password)]);

        Mail::to($user->email)->send(new ForgetPasswordMail($password));

        return response()
            ->json([
                'message' => 'Password successfully send on email address!',
                'data' => [],
                'response' => true
            ], 200);
    }
}
