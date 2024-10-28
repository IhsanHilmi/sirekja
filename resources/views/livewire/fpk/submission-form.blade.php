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
            <x-input id="kodeFPK" class="block mt-1 w-3/4" type="text" name="kodeFPK" wire:model="kodeFPK" disabled/>
            <x-input-error for="kodeFPK" class="mt-2" />
        </div>
        <div class="mt-4 w-3/4">
            <x-label class="text-black" for="jabatan_id" value="{{ __('Jabatan') }}" />
            <select id="jabatan_id" name="jabatan_id" wire:model.change="jabatan_id" required class="block mt-1 w-full mb-4 border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" >
                <option value="">Jabatan yang tersedia</option>
                @foreach($j as $jabatan)
                    <option @selected($jabatan->id == $jabatan_id) value="{{$jabatan->id}}" wire:key='{{$jabatan->id}}'>{{$jabatan->nama_jabatan}}</option>
                @endforeach
            </select>    
            <x-input-error for="jabatan_id" class="mt-2" />
        </div>
    </form>
</div>
