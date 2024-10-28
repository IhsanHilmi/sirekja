<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Employee</h2>
    <div class="flex justify-between items-center mb-2">
        <x-button  wire:click='openFormModalForAdd'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Add</x-button>
        <x-button  color="bg-blue-600" wire:click='redirectToEmployeeTransfer'><i class="fa-solid fa-right-left font-extrabold pr-1"></i>Employee Transfers</x-button>
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-auto py-3 px-4 text-center">Nama</th>
                    <th class="w-1/12 py-3 px-4 text-center">Status</th>
                    <th class="w-auto py-3 px-4 text-center">Jabatan</th>
                    <th class="w-1/12 py-3 px-4 text-center">Golongan</th>
                    <th class="w-1/12 py-3 px-4 text-center">Departemen</th>
                    <th class="w-1/12 py-3 px-4 text-center">Bisnis Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">Tanggal Bergabung</th>
                    <th colspan="2" class="w-1/12 py-3 px-4 text-center justify-between">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($allEmployee as $employee)
                    <tr class="border-b border-gray-200 hover:bg-gray-300" wire:key='{{$employee->id}}'>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $employee->employee_name }}</td>
                        <td class="py-3 px-4">{{ $employee->status }}</td>
                        <td class="py-3 px-4">{{ $employee->jabatan->nama_jabatan }}</td>
                        <td class="py-3 px-4">{{ $employee->golongan }}</td>
                        <td class="py-3 px-4">{{ $employee->jabatan->departemen->nama_departemen }}</td>
                        <td class="py-3 px-4">{{ $employee->jabatan->departemen->bisnisUnit->nama_bisnis_unit }}</td>
                        <td class="py-3 px-4">{{ $employee->tanggal_bergabung }}</td>
                        <td class="py-3 px-4"><x-button color="bg-yellow-600" wire:click='openFormModalForEdit({{$employee->id}})'><i class="fa-solid fa-pen-to-square font-extrabold pr-1"></i>Edit</x-button></td>
                        <td class="py-3 px-4"><x-danger-button wire:click='openDeleteModal({{$employee->id}})'><i class="fa-solid fa-trash-can font-extrabold pr-1"></i>Delete</x-danger-button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allEmployee->links() }}
    </div>

    {{-- Delete Modal --}}
    <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Hapus Employee') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Apakah anda yakin akan menghapus Employee '. $employee_name .' ? Data Employee beserta semua data yang terhubung dengan Employee ini akan terhapus.') }}

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
            {{ __('Employee Form') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="employee_name" value="{{ __('Nama Employee') }}" />
                <x-input id="employee_name" class="block mt-1 w-full" type="text" name="employee_name" wire:model="employee_name" required />
                <x-input-error for="employee_name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="bisnis_unit_id" value="{{ __('Bisnis Unit Asal') }}" />
                <select id="bisnis_unit_id" name="bisnis_unit_id" wire:model.change="bisnis_unit_id" wire:change='mountDepartemens' required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Bisnis Unit yang tersedia</option>
                    @foreach($bu as $bisnisUnit)
                        <option value="{{$bisnisUnit->id}}" wire:key='{{$bisnisUnit->id}}'>{{$bisnisUnit->nama_bisnis_unit}}</option>
                    @endforeach
                </select>    
                <x-input-error for="bisnis_unit_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="departemen_id" value="{{ __('Departemen Asal') }}" />
                <select id="departemen_id" name="departemen_id" wire:model.change="departemen_id" wire:change='mountJabatans' required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($bisnis_unit_id == "")>
                    <option value="">Departemen yang tersedia</option>
                    @foreach($d as $departemen)
                        <option @selected($departemen->id == $departemen_id) value="{{$departemen->id}}" wire:key='{{$departemen->id}}'>{{$departemen->nama_departemen}}</option>
                    @endforeach
                </select>    
                <x-input-error for="departemen_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="jabatan_id" value="{{ __('Jabatan') }}" />
                <select id="jabatan_id" name="jabatan_id" wire:model.change="jabatan_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($departemen_id == "")>
                    <option value="">Jabatan yang tersedia</option>
                    @foreach($j as $jabatan)
                        <option @selected($jabatan->id == $jabatan_id) value="{{$jabatan->id}}" wire:key='{{$jabatan->id}}'>{{$jabatan->nama_jabatan}}</option>
                    @endforeach
                </select>    
                <x-input-error for="jabatan_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="golongan" value="{{ __('Golongan') }}" />
                <x-input id="golongan" class="block mt-1 w-full" type="text" pattern="0[1-6]|24|25" name="golongan" wire:model="golongan" required />
                <x-input-error for="golongan" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="status" value="{{ __('Status Kepegawaian') }}" />
                <select id="status" name="status" wire:model.change="status" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Status Kepegawaian</option>
                    <option value="Kontrak">Kontrak</option>
                    <option value="Bulan">Bulan</option>
                </select>
                <x-input-error for="status" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="tanggal_bergabung" value="{{ __('Tanggal Bergabung') }}" />
                <x-input id="tanggal_bergabung" class="block mt-1 w-full" type="date" name="tanggal_bergabung" wire:model.change="tanggal_bergabung" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm"/>
                <x-input-error for="tanggal_bergabung" class="mt-2" />
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
