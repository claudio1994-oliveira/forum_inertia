<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    meta: Object,
})
</script>

<template>
    <nav class="relative flex justify-center items-center gap-0.5">

        <Link v-for="link in meta.links" :key="link.url" :href="link.url"
              class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg" v-html="link.label"
              :class="{'bg-gray-300': link.active}"/>

    </nav>

</template>

