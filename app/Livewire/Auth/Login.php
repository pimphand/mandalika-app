<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate(['required', 'email'])]
    public string $email = '';

    #[Validate('required')]
    public string $password = '';
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.auth.login');
    }
    public function save()
    {
        $this->validate();

        $response = Http::post(config('app.api_url') . '/api/login', [
            'email' => $this->email,
            'password' => $this->password
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!isset($data['role']['name']) || !isset($data['token'])) {
                $this->addError('email', 'Terjadi kesalahan dalam autentikasi.');
                return;
            }

            if (!in_array($data['role']['name'], ['sales', 'driver'])) {
                $this->addError('email', 'Akun anda tidak memiliki akses.');
                return;
            }

            if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
                session(['token' => $data['token']]);
                session(['role' => $data['role']['name']]);

                if ($data['role']['name'] == 'driver') {
                    return redirect()->to('/orders');
                }
                return redirect()->to('/');
            }
        }
        $this->addError('email', 'Email atau password salah.');
    }
}
