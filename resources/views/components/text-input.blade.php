@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-white bg-[#161B22] border-[#2A2F3A] focus:border-[#3B82F6] focus:ring-[#161B22] rounded-md ']) }}>
