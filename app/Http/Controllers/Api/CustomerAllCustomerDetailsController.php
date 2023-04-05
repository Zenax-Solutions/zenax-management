<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerDetailsResource;
use App\Http\Resources\CustomerDetailsCollection;

class CustomerAllCustomerDetailsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Customer $customer)
    {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $allCustomerDetails = $customer
            ->allCustomerDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerDetailsCollection($allCustomerDetails);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $this->authorize('create', CustomerDetails::class);

        $validated = $request->validate([
            'businuss_name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'number' => ['nullable', 'numeric'],
            'address' => ['nullable', 'max:255', 'string'],
            'about' => ['max:255', 'string'],
            'qoutation' => ['file', 'max:1024', 'required'],
        ]);

        if ($request->hasFile('qoutation')) {
            $validated['qoutation'] = $request
                ->file('qoutation')
                ->store('public');
        }

        $customerDetails = $customer->allCustomerDetails()->create($validated);

        return new CustomerDetailsResource($customerDetails);
    }
}
