<script setup>
defineProps({
    paginator: Object,
});

const makeLabel = (label) => {
    if (label.includes("Previous")) {
        return "<<";
    } else if (label.includes("Next")) {
        return ">>";
    } else {
        return label;
    }
};
</script>

<template>
    <div class="flex justify-between items-start">
        <div class="flex items-center rounded-md overflow-hidden shadow-lg">
            <div v-for="(link, i) in paginator.links" :key="i">
                <component
                    :is="link.url ? 'Link' : 'span'"
                    :class="{
                        'hover:bg-slate-700': link.url,
                        'text-slate-400': !link.url,
                        'font-bold text-white dark:text-indigo-400':
                            link.active,
                    }"
                    :href="link.url"
                    class="border-x border-slate-50 w-12 h-12 grid place-items-center bg-white dark:bg-slate-900 dark:border-slate-700"
                    v-html="makeLabel(link.label)"
                />
            </div>
        </div>
        <p class="text-slate-600 dark:text-slate-200 text-sm">
            Showing {{ paginator.from }} to {{ paginator.to }} of
            {{ paginator.total }}
        </p>
    </div>
</template>

<style scoped></style>
