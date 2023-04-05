<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\OrdersStoreRequest;
use App\Http\Requests\OrdersUpdateRequest;

class OrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Orders::class);

        $search = $request->get('search', '');

        $allOrders = Orders::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_orders.index', compact('allOrders', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Orders::class);

        $customers = Customer::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('app.all_orders.create', compact('customers', 'users'));
    }

    /**
     * @param \App\Http\Requests\OrdersStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersStoreRequest $request)
    {
        $this->authorize('create', Orders::class);

        $validated = $request->validated();

        $orders = Orders::create($validated);

        return redirect()
            ->route('all-orders.edit', $orders)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Orders $orders)
    {
        $this->authorize('view', $orders);

        return view('app.all_orders.show', compact('orders'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Orders $orders)
    {
        $this->authorize('update', $orders);

        $customers = Customer::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.all_orders.edit',
            compact('orders', 'customers', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\OrdersUpdateRequest $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function update(OrdersUpdateRequest $request, Orders $orders)
    {
        $this->authorize('update', $orders);

        $validated = $request->validated();

        $orders->update($validated);

        return redirect()
            ->route('all-orders.edit', $orders)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Orders $orders)
    {
        $this->authorize('delete', $orders);

        $orders->delete();

        return redirect()
            ->route('all-orders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
