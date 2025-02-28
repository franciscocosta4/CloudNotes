<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Palavra-Passe')" />
            <x-text-input id="password" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Palavra-Passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Ano Escolar -->
        <div class="mt-4">
            <x-input-label for="school_year" :value="__('Ano Escolar')" />
            <select id="school_year" name="school_year" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required onchange="showSubjects()">
                <option value="" disabled selected>{{ __('Selecione o Ano Escolar') }}</option>
                @for ($i = 7; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ old('school_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <x-input-error :messages="$errors->get('school_year')" class="mt-2" />
        </div>

        <!-- Disciplinas de Interesse (hidden by default) -->
        <div class="mt-4 hidden" id="subjects_section">
            <x-input-label for="subjects_of_interest" :value="__('Disciplinas de Interesse')" />
            <!-- <label for="subjects_of_interest">Disciplinas de Interesse</label> -->
            <select id="subjects_of_interest"name="subjects_of_interest[]" id="subjects_of_interest" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple >
                @foreach($allSubjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('subjects_of_interest')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já tem conta?') }}
            </a>
            <x-primary-button class="ms-4" style="background-color: #0F044C; color: white; border: none;">
                {{ __('Registar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Função para mostrar a seção de disciplinas quando o ano escolar for selecionado
        function showSubjects() {
            var schoolYear = document.getElementById('school_year').value;
            var subjectsSection = document.getElementById('subjects_section');
            
            if (schoolYear) {
                subjectsSection.classList.remove('hidden'); // Mostra o campo de disciplinas
            } else {
                subjectsSection.classList.add('hidden'); // Esconde o campo de disciplinas
            }
        }
    </script>
</x-guest-layout>
