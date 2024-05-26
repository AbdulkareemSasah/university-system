<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
    public function getToday()
    {
        $currentDate = new DateTime();
        $this->today = $currentDate->format('l');
        return $this->today;
    }
    public $today;

    public $days = [
            1 => "Saturday",
            2 => "Sunday",
            3 => "Monday",
            4 => "Tuesday",
            5 => "Wednesday",
            6 => "Thursday",

        ];
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('lectures') }}" wire:navigate>
                        {{ __('My Lectures') }}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link></x-nav-link>
                    <x-nav-link :href="route('lectures')" :active="request()->routeIs('lectures')" wire:navigate>
                        {{ __('All') }}
                    </x-nav-link>


                    @foreach($this->days as $day => $dayLabel)
                        <x-nav-link :href="route('lectures-per-day', ['day' => $day])" :active="request()->day == $day" wire:navigate>
                            {{ __($dayLabel) }} @if($dayLabel == $this->getToday()) - {{ __("Today") }}@endif
                        </x-nav-link>
                    @endforeach
                </div>
                @auth("doctor")
                    <div class="inline-flex dark:border-gray-600">
                            <div class="my-auto mx-4 text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' =>"د/ ".auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <x-secondary-button wire:click="logout" class="h-fit  my-auto mx-3">
                                {{ __('Log Out') }}
                            </x-secondary-button>
                        <a href="{{route('index')}}" class="my-auto ">
                                {{ __('Back to Home') }}
                            </a>
                    </div>
                @endauth
            </div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('lectures')" :active="request()->routeIs('lectures')" wire:navigate>
                {{ __('All') }}
            </x-responsive-nav-link>
            @foreach($this->days as $day => $dayLabel)
                <x-responsive-nav-link :href="route('lectures-per-day', ['day' => $day])" :active="request()->day == $day" wire:navigate>
                    {{ __($dayLabel) }} @if($dayLabel == $this->getToday()) - {{ __("Today") }}@endif
                </x-responsive-nav-link>
            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        @auth("doctor")
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                </div>

                <div class="mt-3 space-y-1">
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1">
                @guest
                    <x-responsive-nav-link :href="route('login')" wire:navigate>
                        {{ __('Sign In') }}
                    </x-responsive-nav-link>
                @endguest
            </div>
        </div>

    </div>
</nav>

