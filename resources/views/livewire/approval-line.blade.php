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
                    <th class="w-1/12 py-3 px-4 text-center">ID</th>
                    <th class="w-1/12 py-3 px-4 text-center">Bisnis Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">HR Unit</th>
                    <th class="w-1/12 py-3 px-4 text-center">Department Head</th>
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
                        <td class="py-3 px-4">AL-{{ $al->id }}</td>
                        <td class="py-3 px-4">{{ $al->bisnisUnit->nama_bisnis_unit }}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','HR Unit')->first() ? $al->users()->wherePivot('approves_as','HR Unit')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Dept. Head')->first() ? $al->users()->wherePivot('approves_as','Dept. Head')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Direksi 1')->first() ? $al->users()->wherePivot('approves_as','Direksi 1')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Direksi 2')->first() ? $al->users()->wherePivot('approves_as','Direksi 2')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Direksi 3')->first() ? $al->users()->wherePivot('approves_as','Direksi 3')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Presdir')->first() ? $al->users()->wherePivot('approves_as','Presdir')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Corp. HR')->first() ? $al->users()->wherePivot('approves_as','Corp. HR')->first()->name : __('Tidak Dibutuhkan')}}</td>
                        <td class="py-3 px-4">{{ $al->users()->wherePivot('approves_as','Dept. Head')->first() ? $al->users()->wherePivot('approves_as','Dept. Head')->first()->name : __('Tidak Dibutuhkan')}}</td>
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
                {{ __('Apakah anda yakin akan menghapus Approval Line AL-'. $cursorId .' ? Data Approval Line beserta semua data yang terhubung dengan Approval Line ini akan terhapus.') }}

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
                <x-label for="approval_line_desc" value="{{ __('Deskripsi Singkat Approval Line') }}" />
                <x-input id="approval_line_desc" class="block mt-1 w-full" type="text" name="approval_line_desc" wire:model.change="approval_line_desc" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm"/>
                <x-input-error for="approval_line_desc" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="hr_unit_id" value="{{ __('HR Unit') }}" />
                <select id="hr_unit_id" name="hr_unit_id" wire:model.change="hr_unit_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">HR Unit</option>
                    @foreach($allUser->where('role','HR') as $employee)
                        <option @selected($employee->id == $hr_unit_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="hr_unit_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="dept_head_id" value="{{ __('Department Head') }}" />
                <select id="dept_head_id" name="dept_head_id" wire:model.change="dept_head_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Department Head</option>
                    @foreach($allUser->where('role','Employee') as $employee)
                        <option @selected($employee->id == $dept_head_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="dept_head_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi_1_id" value="{{ __('Direksi 1') }}" />
                <select id="direksi_1_id" name="direksi_1_id" wire:model.change="direksi_1_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Direksi 1</option>
                    @foreach($allUser->where('role','Employee') as $employee)
                        <option @selected($employee->id == $direksi_1_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="direksi_1_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi_2_id" value="{{ __('Direksi 2') }}" />
                <select id="direksi_2_id" name="direksi_2_id" wire:model.change="direksi_2_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Direksi 2</option>
                    @foreach($allUser->where('role','Employee') as $employee)
                        <option @selected($employee->id == $direksi_2_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="direksi_2_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="direksi_3_id" value="{{ __('Direksi 3') }}" />
                <select id="direksi_3_id" name="direksi_3_id" wire:model.change="direksi_3_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Direksi 3</option>
                    @foreach($allUser->where('role','Employee') as $employee)
                        <option @selected($employee->id == $direksi_3_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="direksi_3_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="presdir_id" value="{{ __('Presiden Direktur') }}" />
                <select id="presdir_id" name="presdir_id" wire:model.change="presdir_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Presiden Direktur</option>
                    @foreach($allUser->where('role','Employee') as $employee)
                        <option @selected($employee->id == $presdir_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="presdir_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="corp_hr_id" value="{{ __('Corporate HR') }}" />
                <select id="corp_hr_id" name="corp_hr_id" wire:model.change="corp_hr_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Corporate HR</option>
                    @foreach($allUser->where('role','HR') as $employee)
                        <option @selected($employee->id == $corp_hr_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="corp_hr_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="superadmin_id" value="{{ __('Superadmin') }}" />
                <select id="superadmin_id" name="superadmin_id" wire:model.change="superadmin_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Superadmin</option>
                    @foreach($allUser->where('role','Superadmin') as $employee)
                        <option @selected($employee->id == $superadmin_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                    @endforeach
                </select>    
                <x-input-error for="superadmin_id" class="mt-2" />
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
