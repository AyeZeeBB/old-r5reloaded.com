/**
 * Class that handles the server list from https://ms.r5reloaded.com/servers
 */
class ServerListModel {
    url = "./api/server-list.php";
    // url = "https://ms.r5reloaded.com/servers";

    constructor() { 
        this._servers = [];
        this.updateServerList();
    }

    /**
     * Get the server list
     * @returns {Array}
     * @private
     * @readonly
     * @memberof ServerList
     * @type {Array}
     */
    get servers() {
        return this._servers;
    }

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

    async updateServerList() {
        const response = await fetch(this.url, {
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

        console.log(data);

        return this.servers = data.servers;
    }

}