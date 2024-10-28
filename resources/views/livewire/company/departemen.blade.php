<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Departemen</h2>
    <div class="flex justify-between items-center mb-2">
        <x-button  wire:click='openFormModalForAdd'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Add</x-button>
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-auto py-3 px-4 text-center">Departemen</th>
                    <th class="w-auto py-3 px-4 text-center">Bisnis Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">Created At</th>
                    <th class="w-1/12 py-3 px-4 text-center">Updated At</th>
                    <th colspan="2" class="w-1/12 py-3 px-4 text-center justify-between">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($allDepartemen as $departemen)
                    <tr class="border-b border-gray-200 hover:bg-gray-300" wire:key='{{$departemen->id}}'>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $departemen->nama_departemen }}</td>
                        <td class="py-3 px-4">{{ $departemen->bisnisUnit->nama_bisnis_unit }}</td>
                        <td class="py-3 px-4">{{ $departemen->created_at }}</td>
                        <td class="py-3 px-4">{{ $departemen->updated_at }}</td>
                        <td class="py-3 px-4"><x-button color="bg-yellow-600" wire:click='openFormModalForEdit({{$departemen->id}})'><i class="fa-solid fa-pen-to-square font-extrabold pr-1"></i>Edit</x-button></td>
                        <td class="py-3 px-4"><x-danger-button wire:click='openDeleteModal({{$departemen->id}})'><i class="fa-solid fa-trash-can font-extrabold pr-1"></i>Delete</x-danger-button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allDepartemen->links() }}
    </div>

    {{-- Delete Modal --}}
    <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Hapus Departemen') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Apakah anda yakin akan menghapus Departemen '. $nama_departemen .' ? Data Departemen beserta semua data yang terhubung dengan Departemen ini akan terhapus.') }}

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
            {{ __('Departemen Form') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="nama_departemen" value="{{ __('Nama Departemen') }}" />
                <x-input id="nama_departemen" class="block mt-1 w-full" type="text" name="nama_departemen" wire:model="nama_departemen" required />
                <x-input-error for="nama_departemen" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="bisnis_unit_id" value="{{ __('Bisnis Unit Asal') }}" />
                <select id="bisnis_unit_id" name="bisnis_unit_id" wire:model.change="bisnis_unit_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Bisnis Unit yang tersedia</option>
                    @foreach($bu as $bisnisUnit)
                        <option value="{{$bisnisUnit->id}}" wire:key='{{$bisnisUnit->id}}'>{{$bisnisUnit->nama_bisnis_unit}}</option>
                    @endforeach
                </select>    
                <x-input-error for="bisnis_unit_id" class="mt-2" />
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
