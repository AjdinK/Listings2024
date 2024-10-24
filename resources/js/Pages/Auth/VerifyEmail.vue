<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import SessionMessages from "../../Componetns/SessionMessages.vue";
import Container from "../../Componetns/Container.vue";
import PrimaryBtn from "../../Componetns/PrimaryBtn.vue";

const form = useForm({});
const submit = () => {
    form.post(route("verification.send"));
};

defineProps({
    status: String,
});
</script>

<template>
    <Head title="- Email Verification" />

    <Container class="w-1/2">
        <div class="mb-8">
            <p>
                Thanks for signing up! Before getting started, could you verify
                your email address by clicking on the link we just emailed to
                you? If you didn't receive the email, we will gladly send you
                another.
            </p>
        </div>

        <SessionMessages :status="status" />

        <form @submit.prevent="submit">
            <PrimaryBtn :disabled="form.processing"
                >Resend Verification Email
            </PrimaryBtn>
        </form>
    </Container>
</template>

<style scoped></style>
