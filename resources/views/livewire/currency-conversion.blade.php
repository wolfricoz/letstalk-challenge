<div class="bg-gray-300 rounded-xl w-2/3 p-4">

    <form wire:submit.prevent="calculate" class="flex flex-col justify-center">
        <div class="inline-flex gap-4 it justify-center">
            <input type="number" wire:model="amount"  class="rounded-xl"/>

            <select class="p-4 rounded-xl" wire:model="selectedCurrency">
                <option value="">Select Currency</option>
                @foreach($availableCurrenties as $curr)
                    <option value="{{$curr->id}}">{{$curr->name}}</option>
                @endforeach
            </select>
        </div>

        <x-primary-button type="submit" class="w-full mt-2">Calculate</x-primary-button>
        <div wire:loading>
            <p>Calculating the conversions...</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500 text-white p-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
    <div class="grid-cols-10 grid gap-2 max-h-96 overflow-y-scroll">
        @foreach($calculated as $key=>$cal)
            <div class="col-span-1 bg-amber-200 rounded-xl p-1">
                <h1 class="font-bold text-2xl text-center">{{ $key }}</h1>
                <p>{{ number_format($cal, 2) . " " . $key }}</p>
            </div>
        @endforeach
    </div>

</div>
