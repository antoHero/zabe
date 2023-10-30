<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="px-6 py-4">
    @auth
        <button wire:click="logout" class="w-full text-left">
            {{ __('Log Out') }}
        </button>
    @else
        <a href="{{ route('login') }}" class="focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" wire:navigate>Register</a>
        @endif
    @endauth
</div>
