<?php

namespace App\Http\Controllers;

use App\Models\FacebookAd;
use Illuminate\Http\Request;
use App\Http\Requests\FacebookAdStoreRequest;
use App\Http\Requests\FacebookAdUpdateRequest;

class FacebookAdController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', FacebookAd::class);

        $search = $request->get('search', '');

        $facebookAds = FacebookAd::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.facebook_ads.index', compact('facebookAds', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', FacebookAd::class);

        return view('app.facebook_ads.create');
    }

    /**
     * @param \App\Http\Requests\FacebookAdStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacebookAdStoreRequest $request)
    {
        $this->authorize('create', FacebookAd::class);

        $validated = $request->validated();

        $facebookAd = FacebookAd::create($validated);

        return redirect()
            ->route('facebook-ads.edit', $facebookAd)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('view', $facebookAd);

        return view('app.facebook_ads.show', compact('facebookAd'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('update', $facebookAd);

        return view('app.facebook_ads.edit', compact('facebookAd'));
    }

    /**
     * @param \App\Http\Requests\FacebookAdUpdateRequest $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function update(
        FacebookAdUpdateRequest $request,
        FacebookAd $facebookAd
    ) {
        $this->authorize('update', $facebookAd);

        $validated = $request->validated();

        $facebookAd->update($validated);

        return redirect()
            ->route('facebook-ads.edit', $facebookAd)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('delete', $facebookAd);

        $facebookAd->delete();

        return redirect()
            ->route('facebook-ads.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
