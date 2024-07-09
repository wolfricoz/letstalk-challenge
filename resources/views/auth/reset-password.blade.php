<x-header>
<x-center-div>

    @if(isset($user))
        @livewire('reset-password', ['user' => $user])
    @else
        @livewire('request-reset')
    @endif

</x-center-div>
</x-header>
