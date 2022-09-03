<script setup lang="ts">
import MainMenu from '@/components/MainMenu/MainMenu.vue'
</script>

<template>

    <MainMenu />

    <RouterView />

    <hr />

    <a href="https://vitejs.dev" target="_blank">
        <img alt="Vite logo" class="logo vite" src="./gfx/vite.svg" />
    </a>
    <a href="https://pinia.vuejs.org" target="_blank">
        <img alt="Pinia logo" class="logo pinia" src="./gfx/pinia.svg" />
    </a>
    <a href="https://vuejs.org" target="_blank">
        <img alt="Vue logo" class="logo vue" src="./gfx/vue.svg" />
    </a>

</template>

<style src="@/styles/reset.css"></style>
<style src="@/styles/styles.css"></style>