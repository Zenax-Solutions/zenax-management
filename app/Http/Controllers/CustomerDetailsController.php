<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\Storage;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_customer_details.index',
            compact('allCustomerDetails', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CustomerDetails::class);

        $customers = Customer::pluck('name', 'id');

        return view('app.all_customer_details.create', compact('customers'));
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

        return redirect()
            ->route('all-customer-details.edit', $customerDetails)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerDetails $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CustomerDetails $customerDetails)
    {
        $this->authorize('view', $customerDetails);

        return view(
            'app.all_customer_details.show',
            compact('customerDetails')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerDetails $customerDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CustomerDetails $customerDetails)
    {
        $this->authorize('update', $customerDetails);

        $customers = Customer::pluck('name', 'id');

        return view(
            'app.all_customer_details.edit',
            compact('customerDetails', 'customers')
        );
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

        return redirect()
            ->route('all-customer-details.edit', $customerDetails)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-customer-details.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
