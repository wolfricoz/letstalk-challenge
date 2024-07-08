<div>
    <h1 class="text-2xl font-bold text-center">Register</h1>
    <form method="POST" action="{{ route('register.store') }}">
        @method('PUT')
        @csrf
        <div>
            <label for="name">Name</label>
            <input id="name"
                   wire:model.live="name"
                   name="name"
                   class="block"
                   required
                   autofocus>
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="block" wire:model.live="email" required >

        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="text" name="password" class="block" required wire:model.live="password">

        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block" type="text" name="password_confirmation" wire:model.live="password_confirmation" required>

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
            <button type="submit" >Register</button>
        </div>
    </form>
</div>
