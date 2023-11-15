<script setup>
import App from "../../Layouts/App.vue";
import {Head, router, useForm, usePage, Link} from "@inertiajs/vue3";
import swal from "sweetalert";
const {errors,user}=defineProps({errors:Object,user:Object})
defineOptions({layout: App});
const form = useForm({
    name:user.name,
    email:user.email,
})
const submit = ()=>{
    form.put(`/user/${user.id}`,{
        onSuccess:()=>{
            swal({
                icon: "success",
                title: "Success!",
                text: usePage().props.session.message,
            });
        }
    })
}
// console.log($session);
</script>
<template>
    <Head title="Edit User"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit User</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">User Management</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <div class="d-flex">
                    <h5 class="mb-2">Edit User</h5>
                    <Link replace class="btn btn-primary px-4 ms-auto" href="/user"><i class="bx bx-arrow-back"/>Back</Link>
                </div>
                <div class="text-center mb-5">
                    <img :src="`https://ui-avatars.com/api/?name=${form.name}&background=random`" alt="Admin" class="rounded-circle" width="200" height="200">
                </div>
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Name</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.name"  type="text" class="form-control" :class="{'is-invalid':errors.name}">
                            <div class="invalid-feedback">{{errors.name}}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.email" type="text" class="form-control" :class="{'is-invalid':errors.email}">
                            <div class="invalid-feedback">{{errors.email}}</div>
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
    </div>
</template>
