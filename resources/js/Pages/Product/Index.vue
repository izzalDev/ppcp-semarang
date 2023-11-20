<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Pagination from "../../Components/Pagination.vue";
import {reactive, watch} from "vue";
import _ from "lodash";
import ProductItem from "./Partials/ProductItem.vue";
const {products} = defineProps({products:Object});
const params = reactive({
    search: null,
    perPage: 10,
})
watch(params,
    _.debounce(() => {
        router.get('/category', params, {
            replace: true,
            preserveScroll: true,
            preserveState: true,
        })
    },100)
);
</script>
<template>
    <Head title="Product"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <div class="d-flex mb-3">
                <Link class="btn btn-primary px-4 ms-auto" href="/product/create"><i class="bx bx-plus"/>Create Product</Link>
            </div>
            <div class="d-flex align-items-center">
                <span class="fs-6">Show </span>
                <div class="col-auto mx-3">
                    <select v-model="params.perPage" class="form-select">
                        <option value="7">7</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <span class="fs-6"> entries</span>
                <div class="col-4 ms-auto">
                    <input v-model="params.search" type="text" class="form-control" placeholder="Search">
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-hover">
                    <thead class="table-light radius-10">
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Category</th>
                        <th scope="col" class="col-2">Price</th>
                        <th scope="col" class="col-2">Stocks</th>
                        <th scope="col" class="col-2 ps-3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <product-item v-for="(product,key) in products.data" :key="key" :product="product"/>
                    <tr v-if="!products.data.length">
                        <td colspan="5" class="text-center">
                            No data found
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items-center">
                    <div class="text-center">Showing {{ products.from }} to {{ products.to }} of {{ products.total }} entries</div>
                    <pagination :links="products.links" class="ms-auto my-auto"/>
                </div>
            </div>
        </div>
    </div>
</template>
