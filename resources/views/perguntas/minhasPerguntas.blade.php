<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Minhas Perguntas') }}
        </h2>
    </x-slot>

    <x-container>
        <x-form post :action="route('pergunta.store')">
            <x-textarea label="Faça sua pergunta" name="pergunta" placeholder="Qual sua dúvida?"/>
            <x-btn.primary>Enviar</x-btn.primary>
            <x-btn.cancel>Cancelar</x-btn.cancel>
        </x-form>
        {{-- listagem das perguntas --}}
        <hr class="border-gray-700 border-dashed my-4">
        <div class="dark:text-gray-300 uppercase font-bold mb-1">
            Minhas Perguntas
        </div>
        <div>
            <x-perguntas :perguntas="$perguntas"/>
        </div>
    </x-container>
</x-app-layout>
