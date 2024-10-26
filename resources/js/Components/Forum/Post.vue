<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    post: Object
})
</script>

<template>
    <div
        class="block overflow-hidden bg-white shadow-sm sm:rounded-lg my-4">
        <div class="p-6 text-gray-900 flex items-center space-x-6">
            {{ post.body }}
        </div>
    </div>
</template>

