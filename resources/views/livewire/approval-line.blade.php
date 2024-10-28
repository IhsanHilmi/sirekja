<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Approval Line</h2>
    <div class="flex justify-between items-center mb-2">
        <x-button  wire:click='openFormModalForAdd'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Add</x-button>
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-1/12 py-3 px-4 text-center">ID</th>
                    <th class="w-1/12 py-3 px-4 text-center">Bisnis Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">HR Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">Direksi 1</th>
                    <th class="w-1/12 py-3 px-4 text-center">Direksi 2</th>
                    <th class="w-1/12 py-3 px-4 text-center">Direksi 3</th>
                    <th class="w-1/12 py-3 px-4 text-center">Presiden Direktur</th>
                    <th class="w-1/12 py-3 px-4 text-center">Corporate HR</th>
                    <th class="w-1/12 py-3 px-4 text-center">Superadmin</th>
                    <th colspan="2" class="w-1/12 py-3 px-4 text-center justify-between">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($allApprovalLine as $al)
                    <tr class="border-b border-gray-200 hover:bg-gray-300" wire:key='{{$al->id}}'>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">AL{{ $al->id }}</td>
                        <td class="py-3 px-4">{{ $al->bisnisUnit->nama_bisnis_unit }}</td>
                        <td class="py-3 px-4">{{ $al->hrUnit ? $al->hrUnit->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->direksi1 ? $al->direksi1->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->direksi2 ? $al->direksi2->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->direksi3 ? $al->direksi3->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->Presdir ? $al->Presdir->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->corporateHR ? $al->corporateHR->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->Superadmin ? $al->Superadmin->employee_name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4"><x-button color="bg-yellow-600" wire:click='openFormModalForEdit({{$al->id}})'><i class="fa-solid fa-pen-to-square font-extrabold pr-1"></i>Edit</x-button></td>
                        <td class="py-3 px-4"><x-danger-button wire:click='openDeleteModal({{$al->id}})'><i class="fa-solid fa-trash-can font-extrabold pr-1"></i>Delete</x-danger-button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $allApprovalLine->links() }}
    </div>

    {{-- Delete Modal --}}
    <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Hapus Approval Line') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Apakah anda yakin akan menghapus Approval Line AL'. $cursorId .' ? Data Approval Line beserta semua data yang terhubung dengan Approval Line ini akan terhapus.') }}

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
            {{ __('Approval Line Form') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="user_employee" value="{{ __('Nama Employee') }}" />
                <select id="user_employee" name="user_employee" wire:model.change="user_employee" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">USER EMPLOYEE</option>
                    @foreach($e as $employee)
                        <option @selected($employee->id == $user_employee) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->employee_name}}</option>
                    @endforeach
                </select>    
            </div>
            <div class="mt-4">
                <x-label for="bisnis_unit_id" value="{{ __('Bisnis Unit') }}" />
                <select id="bisnis_unit_id" name="bisnis_unit_id" wire:model.change="bisnis_unit_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Bisnis Unit yang tersedia</option>
                    @foreach($bu as $bisnisUnit)
                        <option value="{{$bisnisUnit->id}}" wire:key='{{$bisnisUnit->id}}'>{{$bisnisUnit->nama_bisnis_unit}}</option>
                    @endforeach
                </select>    
                <x-input-error for="bisnis_unit_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="hr_unit" value="{{ __('HR Unit') }}" />
                <select id="hr_unit" name="hr_unit" wire:model.change="hr_unit" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">HR UNIT</option>
                    @foreach($e as $employee)
                        <option @selected($employee->id == $hr_unit) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->employee_name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="hr_unit" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi1" value="{{ __('Direksi 1') }}" />
                <select id="direksi1" name="direksi1" wire:model.change="direksi1" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">DIREKSI 1</option>
                    @foreach($e as $employee)
                        <option @selected($employee->id == $direksi1) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->employee_name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="direksi1" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi2" value="{{ __('Direksi 2') }}" />
                <select id="direksi2" name="direksi2" wire:model.change="direksi2" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">DIREKSI 2</option>
                    @foreach($e as $employee)
                        <option @selected($employee->id == $direksi2) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->employee_name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="direksi2" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi3" value="{{ __('Direksi 3') }}" />
                <x-input id="direksi3" class="block mt-1 w-full" type="text" name="direksi3" wire:model="direksi3" />
                <x-input-error for="direksi3" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="presdir" value="{{ __('Presiden Direktur') }}" />
                <x-input id="presdir" class="block mt-1 w-full" type="text" name="presdir" wire:model="presdir" />
                <x-input-error for="presdir" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="corporateHR" value="{{ __('Corporate HR') }}" />
                <x-input id="corporateHR" class="block mt-1 w-full" type="text" name="corporateHR" wire:model="corporateHR" />
                <x-input-error for="corporateHR" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="superadmin" value="{{ __('Superadmin') }}" />
                <x-input id="superadmin" class="block mt-1 w-full" type="text" name="superadmin" wire:model="superadmin" />
                <x-input-error for="superadmin" class="mt-2" />
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
