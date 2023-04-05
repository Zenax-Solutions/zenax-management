<?php

namespace App\Http\Controllers\Api;

use App\Models\FacebookAd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;

class FacebookAdCustomersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('view', $facebookAd);

        $search = $request->get('search', '');

        $customers = $facebookAd
            ->customers()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerCollection($customers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FacebookAd $facebookAd
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FacebookAd $facebookAd)
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'numeric'],
            'platform' => ['required', 'max:255', 'string'],
        ]);

        $customer = $facebookAd->customers()->create($validated);

        return new CustomerResource($customer);
    }
}
