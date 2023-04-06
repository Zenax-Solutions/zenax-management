<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.customers.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off"></x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Customer::class)
                                <a href="{{ route('customers.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.facebook_ad_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.customers.inputs.platform')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($customers as $customer)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $customer->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($customer->facebookAd)->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($customer->user)->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($customer->status == 1)
                                            <span
                                                class="bg-yellow-100
                                        text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded
                                        ">Pending</span>
                                        @elseif ($customer->status == 2)
                                            <span
                                                class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Proccesing</span>
                                        @elseif ($customer->status == 3)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Running</span>
                                        @elseif ($customer->status == 4)
                                            <span
                                                class="bg-yellow-100
                                        text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded
                                        ">Hold</span>
                                        @elseif ($customer->status == 5)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Completed</span>
                                        @elseif ($customer->status == 6)
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Failed</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($customer->platform == 'facebook')
                                            <b>Facebook</b>
                                        @elseif ($customer->platform == 'whatsapp')
                                            <b>WhatsApp</b>
                                        @elseif ($customer->platform == 'messenger')
                                            <b>Messenger</b>
                                        @elseif ($customer->platform == 'instagram')
                                            <b>Instagram</b>
                                        @elseif ($customer->platform == 'text')
                                            <b>Other</b>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                            relative
                                            inline-flex
                                            align-middle
                                        ">
                                            @can('update', $customer)
                                                <a href="{{ route('customers.edit', $customer) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $customer)
                                                <a href="{{ route('customers.show', $customer) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $customer)
                                                <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="button">
                                                        <i
                                                            class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="mt-10 px-4">
                                        {!! $customers->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
