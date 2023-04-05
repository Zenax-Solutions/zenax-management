<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_customer_details.index_title')
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
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\CustomerDetails::class)
                            <a
                                href="{{ route('all-customer-details.create') }}"
                                class="button button-primary"
                            >
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
                                    @lang('crud.all_customer_details.inputs.customer_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_customer_details.inputs.businuss_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_customer_details.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_customer_details.inputs.number')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_customer_details.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_customer_details.inputs.about')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_customer_details.inputs.qoutation')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($allCustomerDetails as $customerDetails)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($customerDetails->customer)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customerDetails->businuss_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customerDetails->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $customerDetails->number ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customerDetails->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $customerDetails->about ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($customerDetails->qoutation)
                                    <a
                                        href="{{ \Storage::url($customerDetails->qoutation) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $customerDetails)
                                        <a
                                            href="{{ route('all-customer-details.edit', $customerDetails) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $customerDetails)
                                        <a
                                            href="{{ route('all-customer-details.show', $customerDetails) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $customerDetails)
                                        <form
                                            action="{{ route('all-customer-details.destroy', $customerDetails) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="mt-10 px-4">
                                        {!! $allCustomerDetails->render() !!}
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
