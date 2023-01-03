let serverList = new ServerListModel();

/**
 * Create the Petite Vue app
 * @type {PetiteVue}
 * @see https://github.com/vuejs/petite-vue
 */
PetiteVue.createApp({
    // exposed to all expressions
    serverList,
    servers: [],
    serverTemplate: {
        name: 'Name',
        map: 'Map',
        ip: 'IP',
        port: 'Port',
    },

    // getters
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
    async updateServers() {
        console.log('updateServers');
        this.servers = await this.serverList.getServerList();
    },

    // lifecycle hooks
    mounted() {
        console.log('mounted');
        this.servers = this.serverList.servers;
        this.updateServers();
    }
}).mount();