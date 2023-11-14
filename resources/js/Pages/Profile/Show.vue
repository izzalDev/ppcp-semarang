<script setup>
import App from "../../Layouts/App.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import LogoutOtherBrowserSessionForm from "./Partials/LogoutOtherBrowserSessionForm.vue";
import {router,Head} from "@inertiajs/vue3";
import {capWord} from "../../composable/capitalize.js";

defineOptions({layout: App})
const props = defineProps({
    sessions: Array,
    auth: Object,
})

const changePhoto = (e) => {
    router.post(route('photo-profile.post'), {
        _method: 'put',
        image: e.target.files[0],
    })
}
console.log(props.auth)
</script>
<template>
    <Head title="Profile"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img v-if="props.auth.user.image" :src="props.auth.user.image" alt="Admin"
                                     class="rounded-circle bg-light" width="110" height="110">
                                <img v-else
                                     :src="encodeURI('https://ui-avatars.com/api/?name='+props.auth.user.name+'&background=random')"
                                     alt="Admin"
                                     class="rounded-circle" width="110" height="110">
                                <div class="mt-3">
                                    <h4>{{ props.auth.user.name }}</h4>
                                    <p class="text-secondary mb-1">{{ capWord(props.auth.user.role[0]) }}</p>
                                    <p class="text-muted font-size-sm">{{ props.auth.user.email }}</p>
                                    <input type="file" @change="changePhoto" accept="image/*" ref="image" hidden>
                                    <button class="btn btn-outline-primary" @click="$refs.image.click">Change Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <update-profile-information-form :user="$page.props.auth.user" :errors="$page.props.errors"/>
                    <update-password-form :errors="$page.props.errors"/>
                    <logout-other-browser-session-form :sessions="sessions"/>
                </div>
            </div>
        </div>
    </div>
</template>
