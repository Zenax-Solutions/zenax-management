@php $editing = isset($orders) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="customer_id" label="Customer" required>
            @php $selected = old('customer_id', ($editing ? $orders->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $orders->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="discount"
            label="Discount"
            :value="old('discount', ($editing ? $orders->discount : ''))"
            max="255"
            placeholder="Discount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="total"
            label="Total"
            :value="old('total', ($editing ? $orders->total : ''))"
            maxlength="255"
            placeholder="Total"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="payment_status" label="Payment Status">
            @php $selected = old('payment_status', ($editing ? $orders->payment_status : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >No payment</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >Advance Only</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >Full Payment</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="start_date"
            label="Start Date"
            value="{{ old('start_date', ($editing ? optional($orders->start_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="end_date"
            label="End Date"
            value="{{ old('end_date', ($editing ? optional($orders->end_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="order_status" label="Order Status">
            @php $selected = old('order_status', ($editing ? $orders->order_status : '')) @endphp
            <option value="pending" {{ $selected == 'pending' ? 'selected' : '' }} >Pending</option>
            <option value="content_delay" {{ $selected == 'content_delay' ? 'selected' : '' }} >Content Delay</option>
            <option value="hold" {{ $selected == 'hold' ? 'selected' : '' }} >Hold</option>
            <option value="done" {{ $selected == 'done' ? 'selected' : '' }} >Done</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
