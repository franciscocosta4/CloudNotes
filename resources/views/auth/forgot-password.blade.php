<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu-se da sua palavra-passe? Sem problema. Basta indicar-nos o seu endereço de email e iremos enviar-lhe um link para redefinir a palavra-passe, permitindo-lhe escolher uma nova.') }}
    </div>

    <!-- Estado da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Endereço de Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar Link de Redefinição de Palavra-passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
