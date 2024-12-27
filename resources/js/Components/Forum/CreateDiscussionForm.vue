<script setup>

import FixedFormWrapper from "@/Components/Forum/FixedFormWrapper.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Select from "@/Components/Select.vue";
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import useCreateDiscussion from "@/Components/Composables/useCreateDiscussion.js";

const {visible, hideCreateDiscussionForm} = useCreateDiscussion()
</script>

<template>
  <FixedFormWrapper v-if="visible">
    <template v-slot:header>
      <div class="flex items-center justify-between">
        <h1 class="text-lg font-medium">New Discussion</h1>
        <button v-on:click="hideCreateDiscussionForm">&times;</button>
      </div>

    </template>
    <template v-slot:main>
      <div class="flex items-start space-x-3">
        <div class="flex-grow">
          <div>
            <InputLabel for="titel" value="Title" class="sr-only"/>

            <TextInput
                id="title"
                type="text"
                class="w-full"
            />
            <!--            <InputError class="mt-2" :message="form.errors.title"/>-->
          </div>
        </div>


        <div>
          <InputLabel for="select" value="Select a topic" class="sr-only"/>
          <Select id="select">
            <option value="">Choose a topic</option>
            <option :value="topic.slug"
                    v-for="topic in topics"
                    :key="topic.id"
            >
              {{ topic.name }}
            </option>
          </Select>
        </div>

      </div>
      <div class="mt-4">
        <TextArea class="w-full" rows="6"/>
      </div>
    </template>
    <template v-slot:button>
      <PrimaryButton>
        Create discussion
      </PrimaryButton>
    </template>
  </FixedFormWrapper>
</template>

