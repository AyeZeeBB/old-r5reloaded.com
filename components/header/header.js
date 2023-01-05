/**
 * Create the Petite Vue header app
 * @type {PetiteVue}
 * @see https://github.com/vuejs/petite-vue
 */
PetiteVue.createApp({
    
    // exposed to all expressions ======================

    headerExpanded: false,

    // getters ======================

    get something () {

    },

    // methods ======================

    /**
     * Update the server list
     * @returns {Promise<void>}
     */
    async expandHeader() {
        
    },

    // lifecycle hooks ======================

    /**
     * Called when the app is mounted
     * @returns {void}
     */
    async mounted() {
    },
}).mount('#header-app');