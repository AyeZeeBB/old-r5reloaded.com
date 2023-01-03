/**
 * Class that handles the server list from https://ms.r5reloaded.com/servers
 */
class ServerListModel {
    /**
     * The URL to the server list
     * @type {string}
     */
    url = "./api/server-list.php";

    /**
     * Direct URL to the server list
     * @type {string}
     */
    directUrl = "https://ms.r5reloaded.com/servers";

    /**
     * True if the server list was already tried to be fetched
     */
    triedAgain = false;

    constructor() { 
        this._servers = [];
        this.updateServerList();
    }

    /**
     * Setter for the server list
     * @returns {Array}
     */
    get servers() {
        return this._servers;
    }

    /**
     * Getter for the server list
     * @param {Array} value
     */
    set servers(value) {
        this._servers = value;
    }

    /**
     * Get the server list
     */
    async getServerList() {
        await this.updateServerList();
        return this.servers;
    }

    /**
     * Update the server list
     * @returns {Array}
     */
    async updateServerList(url = this.url) {

        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            // mode: 'cors', // no-cors, *cors, same-origin
            // cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            // credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json',
            },
            // redirect: 'follow', // manual, *follow, error
            // referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            // body: data => JSON.stringify(data) // body data type must match "Content-Type" header
        });

        let data = await response.json();

        // if the server list is empty, try again with the direct URL
        if (!data.hasOwnProperty('servers') && !this.triedAgain) {
            this.triedAgain = true;

            console.info("Tried again");
            
            return this.updateServerList(this.directUrl);
        }
        
        if (this.triedAgain) {
            this.triedAgain = false;
            return [];
        }

        console.log(data);

        return this.servers = data.servers;
    }

}