@php $editing = isset($bankAccount) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $bankAccount->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="account_name"
            label="Account Name"
            :value="old('account_name', ($editing ? $bankAccount->account_name : ''))"
            placeholder="Account Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="account_number"
            label="Account Number"
            :value="old('account_number', ($editing ? $bankAccount->account_number : ''))"
            placeholder="Account Number"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $bankAccount->amount : ''))"
            placeholder="Amount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="withdrawal"
            label="Withdrawal"
            :value="old('withdrawal', ($editing ? $bankAccount->withdrawal : ''))"
            placeholder="Withdrawal"
        ></x-inputs.number>
    </x-inputs.group>
</div>
