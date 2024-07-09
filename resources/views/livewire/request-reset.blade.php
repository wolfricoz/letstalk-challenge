<div>
    <form class="space-y-4" method="POST" action="{{ route('request-reset') }}">
        <h1 class="text-2xl font-bold">Request Password Reset</h1>
        @csrf
        <div>
            <label>
                <h6 class="">What is your email?</h6>
                <input name="email" type="email" class="block w-full p-2 rounded-xl"  wire:model.live="email">
            </label>
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
        @if(session()->has('error'))
            <div class="text-red-500 text-sm">
                {{ session('error') }}
            </div>
        @endif
        <x-primary-button class="w-full">
            Submit
        </x-primary-button>
    </form>
</div>
