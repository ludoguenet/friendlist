<script setup lang="ts">
import { FileAttachment } from '@/types';
import { PaperClipIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';

const attachments = ref<FileAttachment[]>([]);
const fileInput = ref<HTMLInputElement | null>(null);

const handleFileSelect = (event: Event) => {
    const input = event.target as HTMLInputElement;

    if (! input.files?.length) return;

    Array.from(input.files).forEach(file => attachments.value.push(file))

    emit('attach', attachments.value);

    input.value = '';
};

const emit = defineEmits<{
    attach: [files: FileAttachment[]];
}>();

const removeAttachment = (index: number) => {
    attachments.value.splice(index, 1);
};

const openFileDialog = () => {
    fileInput.value?.click();
};
</script>

<template>
    <div class="relative flex">

        <input
            ref="fileInput"
            type="file"
            multiple
            class="hidden"
            @change="handleFileSelect"
            accept="*/*"
        />

        <button
            @click="openFileDialog"
            class="text-gray-400 transition-colors hover:text-gray-600"
            title="Add attachments"
        >
            <PaperClipIcon class="h-5 w-5" />
        </button>

        <!-- Attachments Preview -->
        <div
            v-if="attachments.length"
            class="absolute top-10 z-10 mt-2 rounded-lg border border-gray-100 bg-white p-3 shadow-lg"
        >
            <div class="mb-2 text-xs font-medium text-gray-500 z-50">
                Pièce{{  attachments.length > 1 ? 's': '' }} jointe{{  attachments.length > 1 ? 's': '' }} ({{ attachments.length }})
            </div>
            <div class="space-y-2">
                <div
                    v-for="(file, index) in attachments"
                    :key="index"
                    class="flex items-center justify-between rounded-md bg-gray-50 px-3 py-2 text-sm hover:bg-gray-100"
                >
                    <div class="flex items-center space-x-2 truncate">
                        <PaperClipIcon class="h-4 w-4 flex-shrink-0 text-gray-400" />
                        <span class="truncate">{{ file.name }}</span>
                    </div>
                    <button
                        @click="removeAttachment(index)"
                        class="ml-2 flex-shrink-0 text-gray-400 hover:text-red-500"
                    >
                        <span class="sr-only">Remove</span>
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
