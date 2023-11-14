<script setup>

import {capWord} from "../Composable/capitalize.js";
import moment from "moment/moment.js";
defineProps({user:Object})
</script>

<template>
    <tr>
        <th scope="row" class="d-flex align-items-center">
            <div class="m-1">
                <img v-if="user.image" :src="user.image" alt="Admin"
                     class="rounded-circle bg-light" width="42" height="42">
                <img v-else
                     :src="encodeURI('https://ui-avatars.com/api/?name='+user.name+'&background=random')"
                     alt="Admin"
                     class="rounded-circle" width="42" height="42">
            </div>
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
                <a href="/user/edit" class=""><i class="bx bxs-edit-alt"></i></a>
                <a class="ms-4" @click="$emit('delete',user.id)"><i
                    class="bx bxs-trash-alt"></i></a>
            </div>
        </td>
    </tr>
</template>

<style scoped>

</style>
