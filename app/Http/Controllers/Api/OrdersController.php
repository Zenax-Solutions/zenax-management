<?php

namespace App\Http\Controllers\Api;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Http\Resources\OrdersCollection;
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
            ->paginate();

        return new OrdersCollection($allOrders);
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

        return new OrdersResource($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Orders $orders)
    {
        $this->authorize('view', $orders);

        return new OrdersResource($orders);
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

        return new OrdersResource($orders);
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

        return response()->noContent();
    }
}
