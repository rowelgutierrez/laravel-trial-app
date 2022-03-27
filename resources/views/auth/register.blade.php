<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('creditor.register') }}" onsubmit="formLoading()">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('creditor.login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="form-btn ml-4">
                    {{ __('Register') }}
                </x-button>

                @svg('loading', ['x-ref' => 'spinner', 'class' => 'spinner hidden w-12 h-12 !ml-2'])
            </div>
        </form>
    
        <script type="text/javascript">
            function formLoading() {
                const formButtons = document.querySelectorAll('.form-btn');
                formButtons.forEach((btn) => {
                    btn.disabled = true;
                });

                const spinner = document.querySelector('.spinner');
                spinner.classList.remove('hidden');
            }
        </script>
    </x-auth-card>
</x-guest-layout>
