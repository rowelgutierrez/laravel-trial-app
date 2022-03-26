<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Debtors') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false, show_message: true }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('success'))
                <div :class="{ 'block': show_message, 'hidden': ! show_message }" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8 border bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session()->get('success') }}</span>
                    <span class="close absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg @click="show_message = ! show_message" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                            <tr class="font-black">
                                <td class="px-6 py-4"><strong>{{ __('Company name') }}</strong></td>
                                <td class="px-6 py-4"><strong>{{ __('Company address') }}</strong></td>
                                <td class="px-6 py-4"><strong>{{ __('Contact name') }}</strong></td>
                                <td class="px-6 py-4"><strong>{{ __('Contact email') }}</strong></td>
                            </tr>
                        </thead>
                        @foreach ($debtors as $debtor)
                            <tr class="cursor-pointer group">
                                <td class="px-6 py-4">{{ $debtor->company_name }}</td>
                                <td class="px-6 py-4">{{ $debtor->company_address }}</td>
                                <td class="px-6 py-4">{{ $debtor->user->name }}</td>
                                <td class="px-6 py-4 relative">
                                    {{ $debtor->user->email }}
                                    <div class="absolute gap-1 top-1/4 right-0 hidden group-hover:block group-hover:flex">
                                        <span onclick="window.location='{{ route('creditor.debtor.edit', ['id' => $debtor->id]) }}'">
                                            @svg('edit', ['class' => 'fill-green-600'])
                                        </span>
                                        <span class="openModal" @click="open = ! open, $dispatch('delete', '{{ route('creditor.debtor.delete', ['id' => $debtor->id]) }}')" @delete="$refs.delete_form.action = $event.detail">
                                            @svg('delete', ['class' => 'fill-red-600'])
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <x-button class="mt-8" onclick="window.location='{{ route('creditor.debtor.new') }}'">
                {{ __('Add Debtor') }}
            </x-button>
        </div>

        <x-modal ::class="{'block': open, 'hidden': ! open }">
            <x-slot name="title">
                {{ __('Delete Debtor') }}
            </x-slot>

            {{ __('Are you sure you want to delete this debtor?') }}

            <x-slot name="buttons">
                <form method="POST" x-ref="delete_form">
                    @method('DELETE')
                    @csrf

                    <x-button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 !bg-red-600 text-base font-medium text-white hover:!bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:!ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Delete') }}
                    </x-button>
                </form>
                <button @click="open = ! open" type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ __('Cancel') }}
                </button>
            </x-slot>
        </x-modal>
    </div>
</x-app-layout>
