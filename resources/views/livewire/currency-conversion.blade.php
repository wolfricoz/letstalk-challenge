<div class="bg-gray-300 rounded-xl w-2/3 p-4">

    <form wire:submit.prevent="calculate" class="flex flex-col justify-center">
        <div class="inline-flex gap-4">
            <input type="number" wire:model="amount" />

            <select class=" p-4 " wire:model="selectedCurrency">
                <option value="">Select Currency</option>
                @foreach($availableCurrenties as $curr)
                    <option value="{{$curr->id}}">{{$curr->name}}</option>
                @endforeach
            </select>
        </div>

        <button>
            Submit
        </button>
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
    <div class="grid-cols-12 grid">
        @foreach($calculated as $key=>$cal)
            <div class="bg-amber-200">
                <h1 class="font-bold text-2xl">{{ $key }}</h1>
                <p>{{ $cal }}</p>
            </div>
        @endforeach
    </div>

</div>
