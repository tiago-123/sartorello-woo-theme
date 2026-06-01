'use strict';

export default function cart() {
   const cartChannel = new BroadcastChannel('cart_channel');

   return {
      cart: {},
      nonce: document.getElementById('cart-nonce')?.value,
      loading: false,

      init() {
         // When another tab updates the cart, update this tab's cart data.
         cartChannel.onmessage = (e) => {
            const data = typeof e.data === 'string' ? JSON.parse(e.data) : e.data;
            this.cart = data.cart;
            this.nonce = data.nonce;
         };
         // Listen for custom 'added-to-cart' event dispatched by other scripts.
         window.addEventListener('added-to-cart', () => {
            console.log('Item added to cart, refreshing mini cart...');
            this.fetchCart(true);
         });
         // Refresh the mini cart when the user clicks the back button or navigates to a cached page.
         window.addEventListener('pageshow', (e) => {
            if (e.persisted) this.fetchCart(false); // Update just this tab.
         });
      },

      /**
       * Fetches the current cart state from the server.
       * This is a read-only operation and does not require a nonce.
       * @param {boolean} broadcast - Whether to broadcast the change.
       */
      async fetchCart(broadcast = true) {
         this.loading = true;
         try {
            const response = await fetch('/wp-json/wc/store/v1/cart');
            if (!response.ok) throw new Error(`Request failed. Status code: ${response.status}`);

            const json = await response.json();
            if (!json.items) throw new Error('Failed to fetch cart data.');

            this.cart = json;
            if (broadcast) this.broadcastData();
         } catch (error) {
            console.error(error);
         } finally {
            this.loading = false;
         }
      },

      /**
       * Updates an item's quantity in the cart.
       * @param {string} key - The cart item key.
       * @param {number} qty - The new quantity.
       */
      async updateItem(key = '', qty = 0) {
         // Prevent requests for invalid quantities.
         if (qty < 0) return;
         const url =
            '/wp-json/wc/store/v1/cart/update-item' +
            `?key=${encodeURIComponent(key)}` +
            `&quantity=${qty}`;
         await this.updateCart(url, true);
      },

      /**
       * Removes an item from the cart.
       * @param {string} key - The cart item key.
       */
      async removeItem(key = '') {
         const url = `/wp-json/wc/store/v1/cart/remove-item?key=${encodeURIComponent(key)}`;
         await this.updateCart(url, true);
      },

      /**
       * Performs a cart modification action (e.g., update, remove).
       * These actions require a POST request with a nonce.
       * @param {string} url - The API endpoint URL.
       * @param {boolean} broadcast - Whether to broadcast the change.
       */
      async updateCart(url = '', broadcast = true) {
         if (!this.nonce) {
            console.error('Nonce not found. Cannot perform cart action.');
            return;
         }

         this.loading = true;

         try {
            const response = await fetch(url, { method: 'POST', headers: { Nonce: this.nonce } });
            if (!response.ok) throw new Error(`Request failed. Status code: ${response.status}`);

            const json = await response.json();
            if (!json)
               throw new Error('Failed to perform the cart action to the provided url: ' + url);

            // If the action resulted in an error, a message will be included in the response.
            if (json.message) console.error(json.message);

            // Some error responses indicate conflicts, in which case the current state of the cart is returned as part of the error data.
            if (json.data && json.data.cart) {
               this.cart = json.data.cart;
            } else {
               this.cart = json;
            }

            this.updateNonce(response);

            if (broadcast) this.broadcastData();
         } catch (error) {
            console.error(error);
         } finally {
            this.loading = false;
            console.log('Cart updated:', this.cart);
         }
      },

      /**
       * Extracts and updates the nonce from the response headers.
       * @param {Response} response - The fetch response object.
       */
      updateNonce(response) {
         const newNonce = response.headers.get('Nonce');
         if (newNonce) this.nonce = newNonce;
      },

      /**
       * Broadcasts a message to other tabs using the BroadcastChannel API.
       * Sends both the current cart data and most recent nonce, along with any additional data provided.
       * @param {Object} data - Optional additional data to broadcast alongside cart state
       */
      broadcastData(data) {
         cartChannel.postMessage(
            JSON.stringify({
               cart: this.cart,
               nonce: this.nonce,
               ...data,
            }),
         );
      },

      /**
       * Formats a price for display.
       * @param {number} number - The price to format.
       * @returns {string} The formatted price.
       */
      formatPrice(number) {
         if (typeof number !== 'number') {
            number = parseInt(number);
         }
         const value = number / Math.pow(10, this.cart.totals.currency_minor_unit);
         return value
            .toFixed(this.cart.totals.currency_minor_unit)
            .replace('.', this.cart.totals.currency_decimal_separator)
            .replace(/\B(?=(\d{3})+(?!\d))/g, this.cart.totals.currency_thousand_separator);
      },
   };
}
