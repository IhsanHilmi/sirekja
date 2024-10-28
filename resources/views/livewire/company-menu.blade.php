<div class="grid grid-cols-3 mx-auto gap-6 justify-items-center bg-white">
    <x-card-menu>
        <x-slot:url>{{route('company', ['contains' => 'BisnisUnit'])}}</x-slot>
        <x-slot:icon>fa-regular fa-building</x-slot>
            Bisnis Unit
    </x-card-menu>
    <x-card-menu>
        <x-slot:url>{{route('company', ['contains' => 'Departemen'])}}</x-slot>
        <x-slot:icon>fa-solid fa-people-roof</x-slot>
            Departemen
    </x-card-menu>
    <x-card-menu>
        <x-slot:url>{{route('company', ['contains' => 'Jabatan'])}}</x-slot>
        <x-slot:icon>fa-solid fa-user-tie</x-slot>
            Jabatan
    </x-card-menu>
</div>
