<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Bisnis Unit</h2>
    <div class="flex justify-between items-center mb-2">
        <x-button  wire:click='openFormModalForAdd'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Add</x-button>
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-auto py-3 px-4 text-center">Bisnis Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">Created At</th>
                    <th class="w-1/12 py-3 px-4 text-center">Updated At</th>
                    <th colspan="2" class="w-1/12 py-3 px-4 text-center justify-between">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($allBisnisUnit as $bisnisUnit)
                    <tr class="border-b border-gray-200 hover:bg-gray-300" wire:key='{{$bisnisUnit->id}}'>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $bisnisUnit->nama_bisnis_unit }}</td>
                        <td class="py-3 px-4">{{ $bisnisUnit->created_at }}</td>
                        <td class="py-3 px-4">{{ $bisnisUnit->updated_at }}</td>
                        <td class="py-3 px-4"><x-button color="bg-yellow-600" wire:click='openFormModalForEdit({{$bisnisUnit->id}})'><i class="fa-solid fa-pen-to-square font-extrabold pr-1"></i>Edit</x-button></td>
                        <td class="py-3 px-4"><x-danger-button wire:click='openDeleteModal({{$bisnisUnit->id}})'><i class="fa-solid fa-trash-can font-extrabold pr-1"></i>Delete</x-danger-button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allBisnisUnit->links() }}
    </div>

    {{-- Delete Modal --}}
    <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Hapus Bisnis Unit') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Apakah anda yakin akan menghapus Bisnis Unit '. $nama_bisnis_unit .' ? Data Bisnis Unit beserta semua data yang terhubung dengan Bisnis Unit ini akan terhapus.') }}

            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('deleteModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteData" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
    </x-dialog-modal>
    {{-- Delete Modal --}}
        
    {{-- Form Modal --}}
    <x-dialog-modal wire:model.live="formModal">
        <x-slot name="title">
            {{ __('Bisnis Unit Form') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="nama_bisnis_unit" value="{{ __('Nama Bisnis Unit') }}" />
                <x-input id="nama_bisnis_unit" class="block mt-1 w-full" type="text" name="nama_bisnis_unit" wire:model="nama_bisnis_unit" required />
                <x-input-error for="nama_bisnis_unit" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('formModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button wire:click="saveData" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    {{-- Form Modal --}}

</div>
