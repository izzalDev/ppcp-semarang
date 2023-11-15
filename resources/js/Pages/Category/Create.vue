<script setup>
import App from "../../Layouts/App.vue";
import {Head, router, useForm, usePage, Link} from "@inertiajs/vue3";
import swal from "sweetalert";
defineProps({errors:Object})
defineOptions({layout: App});
const form = useForm({
    name:null,
})
const submit = ()=>{
    router.post(route('category.store'),form,{
        onSuccess:()=>{
            form.reset();
            swal({
                icon: "success",
                title: "Success",
                text: usePage().props.session.message,
            });
        }
    })
}

</script>
<template>
    <Head title="Create Category"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Create Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Category</li>
                    <li class="breadcrumb-item active" aria-current="page">Create Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <div class="d-flex mb-5">
                    <h5 class="mb-2">Create Category</h5>
                    <Link replace class="btn btn-primary px-4 ms-auto" href="/category"><i class="bx bx-arrow-back"/>Back</Link>
                </div>
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Name</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.name"  type="text" class="form-control" :class="{'is-invalid':errors.name}">
                            <div class="invalid-feedback">{{errors.name}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
