@extends('layouts.admin')

@section('content')

    <div class="container mt-5 mx-2">
        <!-- Card para Informações da Conta -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title">{{ __('Informações da Conta') }}</h2>
            </div>
            <div class="card-body">
                <header class="mb-4">
                    <p class="mt-2 text-muted">{{ __("Atualize os seus dados.") }}</p>
                </header>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Nome') }}</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}"
                               required autofocus autocomplete="name">
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}"
                               required autocomplete="username">
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Ano Escolar -->
                    <div class="mb-3">
                        <label for="school_year" class="form-label">{{ __('Ano Escolar') }}</label>
                        <select id="school_year" name="school_year" class="form-select"style=" width:70px;" required>
                            <option value="" disabled>{{ __('Selecione o Ano Escolar') }}</option>
                            @for ($i = 7; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('school_year', $user->school_year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('school_year')" />
                    </div>

                    <!-- Disciplinas de Interesse -->
                    <div class="mb-3">
                        <label for="subjects_of_interest" class="form-label">{{ __('Disciplinas de Interesse') }}</label>
                        <select name="subjects_of_interest[]" id="subjects_of_interest" class="form-select" style=" width:170px;" multiple required>
                            @foreach($allSubjects as $subject)
                                <option value="{{ $subject->id }}" @if(in_array($subject->id, old('subjects_of_interest', $user->subjects->pluck('id')->toArray()))) selected @endif>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('subjects_of_interest')" class="mt-2" />
                        <small class="form-text text-muted mt-2">
                            {{ __('Segure a tecla Ctrl ou Command para selecionar várias disciplinas.') }}
                        </small>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                    <button type="button" class="btn btn-black" onclick="window.location.href='{{ route('admin.dashboard') }}'">Voltar</button>

                    @if (session('status') === 'profile-updated')
                        <p class="text-muted small" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                            {{ __('Alterações guardadas.') }}
                        </p>
                    @endif
                </form>
            </div>
        </div>

        <!-- Card para Atualizar Palavra-Passe -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title">{{ __('Atualizar Palavra-Passe') }}</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label">{{ __('Palavra-Passe Atual') }}</label>
                        <input id="update_password_current_password" name="current_password" type="password" class="form-control mt-1 w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">{{ __('Nova Palavra-Passe') }}</label>
                        <input id="update_password_password" name="password" type="password" class="form-control mt-1 w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Nova Palavra-Passe') }}</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control mt-1 w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button class="btn btn-black" >{{ __('Guardar') }}</x-primary-button>

                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Alterações guardadas.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Card para Apagar Conta -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ __('Apagar Conta') }}</h2>
            </div>
            <div class="card-body">


                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Para apagar a sua conta, insira a sua palavra-passe') }}</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="{{ __('Palavra-passe') }}">
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <button type="submit" class="btn btn-danger">{{ __('Apagar Conta') }}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

<style>
    body {
        overflow-x: hidden;
    }

    .form-select:focus {
        border-color: #0F044C;
        box-shadow: 0 0 0 2px rgba(15, 4, 76, 0.2);
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .btn-secondary {
        margin-left: 10px;
    }
</style>
