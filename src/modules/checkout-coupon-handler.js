"use strict";

export default function couponHandler() {
    return {
        form: document.querySelector('form.checkout'),
        email: document.querySelector('input[name="billing_email"]'),

        applyCoupon(code) {
            this.handleCoupon('apply_coupon', code);
        },

        // The coupon removal is currently being controlled by the native WooCommerce jQuery script.
        // removeCoupon(code) {
        //     this.handleCoupon('remove_coupon', code);
        // },

        handleCoupon(action, code) {
            // Note: 'wc_checkout_params' is declared by WooCommerce itself.
            const data = new FormData();
            data.append('coupon_code', code);
            data.append('billing_email', this.email.value);
            data.append('security', wc_checkout_params[action + '_nonce']);

            fetch(wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', action), {
                method: 'POST',
                body: data
            })
                .then(response => response.text())
                .then(data => {
                    document.querySelectorAll('.woocommerce-error, .woocommerce-message, .is-error, .is-success, .checkout-inline-error-message').forEach(el => el.remove());
                    if (data) {
                        this.form.insertAdjacentHTML('beforebegin', data);
                        // Dispatch custom events instead of jQuery triggers
                        document.body.dispatchEvent(new CustomEvent('applied_coupon_in_checkout', { detail: code }));
                        document.body.dispatchEvent(new CustomEvent('update_checkout', { detail: { update_shipping_method: false } }));
                    }
                });
        },
    }
}