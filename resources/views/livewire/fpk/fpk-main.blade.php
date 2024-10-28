<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Formulir Permintaan Karyawan</h2>
    <div class="flex justify-between items-center mb-2">
        <x-button  wire:click='redirectToFPKSubmission'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Buat FPK</x-button>
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    {{-- <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-1/12 py-3 px-4 text-center">Kode FPK</th>
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
    </div> --}}

    {{-- Delete Modal --}}
    {{-- <x-dialog-modal wire:model.live="deleteModal">
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
    </x-dialog-modal> --}}
    {{-- Delete Modal --}}

</div>
