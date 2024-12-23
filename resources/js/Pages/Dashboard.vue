<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const requestFriend = (to: number) => {
    router.post(route('friends.store'), { to });
};

defineProps<{
    potentialFriends: Array<{ id: number; name: string }>;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <ul
                    role="list"
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <li
                        v-for="friend in potentialFriends"
                        :key="friend.id"
                        class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow"
                    >
                        <div
                            class="flex w-full items-center justify-between space-x-6 p-6"
                        >
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3
                                        class="truncate text-sm font-medium text-gray-900"
                                    >
                                        {{ friend.name }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="flex w-0 flex-1">
                                    <button
                                        @click="requestFriend(friend.id)"
                                        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-indigo-600 hover:text-indigo-800"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-5 text-indigo-600"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15"
                                            />
                                        </svg>
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
