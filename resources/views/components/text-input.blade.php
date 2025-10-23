@props(['disabled' => false, 'value' => ''])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    value="{{ $value }}" 
    {!! $attributes->merge([
        'class' => 'block w-full bg-[#2a2a2a] border border-gray-800 text-gray-100 placeholder-gray-600 rounded-lg focus:bg-[#2e2e2e] focus:ring-2 focus:ring-blue-600/50 focus:border-blue-600/50 transition-all px-4 py-2.5'
    ]) !!}
>