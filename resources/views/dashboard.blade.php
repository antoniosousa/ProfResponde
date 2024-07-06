<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dúvidas Gerais') }}
        </h2>
    </x-slot>

    <x-container>
        <div class="dark:text-gray-300 uppercase font-bold mb-1">
            lista de perguntas
        </div>
        <div>
            <x-perguntas :perguntas="$perguntas"/>
        </div>
    </x-container>
</x-app-layout>
