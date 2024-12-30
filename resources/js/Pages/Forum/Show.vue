<script setup>

import {Head} from '@inertiajs/vue3';
import ForumLayout from "@/Layouts/ForumLayout.vue";
import {usePage} from "@inertiajs/vue3";
import Discussion from "@/Components/Forum/Discussion.vue";
import Pagination from "@/Components/Pagination.vue";
import Post from "@/Components/Forum/Post.vue";
import pluralize from 'pluralize';
import Navigation from "@/Components/Forum/Navigation.vue";

const page = usePage();
const topics = page.props.topics;

defineProps({
    discussion: Object,
    posts: Object,
    query: Object
})

</script>

<template>
    <Head :title="discussion.title"/>

    <ForumLayout>
        <div class="sm:px-6 lg:px-8">

            <div class="space-y-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between space-x-3">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600">{{
                                            discussion.topic.name
                                        }}</span>
                                    <h2 class="text-lg font-medium ">
                                        <div>
                                            <template v-if="discussion.is_pinned">
                                                [Pinned]
                                            </template>
                                            {{ discussion.title }}
                                        </div>


                                    </h2>
                                </div>

                                {{ pluralize('replies', discussion.replies_count, true) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <template v-if="posts.data.length">
                    <Post v-for="post in posts.data" :key="post.id" :post="post"/>
                    <Pagination :meta="posts.meta"/>
                </template>

            </div>

        </div>
        <template #side>
            <Navigation :query="query"/>
        </template>
    </ForumLayout>
</template>
