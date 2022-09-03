<script setup lang="ts">
import {defineProps} from "vue";
defineProps<{ menuTitle: string, menuTo: object }>()
</script>

<template>
    <li>
        <RouterLink :to="menuTo">
            {{ menuTitle }}
        </RouterLink>
    </li>
</template>