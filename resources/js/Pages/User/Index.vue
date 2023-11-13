<script setup>
import App from "../../Layouts/App.vue";
import Pagination from "../../Components/Pagination.vue";
import {usePage,Link} from "@inertiajs/vue3";
import {capWord} from "../../Composable/capitalize.js";
import moment from "moment";

defineOptions({layout: App});
defineProps({users: Object});
console.log(usePage().props.users);
</script>
<template>
  <Head title="User Management"/>
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Mangement</div>
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
      <div class="d-flex align-items-center">
        <span class="fs-6">Show </span>
        <div class="col-auto mx-3">
          <select class="form-select">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
        <span class="fs-6"> entries</span>
        <div class="col-4 ms-auto">
          <input type="text" class="form-control" placeholder="Search">
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
          <tr v-for="(user,key) in users.data">
            <th scope="row" class="d-flex align-items-center">
              <div class="m-2">
                <img v-if="user.image" :src="user.image" alt="Admin"
                     class="rounded-circle bg-secondary" width="42" height="42">
                <img v-else
                     :src="encodeURI('https://ui-avatars.com/api/?name='+user.name+'&background=random')"
                     alt="Admin"
                     class="rounded-circle" width="42" height="42"></div>
              <div class="ms-2">
                <h6 class="mb-1 font-14">{{ user.name }}</h6>
                <p class="mb-0 font-13 text-secondary">{{ user.email }}</p>
              </div>
            </th>
            <td>{{ user.roles.map((e) => capWord(e.name)).join(', ') }}</td>
            <td>
              <span v-if="user.last_seen">{{ moment.utc(user.last_seen).local().fromNow() }}</span>
              <span v-else class="badge text-bg-warning">Inactive</span>
            </td>
            <td>{{ moment.utc(user.created_at).local().fromNow() }}</td>
            <td>
              <div class="d-flex order-actions">
                <Link href="/user/edit" class=""><i class="bx bxs-edit-alt"></i></Link>
                <Link href="/user/delete" :data="{id:user.id}" class="ms-4"><i class="bx bxs-trash-alt"></i></Link>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
        <div class="d-flex align-items-center">
          <span>Showing {{users.from}} to {{ users.to }} of {{ users.total }} entries</span>
          <pagination class="ms-auto"></pagination>
        </div>
      </div>
    </div>
  </div>
</template>
