<a
		{{ $attributes->class(['bg-gray-400 hover:bg-blue-400 hover:text-white px-2 py-1 rounded transition-all']) }}
		href="{{ $attributes['href'] }}">
    {{ $slot }}
</a>
