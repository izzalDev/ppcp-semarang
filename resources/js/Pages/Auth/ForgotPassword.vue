<script setup>
import Auth from '../../Layouts/Auth.vue';
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import {reactive} from "vue";

defineOptions({layout: Auth});
defineProps({errors: Object});

const form = reactive({
    email: null,
    _token: usePage().props.csrf_token,
})

const handelSubmit = function () {
    router.post('/auth/forgot-password', form)
}
</script>
<template>
    <Head title="Forgot Password"/>

    <div class="text-center mb-5">
        <img src="/assets/images/icons/forgot-2.png" width="100" alt=""/>
    </div>
    <div v-if="$page.props.flash.message" class="alert alert-success border-0 bg-success alert-dismissible fade show">
        <div class="text-white">{{ $page.props.flash.message }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div v-if="errors.error" class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
        <div class="text-white">{{ errors.error }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h4 class="font-weight-bold">Forgot Password?</h4>
    <p>Enter your registered email ID to reset the password</p>
    <form @submit.prevent="handelSubmit">
        <div class="my-4">
            <label class="form-label">Email id</label>
            <input v-model="form.email" type="text" class="form-control" :class="{'is-invalid':errors.email}"
                   placeholder="example@user.com"/>
            <div v-if="errors.email" class="invalid-feedback">
                {{ errors.email }}
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Send</button>
            <Link href="/auth/login" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to Login</Link>
        </div>
    </form>
</template>
