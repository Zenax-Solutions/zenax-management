<?php

namespace App\Http\Controllers\Api;

use App\Models\FacebookAd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FacebookAdResource;
use App\Http\Resources\FacebookAdCollection;
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
            ->paginate();

        return new FacebookAdCollection($facebookAds);
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

        return new FacebookAdResource($facebookAd);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('view', $facebookAd);

        return new FacebookAdResource($facebookAd);
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

        return new FacebookAdResource($facebookAd);
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

        return response()->noContent();
    }
}
