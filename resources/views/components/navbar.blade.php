@php use App\Http\Middleware\auth; @endphp
<div class="flex flex-row justify-between border h-10 content-center items-center">
	<a href="{{ route('home') }}">
		<h1 class="text-2xl font-bold px-2">{{ config('app.name') }}</h1>
	</a>
	<div>
		@auth()
			<p1> Logged in: {{ auth()->user()->name }}</p1>
			<a href="{{ _('dashboard') }}">Dashboard</a>
			<form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
		@else
			<a href="{{ route('login') }}">Login</a>
			<a href="{{ route('register') }}">Register</a>
		@endauth
	</div>
</div>
