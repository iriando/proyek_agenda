<?php

namespace App\Filament\Pages;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class Login extends BaseLogin
{
    public ?string $email = '';
    public ?string $password = '';
    public ?string $captcha = '';
    public bool $remember = false;

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('email')
                ->label('Email')
                ->required()
                ->email(),

            TextInput::make('password')
                ->label('Password')
                ->password()
                ->required(),

            TextInput::make('captcha')
                ->label('Kode Keamanan')
                ->required(),

            View::make('components.captcha'),
        ]);
    }

    public function authenticate(): ?LoginResponse
    {
        if (!captcha_check($this->captcha)) {
            throw ValidationException::withMessages([
                'captcha' => 'Kode captcha salah.',
            ]);
        }

        if (!Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
