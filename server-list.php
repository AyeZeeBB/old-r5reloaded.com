<!DOCTYPE html>
<html class='page font-Roboto' lang='en'>

<head>
    <meta name="description" content="A Mod For Apex Legends." />

    <meta name="twitter:site" content="r5reloaded.com" />
    <meta name="twitter:title" content="R5Reloaded" />
    <meta name="twitter:description" content="A Mod For Apex Legends." />
    <meta name="twitter:image" content="./content/logo.png" />

    <meta property='og:title' content='r5reloaded.com' />
    <meta property='og:type' content="R5Reloaded" />
    <meta property='og:description' content='A Mod For Apex Legends.' />
    <meta property="og:image" content='./content/logo.png' />
    <meta name="theme-color" content="#ca4c4c" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name='viewport' />
    <meta charset='utf-8' />
    <meta name='language' content='english' />
    <meta name='keywords' content='website' />
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.4/tailwind.min.css' />
    <link rel='stylesheet' href='./styles/page.css' />
    <link rel='stylesheet' href='./styles/about-me.css' />
    <link rel='stylesheet' href='./styles/cards.css' />
    <link rel='stylesheet' href='./styles/server-list.css' />

    <link rel='preconnect' href='https://fonts.googleapis.com' />
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
    <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet' />

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap' rel='stylesheet'>


    <link rel="shortcut icon" href="./content/logo.png" type="image/x-icon">
    <title>R5Reloaded - Server List</title>
</head>

<body class="p-0">
    <header class='top-padding'>
        <div class='pfp-flex'>
            <div class='md:w-1/2 w-screen text-margin'>
                <text class='name'>R5 Reloaded Server List</text>
                <p class='sub-text'>
                    Check out the servers that are currently running on R5 Reloaded!
                </p>
            </div>
        </div>
    </header>
    <main v-scope @vue:mounted="mounted" class="flex items-center justify-center mt-5">
        <div>
            <div class="mb-12 px-4 mx-auto">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded ">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">Server List</h3>
                            </div>
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                <button
                                    class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button" @click="updateServers">Refresh</button>
                            </div>
                        </div>
                    </div>

                    <!-- Old Table -->
                    <table class="w-full flex flex-row flex-no-wrap rounded-lg overflow-hidden sm:shadow-lg my-5">
                        <thead>
                            <tr style="background-color: #242430"
                                class="flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0 text-xs uppercase whitespace-nowrap"
                                v-for="server in servers">
                                <th class="p-4 text-left">Name</th>
                                <th class="p-4 text-left">Map</th>
                                <th class="p-4 text-left">IP</th>
                                <th class="p-4 text-left">Port</th>
                            </tr>
                        </thead>
                        <tbody class="flex-1 sm:flex-none">
                            <tr class="flex flex-col sm:table-row mb-2 sm:mb-0 text-xs text-left" v-for="server in servers">
                                <td
                                    class="outline-grey-light outline-1 p-4 font-bold max-w-1">
                                    {{server.name}}
                                </td>
                                <td
                                    class="outline-grey-light outline-1 p-4 max-w-3">
                                    {{server.map}}
                                </td>
                                <td
                                    class="outline-grey-light outline-1 p-4 max-w-3">
                                    {{server.ip}}
                                </td>
                                <td
                                    class="outline-grey-light outline-1 p-4 max-w-3">
                                    {{server.port}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- https://github.com/vuejs/petite-vue -->
    <script src="https://unpkg.com/petite-vue"></script>
    <script src="./scripts/server-list-model.js"></script>
    <script src="./scripts/server-list.js"></script>
</body>

</html>