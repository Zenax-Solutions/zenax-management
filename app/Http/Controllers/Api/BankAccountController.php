<?php

namespace App\Http\Controllers\Api;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankAccountResource;
use App\Http\Resources\BankAccountCollection;
use App\Http\Requests\BankAccountStoreRequest;
use App\Http\Requests\BankAccountUpdateRequest;

class BankAccountController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BankAccount::class);

        $search = $request->get('search', '');

        $bankAccounts = BankAccount::search($search)
            ->latest()
            ->paginate();

        return new BankAccountCollection($bankAccounts);
    }

    /**
     * @param \App\Http\Requests\BankAccountStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankAccountStoreRequest $request)
    {
        $this->authorize('create', BankAccount::class);

        $validated = $request->validated();

        $bankAccount = BankAccount::create($validated);

        return new BankAccountResource($bankAccount);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankAccount $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BankAccount $bankAccount)
    {
        $this->authorize('view', $bankAccount);

        return new BankAccountResource($bankAccount);
    }

    /**
     * @param \App\Http\Requests\BankAccountUpdateRequest $request
     * @param \App\Models\BankAccount $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(
        BankAccountUpdateRequest $request,
        BankAccount $bankAccount
    ) {
        $this->authorize('update', $bankAccount);

        $validated = $request->validated();

        $bankAccount->update($validated);

        return new BankAccountResource($bankAccount);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankAccount $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BankAccount $bankAccount)
    {
        $this->authorize('delete', $bankAccount);

        $bankAccount->delete();

        return response()->noContent();
    }
}
