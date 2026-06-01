<?php

declare(strict_types=1);
defined('ABSPATH') || exit;


$email = get_option('sartorello_woo_theme_email') ?: 'example@example.com';

$whatsapp_number = get_option('sartorello_woo_theme_whatsapp');
$whatsapp_link = $whatsapp_number ? "https://api.whatsapp.com/send?phone={$whatsapp_number}" : '#';


get_header();
?>

<main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
            <div class="border-b border-neutral-200 py-10">
                <h1 class="text-3xl font-bold tracking-tight">
                    <?php the_title(); ?>
                </h1>
            </div>

            <section class="my-8 text-sm space-y-3">
                <ul class="space-y-8">
                    <li class="flex gap-4">
                        <div class="flex items-center justify-center">
                            <svg class="size-7.5" viewBox="0 -960 960 960" fill="currentColor" aria-hidden="true">
                                <path d="m618.92-298.92 42.16-42.16L510-492.16V-680h-60v212.15l168.92 168.93ZM480.07-100q-78.84 0-148.21-29.92t-120.68-81.21q-51.31-51.29-81.25-120.63Q100-401.1 100-479.93q0-78.84 29.92-148.21t81.21-120.68q51.29-51.31 120.63-81.25Q401.1-860 479.93-860q78.84 0 148.21 29.92t120.68 81.21q51.31 51.29 81.25 120.63Q860-558.9 860-480.07q0 78.84-29.92 148.21t-81.21 120.68q-51.29 51.31-120.63 81.25Q558.9-100 480.07-100ZM480-480Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold">Horário de Atendimento</h3>
                            <p class="text-neutral-600">Segunda a Sábado</p>
                            <p class="text-neutral-600">das 09h às 18h (exceto feriados)</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex items-center justify-center">
                            <svg class="size-7.5" viewBox="0 -960 960 960" fill="currentColor">
                                <path d="M160-200h100v-320h440v320h100v-426L480-754 160-626v426Zm-60 60v-526.54l380-151.92 380 151.92V-140H640v-320H320v320H100Zm271.15 0v-70.77h70.77V-140h-70.77Zm73.47-120v-70.77h70.76V-260h-70.76Zm73.46 120v-70.77h70.77V-140h-70.77ZM260-520h440-440Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold">Horário de Funcionamento da Fábrica</h3>
                            <p class="text-neutral-600">Segunda a Sexta</p>
                            <p class="text-neutral-600">das 07h às 17h (exceto feriados)</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex items-center justify-center">
                            <svg class="size-7.5" viewBox="0 -960 960 960" fill="currentColor" aria-hidden="true">
                                <path d="M172.31-180Q142-180 121-201q-21-21-21-51.31v-455.38Q100-738 121-759q21-21 51.31-21h615.38Q818-780 839-759q21 21 21 51.31v455.38Q860-222 839-201q-21 21-51.31 21H172.31ZM480-457.69 160-662.31v410q0 5.39 3.46 8.85t8.85 3.46h615.38q5.39 0 8.85-3.46t3.46-8.85v-410L480-457.69Zm0-62.31 313.85-200h-627.7L480-520ZM160-662.31V-720v467.69q0 5.39 3.46 8.85t8.85 3.46H160v-422.31Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold">E-mail</h3>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="text-neutral-600 hover:text-gold-600 underline"><?php echo esc_html($email); ?></a>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex items-center justify-center">
                            <svg class="size-7.5" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                                <path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold">Telefone e WhatsApp</h3>
                            <a href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" class="text-neutral-600 hover:text-gold-600 underline">(54) 99928-0102</a>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <div class="flex items-center justify-center">
                            <svg class="size-7.5" viewBox="0 -960 960 960" fill="currentColor" aria-hidden="true">
                                <path d="M480-100q-101.38 0-165.69-29.1T250-204.23q0-21.31 16.04-40.08t44.35-32.23l47.23 42.85q-12.85 5.15-27.01 12.84-14.15 7.7-19.38 16.23 9.92 17.93 59.04 31.27Q419.38-160 479.81-160q60.42 0 110.04-13.35 49.61-13.34 59.54-31.27-5.08-9.15-20.5-16.84-15.43-7.69-29.27-12.85l46.61-43.46q30.69 14.08 47.23 32.85Q710-226.15 710-204.4q0 46.11-64.31 75.25Q581.38-100 480-100Zm1-195q99.38-75.31 149.19-149.19Q680-518.08 680-590.92q0-103.53-64.81-156.3-64.81-52.78-135-52.78T345-747.19q-65 52.8-65 156.38 0 68.04 49.19 141.12T481-295Zm-1 75q-130.93-97.89-195.46-190.14Q220-502.38 220-590.86q0-66.83 23.58-117.06 23.58-50.23 60.88-84.12 37.31-33.88 83.72-50.92Q434.58-860 480.06-860t91.82 17.04q46.35 17.04 83.66 50.92 37.3 33.89 60.88 84.15Q740-657.63 740-590.92q0 88.49-64.54 180.75Q610.93-317.91 480-220Zm.19-304.23q29.73 0 50.92-21 21.2-21 21.2-51.12 0-30.11-21.24-51.3-21.24-21.2-51.07-21.2-29.54 0-50.92 21.24-21.39 21.25-21.39 51.07 0 30.31 21.39 51.31 21.38 21 51.11 21Zm-.19-72.31Z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold">Endereço</h3>
                            <a href="https://maps.app.goo.gl/mfBCbtiPV8djki3R6" target="_blank" class="text-neutral-600 hover:text-gold-600 hover:underline">Rua Giovanni Baptista Fracalossi, 716 - Distrito Industrial de São Valentin - Bento Gonçalves/RS - CEP 95709-250</a>
                        </div>
                    </li>
                </ul>

                <a role="button" href="<?php echo esc_url($whatsapp_link); ?>" target="_blank" class="flex items-center justify-center gap-1 w-full mt-8 px-8 py-3 text-sm text-green-600 hover:text-white hover:font-medium rounded-md border border-green-600 bg-green-50 hover:bg-green-600 shadow-md focus:outline-hidden">
                    <svg class="size-5.5" fill="currentColor" viewBox="0 0 640 640" aria-hidden="true">
                        <path d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"></path>
                    </svg>
                    Atendimento WhatsApp
                </a>
            </section>
    <?php
        }
    }
    ?>
    <div class="mt-8">
        <a
            class="text-sm font-medium underline underline-offset-6 hover:text-gold-600"
            href="<?php echo esc_url(home_url()); ?>"
            role="button">
            <span aria-hidden="true">← </span>
            Retornar ao início
        </a>
    </div>
</main>

<?php
get_footer();
