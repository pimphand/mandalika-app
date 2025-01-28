<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate(['required','email'])]
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

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            $data = Http::post(config('app.api_url') . '/api/login', [
                'email' => $this->email,
                'password' => $this->password
            ]);
            $data = $data->json();
            session(['token' => $data['token']]);
            return redirect()->to('/');
        }
        $this->addError('email', 'Email or password is incorrect.');
    }
}
