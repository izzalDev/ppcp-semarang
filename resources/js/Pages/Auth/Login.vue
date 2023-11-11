<script setup>
import Auth from '../../Layouts/Auth.vue'
import {reactive, ref} from "vue";
import {router, usePage, Link, Head} from "@inertiajs/vue3";

defineOptions({layout: Auth});
defineProps({errors: Object})
const isPasswordHide = ref(true)

const form = reactive({
    email: null,
    password: null,
    remember: true,
    _token: usePage().props.csrf_token,
})

const handleSubmit = function () {
    router.post('/auth/login', form)
}

const handleTogglePassword = function () {
    isPasswordHide.value = !isPasswordHide.value;
}
</script>
<template>
    <Head title="Login"/>
    <div class="mb-3 text-center">
        <img src="/assets/images/logo-icon.png" width="60" alt=""/>
    </div>
    <div class="text-center mb-4">
        <h5 class="">PPCP Semarang</h5>
        <p class="mb-0">Please log in to your account</p>
    </div>
    <div v-if="$page.props.flash.message" class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
        <div class="text-white">{{ $page.props.flash.message }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div v-if="$page.props.flash.status" class="alert alert-success border-0 bg-success alert-dismissible fade show">
        <div class="text-white">{{ $page.props.flash.status }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="form-body">
        <form class="row g-3" @submit.prevent="handleSubmit">
            <div class="col-12">
                <label for="inputEmailAddress" class="form-label">Email</label>
                <input v-model="form.email" class="form-control" :class="{'is-invalid':errors.email}"
                       id="inputEmailAddress" placeholder="jhon@example.com">
                <div v-if="errors.email" class="invalid-feedback">
                    {{ errors.email }}
                </div>
            </div>
            <div class="col-12">
                <label for="inputChoosePassword" class="form-label">Password</label>
                <div class="input-group" :class="{'has-validation':errors.password}">
                    <input v-model="form.password" :type="isPasswordHide?'password':'text'" class="form-control"
                           :class="{'is-invalid':errors.password}" placeholder="Enter Password">
                    <span class="input-group-text" @click="handleTogglePassword"><i
                        :class="isPasswordHide?'bx bx-hide':'bx bx-show'"></i></span>
                    <div v-if="errors.password" class="invalid-feedback">
                        {{ errors.password }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input v-model="form.remember" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <Link href="/auth/forgot-password">Forgot Password ?</Link>
            </div>
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </div>
        </form>
    </div>
</template>
