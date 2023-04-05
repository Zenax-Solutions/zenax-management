@php $editing = isset($facebookAd) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $facebookAd->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" required
            >{{ old('content', ($editing ? $facebookAd->content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $facebookAd->type : '')) @endphp
            <option value="web" {{ $selected == 'web' ? 'selected' : '' }} >Web development</option>
            <option value="graphics" {{ $selected == 'graphics' ? 'selected' : '' }} >Graphic Design</option>
            <option value="video" {{ $selected == 'video' ? 'selected' : '' }} >Video Editing</option>
            <option value="animation" {{ $selected == 'animation' ? 'selected' : '' }} >Animation</option>
            <option value="fb_page" {{ $selected == 'fb_page' ? 'selected' : '' }} >FaceBook Page</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $facebookAd->status : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >Running</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >Pause</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >Complete</option>
            <option value="4" {{ $selected == '4' ? 'selected' : '' }} >Fail</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="reach"
            label="Reach"
            :value="old('reach', ($editing ? $facebookAd->reach : ''))"
            max="255"
            placeholder="Reach"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="leads"
            label="Leads"
            :value="old('leads', ($editing ? $facebookAd->leads : ''))"
            max="255"
            placeholder="Leads"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="cost"
            label="Cost"
            :value="old('cost', ($editing ? $facebookAd->cost : ''))"
            max="255"
            placeholder="Cost"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
