<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.facebook_ads.index_title')
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
                            @can('create', App\Models\FacebookAd::class)
                                <a href="{{ route('facebook-ads.create') }}" class="button button-primary">
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
                                    @lang('crud.facebook_ads.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.facebook_ads.inputs.content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.facebook_ads.inputs.type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.facebook_ads.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.facebook_ads.inputs.reach')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.facebook_ads.inputs.leads')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.facebook_ads.inputs.cost')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($facebookAds as $facebookAd)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ $facebookAd->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $facebookAd->content ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($facebookAd->type == 'web')
                                            <b>Website</b>
                                        @elseif ($facebookAd->type == 'graphics')
                                            <b>Graphic</b>
                                        @elseif ($facebookAd->type == 'video')
                                            <b>Video Editing</b>
                                        @elseif ($facebookAd->type == 'animation')
                                            <b>Animations</b>
                                        @elseif ($facebookAd->type == 'fb_page')
                                            <b>FaceBook Page</b>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if ($facebookAd->status == 3)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Completed</span>
                                        @elseif ($facebookAd->status == 2)
                                            <span
                                                class="bg-yellow-100
                                                text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded
                                                ">Hold</span>
                                        @elseif ($facebookAd->status == 1)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Running</span>
                                        @elseif ($facebookAd->status == 4)
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ">Fail</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $facebookAd->reach ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $facebookAd->leads ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        {{ $facebookAd->cost ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class="
                                            relative
                                            inline-flex
                                            align-middle
                                        ">
                                            @can('update', $facebookAd)
                                                <a href="{{ route('facebook-ads.edit', $facebookAd) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $facebookAd)
                                                <a href="{{ route('facebook-ads.show', $facebookAd) }}" class="mr-1">
                                                    <button type="button" class="button">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $facebookAd)
                                                <form action="{{ route('facebook-ads.destroy', $facebookAd) }}"
                                                    method="POST"
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
                                        {!! $facebookAds->render() !!}
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
