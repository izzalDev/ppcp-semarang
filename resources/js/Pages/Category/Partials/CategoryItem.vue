<script setup>
import {router, usePage} from "@inertiajs/vue3";
import swal from "sweetalert";

const {category} = defineProps({category: Object});
const edit = (id) => {
    router.get(`/category/${id}/edit`);
}

const onDelete = (id) => {
    swal({
        title: `Are you sure?`,
        text: "Once deleted, you will not be able to recover this action!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirm) => {
        if (confirm) {
            router.delete(`/category/${id}`,{
                preserveState:true,
                preserveScroll:true,
                onSuccess:()=>{
                    swal(`Poof! Category has been deleted!`, {
                        icon: "success",
                    });
                }
            });
        }
    });
}

</script>

<template>
    <tr>
        <th>
            {{ category.name }}
        </th>
        <td>
            <div class="d-flex order-actions">
                <a @click="edit(category.id)"><i class="bx bxs-edit-alt"></i></a>
                <a class="ms-4" @click="onDelete(category.id)"><i
                    class="bx bxs-trash-alt"></i></a>
            </div>
        </td>
    </tr>
</template>
