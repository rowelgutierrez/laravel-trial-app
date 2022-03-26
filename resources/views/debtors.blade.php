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
                                        <span>
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
    </div>
</x-app-layout>
