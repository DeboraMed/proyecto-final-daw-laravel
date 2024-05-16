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
use Illuminate\Validation\Rule;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            # TODO: Validar password correctamente
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'avatar' => 'required|string|max:255',

            'user_type' => 'required|string|in:empresa,desarrollador',
            /*
            'contract_type' => 'required_if:user_type,desarrollador|string|max:255',
            'work_mode' => 'required_if:user_type,desarrollador|string|max:255',
            'schedule' => 'required_if:user_type,desarrollador|string|max:255',
            'specialization' => 'required_if:user_type,desarrollador|string|max:255',
            */
        ]);

        // Crear la empresa o el desarrollador según el tipo de usuario
        if ($request->user_type === 'empresa') {
            $userable = Company::create([
            ]);
        } else {
            $userable = Developer::create([
                /*
                'contract_type' => $request->contract_type,
                'work_mode' => $request->work_mode,
                'schedule' => $request->schedule,
                'specialization' => $request->specialization,
                'github_url' => $request->github_url,
                */
            ]);
        }

        // Crear el usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->description = $request->description;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->avatar = $request->avatar;
        $user->userable_id = $userable->id;
        $user->userable_type = $userable::class;
        $user->save();

        return response()->json(['message' => 'Usuario registrado correctamente'], 201);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        # TODO: Intentar tratar como Patch?

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'phone' => 'string|max:255',
            'address' => 'string|max:255',
            'avatar' => 'string|max:255',
            'contract_type' => Rule::enum(ContractTypeEnum::class),
            'work_mode' => Rule::enum(WorkModeEnum::class),
            'schedule' => Rule::enum(ScheduleEnum::class),
            'specialization' => Rule::enum(SpecializationEnum::class),
        ]);

        $user->update($request->all());

        return response()->json(['user' => $user], 200);
    }
}
