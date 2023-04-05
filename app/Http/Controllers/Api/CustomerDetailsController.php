<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CustomerDetailsResource;
use App\Http\Resources\CustomerDetailsCollection;
use App\Http\Requests\CustomerDetailsStoreRequest;
use App\Http\Requests\CustomerDetailsUpdateRequest;

class CustomerDetailsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CustomerDetails::class);

        $search = $request->get('search', '');

        $allCustomerDetails = CustomerDetails::search($search)
            ->latest()
            ->paginate();

        return new CustomerDetailsCollection($allCustomerDetails);
    }

    /**
     * @param \App\Http\Requests\CustomerDetailsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerDetailsStoreRequest $request)
    {
        $this->authorize('create', CustomerDetails::class);

        $validated = $request->validated();
        if ($request->hasFile('qoutation')) {
            $validated['qoutation'] = $request
                ->file('qoutation')
                ->store('public');
        }

        $customerDetails = CustomerDetails::create($validated);

        return new CustomerDetailsResource($customerDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerDetails $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CustomerDetails $customerDetails)
    {
        $this->authorize('view', $customerDetails);

        return new CustomerDetailsResource($customerDetails);
    }

    /**
     * @param \App\Http\Requests\CustomerDetailsUpdateRequest $request
     * @param \App\Models\CustomerDetails $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function update(
        CustomerDetailsUpdateRequest $request,
        CustomerDetails $customerDetails
    ) {
        $this->authorize('update', $customerDetails);

        $validated = $request->validated();

        if ($request->hasFile('qoutation')) {
            if ($customerDetails->qoutation) {
                Storage::delete($customerDetails->qoutation);
            }

            $validated['qoutation'] = $request
                ->file('qoutation')
                ->store('public');
        }

        $customerDetails->update($validated);

        return new CustomerDetailsResource($customerDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerDetails $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CustomerDetails $customerDetails)
    {
        $this->authorize('delete', $customerDetails);

        if ($customerDetails->qoutation) {
            Storage::delete($customerDetails->qoutation);
        }

        $customerDetails->delete();

        return response()->noContent();
    }
}
