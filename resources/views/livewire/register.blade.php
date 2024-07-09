<div>
    <h1 class="text-2xl font-bold text-center">Register</h1>
    <form method="POST" action="{{ route('auth.register.store') }}" class="flex flex-col justify-center items-center gap-2">
        @method('PUT')
        @csrf
        <div>
            <label for="name">Name</label>
            <input id="name"
                   wire:model.live="name"
                   name="name"
                   class="block p-2 rounded-xl"
                   required
                   autofocus>
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="block p-2 rounded-xl" wire:model.live="email" required >

        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="block p-2 rounded-xl" required wire:model.live="password">

        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block p-2 rounded-xl" type="password" name="password_confirmation" wire:model.live="password_confirmation" required>

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
            <x-primary-button type="submit" class="w-full mt-2">Register</x-primary-button>

    </form>
</div>
