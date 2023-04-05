<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\OrdersCollection;

class CustomerAllOrdersController extends Controller
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

        $allOrders = $customer
            ->allOrders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrdersCollection($allOrders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $this->authorize('create', Orders::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'discount' => ['nullable', 'numeric'],
            'total' => ['required', 'max:255'],
            'payment_status' => ['required', 'max:255', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'order_status' => ['required', 'max:255', 'string'],
        ]);

        $orders = $customer->allOrders()->create($validated);

        return new OrdersResource($orders);
    }
}
