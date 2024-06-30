<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>
        <x-form post :action="route('pergunta.store')">
            <x-textarea label="Faça sua pergunta" name="pergunta" placeholder="Qual sua dúvida?"/>
            <x-btn.primary>Enviar</x-btn.primary>
            <x-btn.cancel>Cancelar</x-btn.cancel>
        </x-form>
    </x-container>
</x-app-layout>
