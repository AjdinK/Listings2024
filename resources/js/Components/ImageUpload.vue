<script setup>
import { ref } from 'vue'

const props = defineProps({
    listingImage: String,
})

const currentImage = props.listingImage
    ? `/storage/${props.listingImage}`
    : null

const emit = defineEmits(['image'])
const preview = ref(currentImage)
const overSizedImage = ref(false)
const showRevertBtn = ref(false)

const selectImage = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0])
    overSizedImage.value = e.target.files[0].size > 3145728
    showRevertBtn.value = true
    emit('image', e.target.files[0])
}

const revertImage = () => {
    showRevertBtn.value = false
    preview.value = currentImage
    overSizedImage.value = false
}
</script>

<template>
    <div>
        <span
            :class="{ '!text-red-500': overSizedImage }"
            class="block text-sm font-medium text-slate-700 dark:text-slate-300"
        >
            {{ overSizedImage ? 'Image is too large' : 'Image (Max size 3MB)' }}
        </span>

        <label
            for="image"
            class="relative block rounded-md mt-1 bg-salate-300 h-[140px] overflow-hidden cursor-pointer border-slate-300 border"
            :class="{ '!border-red-500 border': overSizedImage }"
        >
            <img
                :src="preview ?? '/storage/images/listings/default.jpg'"
                alt="Image Preview"
                class="object-cover object-center w-full h-full"
            />

            <button
                class="absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full grid place-items-center text-slate-700"
                v-if="showRevertBtn"
                type="button"
                @click.prevent="revertImage()"
            >
                <i class="fa-solid fa-rotate-left"></i>
            </button>
        </label>
        <input
            @input="selectImage"
            type="file"
            name="image"
            id="image"
            hidden
        />
    </div>
</template>
