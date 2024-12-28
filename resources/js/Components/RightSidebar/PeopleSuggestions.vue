<script setup lang="ts">
import SuggestedUser from './SuggestedUser.vue';

// Mock data - in a real app, this would come from props or a store
const potentialFriends = [
    {
        id: 1,
        name: 'Melissa Lavala',
        bio: 'Software Engineer',
        profile_picture:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&h=200',
    },
    {
        id: 2,
        name: 'Peter Kilman',
        bio: 'Product Designer',
        profile_picture:
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&h=200',
    },
    {
        id: 3,
        name: 'Panama Lavala',
        bio: 'Marketing Manager',
        profile_picture:
            'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=200&h=200',
    },
];

const handleConnect = (id: number) => {
    console.log('Connecting with user:', id);
    // Handle connection logic here
};
</script>

<template>
    <aside class="rounded-lg bg-white p-6 shadow">
        <h3 class="text-lg font-medium text-gray-800">People you may know</h3>
        <ul class="mt-4 space-y-4">
            <SuggestedUser
                v-for="friend in potentialFriends"
                :key="friend.id"
                :user="friend"
                @connect="handleConnect"
            />
        </ul>
    </aside>
</template>
