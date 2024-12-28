<script setup lang="ts">
import CreatePost from '@/Components/CreatePost.vue';
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
        <!-- Content -->
        <CreatePost />
    </AuthenticatedLayout>
</template>
