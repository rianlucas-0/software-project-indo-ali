<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'min-w-[160px] inline-flex justify-center items-center px-6 py-2 bg-blue-500 hover:bg-blue-600 active:bg-blue-700 border border-transparent rounded-3xl font-semibold text-base text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center'
]) }}>
    {{ $slot }}
</button>
