<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_orders.index_title')
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
                            @can('create', App\Models\Orders::class)
                                <a href="{{ route('all-orders.create') }}" class="button button-primary">
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
                                    @lang('crud.all_orders.inputs.customer_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.user_id')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_orders.inputs.discount')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.total')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.payment_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.start_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.end_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.order_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_orders.inputs.payment_proof')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($allOrders as $orders)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($orders->customer)->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($orders->user)->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $orders->discount ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $orders->total ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($orders->payment_status == 1)
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">No
                                                payment</span>
                                        @elseif ($orders->payment_status == 2)
                                            <span
                                                class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Advance
                                                Payment</span>
                                        @elseif ($orders->payment_status == 3)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Full
                                                Payment</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ date_format($orders->start_date, 'Y/m/d') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ date_format($orders->end_date, 'Y/m/d') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($orders->order_status == 'pending')
                                            <span
                                                class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Pending</span>
                                        @elseif ($orders->order_status == 'content_delay')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Content
                                                Delay</span>
                                        @elseif ($orders->order_status == 'hold')
                                            <span
                                                class="bg-yellow-100text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Hold</span>
                                        @elseif ($orders->order_status == 'done')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Done</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($orders->payment_proof)
                                            <a href="{{ \Storage::url($orders->payment_proof) }}" target="blank"><i
                                                    class="mr-1 icon ion-md-download"></i>&nbsp;Download</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                            relative
                                            inline-flex
                                            align-middle
                                        ">
                                            @can('update', $orders)
                                                <a href="{{ route('all-orders.edit', $orders) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $orders)
                                                <a href="{{ route('all-orders.show', $orders) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $orders)
                                                <form action="{{ route('all-orders.destroy', $orders) }}" method="POST"
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
                                    <td colspan="9">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">
                                    <div class="mt-10 px-4">
                                        {!! $allOrders->render() !!}
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
