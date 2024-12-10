<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddSignature extends Component
{
    use WithFileUploads;
    
    public $file_sign = null;
    public $messageModal = false;
    
    protected $rules = [
        'file_sign' => ['nullable', 'file', 'max:10240', 'extensions:png', 'mimes:png']
    ];
    public function render()
    {
        return view('livewire.add-signature');
    }

    public function submitSignature() {
        $this->validate();
        $signature_path = null;
        if($this->file_sign){
            $hashed_id = str_replace(['/', '+'], ['-', '_'], base64_encode(Hash::make(Auth::user()->id)));
            $newFileName = Auth::user()->name . "_signature_" . $hashed_id . '.png';
            $signature_path = $this->file_sign->storeAs('images/userSignatures',$newFileName,'public');
        }
        $user = User::find(Auth::user()->id);
        $user->signature_path = $signature_path;
        $user->save();
        $this->messageModal = true;
        $this->toDashboard();
    }

    public function toDashboard() {
        return redirect()->route('dashboard');
    }
}
