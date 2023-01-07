<?php include_once 'config.php'; ?>

<!DOCTYPE html>
<html class='page font-Roboto' lang='en'>
<head>
    <?php include RCOMPONENTSPATH.'/head.php'; ?>
</head>

<body>
    <video autoplay muted loop class="fixed top-0 left-0 w-full h-screen object-cover blur-sm overflow-hidden">
        <source src="https://atlas.r5reloaded.com/assets/bg.mp4" type="video/mp4">
    </video>
    
    <main class="flex flex-col items-center z-10">
        <div class="mt-48 text-5xl flex flex-col items-center font-segoeui">
            <img class="drop-shadow-md" src="<?=PUBLICPATH?>/mainlogo.png" alt="Apex Legends Logo" width="100" height="100">
            <h1 class="text-xl font-bold drop-shadow-md my-5">R5RELOADED</h1>
            <h2 class="text-lg drop-shadow-md">Apex Legends Modding SDK</h2>
        </div>

        <article class="list mb-6">
            <a>
                <div class='card' onclick='window.open("https://docs.r5reloaded.com/")'>
                    <div style='display: flex;'>
                        <img src='<?=PUBLICPATH?>/logo.png' class='card-img' alt='Twitter' draggable=false>
                        <span class='card-title'>Documentation/Wiki</span>
                    </div>
                    <p class='card-desc'>
                        You can find useful tutorials and information on our wiki page.
                    </p>
                    <p class='card-url'>
                        https://docs.r5reloaded.com/
                    </p>
                </div>
            </a>
            <a>
                <div class='card' onclick='location.href = "<?=SERVERPATH?>/server-list"'>
                    <div style='display: flex;'>
                        <img src='<?=PUBLICPATH?>/logo.png' class='card-img' alt='Twitter' draggable=false>
                        <span class='card-title'>Server List</span>
                    </div>
                    <p class='card-desc'>
                        Want to see what servers are currently operational and running?
                    </p>
                    <p class='card-url'>
                        https://r5reloaded.com/server-list
                    </p>
                </div>
            </a>
            <a>
                <div class='card' onclick='window.open("https://trello.com/b/ymr4R3j9/r5reloaded")'>
                    <div style='display: flex;'>
                        <img src='<?=PUBLICPATH?>/logo.png' class='card-img' alt='Twitter' draggable=false>
                        <span class='card-title'>Trello</span>
                    </div>
                    <p class='card-desc'>
                        Want to see what bugs need fixing, or just view overall progress?
                    </p>
                    <p class='card-url'>
                        https://trello.com/b/ymr4R3j9/r5reloaded
                    </p>
                </div>
            </a>
            <a>
                <div class='card' onclick='window.open("https://github.com/Mauler125/r5sdk/releases")'>
                    <div style='display: flex;'>
                        <img src='<?=PUBLICPATH?>/logo.png' class='card-img' alt='Twitter' draggable=false>
                        <span class='card-title'>Download the Mod</span>
                    </div>
                    <p class='card-desc'>
                        If you need any help downloading or installing the mod join our discord!
                    </p>
                    <p class='card-url'>
                        https://github.com/Mauler125/r5sdk/releases
                    </p>
                </div>
            </a>
        </article>
    </main>
    
    <?php foreach ($CONFIG->getFrontendScripts() as $scriptPath): ?>
        <script src="<?=$scriptPath?>"></script>
    <?php endforeach ?>
</body>
</html>