<?php include_once '../config.php'; ?>

<!DOCTYPE html>
<html class='page font-Roboto' lang='en'>

<head>
    <?php include RCOMPONENTSPATH.'/head.php'; ?>

    <link rel='stylesheet' href='./server-list.css' />
    <title>R5Reloaded - Server List</title>
</head>

<body>
    <?php include RCOMPONENTSPATH.'/header/header.php'; ?>

    <article id="server-list-app" @vue:mounted="mounted" class="px-2 md:px-4 mx-auto" >
        <header class='top-padding'>
            <div class='pfp-flex'>
                <div class='md:w-1/2 text-margin'>
                    <text class='name'>R5 Reloaded Server List</text>
                    <p class='sub-text' style="display: hidden;" @vue:mounted="$el.style='';">
                        Check all {{servers.length}} servers that are currently running on R5 Reloaded!
                    </p>
                </div>
            </div>
        </header>
        <main class="flex items-center justify-center mt-10" style="display: hidden;" @vue:mounted="$el.style=''">
            <div class="relative flex flex-col min-w-0 break-words">

                <div class="rounded-t mb-0 py-3 border-0">
                    <div class="flex flex-wrap items-center justify-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-blueGray-700">Server List</h3>
                        </div>
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                            <button
                                class="text-white text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button" @click="updateServers" :class="loadingCooldown ? 'bg-indigo-800 active:bg-indigo-800 focus:bg-indigo-800 cursor-not-allowed loading' : 'bg-indigo-500 active:bg-indigo-600'">Refresh</button>
                        </div>
                    </div>
                </div>

                <table class="w-full flex flex-row flex-no-wrap rounded-lg overflow-hidden md:shadow-lg my-5">
                    <thead class="w-full">
                        <tr style="background-color: #242430"
                            class="flex flex-col flex-no-wrap md:table-row rounded-l-lg md:rounded-none mb-2 md:mb-0 text-xs uppercase whitespace-nowrap"
                            v-for="server in servers">
                            <th class="py-4 px-3 h-15 text-left">No.</th>
                            <th class="py-4 px-3 h-16 text-left md:h-10">Name</th>
                            <th class="py-4 px-3 h-15 text-left md:text-center">Map</th>
                            <!-- <th class="py-4 px-3 h-15 text-left md:text-center">Gamemode</th> -->
                            <!-- <th class="py-4 px-3 h-15 text-left md:text-center">IP</th> -->
                            <th class="py-4 px-3 h-15 text-left md:text-center">Players</th>
                        </tr>
                    </thead>
                    <tbody class="w-full flex-1 md:flex-none">
                        <tr class="flex flex-col flex-no-wrap md:table-row text-xs text-left mb-2 md:mb-0" style="outline: 1px solid #242430"
                            v-for="(server, key) in servers">
                            <td class="outline-grey-light outline-1 p-4 h-15">
                                {{key + 1}}.
                            </td>
                            <td class="outline-grey-light outline-1 p-4 font-bold h-16 md:h-10">
                                {{server.name}}
                            </td>
                            <td class="outline-grey-light outline-1 p-4 h-15 text-left md:text-center">
                                {{server.map}}
                                <!-- [{{server.playlist}}] -->
                            </td>
                            <!-- <td class="outline-grey-light outline-1 p-4 h-15 text-left md:text-center">
                                {{server.ip}}:{{server.port}}
                            </td> -->
                            <!-- <td class="outline-grey-light outline-1 p-4 h-15 text-left md:text-center">
                                {{server.playlist}}
                            </td> -->
                            <td class="outline-grey-light outline-1 p-4 h-15 text-left md:text-center"
                                :class="(server.playerCount == server.maxPlayers) ? 'text-red-500' : (server.playerCount > 0) ? 'text-green-500' : ''">
                                {{server.playerCount}}/{{server.maxPlayers}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </article>

    <!-- https://github.com/vuejs/petite-vue -->
    <script src="https://unpkg.com/petite-vue"></script>
    <script src="./scripts/models/server-list-model.js"></script>
    <script src="./scripts/server-list.js"></script>
    <?php foreach ($CONFIG->getFrontendScripts() as $scriptPath): ?>
        <script src="<?=$scriptPath?>"></script>
    <?php endforeach ?>
</body>

</html>