<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import Card from "../Components/Card.vue";
import PaginationLinks from "../Components/PaginationLinks.vue";
import InputField from "../Components/InputField.vue";

const params = route().params;

const props = defineProps({
    listings: Object,
    searchTerm: String,
});

const username = params.user_id
    ? props.listings.data.find(
          (user) => user.user_id === Number(params.user_id)
      ).user.name
    : null;

const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    router.get(route("home"), {
        search: form.search,
        user_id: params.user_id,
        tag: params.tag,
    });
};
</script>

<template>
    <Head title=" - Latest Listings" />

    <!--reset links-->
    <div class="flex items-center justify-between space-x-6 mb-4">
        <div class="flex items-center space-x-2 gap-2">
            <!--reset tag-->
            <Link
                v-if="params.tag"
                :href="
                    route('home', {
                        ...params,
                        page: null,
                        tag: null,
                    })
                "
                class="px-2 py-2 font-bold text-sm rounded-md bg-black/80 dark:bg-black/20 text-white flex items-center gap-2"
            >
                {{ params.tag }}
                <i class="fa-solid fa-xmark"></i>
            </Link>

            <!--reset search-->
            <Link
                v-if="params.search"
                :href="
                    route('home', {
                        ...params,
                        page: null,
                        search: null,
                    })
                "
                class="px-2 py-2 font-bold text-sm rounded-md bg-black/80 dark:bg-black/20 text-white flex items-center gap-2"
            >
                {{ params.search }}
                <i class="fa-solid fa-xmark"></i>
            </Link>

            <!--reset user_id-->
            <Link
                v-if="params.user_id"
                :href="
                    route('home', {
                        ...params,
                        page: null,
                        user_id: null,
                    })
                "
                class="px-2 py-2 font-bold text-sm rounded-md bg-black/80 dark:bg-black/20 text-white flex items-center gap-2"
            >
                {{ username }}
                <i class="fa-solid fa-xmark"></i>
            </Link>
        </div>

        <div class="w-1/4 mb-4">
            <form @submit.prevent="search">
                <InputField
                    v-model="form.search"
                    icon="magnifying-glass"
                    label=""
                    placeholder="Search..."
                    type="search"
                />
            </form>
        </div>
    </div>

    <div v-if="Object.keys(props.listings.data).length">
        <div class="grid grid-cols-3 gap-4">
            <div v-for="listing in props.listings.data" :key="listing.id">
                <Card :listing="listing" />
            </div>
        </div>

        <div class="mt-8">
            <PaginationLinks :paginator="listings" />
        </div>
    </div>

    <div v-else>
        <p>No listings found</p>
    </div>
</template>
