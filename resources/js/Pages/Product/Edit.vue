<script setup>
import App from "../../Layouts/App.vue";
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import swal from "sweetalert";

const {product, errors, categories} = defineProps({
    product: Object,
    errors: Object,
    categories: Object,
});
defineOptions({layout: App});
const form = useForm({
    name: product.name,
    category:product.category_id,
    price: product.price,
    stocks: product.quantity,
});
const submit = () => {
    form.put(route('product.update',product.id), {
        preserveState:true,
        onSuccess: () => {
            swal({
                icon: "success",
                title: "Success",
                text: usePage().props.session.message,
            });
        }
    });
}

</script>
<template>
    <Head title="Edit Product"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Product</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <div class="d-flex mb-5">
                    <h5 class="mb-2">Edit Product</h5>
                    <Link replace class="btn btn-primary px-4 ms-auto" href="/product"><i class="bx bx-arrow-back"/>Back
                    </Link>
                </div>
                <form @submit.prevent="submit">
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Product Name</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.name" type="text" class="form-control"
                                   :class="{'is-invalid':errors.name}"
                            placeholder="Product Name">
                            <div class="invalid-feedback">{{ errors.name }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Category</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <select v-model="form.category" class="form-select" :class="{'is-invalid':errors.category}">
                                <option selected>Select Category</option>
                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                            <div class="invalid-feedback">{{ errors.category }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Price</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.price" type="text" class="form-control"
                                   :class="{'is-invalid':errors.price}"
                            placeholder="Product Price">
                            <div class="invalid-feedback">{{ errors.price }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6 class="mb-0">Stocks</h6></div>
                        <div class="col-sm-9 text-secondary">
                            <input v-model="form.stocks" type="text" class="form-control"
                                   :class="{'is-invalid':errors.stocks}"
                            placeholder="Product Stocks">
                            <div class="invalid-feedback">{{ errors.stocks }}</div>
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
