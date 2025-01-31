<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informação do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Atualize os seus dados.") }}
        </p>
        <br>
        <a href="{{ route('dashboard') }}" 
           style="border-radius:6.5px; padding:8px 6px; background-color: #0F044C; color: white; border: none;">
            {{ __('Voltar à dashboard') }}
        </a>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="form-input mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-input mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Ano Escolar -->
        <div class="form-group">
            <x-input-label for="school_year" :value="__('Ano Escolar')" />
            <select id="school_year" name="school_year" class="form-input mt-1 block w-full" required>
                <option value="" disabled>{{ __('Selecione o Ano Escolar') }}</option>
                @for ($i = 7; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ old('school_year', $user->school_year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('school_year')" />
        </div>

        <!-- Disciplinas de Interesse -->
        <div class="form-group">
            <x-input-label for="subjects_of_interest" :value="__('Disciplinas de Interesse')" />
            <select id="subjects_of_interest" name="subjects_of_interest[]" class="form-input mt-1 block w-full" multiple>
                @php
                    $subjects = ['Matemática', 'Física', 'Química', 'Biologia', 'Português', 'História', 'Geografia', 'Inglês'];
                @endphp

                @foreach ($subjects as $subject)
                    <option value="{{ $subject }}" {{ collect(old('subjects_of_interest', json_decode($user->subjects_of_interest, true)))->contains($subject) ? 'selected' : '' }}>
                        {{ $subject }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('subjects_of_interest')" />
            <p class="text-sm text-gray-600 mt-2">
                {{ __('Segure a tecla Ctrl ou Command para selecionar várias disciplinas.') }}
            </p>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color: #0F044C; color: white; border: none;">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>

.form-input {
    border: 1px solid #d1d5db; /* Borda cinza */
    border-radius: 6px; /* Bordas arredondadas */
    padding: 8px 10px; /* Espaçamento interno */
    font-size: 1rem; /* Tamanho de fonte */
    width: 100%; /* Largura total */
    background-color: #fff; /* Fundo branco */
    transition: border-color 0.2s;
}

.form-input:focus {
    border-color: #0F044C; /* Azul escuro ao foco */
    outline: none;
    box-shadow: 0 0 0 2px rgba(15, 4, 76, 0.2); /* Efeito de foco */
}

</style>