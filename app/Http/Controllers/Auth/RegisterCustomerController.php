<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role; 

class RegisterCustomerController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/customer/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.registercustomer');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'dni'      => ['required', 'string', 'max:20', 'unique:customers'],
            'telefono' => ['required', 'string', 'max:15'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $customer = Customer::create([
            'name'     => $data['name'],
            'dni'      => $data['dni'],
            'telefono' => $data['telefono'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // se asigna el rol "cliente"
        $customer->assignRole('cliente');

        return $customer;
    }
}
