'use strict';

document.addEventListener('DOMContentLoaded', addressAutocomplete);

function addressAutocomplete() {
   // Array of types to handle both billing and shipping.
   const types = ['billing', 'shipping'];

   // Loop through each type to add event listeners for postcode fields.
   for (let type of types) {
      const postcodeField = document.getElementById(type + '_postcode');
      if (postcodeField) {
         postcodeField.addEventListener('input', function () {
            const postcode = postcodeField.value;
            if (validate(postcode)) {
               autofillAddress(postcode, type);
            }
         });
      }
   }

   // Validate the postcode input
   function validate(postcode) {
      const cleaned = postcode.replace(/[^0-9]/g, '');
      return cleaned.length === 8;
   }

   // Set the value of a field
   // This is intended to be used together with the x-model in Alpine.js
   function setFieldValue(key, value, type) {
      // window.billingFields and window.shippingFields are initialized with the x-init directive on the checkout form.
      if (window[type + 'Fields'] && key in window[type + 'Fields']) {
         window[type + 'Fields'][key] = value;
      }
   }

   // Fetch address data from ViaCEP API and fill-in the correspondent fields.
   async function autofillAddress(postcode, type) {
      const url = `https://viacep.com.br/ws/${postcode}/json/`;

      toggleLoading(type, true);

      try {
         const response = await fetch(url);
         if (!response.ok) {
            throw new Error(`Request failed for URL: '${url}' >> Status code: ${response.status}`);
         }

         const data = await response.json();
         const isValid = data && !data.erro;

         const fields = {
            [type + '_address_1']: isValid ? data.logradouro : '',
            [type + '_neighborhood']: isValid ? data.bairro : '',
            [type + '_city']: isValid ? data.localidade : '',
            [type + '_state']: isValid ? data.uf : '',
         };

         for (let [key, value] of Object.entries(fields)) {
            setFieldValue(key, value, type);
         }

         document.body.dispatchEvent(
            new CustomEvent('update_checkout', { detail: { update_shipping_method: true } }),
         );
      } catch (error) {
         console.error('Address Autocomplete Error:', error);
      } finally {
         toggleLoading(type, false);
      }
   }

   // Set loading state via Alpine's $data
   function toggleLoading(type, value) {
      const target = window[type + 'Fields']; // Either window.billingFields or window.shippingFields
      if (target && 'loading' in target) {
         target.loading = value;
         // console.log('Loading state updated:', target.loading);
      }
   }
}
