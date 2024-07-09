@php use App\Http\Middleware\auth; @endphp
<div class="flex flex-row justify-between border h-10 content-center items-center">
    <div class="inline-flex gap-5 items-center ">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold px-2">{{ config('app.name') }}</h1>
        </a>
        <a href="{{ route('home') }}">Home</a>
        @auth()
            <a href="{{ route('admin.index') }}">admin</a>
        @endauth()
    </div>

	<div>
		@auth()
			<a href="{{  route('dashboard')  }}">Dashboard</a>
			<form method="POST" action="{{ route('logout') }}" class="inline-flex">
                @csrf
                <button type="submit">Logout</button>
            </form>
		@else
			<a href="{{ route('login') }}">Login</a>
			<a href="{{ route('register') }}">Register</a>
		@endauth
	</div>
</div>
