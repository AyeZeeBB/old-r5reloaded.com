let serverList = new ServerListModel();

/**
 * Create the Petite Vue app
 * @type {PetiteVue}
 * @see https://github.com/vuejs/petite-vue
 */
PetiteVue.createApp({
    // exposed to all expressions

    /**
     * The server list model
     */
    serverList,
    /**
     * The server list values
     */
    servers: [],
    /**
     * The server list template
     */
    serverTemplate: {
        name: 'Name',
        map: 'Map',
        ip: 'IP',
        port: 'Port',
    },
    /**
     * True if the app was already mounted
     */
    alreadyMounted: false,
    /**
     * If true, the refresh button is disabled
     */
    loadingCooldown: false,

    // getters

    /**
     * Get the servers with only the properties that are in the template
     * TODO: This is not working properly yet and is not used
     * @returns {Array}
     */
    get serversFilteredProperties() {
        console.log("🚀 ~ file: server-list.js:22 ~ getserversFilteredProperties ~ servers", this.servers);

        let servers = this.servers;

        // filter out properties that are not in the template
        for (const server in servers) {
            for (const property in servers[server]) {
                if (!this.serverTemplate.hasOwnProperty(property)) {
                    delete servers[server][property];
                }
            }
        }

        return servers;
    },

    // methods

    /**
     * Update the server list
     * @returns {Promise<void>}
     */
    async updateServers() {
        // prevent spamming the refresh button
        if (this.loadingCooldown) {
            return;
        }
        
        this.loadingCooldown = true;
        setTimeout(() => {
            this.loadingCooldown = false;
        }, 3000);
        
        // update the server list
        this.servers = await this.serverList.getServerList();
    },

    // lifecycle hooks

    /**
     * Called when the app is mounted
     * @returns {void}
     */
    async mounted() {
        this.servers = this.serverList.servers;
        await this.updateServers();
    }
}).mount();