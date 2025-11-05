@extends('layouts.app')

@section('title', 'Deserción Escolar')

@section('styles')
<style>
    body {
        background: url('https://cdn-3.expansion.mx/dims4/default/8713693/2147483647/strip/true/crop/724x380+0+24/resize/1200x630!/format/jpg/quality/80/?url=https%3A%2F%2Fcdn-3.expansion.mx%2F14%2F62%2F9ba314e94b7f9b0e5ffbb3fd9ad4%2Fistock-1047047834.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
</style>
@endsection

@section('content')
<div class="relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 text-center">
        <h1 class="filter blur-[1px] text-5xl font-semibold tracking-tight text-white sm:text-7xl">
            Abandono escolar en la UNRC, una realidad compleja, un reto superado.
        </h1>
        <ul class="mt-6 text-xl leading-8 bg-white/30 inline-block px-6 py-4 rounded-lg text-white backdrop-blur-sm">
            Integrantes
            <li>Fernanda Ruiz Dávila</li>
            <li>Erick Sergio Feria Valencia</li>
            <li>Ángel Diego Toriz Urbina</li>
            <li>Maya Sofia Montiel Aguilar</li>
        </ul>
    </div>
</div>
@endsection