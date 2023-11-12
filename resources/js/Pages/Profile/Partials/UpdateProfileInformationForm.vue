<template>
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-0">Profile Information</h5>
            <p class="mb-3 text-secondary">Update your account's profile information and email address</p>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.name" type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.email" type="text" class="form-control" :class="{'is-valid':$page.props.session.email}">
                    <div v-if="$page.props.session.email" class="valid-feedback">
                        {{ $page.props.session.email }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="d-flex justify-content-end">
                    <input @click="updateProfileInformation" type="button" class="btn btn-primary px-4" value="Save">
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {router, useForm, usePage} from "@inertiajs/vue3";
import {reactive} from "vue";

const props = defineProps({user:Object})
const form = reactive({
    name: props.user.name,
    email: props.user.email,
    _token: usePage().props.csrf_token,
});

const updateProfileInformation = ()=>{
    router.put(route('profile-information.update'),form)
};
</script>
