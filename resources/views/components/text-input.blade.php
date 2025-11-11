@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-black dark:text-white bg-white dark:bg-[#161B22] border-gray-300 dark:border-[#2A2F3A] focus:border-blue-500 dark:focus:border-[#3B82F6] focus:ring-blue-500 dark:focus:ring-[#161B22] rounded-md md:rounded-lg md:py-2 lg:py-3 lg:text-lg xl:py-4']) }}>