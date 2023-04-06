@php $editing = isset($customer) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="name" label="Name" :value="old('name', $editing ? $customer->name : '')" maxlength="255" placeholder="Name" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="facebook_ad_id" label="Facebook Ad" required>
            @php $selected = old('facebook_ad_id', ($editing ? $customer->facebook_ad_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Facebook Ad</option>
            @foreach ($facebookAds as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $customer->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach ($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $customer->status : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }}>Pending</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }}>Processing</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }}>Running</option>
            <option value="4" {{ $selected == '4' ? 'selected' : '' }}>Hold</option>
            <option value="5" {{ $selected == '5' ? 'selected' : '' }}>Done</option>
            <option value="6" {{ $selected == '6' ? 'selected' : '' }}>Failed</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="platform" label="Platform">
            @php $selected = old('platform', ($editing ? $customer->platform : '')) @endphp
            <option value="facebook" {{ $selected == 'facebook' ? 'selected' : '' }}>Facebook</option>
            <option value="whatsapp" {{ $selected == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
            <option value="messenger" {{ $selected == 'messenger' ? 'selected' : '' }}>Messenger</option>
            <option value="instagram" {{ $selected == 'instagram' ? 'selected' : '' }}>Instagram</option>
            <option value="text" {{ $selected == 'text' ? 'selected' : '' }}>Other</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
