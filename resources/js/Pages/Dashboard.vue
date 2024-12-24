<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { User } from '@/types';
import { Head, router } from '@inertiajs/vue3';

const requestFriend = (to: number) => {
    router.post(route('friends.requestFriends'), { to });
};

defineProps<{
    potentialFriends: Array<User>;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Header -->
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Sockitx
                </h2>
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-500 hover:text-gray-900">
                        <span class="sr-only">Home</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 10h11M9 21v-6a4 4 0 100-8h-1a4 4 0 00-4 4v10z"
                            />
                        </svg>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-gray-900">
                        <span class="sr-only">Notifications</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v.341C6.67 5.165 6 7.388 6 10v4c0 .828-.334 1.578-.895 2.105L4 17h5m5 0v2a2 2 0 11-4 0v-2m4 0H9"
                            />
                        </svg>
                    </button>
                    <button class="p-2 text-gray-500 hover:text-gray-900">
                        <span class="sr-only">Messages</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 8h10M7 12h8m-5 8l3.396-2.547A2 2 0 0016 14.528V5.47a2 2 0 00-.604-1.44L12 2m0 16H9m3 0H7"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </template>

        <!-- Content -->
        <div class="py-8">
            <div class="mx-auto grid max-w-7xl grid-cols-12 gap-6">
                <!-- Main Feed -->
                <main class="col-span-6 rounded-lg bg-white p-6 shadow">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            Write something...
                        </h3>
                        <div class="mt-4 flex">
                            <button
                                class="flex-1 rounded-l-lg border px-4 py-2 text-gray-600"
                            >
                                Photo
                            </button>
                            <button
                                class="flex-1 border-b border-t px-4 py-2 text-gray-600"
                            >
                                Video
                            </button>
                            <button
                                class="flex-1 border-b border-t px-4 py-2 text-gray-600"
                            >
                                Event
                            </button>
                            <button
                                class="flex-1 rounded-r-lg border px-4 py-2 text-gray-600"
                            >
                                Location
                            </button>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="mb-4 border-b pb-4">
                            <div class="flex items-center">
                                <img
                                    src="/default-avatar.png"
                                    alt="Prely Kilman"
                                    class="mr-4 h-10 w-10 rounded-full"
                                />
                                <div>
                                    <h4 class="font-semibold text-gray-800">
                                        Prely Kilman
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        2 hours ago
                                    </p>
                                </div>
                            </div>
                            <img
                                src="/post-image.png"
                                alt="Post"
                                class="mt-4 w-full rounded-lg"
                            />
                            <div class="mt-4 flex justify-between">
                                <button
                                    class="text-gray-600 hover:text-sky-500"
                                >
                                    Like
                                </button>
                                <button
                                    class="text-gray-600 hover:text-sky-500"
                                >
                                    Comment
                                </button>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- Suggestions -->
                <aside class="col-span-3 rounded-lg bg-white p-6 shadow">
                    <h3 class="text-lg font-medium text-gray-800">
                        People you may know
                    </h3>
                    <ul class="mt-4 space-y-4">
                        <li
                            v-for="friend in potentialFriends"
                            :key="friend.id"
                            class="flex items-center justify-between"
                        >
                            <div class="flex items-center gap-4">
                                <img
                                    :src="
                                        friend.profile_picture ||
                                        '/default-avatar.png'
                                    "
                                    alt=""
                                    class="h-10 w-10 rounded-full"
                                />
                                <div>
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ friend.name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ friend.bio || 'No bio available' }}
                                    </p>
                                </div>
                            </div>
                            <button
                                @click.prevent="requestFriend(friend.id)"
                                class="rounded-md bg-sky-500 px-3 py-1.5 text-sm font-semibold text-white hover:bg-sky-600"
                            >
                                Connect
                            </button>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
