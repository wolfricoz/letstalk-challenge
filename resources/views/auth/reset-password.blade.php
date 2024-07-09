<x-header>
<x-center-div>
    @if(isset($$user))
        @livewire('reset-password')
    @else
        @livewire('request-reset')
    @endif

</x-center-div>
</x-header>
