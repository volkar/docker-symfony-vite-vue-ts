<script setup lang="ts">
import MainMenuItem from "@/components/MainMenu/MainMenuItem.vue"

const mainMenuLinksArray = [
    {title: 'Index', to: {name: 'index'}},
    {title: 'Categories', to: {name: 'categories'}},
    {title: 'About', to: {name: 'about'}},
]
</script>

<template>
    <ul class="mainmenu">
        <MainMenuItem v-for="menuItem in mainMenuLinksArray" :menu-to="menuItem.to" :menu-title="menuItem.title"></MainMenuItem>
        <li><a href="/admin">Admin</a></li>
    </ul>
</template>

<style>
ul.mainmenu {
    background-color: rgba(0, 0, 0, 0.2);
    display: flex;
    flex-flow: row nowrap;
    justify-content: center;
    align-items: flex-start;
}
ul.mainmenu li {
    margin: 0 1em;
}
ul.mainmenu li a {
    padding: 1em;
    display: block;
}
ul.mainmenu li a.router-link-active {
    color: #fff;
    font-weight: 700;
}
</style>