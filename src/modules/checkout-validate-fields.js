"use strict";

export default function fieldValidation(fieldKeys) {
    return {

        // Dynamically initialize all fields as empty strings
        // and spread them as properties of the object
        ...Object.fromEntries(fieldKeys.map(key => [key, ''])),

        errors: {},
        loading: false,

        // Validate fields for shipping and billing addresses.
        validateField(key, label) {
            if (!key || !label) {
                console.error('Key and label are required for validation.');
                return;
            }
            if (key === 'billing_email') {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (this[key].trim() === '') {
                    this.setErrorRequired(key, label);
                } else if (!emailPattern.test(this[key])) {
                    this.setErrorInvalid(key, label);
                } else {
                    this.errors[key] = false;
                }
            } else if (['shipping_postcode', 'billing_postcode', 'billing_cpf', 'billing_cnpj', 'billing_phone'].includes(key)) {
                const cleaned = this[key].replace(/[^0-9]/g, '');
                if (cleaned === '') {
                    this.setErrorRequired(key, label);
                } else if (
                    (['shipping_postcode', 'billing_postcode'].includes(key) && cleaned.length !== 8) ||
                    (key === 'billing_cpf' && cleaned.length !== 11) ||
                    (key === 'billing_cnpj' && cleaned.length !== 14) ||
                    (key === 'billing_phone' && (cleaned.length !== 10 && cleaned.length !== 11))
                ) {
                    this.setErrorInvalid(key, label);
                } else {
                    this.errors[key] = false;
                }
            } else {
                if (this[key].trim() === '') {
                    this.setErrorRequired(key, label);
                } else {
                    this.errors[key] = false;
                }
            }
        },
        setErrorRequired(key, label) {
            this.errors[key] = `${label} é um campo obrigatório.`;
        },
        setErrorInvalid(key, label) {
            this.errors[key] = `${label} não é válido.`;
        },
        formatTextInput(input) {
            return input
                .trim()
                .replace(/\s+/g, ' ')
                .toLowerCase()
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        },
    }
}