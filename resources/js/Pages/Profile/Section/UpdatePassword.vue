<script setup>
import Container from "../../../Componetns/Container.vue";
import InputField from "../../../Componetns/InputField.vue";
import PrimaryBtn from "../../../Componetns/PrimaryBtn.vue";
import { useForm } from "@inertiajs/vue3";
import ErrorMessages from "../../../Componetns/ErrorMessages.vue";
import Title from "../../../Componetns/Title.vue";

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.put(route("profile.password"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
    });
};
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Update Password</Title>
            <p>
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form class="space-y-6" @submit.prevent="submit">
            <InputField
                v-model="form.current_password"
                class="w-1/2"
                icon="key"
                label="Current Password"
                type="password"
            />
            <InputField
                v-model="form.password"
                class="w-1/2"
                icon="key"
                label="New Password"
                type="password"
            />
            <InputField
                v-model="form.password_confirmation"
                class="w-1/2"
                icon="key"
                label="Password Confirmation"
                type="password"
            />

            <p
                v-if="form.recentlySuccessful"
                class="text-green-500 font-bold text-sm"
            >
                Password Saved!
            </p>
            <PrimaryBtn :disabled="form.processing">Save</PrimaryBtn>
        </form>
    </Container>
</template>

<style scoped></style>
