<div class="bg-gray-300 rounded-xl w-2/3 p-4">

    <form wire:submit.prevent="calculate" class="flex flex-col justify-center">
        <div class="inline-flex gap-4">
            <input type="number" wire:model="amount" />

            <select class=" p-4 " wire:model="selectedCurrency">
                @foreach($availableCurrenties as $curr)
                    <option value="{{$curr->id}}">{{$curr->name}}</option>
                @endforeach
            </select>
        </div>

        <button>
            Submit
        </button>
    </form>
    <div>
        Grid comes here
    </div>

</div>
