<script setup lang="ts">
import { watch, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useGetRequest } from "@/use/useFetchRequest";

const route = useRoute();

const data = ref();
const error = ref();
const isLoading = ref(true);

const loadData = (slug) => {
    if (slug) {
        const url = '/api/getCategory/' + slug
        useGetRequest(url, url).then((result) => {
            data.value = result
        }).catch((err) => {
            error.value = err
        }).finally(() => {
            isLoading.value = false
        })
    }
}

watch(() => route.params.slug, (newSlug) => {
    loadData(newSlug)
})

loadData(route.params.slug)

</script>

<template>
    <article>
        <div v-if="isLoading">Loading...</div>
        <div v-else-if="error">
            Error: {{ error.message }}
        </div>
        <div v-else-if="data">
            <h1>{{ data.title }}</h1>

            <div class="projects">
                <div v-for="project in data.projects" :key="project.id">
                    <h2>{{ project.title }}</h2>
                    <img :src="'/uploads/' + project.cover" :alt="project.title">
                    <p>{{ project.content }}</p>
                </div>
            </div>

            <RouterLink :to="{name: 'categories'}">All categories</RouterLink>

        </div>
    </article>
</template>

<style scoped>
.projects {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
}

h2 {
    margin-bottom: 0.8em;
}

.projects > div {
    flex: 0 0 47%;
}

.projects > div > img {
    width: 100%;
    height: auto;
    margin-bottom: 0.8em;
}
</style>