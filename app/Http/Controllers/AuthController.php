<?php

namespace App\Http\Controllers;

use App\Enums\ContractTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SpecializationEnum;
use App\Enums\WorkModeEnum;
use App\Models\Company;
use App\Models\Developer;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use function Laravel\Prompts\password;

//use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('my_token');
            return ['token' => $token->plainTextToken, 'user_type' => ($user->userable instanceof Developer) ? 'developer' : 'company'];
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function user()
    {
        $user = auth()->user()->load('userable');
        return response()->json(['user' => $user], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }


    public function register(Request $request)
    {
        # TODO: Considerar actualizar el avatar en un endpoint aparte

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_data' => 'required|json'
        ]);

        $userData = json_decode($request->input('user_data'), true);

        $input_data = validator($userData, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', Password::defaults()],
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'user_type' => 'required|string|in:empresa,desarrollador',
        ])->validate();

        // Crear la empresa o el desarrollador según el tipo de usuario
        if ($input_data['user_type'] === 'empresa') {
            $userable = Company::create();
        } else {
            $userable = Developer::create();
        }

        $image = $request->file('avatar');
        $imagePath = Storage::disk('public')->put('storage', $image);
        $input_data['avatar'] = basename($imagePath);

        $user = new User($input_data);
        $user->userable_id = $userable->id;
        $user->userable_type = $userable::class;
        $user->save();

        return response()->json(['message' => 'Usuario registrado correctamente'], 201);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $input_data = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'phone' => 'string|max:255',
            'address' => 'string|max:255',
            'userable.contract_type' => Rule::enum(ContractTypeEnum::class),
            'userable.work_mode' => Rule::enum(WorkModeEnum::class),
            'userable.schedule' => Rule::enum(ScheduleEnum::class),
            'userable.specialization' => Rule::enum(SpecializationEnum::class),
            'userable.github_url' => 'nullable|url',
        ]);

        $user->update($input_data);

        if($user->userable instanceof Developer && $input_data['userable'])
            $user->userable->update($input_data['userable']);

        return response()->json(['user' => $user], 200);
    }
}
