<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.bank_accounts.index',
            compact('bankAccounts', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BankAccount::class);

        $users = User::pluck('name', 'id');

        return view('app.bank_accounts.create', compact('users'));
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

        return redirect()
            ->route('bank-accounts.edit', $bankAccount)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankAccount $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BankAccount $bankAccount)
    {
        $this->authorize('view', $bankAccount);

        return view('app.bank_accounts.show', compact('bankAccount'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BankAccount $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BankAccount $bankAccount)
    {
        $this->authorize('update', $bankAccount);

        $users = User::pluck('name', 'id');

        return view('app.bank_accounts.edit', compact('bankAccount', 'users'));
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

        return redirect()
            ->route('bank-accounts.edit', $bankAccount)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('bank-accounts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
