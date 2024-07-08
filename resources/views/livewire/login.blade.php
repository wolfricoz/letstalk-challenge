<div>
    <h1 class="text-2xl font-bold text-center">Login</h1>
    <form method="POST" action="{{ route('login.authenticate') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="block" wire:model.live="email" required >
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="text" name="password" class="block" required wire:model.live="password">
        </div>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600 text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <button type="submit" >Login</button>
        </div>
    </form>
</div>
