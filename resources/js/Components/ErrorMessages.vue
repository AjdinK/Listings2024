<script setup>
defineProps({
    errors: Object,
});
</script>

<template>
    <div v-if="Object.keys(errors).length" class="mb-4">
        <p class="text-red-500 font-bold text-sm">Something went wrong!</p>
        <ul class="ml-4 list-disc list-inside">
            <li
                v-for="(error, i) in errors"
                :key="i"
                class="text-sm text-red-500 font-bold"
            >
                {{ error }}
            </li>
        </ul>
    </div>
</template>

<style scoped></style>
