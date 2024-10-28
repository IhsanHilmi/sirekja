<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="isEmployee">
                    <x-checkbox name="isEmployee" id="isEmployee" onclick="Pegawai()"/>
                        {{__('Merupakan pegawai?')}}            
                </x-label>
            </div>

            <div class="mt-4">
                <x-label for="employee_name" value="{{ __('Employee Name') }}" />
                <x-input id="employee_name" class="block mt-1 w-full" type="text" name="employee_name" disabled/>
            </div>

            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}"/>
                <select name="role" id="role" class="mb-4 w-full border-gray-700 bg-gray-200 text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm" disabled>
                    <option value="Superadmin">SuperAdmin</option>
                    <option value="Corporate HR">Corporate HR</option>
                    <option value="Presiden Direktur">Presiden Direktur</option>
                    <option value="Direktur 1">Direktur 1</option>
                    <option value="Direktur 2">Direktur 2</option>
                    <option value="Direktur 3">Direktur 3</option>
                    <option value="HR Unit">HR Unit</option>
                    <option value="Kandidat" selected>Kandidat</option>
                </select>    
            </div>
            

            <!-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif -->

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-secondary-button class="ms-4">
                    {{ __('Register') }}
                </x-secondary-button>
            </div>
        </form>
        <script>
            function Pegawai(){
                const select = document.getElementById('role');
                const checkbox = document.getElementById('isEmployee');
                const inputField = document.getElementById('employee_name');

                if(!checkbox.checked){
                    select.value = "Kandidat";
                    inputField.setAttribute('disabled','disabled');
                    select.setAttribute('disabled','disabled');
                }else{
                    inputField.removeAttribute('disabled');
                    select.removeAttribute('disabled');
                }
            }    
        </script>
    </x-authentication-card>
</x-guest-layout>
