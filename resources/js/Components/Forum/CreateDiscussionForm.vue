<script setup>

import FixedFormWrapper from "@/Components/Forum/FixedFormWrapper.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useCreateDiscussion from "@/Components/Composables/useCreateDiscussion.js";

const {visible, hideCreateDiscussionForm, form} = useCreateDiscussion()

const createDiscussion = () => {
    form.post(route('discussion.store'), {
        onSuccess: () => {
            form.reset()
            hideCreateDiscussionForm()
        }
    })
}

</script>

<template>
    <FixedFormWrapper v-if="visible" v-on:submit.prevent="createDiscussion" :form="form">
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-medium">New Discussion</h1>
                <button v-on:click="hideCreateDiscussionForm">&times;</button>
            </div>

        </template>
        <template v-slot:main="{markdownPreviewEnabled}">
            <div class="flex items-start space-x-3">
                <div class="flex-grow">
                    <div>
                        <InputLabel for="titel" value="Title" class="sr-only"/>

                        <TextInput
                            id="title"
                            type="text"
                            class="w-full"
                            placeholder="Discussion title"
                            v-model="form.title"
                        />
                        <InputError class="mt-2" :message="form.errors.title"/>
                    </div>
                </div>

                <div>
                    <InputLabel for="topic" value="Topic" class="sr-only"/>
                    <select id="topic" v-model="form.topic_id"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Choose a topic</option>
                        <option
                            :value="topic.id"
                            v-for="topic in $page.props.topics"
                            :key="topic.id"
                        >
                            {{ topic.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.topic_id"/>
                </div>

            </div>
            <div class="mt-4">

                <InputLabel for="body" value="Body" class="sr-only"/>
                <TextArea id="body" v-if="!markdownPreviewEnabled" v-model="form.body" class="w-full h-48 align-top"/>
                <InputError class="mt-2" :message="form.errors.body"/>
            </div>
        </template>
        <template v-slot:button>
            <PrimaryButton>
                Create discussion
            </PrimaryButton>
        </template>
    </FixedFormWrapper>
</template>

