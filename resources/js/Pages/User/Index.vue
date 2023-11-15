<script setup>
import App from "../../Layouts/App.vue";
import {Head, router, usePage, Link} from "@inertiajs/vue3";
import {reactive, watch} from "vue";
import swal from "sweetalert";
import UserListItem from "../../Components/UserListItem.vue";
import Pagination from "../../Components/Pagination.vue";
import _ from 'lodash';

defineOptions({layout: App});
defineProps({users: Object});

const params = reactive({
    search: null,
    perPage: 10,
})

watch(() => [params.search, params.perPage],
    _.debounce(() => {
        router.get('/user', params, {
            replace: true,
            preserveScroll: true,
            preserveState: true,
        })
    },100)
);
console.log(usePage().props.users);
const deleteUser = (id) => {
    router.delete('user/' + id, {
        preserveScroll: true,
        preserveState: true,
    })
}

const deleteConfirmation = (id,name) => swal({
    title: `Are you sure?`,
    text: "Once deleted, you will not be able to recover this action!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
}).then((willDelete) => {
    if (willDelete) {
        deleteUser(id)
        swal(`Poof! ${name} has been deleted!`, {
            icon: "success",
        });
    }
});
</script>
<template>
    <Head title="User Management"/>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">User Management</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-user-circle"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <div class="d-flex mb-3">
                <Link class="btn btn-primary px-4 ms-auto" href="/user/create"><i class="bx bx-plus"/>Create User</Link>
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
                        <th scope="col">User</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Last Active</th>
                        <th scope="col">Since</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <user-list-item v-for="(user,key) in users.data" :key="key" :user="user"
                                    @delete="deleteConfirmation"/>
                    <tr v-if="!users.data.length">
                        <td colspan="5" class="text-center">
                            No data found
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items-center">
                    <div class="text-center">Showing {{ users.from }} to {{ users.to }} of {{ users.total }} entries</div>
                    <pagination :links="users.links" class="ms-auto my-auto"/>
                </div>
            </div>
        </div>
    </div>
</template>
