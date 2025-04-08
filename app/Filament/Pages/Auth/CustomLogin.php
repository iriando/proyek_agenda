<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;

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

            View::make('components.captcha-image'),

            TextInput::make('captcha')
                ->label('Kode Keamanan')
                ->required()
                ->rules(['captcha']),
        ]);
    }
}
