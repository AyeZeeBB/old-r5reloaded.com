<?php $CONFIG->addFrontendScript(COMPONENTSPATH.'/header/header.js'); ?>

<nav id="header-app" @vue:mounted="mounted" class="flex items-center justify-between flex-wrap bg-teal p-6">
  <a class="flex items-center flex-no-shrink text-white mr-6" href="<?=SERVERPATH?>">
    <!-- <svg class="h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg> -->
    <img src="<?=PUBLICPATH?>/logo.png" class="h-8 w-8 mr-2" alt="R5Reloaded Logo" width="54" height="54">
    <span class="font-semibold text-xl tracking-tight">R5Reloaded</span>
  </a>
  <div class="block lg:hidden">
    <button @click="headerExpanded = !headerExpanded" class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
        <!-- <svg class="h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg> -->
        <svg class="h-3 w-3" viewBox="0 0 100 80">
            <rect width="100" height="20" fill="white"></rect>
            <rect y="30" width="100" height="20" fill="white"></rect>
            <rect y="60" width="100" height="20" fill="white"></rect>
        </svg>
    </button>
  </div>
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto" :class="{'hidden': !headerExpanded}">
    <div class="text-sm lg:flex-grow lg:space-x-4">
      <a href="<?=SERVERPATH?>" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Home
      </a>
      <a href="<?=SERVERLISTPATH?>" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Server List
      </a>
      <a href="https://docs.r5reloaded.com/" target="_blank" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Wiki
      </a>
      <a href="https://trello.com/b/ymr4R3j9/r5reloaded" target="_blank" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white">
        Trello
      </a>
    </div>
    <div>
      <a href="https://github.com/Mauler125/r5sdk/releases" target="_blank" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal hover:bg-white mt-4 lg:mt-0">Download</a>
    </div>
  </div>
</nav>