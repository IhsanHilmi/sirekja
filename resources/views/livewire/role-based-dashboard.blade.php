
<div class="grid {{ $loggedUser->role == "Superadmin" || $loggedUser->role == "HR Unit" ? 'grid-cols-3' : 'grid-cols-2' }} mx-auto gap-6 justify-items-center bg-white">
    @if($loggedUser->role == "Superadmin")
        
        {{-- FPK Menu --}}
        <x-card-menu>
            <x-slot:url>{{route('FPK Main')}}</x-slot>
            <x-slot:icon>fa-solid fa-file-contract</x-slot>
                Form Permintaan Karyawan
        </x-card-menu>
        
        {{-- Vacant Position --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-user-tie</x-slot>
                Hiring Vacancies
        </x-card-menu>
        
        {{-- HC --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-address-card</x-slot>
                Hiring Confirmation Form
        </x-card-menu>
        
        {{-- Employee Data Management --}}
        <x-card-menu>
            <x-slot:url>{{route('employee')}}</x-slot>
            <x-slot:icon>fa-solid fa-building-user</x-slot>
                Employee
        </x-card-menu>

        {{-- Approval Line Managemen --}}
        <x-card-menu>
            <x-slot:url>{{route('approval line')}}</x-slot>
            <x-slot:icon>fa-solid fa-stamp</x-slot>
                Approval Line
        </x-card-menu>
        
        {{-- Company Data Management like branch --}}
        <x-card-menu>
            <x-slot:url>{{ route('company') }}</x-slot>
            <x-slot:icon>fa-solid fa-building</x-slot>
                Company Data
        </x-card-menu>

    @elseif($loggedUser->role == "HR Unit")
        {{-- FPK Menu --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-file-contract</x-slot>
                Form Permintaan Karyawan
        </x-card-menu>
        
        {{-- Vacant Position --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-user-tie</x-slot>
                Hiring Vacancies
        </x-card-menu>
        
        {{-- HC --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-address-card</x-slot>
                Hiring Confirmation Form
        </x-card-menu>

    @elseif($loggedUser->role == "Kandidat")

        {{-- Biodata --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-id-card</x-slot>
                Biodata
        </x-card-menu>

        {{-- Unggah Dokumen --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-regular fa-folder-open</x-slot>
            Unggah Dokumen
        </x-card-menu>

    @else
        {{-- FPK Approval --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-file-circle-check</x-slot>
                FPK Approval
        </x-card-menu>

        {{-- HC Approval --}}
        <x-card-menu>
            <x-slot:url>#</x-slot>
            <x-slot:icon>fa-solid fa-person-circle-check</x-slot>
            HC Approval
        </x-card-menu>
    @endif
    
</div>