<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    discussion: Object,

})
</script>

<template>
    <Link :href="route('discussion.show', discussion.slug)"
          class="block overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="flex items-center p-6 space-x-6 text-gray-900">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600">{{
                            discussion.topic.name
                        }}</span>
                    <h2 class="text-lg font-medium">
                        <template v-if="discussion.is_pinned">
                            [Pinned]
                        </template>
                        {{ discussion.title }}

                    </h2>
                </div>
                <div class="mt-3 text-sm text-gray-500 line-clamp-1">
                    {{ discussion.post.body_preview }}
                </div>
            </div>
            <div>
                Avatars
            </div>
        </div>
    </Link>

</template>

<style scoped>

</style>
