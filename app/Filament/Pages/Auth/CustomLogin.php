<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\Html;
use Filament\Forms\Components\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Validator;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use MarcoGermani87\FilamentCookieConsent\Components\CaptchaField;


class CustomLogin extends BaseLogin
{
    public ?string $email = null;
    public ?string $password = null;
    public ?string $captcha = null;

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

            CaptchaField::make('captcha')
            ->label('Masukkan Captcha')
            ->required(),
        ]);
    }

    public function authenticate(): ?LoginResponse
    {
        Validator::make(
            ['captcha' => $this->captcha],
            ['captcha' => 'required|captcha']
        )->validate();

        $this->validate();

        if (! Auth::attempt([
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
