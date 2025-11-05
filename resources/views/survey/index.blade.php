@extends('layouts.app')

@section('title', 'Deserción Escolar')

@section('content')
<div class="mx-auto max-w-4xl mt-10" x-data="{ tab: 'general' }">
    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Deserción escolar</h1>
    <p class="mt-2 text-gray-600 dark:text-gray-400">Por favor, completa el formulario</p>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800 dark:bg-green-900 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errores globales --}}
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-800 dark:bg-red-900 dark:text-red-200">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul class="list-disc ml-5 mt-2 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabs --}}
    <div class="mt-6 border-b border-gray-900/10 pb-6 dark:border-white/10">
        {{-- Mobile select --}}
        <div class="grid grid-cols-1 sm:hidden">
            <select
                x-model="tab"
                aria-label="Select a tab"
                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 dark:bg-white/5 dark:text-gray-100 dark:outline-white/10 dark:*:bg-gray-800 dark:focus:outline-indigo-500">
                <option value="general">Datos generales</option>
                <option value="personal">Factores personales</option>
                <option value="academic">Factores académicos</option>
            </select>
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"
                 class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end fill-gray-500 dark:fill-gray-400">
                <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd"/>
            </svg>
        </div>

        {{-- Desktop pills --}}
        <div class="hidden sm:block">
            <nav aria-label="Tabs" class="flex space-x-4">
                <button
                    @click="tab = 'general'"
                    :class="tab === 'general'
                        ? 'bg-gray-200 dark:bg-white/10 text-gray-800 dark:text-white'
                        : 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white'"
                    class="rounded-md px-3 py-2 text-sm font-medium">
                    Datos generales
                </button>

                <button
                    @click="tab = 'personal'"
                    :class="tab === 'personal'
                        ? 'bg-gray-200 dark:bg-white/10 text-gray-800 dark:text-white'
                        : 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white'"
                    class="rounded-md px-3 py-2 text-sm font-medium">
                    Factores personales
                </button>
                <button
                    @click="tab = 'academic'"
                    :class="tab === 'academic'
                        ? 'bg-gray-200 dark:bg-white/10 text-gray-800 dark:text-white'
                        : 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white'"
                    class="rounded-md px-3 py-2 text-sm font-medium">
                    Factores académicos
                </button>
            </nav>
        </div>
    </div>

    {{-- Form --}}
    <form
        class="mt-6 space-y-8"
        action="{{ route('survey.store') }}"
        method="POST"
    >
        @csrf
        <div class="space-y-12">

            {{-- TAB 1: Datos generales --}}
            <div x-show="tab === 'general'" x-transition.opacity.duration.200ms
                 class="border-b border-gray-900/10 pb-12 dark:border-white/10">
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Datos generales</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            Nombre completo
                        </label>
                        <input id="first-name" name="name" type="text" value="{{ old('name') }}"
                               class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:focus:outline-indigo-500"/>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="age" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Edad</label>
                        <input id="age" name="age" type="number" value="{{ old('age') }}"
                               class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:focus:outline-indigo-500"/>
                        @error('age')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Género --}}
                    <div class="col-span-full">
                        <fieldset class="space-y-3">
                            <legend class="text-sm font-medium text-neutral-700 dark:text-neutral-300">Género</legend>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                @foreach ([
                                    ['male', 'Masculino', '<path d="M16 3h5m0 0v5m0-5-7 7"/><circle cx="10" cy="14" r="5"/>'],
                                    ['female', 'Femenino', '<circle cx="12" cy="8" r="5"/><path d="M12 13v8m-4-4h8"/>'],
                                    ['other', 'Otro / Prefiero no decirlo', '<path d="M6 8a6 6 0 1 1 6 6H9m3 0v4"/>']
                                ] as [$value, $label, $icon])
                                <label class="relative">
                                    <input type="radio" name="gender" value="{{ $value }}" class="peer sr-only" @checked(old('gender') === $value) />
                                    <div class="flex items-center gap-3 rounded-2xl border border-neutral-300 p-4 hover:border-neutral-400 cursor-pointer peer-checked:border-blue-500 peer-checked:ring-4 peer-checked:ring-blue-500/10">
                                        <svg viewBox="0 0 24 24"
                                             class="size-6 shrink-0 text-neutral-500 peer-checked:text-blue-600"
                                             fill="none" stroke="currentColor" stroke-width="1.8">
                                            {!! $icon !!}
                                        </svg>
                                        <span class="text-sm font-medium text-neutral-800 dark:text-neutral-200">{{ $label }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </fieldset>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="career" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            Carrera que estudia/estudió
                        </label>
                        <input id="career" name="career" type="text" value="{{ old('career') }}"
                               class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:focus:outline-indigo-500"/>
                        @error('career')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="semester" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            Semestre actual o en el que desertó
                        </label>
                        <select id="semester" name="semester" class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:focus:outline-indigo-500">
                            <option value="">Selecciona una opción</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option @selected(old('semester') == $i)>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('semester')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm/6 font-semibold text-gray-900 dark:text-white">
                                ¿Trabajas actualmente?
                            </legend>
                            <div class="mt-3 flex items-center gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="working" value="1" @checked(old('working')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="working" value="0" @checked(old('working')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('working')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- TAB 2: Factores personales --}}
            <div x-show="tab === 'personal'" x-transition.opacity.duration.200ms
                 class="border-b border-gray-900/10 pb-12 dark:border-white/10">
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Factores personales</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="motivation" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            ¿Qué tan motivado(a) te sientes con tu carrera?
                        </label>
                        <select id="motivation" name="motivation" class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 dark:bg-white/5 dark:text-white">
                            <option value="">Selecciona una opción</option>
                            <option @selected(old('motivation')=='Muy motivado(a)')>Muy motivado(a)</option>
                            <option @selected(old('motivation')=='Algo motivado(a)')>Algo motivado(a)</option>
                            <option @selected(old('motivation')=='Neutral')>Neutral</option>
                            <option @selected(old('motivation')=='Poco motivado(a)')>Poco motivado(a)</option>
                            <option @selected(old('motivation')=='Nada motivado(a)')>Nada motivado(a)</option>
                        </select>
                        @error('motivation')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">¿Has pensado en abandonar la universidad?</legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="abandon" value="1" @checked(old('abandon')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="abandon" value="0" @checked(old('abandon')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('abandon')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="reason-container" class="sm:col-span-6 {{ old('abandon')==='1' ? '' : 'hidden' }}">
                        <label for="reason" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            ¿Cuál es la razón principal?
                        </label>
                        <input id="reason" name="reason" type="text" value="{{ old('reason') }}"
                               class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 dark:bg-white/5 dark:text-white"/>
                        @error('reason')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="emotional-state" class="block text-sm font-medium text-gray-900 dark:text-white">¿Cómo describirías tu estado emocional actual?</label>
                        <select id="emotional-state" name="emotional-state" class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 dark:bg-white/5 dark:text-white">
                            <option value="">Selecciona una opción</option>
                            <option @selected(old('emotional-state')=='Estable')>Estable</option>
                            <option @selected(old('emotional-state')=='Ansioso(a)')>Ansioso(a)</option>
                            <option @selected(old('emotional-state')=='Estresado(a)')>Estresado(a)</option>
                            <option @selected(old('emotional-state')=='Triste')>Triste</option>
                            <option @selected(old('emotional-state')=='Otro')>Otro</option>
                        </select>
                        @error('emotional-state')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">¿Cuentas con apoyo familiar o social?</legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="support" value="1" @checked(old('support')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="support" value="0" @checked(old('support')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('support')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="economic-pillar-container" class="sm:col-span-3 {{ old('support')==='0' ? '' : 'hidden' }}">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">¿Eres el pilar económico de tu familia?</legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="economic-pillar" value="1" @checked(old('economic-pillar')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="economic-pillar" value="0" @checked(old('economic-pillar')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('economic-pillar')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">¿Vives lejos de la universidad?</legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="far-from-university" value="1" @checked(old('far-from-university')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="far-from-university" value="0" @checked(old('far-from-university')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('far-from-university')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- TAB 3: Factores académicos --}}
            <div x-show="tab === 'academic'" x-transition.opacity.duration.200ms class="border-b border-gray-900/10 pb-12 dark:border-white/10">
                <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Factores académicos</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="academic-performance" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            ¿Consideras que el nivel académico de las materias es…?
                        </label>
                        <select id="academic-performance" name="academic-performance" class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 dark:bg-white/5 dark:text-white">
                            <option value="">Selecciona una opción</option>
                            <option @selected(old('academic-performance')=='Muy alto')>Muy alto</option>
                            <option @selected(old('academic-performance')=='Alto')>Alto</option>
                            <option @selected(old('academic-performance')=='Adecuado')>Adecuado</option>
                            <option @selected(old('academic-performance')=='Bajo')>Bajo</option>
                            <option @selected(old('academic-performance')=='Muy bajo')>Muy bajo</option>
                        </select>
                        @error('academic-performance')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="has-failed" class="block text-sm/6 font-medium text-gray-900 dark:text-white">
                            ¿Has reprobado materias en semestres anteriores?
                        </label>
                        <select id="has-failed" name="has-failed" class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-gray-900 outline outline-1 outline-gray-300 focus:outline-indigo-600 dark:bg-white/5 dark:text-white">
                            <option value="">Selecciona una opción</option>
                            <option @selected(old('has-failed')=='1') value="1">Sí</option>
                            <option @selected(old('has-failed')=='0') value="0">No</option>
                        </select>
                        @error('has-failed')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">
                                ¿Sientes que tus profesores te brindan apoyo?
                            </legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="professor-support" value="1" @checked(old('professor-support')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="professor-support" value="0" @checked(old('professor-support')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('professor-support')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <fieldset>
                            <legend class="text-sm font-semibold text-gray-900 dark:text-white">
                                ¿Tienes acceso adecuado a recursos académicos?
                            </legend>
                            <div class="mt-3 flex gap-6">
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="resources-access" value="1" @checked(old('resources-access')==='1') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">Sí</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" name="resources-access" value="0" @checked(old('resources-access')==='0') class="size-4 border-gray-300" />
                                    <span class="text-sm text-gray-900 dark:text-white">No</span>
                                </label>
                            </div>
                        </fieldset>
                        @error('resources-access')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancelar</button>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500">
                Guardar
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const abandonRadios = document.querySelectorAll('input[name="abandon"]');
        const reasonContainer = document.getElementById('reason-container');

        abandonRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                reasonContainer.classList.toggle('hidden', radio.value !== '1');
            });
        });

        const supportRadios = document.querySelectorAll('input[name="support"]');
        const economicContainer = document.getElementById('economic-pillar-container');

        supportRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                economicContainer.classList.toggle('hidden', radio.value !== '0');
            });
        });
    });
</script>
@endsection
    