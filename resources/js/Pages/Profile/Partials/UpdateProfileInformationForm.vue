<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {reactive} from "vue";

const props = defineProps({
    user:Object,
    errors:Object,
})
const form = reactive({
    name: props.user.name,
    email: props.user.email,
    _token: usePage().props.csrf_token,
});

const updateProfileInformation = ()=>{
    router.put(route('profile-information.update'),form,{
        preserveScroll:true
    })
};
</script>
<template>
    <div class="card">
        <div class="card-body p-4">
            <div v-if="$page.props.session.email||$page.props.session.verified" class="alert alert-success border-0 bg-success alert-dismissible fade show">
                <div class="text-white">{{ $page.props.session.email }}</div>
                <div v-if="$page.props.session.verified" class="text-white">Your email has been changed</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <h5 class="mb-0">Profile Information</h5>
            <p class="mb-3 text-secondary">Update your account's profile information and email address</p>
            <form @submit.prevent="updateProfileInformation">
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':props.errors.name}">
                    <div class="invalid-feedback">{{props.errors.name}}</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.email" type="text" class="form-control" :class="{'is-invalid':props.errors.email}">
                    <div class="invalid-feedback">
                        {{props.errors.email}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</template>

