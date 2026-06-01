<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

$phone = '5554999280102';
$whatsapp_link = "https://api.whatsapp.com/send?phone={$phone}";
?>

<div x-data="{open: true}" x-on:keyup.escape.window="open = false">

    <!-- Background Overlay -->
    <div
        x-cloak
        x-show="open"
        x-transition.opacity.duration.500ms
        class="fixed inset-0 overflow-hidden bg-black/75 backdrop-blur-[2px] z-999"
        aria-hidden="true">
    </div>

    <!-- Pop-up Modal -->
    <div
        x-cloak
        x-show="open"
        x-on:click.outside="open = false"
        x-transition.opacity.duration.500ms
        class="fixed inset-3 max-w-lg max-h-fit m-auto p-3 overflow-hidden rounded-lg text-neutral-800 bg-gold-100 shadow-2xl z-1000">

        <div class="flex items-center justify-end">
            <button x-on:click="open = false" class="relative flex items-center justify-center text-neutral-400 hover:text-neutral-600" type="button" aria-label="Fechar popup">
                <svg class="size-6.5" fill="none" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div>
            <h2 class="flex flex-col items-center justify-center gap-1">
                <span class="text-xs sm:text-sm font-light tracking-wider">AVISO IMPORTANTE</span>
                <span class="text-2xl sm:text-3xl font-light">ENTREGA ANTES DO NATAL</span>
            </h2>
        </div>

        <div class="flex items-center justify-center my-3 p-1">
            <span class="w-1/5 border-b border-neutral-500"></span>
        </div>

        <div class="px-6 space-y-3 text-sm font-light text-center">
            <p>Devido aos prazos necessários para a fabricação e transporte dos pedidos, e para garantir que todos os nossos clientes possam desfrutar de uma casa ainda mais bonita para as festas de final de ano, alertamos para fecharem seus pedidos até <span class="font-medium underline">11 de novembro!</span></p>
            <p>Este prazo é necessário para que possamos cumprir com os tempos de fabricação e transporte, assegurando que os produtos cheguem a tempo para as celebrações.</p>
            <p>Agradecemos a sua compreensão e nos colocamos à disposição para quaisquer esclarecimentos.</p>
        </div>

        <div class="flex items-center justify-center mt-8 mb-4">
            <a
                class="flex items-center justify-center gap-1 px-8 py-3 text-sm text-green-600 hover:text-white hover:font-medium rounded-md border border-green-600 bg-green-50 hover:bg-green-600 shadow-md focus:outline-hidden"
                href="<?php echo esc_url($whatsapp_link); ?>" role="button" target="_blank">
                <svg class="size-5.5" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                    <path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"></path>
                </svg>
                Atendimento WhatsApp
            </a>
        </div>
    </div>
</div>