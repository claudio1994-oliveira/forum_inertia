<script setup>

import {Head} from '@inertiajs/vue3';
import ForumLayout from "@/Layouts/ForumLayout.vue";
import {usePage} from "@inertiajs/vue3";
import Select from "@/Components/Select.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import Pagination from "@/Components/Pagination.vue";
import Navgation from "@/Components/Forum/Navigation.vue";

const page = usePage();
const topics = page.props.topics;

defineProps({
    discussions: Object,
    query: Object
})

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
                            <Select id="select">
                                <option value="">All topics</option>
                                <option :value="topic.slug" v-for="topic in topics" :key="topic.id">
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
          <Navgation :query="query" />
        </template>
    </ForumLayout>
</template>
