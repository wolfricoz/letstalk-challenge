@php use App\Http\Middleware\auth; @endphp
<div class="flex flex-row justify-between border h-10 content-center items-center ">
    <div class="inline-flex gap-5 items-center ">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold px-2">{{ config('app.name') }}</h1>
        </a>
        <x-navbutton href="{{ route('home') }}">Home</x-navbutton>
        @auth()
            <x-navbutton href="{{ route('admin.index') }}">
                Admin
            </x-navbutton>
        @endauth()
    </div>

	<div class="inline-flex gap-2 p-1">
		@auth()
            <x-navbutton href="{{ route('dashboard') }}">
                Dashboard
            </x-navbutton>
			<form method="POST" action="{{ route('auth.logout') }}" class="inline-flex">
                @csrf
                <button type="submit" class="bg-gray-400 hover:bg-blue-400 hover:text-white px-2 py-1 rounded transition-all">Logout</button>
            </form>
		@else
            <x-navbutton href="{{ route('auth.login') }}">
                Login
            </x-navbutton>
            <x-navbutton href="{{ route('auth.register') }}">
                Register
            </x-navbutton>
		@endauth
	</div>
</div>
