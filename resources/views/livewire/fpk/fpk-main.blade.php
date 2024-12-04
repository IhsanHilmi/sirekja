<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Formulir Permintaan Karyawan</h2>
    <div class="flex justify-between items-center mb-2">
        @if (auth()->user()->role == 'HR')
            <x-button  wire:click='redirectToFPKSubmission'><i class="fa-solid fa-plus font-extrabold pr-1"></i>Buat FPK</x-button>
        @endif
        <x-button color="bg-blue-600" wire:click='$refresh'><i class="fa-solid fa-arrow-rotate-right font-extrabold pr-1"></i>Refresh</x-button>
    </div>
    <div class="overflow-x-auto pt-4">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="w-1/12 py-3 px-4 text-center">No.</th>
                    <th class="w-1/12 py-3 px-4 text-center">kode FPK</th>
                    <th class="w-1/12 py-3 px-4 text-center">jenis FPK</th>
                    <th class="w-auto py-3 px-4 text-center">Jabatan</th>
                    <th class="w-1/12 py-3 px-4 text-center">Pengaju</th>
                    <th class="w-1/12 py-3 px-4 text-center">Status Approval</th>
                    <th colspan="4" class="w-auto py-3 px-4 text-center justify-between">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($fpks as $fpk)
                    <tr class="border-b border-gray-200 hover:bg-gray-300" wire:key='{{$fpk->id}}'>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $fpk->kodeFPK }}</td>
                        <td class="py-3 px-4">{{ $fpk->jenis_FPK }}</td>
                        <td class="py-3 px-4">{{ $fpk->jabatan->nama_jabatan }}</td>
                        <td class="py-3 px-4">{{ $fpk->issuedBy->name }}</td>
                        <td class="py-3 px-4">
                            @isset($fpk->approvalProcess)
                                @if ($fpk->approvalProcess->approval_status == 'Approved')
                                    <x-button color="bg-green-700" wire:click='openApprovalStatusModal({{$fpk->id}})'><i class="fa-solid fa-circle-info font-extrabold pr-1"></i>Approved</x-button>
                                @elseif($fpk->approvalProcess->approval_status == 'Rejected')
                                    <x-button color="bg-red-700" wire:click='openApprovalStatusModal({{$fpk->id}})'><i class="fa-solid fa-circle-info font-extrabold pr-1" ></i>Rejected</x-button>
                                @else
                                    <x-button color="bg-orange-600" wire:click='openApprovalStatusModal({{$fpk->id}})'><i class="fa-solid fa-circle-info font-extrabold pr-1"></i>Pending</x-button>    
                                @endif   
                            @else
                                {{__('Approval Line belum ditentukan')}}
                            @endisset
                        </td>
                        <td class="py-3 px-4"><x-button color="bg-sky-500" wire:click='openDetails({{$fpk->id}})'><i class="fa-solid fa-circle-info font-extrabold pr-1"></i>Detail</x-button></td>
                        @if (auth()->user()->role == 'HR')
                            <td class="py-3 px-4">
                                <x-button color="bg-yellow-600" wire:click='redirectToFPKSubmission({{$fpk->id}})'><i class="fa-solid fa-pen-to-square font-extrabold pr-1"></i>Edit FPK</x-button>
                            </td>
                            <td class="py-3 px-4">
                                <x-danger-button wire:click='openDeleteModal({{$fpk->id}})'><i class="fa-solid fa-trash-can font-extrabold pr-1"></i>Delete FPK</x-danger-button>
                            </td>
                        @elseif(auth()->user()->role == 'Superadmin')
                            <td class="py-3 px-4 w-auto">
                                <x-button wire:click='openApprovalProcessModal({{$fpk->id}})'><i class="fa-solid fa-clipboard-list font-extrabold pr-1"></i>Set/Edit Approval Line</x-button>
                            </td>
                        @endif
                        @if(isset($fpk->approvalProcess))
                            <td class="py-3 px-4 w-1/3">
                                <x-button wire:click='openApproveModal({{$fpk->id}})'><i class="fa-solid fa-stamp font-extrabold pr-1"></i>Give Approval</x-button>
                            </td>
                        @endif                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $fpks->links() }}
    </div>    

                    {{-- <th class="w-1/12 py-3 px-4 text-center">No.</th>
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
    <x-dialog-modal wire:model.live="deleteModal">
            <x-slot name="title">
                {{ __('Hapus FPK') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Apakah anda yakin akan menghapus FPK dengan kode '. $this->kodeFPK .' ? Data FPK beserta semua data yang terhubung dengan FPK ini akan terhapus.') }}
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
    <x-dialog-modal wire:model.live="detailModal">
        <x-slot name="title">
          {{ __('Detail FPK ') }}{{$kodeFPK}}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="mt-4">
                    <p>Tanggal Efektif: {{$tgl_effect}}</p>
                    <p>Golongan: {{$detail_golongan}}</p>
                    <p>Target Gender: {{$detail_gender}}</p>
                    <p>Target Usia: {{$detail_usia}}</p>
                    <p>Pengalaman: {{$detail_thn_pengalaman}} Tahun</p>
                    <p>Pendidikan Terakhir: {{$detail_pendidikan}}</p>
                    <p>Jurusan: {{$detail_jurusan}}</p>
                    <p>Lokasi Kerja: {{$detail_lokasi_kerja}}</p>
                    <p>Alasan: {{$detail_alasan}}</p>
                    <p>Spesifikasi: {{$detail_spesifikasi}}</p>
                    <p>Job Desc: {{$detail_deskripsi}}</p>
                    <p>Hard Skill: {{$detail_hard_skills}}</p>
                    <p>Soft Skill: {{$detail_soft_skills}}</p>
                    <p>Catatan: {{$detail_catatan}}</p>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('detailModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="approvalStatusModal">
        <x-slot name="title">
          {{ __('Status Approval FPK ') }}{{$kodeFPK}}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="mt-4">
                    <p>{{$sa_superadmin}}</p>
                    <p>{{$sa_presdir}}</p>
                    <p>{{$sa_corp_hr}}</p>
                    <p>{{$sa_direksi_1}}</p>
                    <p>{{$sa_direksi_2}}</p>
                    <p>{{$sa_direksi_3}}</p>
                    <p>{{$sa_depthead}}</p>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('approvalStatusModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="approvalProcessModal">
        <x-slot name="title">
          {{ __('Set Approval Line dari FPK ') }}{{$kodeFPK}}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="mt-4 col-span-2">
                    <x-label for='isUsingApprovalLine'>
                        <x-checkbox id="isUsingApprovalLine" name="isUsingApprovalLine" wire:model.change='isUsingApprovalLine' wire:change='setDefault'/>
                        {{__('Gunakan Approval Line yang ada?')}}
                    </x-label>
                    <x-label for="approval_line_id" value="{{ __('Approval Line yang tersedia') }}" />
                    <select id="approval_line_id" name="approval_line_id" wire:model.change="approval_line_id" wire:change='setUsers' class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm"  @disabled(!$isUsingApprovalLine)>
                        <option value="">NO APPROVAL LINE TEMPLATE</option>
                        @foreach($als as $al)
                            <option value="{{$al->id}}" wire:key='{{$al->id}}'>AL-{{$al->id}} - {{$al->approval_line_desc}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="approval_line_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="hr_unit_id" value="{{ __('HR Unit') }}" />
                    <select id="hr_unit_id" name="hr_unit_id" wire:model.change="hr_unit_id" class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm disabled" disabled>
                        <option value="">HR Unit</option>
                        @foreach($allUser->where('role','HR') as $employee)
                            <option @selected($employee->id == $hr_unit_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="hr_unit_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="dept_head_id" value="{{ __('Department Head') }}" />
                    <select id="dept_head_id" name="dept_head_id" wire:model.change="dept_head_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Department Head</option>
                        @foreach($allUser->where('role','Employee') as $employee)
                            <option @selected($employee->id == $dept_head_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="dept_head_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="direksi_1_id" value="{{ __('Direksi 1') }}" />
                    <select id="direksi_1_id" name="direksi_1_id" wire:model.change="direksi_1_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Direksi 1</option>
                        @foreach($allUser->where('role','Employee') as $employee)
                            <option @selected($employee->id == $direksi_1_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="direksi_1_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="direksi_2_id" value="{{ __('Direksi 2') }}" />
                    <select id="direksi_2_id" name="direksi_2_id" wire:model.change="direksi_2_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Direksi 2</option>
                        @foreach($allUser->where('role','Employee') as $employee)
                            <option @selected($employee->id == $direksi_2_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="direksi_2_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="direksi_3_id" value="{{ __('Direksi 3') }}" />
                    <select id="direksi_3_id" name="direksi_3_id" wire:model.change="direksi_3_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Direksi 3</option>
                        @foreach($allUser->where('role','Employee') as $employee)
                            <option @selected($employee->id == $direksi_3_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="direksi_3_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="presdir_id" value="{{ __('Presiden Direktur') }}" />
                    <select id="presdir_id" name="presdir_id" wire:model.change="presdir_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Presiden Direktur</option>
                        @foreach($allUser->where('role','Employee') as $employee)
                            <option @selected($employee->id == $presdir_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="presdir_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="corp_hr_id" value="{{ __('Corporate HR') }}" />
                    <select id="corp_hr_id" name="corp_hr_id" wire:model.change="corp_hr_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Corporate HR</option>
                        @foreach($allUser->where('role','HR') as $employee)
                            <option @selected($employee->id == $corp_hr_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="corp_hr_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="superadmin_id" value="{{ __('Superadmin') }}" />
                    <select id="superadmin_id" name="superadmin_id" wire:model.change="superadmin_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($isUsingApprovalLine)>
                        <option value="">Superadmin</option>
                        @foreach($allUser->where('role','Superadmin') as $employee)
                            <option @selected($employee->id == $superadmin_id) value="{{$employee->id}}" wire:key='{{$employee->id}}'>{{$employee->name}}</option>
                        @endforeach
                    </select>    
                    <x-input-error for="superadmin_id" class="mt-2" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button class="gap-3" wire:click="$set('approvalProcessModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button wire:click="saveApprovalProcessData" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="approveModal">
        <x-slot name="title">
            {{ __('Approve FPK ') }}{{$this->kodeFPK}}
        </x-slot>

        <x-slot name="content">
            {{ __('Apa yang anda ingin lakukan terhadap FPK '. $this->kodeFPK .' ini?') }}
        </x-slot>

        <x-slot name="footer">
            
            @if($canApprove)
                <x-button class="ms-3" wire:click="approveFPK('Approve')" wire:loading.attr="disabled" >
                    {{ __('Approve') }}
                </x-button>
            @endif
            <x-danger-button class="ms-3" wire:click="approveFPK('Reject')" wire:loading.attr="disabled">
                {{ __('Reject') }}
            </x-danger-button>

            <x-secondary-button wire:click="$set('approveModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
