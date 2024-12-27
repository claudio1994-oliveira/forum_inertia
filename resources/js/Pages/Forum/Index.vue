<script setup>

import {Head, router} from '@inertiajs/vue3';
import ForumLayout from "@/Layouts/ForumLayout.vue";
import {usePage} from "@inertiajs/vue3";
import Select from "@/Components/Select.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import Pagination from "@/Components/Pagination.vue";
import Navgation from "@/Components/Forum/Navigation.vue";
import _omitBy from 'lodash.omitby'
import _isEmpty from 'lodash.isempty'
import useCreateDiscussion from "@/Components/Composables/useCreateDiscussion.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const {showCreateDiscussionForm} = useCreateDiscussion()
const page = usePage();
const topics = page.props.topics;

defineProps({
    discussions: Object,
    query: Object
})

const filterTopic = (e) => {
    router.visit('/', {
        data: _omitBy(
            {
                'filter[topic]': e.target.value
            }, _isEmpty
        ),
        preserveScroll: true
    })
}

</script>

<template>
    <Head title="Forum"/>

    <ForumLayout>
        <div class="sm:px-6 lg:px-8">

            <div class="space-y-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <div>
                            <InputLabel for="select" value="Select a topic" class="sr-only"/>
                            <Select
                                id="select"
                                v-on:change="filterTopic"

                            >
                                <option value="">All topics</option>
                                <option :value="topic.slug"
                                        v-for="topic in topics"
                                        :key="topic.id"
                                        :selected="query.filter?.topic === topic.slug"
                                >
                                    {{ topic.name }}
                                </option>
                            </Select>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <template v-if="discussions.data.length">
                        <Discussion v-for="discussion in discussions.data" :key="discussion.id"
                                    :discussion="discussion"/>
                        <Pagination :meta="discussions.meta"/>
                    </template>
                </div>
            </div>
        </div>
        <template #side>
            <PrimaryButton
                v-if="$page.props.auth.user"
                class="w-full flex justify-center h-10"
                v-on:click="showCreateDiscussionForm">Start A Discussion
            </PrimaryButton>

            <Navgation :query="query"/>
        </template>
    </ForumLayout>
</template>
