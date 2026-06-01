<?php

declare(strict_types=1);
defined('ABSPATH') || exit;
?>

<div
    x-data="countdown('2025-09-30T23:59:59')"
    x-init="startTimer()"
    class="flex flex-col items-center justify-center bg-black py-8 gap-4">

    <div class="flex flex-col sm:flex-row items-center sm:items-end justify-center gap-2 sm:gap-4">
        <span class="text-xs font-light text-white tracking-wider uppercase">Acaba em:</span>
        <div class="countdown flex items-center justify-center text-white gap-4">
            <div class="countdown__item flex flex-col items-center justify-center">
                <span class="countdown__number text-3xl font-semibold" x-text="days">00</span>
                <span class="countdown__label text-xs font-light tracking-wider uppercase">Dias</span>
            </div>
            <div class="countdown__item flex flex-col items-center justify-center">
                <span class="countdown__number text-3xl font-semibold" x-text="hours">00</span>
                <span class="countdown__label text-xs font-light tracking-wider uppercase">Horas</span>
            </div>
            <div class="countdown__item flex flex-col items-center justify-center">
                <span class="countdown__number text-3xl font-semibold" x-text="minutes">00</span>
                <span class="countdown__label text-xs font-light tracking-wider uppercase">Minutos</span>
            </div>
            <div class="countdown__item flex flex-col items-center justify-center">
                <span class="countdown__number text-3xl font-semibold" x-text="seconds">00</span>
                <span class="countdown__label text-xs font-light tracking-wider uppercase">Segundos</span>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-center flex-wrap gap-3 text-5xl text-white text-center">
        <span class="font-extrabold tracking-tight uppercase">Black November</span>
        <span class="font-light tracking-tighter text-shadow-[0_0_20px_#fff,0_0_10px_#fff,0_0_50px_#be9959,0_0_50px_#be9959,0_0_40px_#be9959,0_0_100px_#be9959,0_0_75px_#be9959]">15%OFF</span>
    </div>

    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 sm:gap-12 text-white">
        <span class="font-light tracking-wide sm:underline underline-offset-6">De 01/11 a 30/11</span>
        <div class="border-[1.5px] border-white border-dashed py-2 px-3 rounded-xl">
            <span class="font-light">Cupom: </span>
            <span class="font-semibold">BLACK15</span>
        </div>
    </div>
</div>