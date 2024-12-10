<div>
    <h1>Anda belum memasukkan tanda tangan anda. Mohon submit tanda tangan anda dalam bentuk file image png tanpa latar belakang (background transparan)</h1>
    <div class="mt-4">
        <x-label for="file_sign" value="{{ __('Tanda Tangan Anda') }}" />
        <x-input id="file_sign" class="block mt-1 w-full" type="file" name="file_sign" wire:model="file_sign" required />
        <x-input-error for="file_sign" class="mt-2" />
    </div>
    <div class="flex justify-end">
        <x-button class="m-4" wire:click="submitSignature" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-button>
    </div>

    <x-dialog-modal wire:model.live="messageModal">
        <x-slot name="title">
          {{ __('Signature has been added') }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-2">
                <div class="mt-4">
                    <p>Anda telah berhasil menambahkan tanda tangan anda</p>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="toDashboard" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
