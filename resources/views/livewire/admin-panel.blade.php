<div>
    <form class="space-y-2" wire:submit.prevent="">
        <h1 class="text-2xl font-bold text-center">Admin Panel</h1>
        add IP
        <input type="text" wire:model.live="newip" class="p-2 rounded-xl">
        <button
            wire:click="addIp"
            class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl"
        >Add</button>
        @if($errors->has('newip'))
            <div class="text-red-500">{{ $errors->first('newip') }}</div>
        @endif

        <div class="w-96 flex flex-col gap-2">
            @foreach($ips as $ip)
                <div class="inline-flex items-center justify-between">
                    <div>
                    {{ $ip->ip_address }}
                    </div>

                    <button
                        wire:click="removeIp({{ $ip->id }})"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl"
                    >
                        Remove
                    </button>
                </div>
            @endforeach
        </div>
    </form>
</div>
