<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import TextArea from "../../Components/TextArea.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ImageUpload from "../../Components/ImageUpload.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";

const props = defineProps({
    listing: Object
});

const form = useForm({
    title: props.listing.title,
    description: props.listing.description,
    email: props.listing.email,
    tags: props.listing.tags,
    link: props.listing.link,
    image: null,
});

const submit = () => {
    form.post(route('listing.store'));
}

</script>

<template>

    <Head title=" - Edit Listing" />
    <Container>
        <div class="mb-6">
            <Title>Edit Your Listing</Title>
        </div>
        <ErrorMessages :errors="form.errors" />

        <form @submit.prevent='submit' class="grid grid-cols-2 gap-6">

            <div class='space-y-6'>
                <InputField label="Title" icon="heading" placeholder="Enter Listing Title" v-model="form.title" />
                <InputField label="Tags (seperate with comma)" icon="tags" placeholder="one,two,three"
                    v-model="form.tags" />
                <TextArea label="Description" icon="newspaper" placeholder="Enter Description"
                    v-model="form.description" />
                <PrimaryBtn :disabled='form.processing'>Update</PrimaryBtn>
            </div>

            <div class='space-y-6'>
                <InputField label=" Email" icon="at" placeholder="Enter Your Email" v-model="form.email" />
                <InputField label="External Link" icon="up-right-from-square" placeholder="https://"
                    v-model="form.link" />

                <ImageUpload @image="(e) => form.image = e" :listingImage='listing.image' />
            </div>
        </form>
    </Container>
</template>

<style scoped></style>
