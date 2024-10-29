<script setup>
import { ref } from 'vue';

const emit = defineEmits(['image']);

const preview = ref(null)
const overSizedImage = ref(false);

const selectImage = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    overSizedImage.value = e.target.files[0].size > 3145728;
    emit('image', e.target.files[0]);
}
</script>

<template>
    <div>
        <span :class="{ '!text-red-500': overSizedImage }"
            class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            {{ overSizedImage ? 'Image is too large' : 'Image (Max size 3MB)' }}
        </span>

        <label for="image"
            class="block rounded-md mt-1 bg-salate-300 h-[140px]  overflow-hidden cursor-pointer border-slate-300 border"
            :class="{ '!border-red-500 border': overSizedImage }">

            <img :src="preview ?? '/storage/images/listings/default.jpg'" alt="Image Preview"
                class="object-cover object-center w-full h-full" />
        </label>
        <input @input="selectImage" type="file" name="image" id="image" hidden />
    </div>
</template>
