<script setup>
import { switchTheme } from "../theme.js";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import NavLink from "../Components/NavLink.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
const show = ref(false);
</script>

<template>
    <!--overlay-->
    <div v-show="show" class="fixed inset-0 z-40" @click="show = false"></div>

    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            <NavLink componentName="Home" routeName="home">Home</NavLink>

            <div class="flex gap-4 items-center">
                <!--Auth-->
                <div v-if="user" class="relative">
                    <div :class="{ 'bg-slate-700': show }"
                        class="flex items-center gap-2 px-3 py-3 rounded-lg hover:bg-slate-700 cursor-pointer"
                        @click="show = !show">
                        <p>{{ user.name }}</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <!--user drop down menu-->

                    <div v-show="show"
                        class="absolute z-50 top-16 right-0 bg-slate-800 text-white rounded-lg p-4 border-slate-500 overflow-hidden w-40"
                        @click="show = false">
                        <Link :href="route('profile.edit')"
                            class="block w-full rounded-lg px-3 py-4 hover:bg-slate-700 text-left">Profile
                        </Link>

                        <Link :href="route('dashboard')"
                            class="block w-full rounded-lg px-3 py-4 hover:bg-slate-700 text-left">Dashboard
                        </Link>

                        <Link :href="route('logout')" as="button"
                            class="block w-full rounded-lg px-3 py-4 hover:bg-slate-700 text-left" method="post">Logout
                        </Link>
                    </div>
                </div>

                <!--Guest -->
                <div v-else class="space-x-6">
                    <NavLink componentName="Auth/Login" routeName="login">Login
                    </NavLink>
                    <NavLink componentName="Auth/Register" routeName="register">Register
                    </NavLink>
                </div>

                <button
                    class="hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white"
                    @click="switchTheme()">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>
        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
