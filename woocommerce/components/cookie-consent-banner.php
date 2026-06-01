<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

if (is_cart() || is_checkout() || is_account_page()) {
    return;
}
?>

<div id="cookie-consent-banner" class="fixed inset-x-0 bottom-0 hidden! items-center justify-center gap-4 sm:gap-6 max-h-fit p-3 text-xs sm:text-sm text-justify bg-white shadow-[0_0_20px_0_rgba(0,0,0,0.1)]">
    <p>
        Nosso site utiliza cookies, ao continuar navegando você concorda com os
        <a class="underline" href="<?php echo esc_url(get_permalink(wc_get_page_id('terms'))); ?>">Termos de Uso</a>
        e a
        <a class="underline" href="<?php echo esc_url(get_privacy_policy_url()); ?>">Política de Privacidade</a>.
    </p>
    <button class="px-4 py-2 text-nowrap border border-neutral-300 bg-neutral-100 rounded-md hover:bg-neutral-200" type="button">
        Aceitar e fechar
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const banner = document.getElementById('cookie-consent-banner');
        const acceptButton = banner.querySelector('button');

        // Verifica se o cookie de consentimento já foi definido
        if (!document.cookie.split('; ').find(row => row.startsWith('cookie_consent=true'))) {
            // Mostra o banner se o cookie não estiver definido
            banner.classList.remove('hidden!');
            banner.classList.add('flex');
        }

        acceptButton.addEventListener('click', function() {
            // Define o cookie de consentimento com validade de 1 ano
            const d = new Date();
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
            const expires = "expires=" + d.toUTCString();
            document.cookie = "cookie_consent=true;" + expires + ";path=/";
            // Esconde o banner
            banner.classList.add('hidden!');
            banner.classList.remove('flex');
        });
    });
</script>