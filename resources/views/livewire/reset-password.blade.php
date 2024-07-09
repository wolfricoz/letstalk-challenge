<div>

    <form method="POST" action="{{ route('auth.reset-password.update', $user) }}">
        @csrf
        @method('PATCH')
        <h1 class="text-2xl font-bold text-center">Reset Password</h1>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="block" required wire:model.live="password">

        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="block" type="password" name="password_confirmation" wire:model.live="password_confirmation" required>

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
            <button type="submit" >update password</button>
        </div>

    </form>
</div>
