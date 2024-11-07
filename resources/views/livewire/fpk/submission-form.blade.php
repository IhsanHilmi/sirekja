<div>
    <h2 class="font-semibold text-l text-gray-800 leading-tight">
        @isset($cursorId)
            {{__("Update Form Permintaan Karyawan")}}
        @else
            {{__("Create Form Permintaan Karyawan")}}
        @endisset
    </h2>
    <form class="grid grid-cols-2 pl-3" action="">
        <div class="mt-4">
            <x-label class="text-black" for="kodeFPK" value="{{ __('Kode FPK') }}" />
            <x-input id="kodeFPK" class=" bg-neutral-400 dark:focus:border-red-500 focus:border-red-500 dark:focus:ring-red-500 focus:ring-red-500" type="text" name="kodeFPK" wire:model="kodeFPK" readonly/>
            <x-input-error for="kodeFPK" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label for="hr_unit_name" value="{{ __('HR Unit') }}" />
            <x-input id="hr_unit_name" class=" bg-neutral-400 dark:focus:border-red-500 focus:border-red-500 dark:focus:ring-red-500 focus:ring-red-500" name="hr_unit_name" type="text" readonly value="{{auth()->user()->name}}"/>
        </div>
        <div class="mt-4 pb-4 w-5/6 col-span-2">
            <x-label class="text-black" for="jenis_fpk" value="{{ __('Permintaan Untuk :') }}" />
            <select id="jenis_fpk" name="jenis_fpk" wire:model.change="jenis_fpk" class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                <option @selected($jenis_fpk =="New Hire") value="New Hire">New Hire</option>
                <option @selected($jenis_fpk =="Resign") value="Resign">Resign</option>
            </select>   
            <x-input-error for="jenis_fpk" class="mt-2" />
        </div>
        <div class="col-span-2 mt-4 mb-4"></div>

        
        <div class="mt-4 w-3/4">
            <x-label for="bisnis_unit_id" value="{{ __('Bisnis Unit Asal') }}" />
            <select id="bisnis_unit_id" name="bisnis_unit_id" wire:model.change="bisnis_unit_id" wire:change='mountDepartemens' required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">Bisnis Unit yang tersedia</option>
                @foreach($bu as $bisnisUnit)
                    <option value="{{$bisnisUnit->id}}" wire:key='{{$bisnisUnit->id}}'>{{$bisnisUnit->nama_bisnis_unit}}</option>
                @endforeach
            </select>    
            <x-input-error for="bisnis_unit_id" class="mt-2" />
        </div>
        <div class="mt-4 w-3/4">
            <x-label for="departemen_id" value="{{ __('Departemen Asal') }}" />
            <select id="departemen_id" name="departemen_id" wire:model.change="departemen_id" wire:change='mountJabatans' required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" @disabled($bisnis_unit_id == "")>
                <option value="">Departemen yang tersedia</option>
                @foreach($d as $departemen)
                    <option @selected($departemen->id == $departemen_id) value="{{$departemen->id}}" wire:key='{{$departemen->id}}'>{{$departemen->nama_departemen}}</option>
                @endforeach
            </select>    
            <x-input-error for="departemen_id" class="mt-2" />
        </div>
        <div class="mt-4 w-3/4">
            <x-label class="text-black" for="jabatan_id" value="{{ __('Jabatan') }}" />
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
            <x-input id="golongan" class="block mt-1 w-3/4" type="text" pattern="0[1-6]|24|25" name="golongan" wire:model="golongan" required />
            <x-input-error for="golongan" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label for="in_file" class="text-black" value="{{__('File Lampiran (Opsional)')}}" />
            <x-input id="in_file" class="block mt-1 w-3/4 p-3" type="file" name="in_file" wire:model='in_file' />
            @if ($currentFile)
                <p>File yang terlampir: <a class="text-black hover:text-indigo-500" href="{{ Storage::url($currentFile) }}" target="_blank">View file</a></p>
            @endif
            <x-input-error for="in_file" class="mt-2" />
        </div>

        {{-- <div class="mt-4 w-3/4">
            <x-label class="text-black" for="al_id" value="{{ __('Approval yang digunakan') }}" />
            <select id="al_id" name="al_id" wire:model.change="al_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach($user_al as $ual)
                    <option value="{{$ual->id}}" wire:key='{{$ual->id}}'>{{$ual->id}} - {{$ual->approval_line_desc}}</option>
                @endforeach
            </select>    
            <x-input-error for="al_id" class="mt-2" />
        </div> --}}

        <div class="mt-4">
            <x-label class="text-black" for="tgl_effect" value="{{ __('Tanggal Efektif') }}" />
            <x-input id="tgl_effect" class="block mt-1 w-3/4" type="date" name="tgl_effect" wire:model="tgl_effect"/>
            <x-input-error for="tgl_effect" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="usia" value="{{ __('Usia(thn)') }}" />
            <x-input id="usia" class="block mt-1 w-3/4" type="number" name="usia" wire:model="usia"/>
            <x-input-error for="usia" class="mt-2" />
        </div>
        <div class="mt-4 w-3/4">
            <x-label class="text-black" for="gender" value="{{ __('Jenis Kelamin') }}" />
            <select id="gender" name="gender" wire:model.change="gender" class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                <option @selected($gender =="Both") value="Both">Keduanya</option>
                <option @selected($gender =="L") value="L">Laki-Laki</option>
                <option @selected($gender =="P") value="P">Perempuan</option>
            </select>   
            <x-input-error for="gender" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="work_exp" value="{{ __('Pengalaman(thn)') }}" />
            <x-input id="work_exp" class="block mt-1 w-3/4" type="number" name="work_exp" wire:model="work_exp"/>
            <x-input-error for="work_exp" class="mt-2" />
        </div>
        <div class="mt-4 w-3/4">
            <x-label class="text-black" for="last_edu" value="{{ __('Pendidikan Terakhir') }}" />
            <select id="last_edu" name="last_edu" wire:model.change="last_edu" class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                <option @selected($last_edu =="SMA/SMK/MA") value="SMA/SMK/MA">SMA/SMK/MA dan sedejarat</option>
                <option @selected($last_edu =="DIII") value="DIII">DIII</option>
                <option @selected($last_edu =="S1") value="S1">S1</option>
                <option @selected($last_edu =="S2") value="S2">S2</option>
            </select>   
            <x-input-error for="last_edu" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="jurusan" value="{{ __('Jurusan') }}" />
            <x-input id="jurusan" class="block mt-1 w-3/4" type="text" name="jurusan" wire:model="jurusan"/>
            <x-input-error for="jurusan" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="lokasi_kerja" value="{{ __('Lokasi Kerja') }}" />
            <x-input id="lokasi_kerja" class="block mt-1 w-3/4" type="text" name="lokasi_kerja" wire:model="lokasi_kerja"/>
            <x-input-error for="lokasi_kerja" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="alasan" value="{{ __('Alasan') }}" />
            <x-textarea id="alasan" class="block mt-1 w-3/4" name="alasan" wire:model="alasan"></x-textarea>
            <x-input-error for="alasan" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="job_spec" value="{{ __('Spesifikasi Pekerjaan') }}" />
            <x-textarea id="job_spec" class="block mt-1 w-3/4" name="job_spec" wire:model="job_spec"></x-textarea>
            <x-input-error for="job_spec" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="job_desc" value="{{ __('Deskripsi Pekerjaan') }}" />
            <x-textarea id="job_desc" class="block mt-1 w-3/4" name="job_desc" wire:model="job_desc"></x-textarea>
            <x-input-error for="job_desc" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="soft_skills" value="{{ __('Soft Skills') }}" />
            <x-textarea id="soft_skills" class="block mt-1 w-3/4" name="soft_skills" wire:model="soft_skills"></x-textarea>
            <x-input-error for="soft_skills" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="hard_skills" value="{{ __('Hard Skills') }}" />
            <x-textarea id="hard_skills" class="block mt-1 w-3/4" name="hard_skills" wire:model="hard_skills"></x-textarea>
            <x-input-error for="hard_skills" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label class="text-black" for="catatan" value="{{ __('Catatan') }}" />
            <x-textarea id="catatan" class="block mt-1 w-3/4" name="catatan" wire:model="catatan"></x-textarea>
            <x-input-error for="catatan" class="mt-2" />
        </div>
        
    </form>
    <div class="flex justify-end">
        <x-button class="m-4" wire:click="submitFPK" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </div>
    </div>
