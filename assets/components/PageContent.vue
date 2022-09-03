<script setup lang="ts">
import { defineProps, toRefs, ref } from "vue";
import { useGetRequest } from "@/use/useFetchRequest";

const props = defineProps<{ url: string }>()
const { url } = toRefs(props);

const data = ref()
const error = ref()
const isLoading = ref(true)

useGetRequest(url, url).then((result) => {
    data.value = result
}).catch((err) => {
    error.value = err
}).finally(() => {
    isLoading.value = false
})

</script>

<template>
    <div v-if="isLoading">Loading...</div>
    <div v-else-if="error">
        Error: {{ error.message }}
    </div>
    <div v-else-if="data">
        <h1>{{ data.title }}</h1>
        <div v-html="data.content"></div>
    </div>
</template>