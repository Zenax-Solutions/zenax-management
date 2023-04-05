@php $editing = isset($customerDetails) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="customer_id" label="Customer" required>
            @php $selected = old('customer_id', ($editing ? $customerDetails->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="businuss_name"
            label="Businuss Name"
            :value="old('businuss_name', ($editing ? $customerDetails->businuss_name : ''))"
            maxlength="255"
            placeholder="Businuss Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $customerDetails->email : ''))"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number"
            label="Number"
            :value="old('number', ($editing ? $customerDetails->number : ''))"
            max="255"
            placeholder="Number"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $customerDetails->address : ''))"
            maxlength="255"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="about" label="About"
            >{{ old('about', ($editing ? $customerDetails->about : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="qoutation"
            label="Qoutation"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="qoutation"
            id="qoutation"
            class="form-control-file"
        />

        @if($editing && $customerDetails->qoutation)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($customerDetails->qoutation) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('qoutation') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>
