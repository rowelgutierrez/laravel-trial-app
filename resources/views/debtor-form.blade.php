<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Debtors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ isset($debtor)? route('creditor.debtor.update', ['id' => $debtor->id]) : route('creditor.debtor') }}" onsubmit="formLoading()">
                        @if(isset($debtor))
                            @method('PUT')
                        @endif

                        @csrf

                        <!-- Company name -->
                        <div>
                            <x-label for="company_name" :value="__('Company name')" />

                            <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name', isset($debtor) ? $debtor->company_name : '')" required autofocus />
                        </div>

                        <!-- Company address -->
                        <div class="mt-4">
                            <x-label for="company_address" :value="__('Company address')" />

                            <x-input id="company_address" class="block mt-1 w-full" type="text" name="company_address" :value="old('company_address', isset($debtor) ? $debtor->company_address : '')" required autofocus />
                        </div>

                        <!-- Contact name -->
                        <div class="mt-4">
                            <x-label for="contact_name" :value="__('Contact name')" />

                            <x-input id="contact_name" class="block mt-1 w-full" type="text" name="contact_name" :value="old('contact_name', isset($debtor) ? $debtor->user->name : '')" required autofocus />
                        </div>

                        <!-- Contact Email -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Contact email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', isset($debtor) ? $debtor->user->email : '')" required disabled="{{ isset($debtor) }}" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="button" class="form-btn ml-4" onclick="window.location='{{ route('creditor.debtors') }}'">
                                {{ __('Cancel') }}
                            </x-button>

                            <x-button class="form-btn ml-4">
                                {{ __('Save') }}
                            </x-button>

                            @svg('loading', ['x-ref' => 'spinner', 'class' => 'spinner hidden w-12 h-12 !ml-2'])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
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
</x-app-layout>
