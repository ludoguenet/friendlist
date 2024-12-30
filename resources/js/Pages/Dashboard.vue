<script setup lang="ts">
import CreatePost from '@/Components/CreatePost.vue';
import FeedList from '@/Components/FeedList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { User } from '@/types';
import { Head } from '@inertiajs/vue3';

// const requestFriend = (friend: number) => {
//     router.post(route('friends.request', { friend }));
// };

defineProps<{
    potentialFriends: Array<User>;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <CreatePost />

        <FeedList />
    </AuthenticatedLayout>
</template>
