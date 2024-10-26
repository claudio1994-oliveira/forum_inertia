<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    post: Object
})
</script>

<template>
    <div
        class=" overflow-hidden bg-white shadow-sm sm:rounded-lg my-4 p-6 text-gray-900 flex items-start space-x-3">

        <div class="w-7 flex-shrink-0">
            <img :src="post.user.avatar_url" alt="avatar" class="rounded-full w-7 h-7">
        </div>
        <div class="w-full ">
            <div>
                <div>{{ post.user.username }}</div>
                <div class="text-sm text-gray-500">Posted {{ post.created_at.human }}</div>
            </div>
            <div class="mt-3">
                {{ post.body }}
            </div>

        </div>

    </div>
</template>

