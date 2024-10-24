<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Container from "../../Componetns/Container.vue";
import ErrorMessages from "../../Componetns/ErrorMessages.vue";
import InputField from "../../Componetns/InputField.vue";
import PrimaryBtn from "../../Componetns/PrimaryBtn.vue";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
<template>
    <Head title="- Reset Password" />

    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Enter Your New Password</Title>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField
                v-model="form.email"
                icon="at"
                label="Email"
                type="email"
            />
            <InputField
                v-model="form.password"
                icon="key"
                label="Password"
                type="password"
            />
            <InputField
                v-model="form.password_confirmation"
                icon="key"
                label="Confirm Password"
                type="password"
            />

            <div class="flex justify-end">
                <PrimaryBtn :disabled="form.processing"
                    >Reset Password
                </PrimaryBtn>
            </div>
        </form>
    </Container>
</template>
