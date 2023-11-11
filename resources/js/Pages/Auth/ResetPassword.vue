<script setup>
import Auth from '../../Layouts/Auth.vue';
import {Head, Link, router, usePage} from "@inertiajs/vue3";
import {reactive} from "vue";

defineOptions({layout: Auth})
const props = defineProps({
    token: String,
    email: String,
    errors: Object,
})

const form = reactive({
    email: props.email,
    token: props.token,
    password: null,
    password_confirmation: null,
    _token: usePage().props.csrf_token,
})

const handleSubmit = function () {
    router.post('/auth/reset-password', form)
}
</script>
<template>
    <Head title="Reset Password"/>
    <div class="mb-4 text-center">
        <img src="/assets/images/logo-icon.png" width="60" alt=""/>
    </div>
    <div class="text-start mb-4">
        <h5 class="">Generate New Password</h5>
        <p class="mb-0">We received your reset password request. Please enter your new password!</p>
    </div>
    <div v-if="errors.email" class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
        <div class="text-white">{{ errors.email }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <form @submit.prevent="handleSubmit">
        <div class="mb-3 mt-4">
            <label class="form-label">New Password</label>
            <input v-model="form.password" type="password" class="form-control" :class="{'is-invalid':errors.password}"
                   placeholder="Enter new password"/>
            <div v-if="errors.password" class="invalid-feedback">
                {{ errors.password }}
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input v-model="form.password_confirmation" type="password" class="form-control"
                   :class="{'is-invalid':errors.password_confirmation}" placeholder="Confirm password"/>
            <div v-if="errors.password_confirmation" class="invalid-feedback">
                {{ errors.password_confirmation }}
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Change Password</button>
            <Link href="/auth/login" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</Link>
        </div>
    </form>
</template>
