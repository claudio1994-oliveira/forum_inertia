<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    post: Object
})
</script>

<template>
    <div
        class="flex items-start p-6 my-4 space-x-3 overflow-hidden text-gray-900 bg-white shadow-sm sm:rounded-lg">

        <div class="flex-shrink-0 w-7">
            <img :src="post.user?.avatar_url" alt="avatar" class="rounded-full w-7 h-7" v-if="post.user">
        </div>
        <div class="w-full">
            <div>
                <div>{{ post.user?.username || '[user deleted]' }}</div>
                <div class="text-sm text-gray-500">Posted {{ post.created_at.human }}</div>
            </div>
            <div class="mt-3">
                <div v-html="post.body_markdown" class="markdown"></div>
            </div>

        </div>

    </div>
</template>

