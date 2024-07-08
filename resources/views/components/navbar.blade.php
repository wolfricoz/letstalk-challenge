<div class="flex flex-row justify-between border h-10 content-center items-center">
    <h1 class="text-2xl font-bold px-2">{{ config('app.name') }}</h1>
    <div>
        @auth()
        <a href="{{ _('dashboard') }}">Dashboard</a>
        <a href="{{ _('logout') }}">Logout</a>
        @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</div>
