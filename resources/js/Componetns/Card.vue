<script setup>
import TextLink from "./TextLink.vue";

defineProps({
    listing: Object,
});
</script>

<template>
    <div
        class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between"
    >
        <div>
            <!--Image-->
            <div class="w-full h-48 bg-blue-300"></div>

            <!--Title & User Info -->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">
                    {{ listing.title.substring(0, 15) }}...
                </h3>
                <p>
                    Listed on
                    {{ new Date(listing.created_at).toLocaleDateString() }}
                    by
                    <!--Todo:change the routeName to listing by user-->
                    <TextLink :label="listing.user.name" :routeName="'home'" />
                </p>
            </div>
        </div>

        <!--Tags-->
        <div v-if="listing.tags" class="flex items-center gap-3 px-4 py-4">
            <div v-for="tag in listing.tags.split(',')" :key="tag">
                <button
                    class="bg-slate-600 text-white text-sm transition-colors duration-300 px-3 py-1 rounded-full hover:bg-slate-700 dark:hover:bg-slate-850"
                >
                    {{ tag }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
