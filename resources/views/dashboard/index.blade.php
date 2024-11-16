<x-app-layout>
    @include('components.message')
    <x-slot name="title">{{ $title }}</x-slot>

    <div>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam expedita nihil repellat sed aspernatur quo
        voluptatibus perspiciatis architecto fugiat! Quasi dolores autem perspiciatis quos est temporibus dolorum,
        nemo iusto excepturi?
    </div>
</x-app-layout>
