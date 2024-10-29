<script setup>

import {router} from "@inertiajs/vue3";

const params = route().params;

defineProps({
  listing: Object,
});

const selectUser = (id) => {
  router.get(route('home'), {
    user_id: id,
    search: params.search,
    tag: params.tag,
  });
}

const selectTag = (tag) => {
  router.get(route('home'), {
    search: params.search,
    user_id: params.user_id,
    tag: tag,
  })
}

</script>

<template>
  <div class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between">
    <div>
      <!--Image-->
      <Link href="">
        <img :src="listing.image
                ? `/storage/${listing.image}`
                : 'storage/images/listings/default.jpg'
                " alt="default image" class="w-full h-48 bg-blue-200 object-cover object-center"/>
      </Link>

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
          <button class="text-link" @click="selectUser(listing.user.id)">{{ listing.user.name }}</button>
        </p>
      </div>
    </div>

    <!--Tags-->
    <div v-if="listing.tags" class="flex items-center gap-3 px-4 py-4">
      <div v-for="tag in listing.tags.split(',')" :key="tag">
        <button
            class="bg-slate-600 text-white text-sm transition-colors duration-300 px-3 py-1 rounded-full hover:bg-slate-700 dark:hover:bg-slate-850"
            @click="selectTag(tag)">
          {{ tag }}
        </button>
      </div>
    </div>
  </div>

</template>

<style scoped></style>
