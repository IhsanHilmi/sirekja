<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FPK') }}@isset($submenu) {{__('> '.$submenu)}}@endisset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (request()->routeIs('FPK Submission'))
                    @livewire('Fpk.SubmissionForm', ['cursorId' => $cursorId])
                @elseif (request()->routeIs('FPK Main'))
                    @livewire('Fpk.fpkMain')
                @endif
            </div>
        </div>
    </div>
</x-app-layout>