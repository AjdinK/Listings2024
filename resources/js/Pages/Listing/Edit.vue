<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import Container from '../../Components/Container.vue'
import Title from '../../Components/Title.vue'
import InputField from '../../Components/InputField.vue'
import TextArea from '../../Components/TextArea.vue'
import PrimaryBtn from '../../Components/PrimaryBtn.vue'
import ImageUpload from '../../Components/ImageUpload.vue'
import ErrorMessages from '../../Components/ErrorMessages.vue'

const props = defineProps({
    listing: Object,
})

const form = useForm({
    title: props.listing.title,
    description: props.listing.description,
    email: props.listing.email,
    tags: props.listing.tags,
    link: props.listing.link,
    image: null,
    _method: 'PUT',
})
</script>

<template>
    <Head title=" - Edit Listing" />
    <Container>
        <div class="mb-6">
            <Title>Edit Your Listing</Title>
        </div>
        <ErrorMessages :errors="form.errors" />

        <form
            class="grid grid-cols-2 gap-6"
            @submit.prevent="form.post(route('listing.update', listing.id))"
        >
            <div class="space-y-6">
                <InputField
                    v-model="form.title"
                    icon="heading"
                    label="Title"
                    placeholder="Enter Listing Title"
                />
                <InputField
                    v-model="form.tags"
                    icon="tags"
                    label="Tags (separate with comma)"
                    placeholder="one,two,three"
                />
                <TextArea
                    v-model="form.description"
                    icon="newspaper"
                    label="Description"
                    placeholder="Enter Description"
                />
                <PrimaryBtn :disabled="form.processing">Update</PrimaryBtn>
            </div>

            <div class="space-y-6">
                <InputField
                    v-model="form.email"
                    icon="at"
                    label=" Email"
                    placeholder="Enter Your Email"
                />
                <InputField
                    v-model="form.link"
                    icon="up-right-from-square"
                    label="External Link"
                    placeholder="https://"
                />

                <ImageUpload
                    :listingImage="listing.image"
                    @image="(e) => (form.image = e)"
                />
            </div>
        </form>
    </Container>
</template>

<style scoped></style>
