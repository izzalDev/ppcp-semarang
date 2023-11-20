<script setup>
import {router} from "@inertiajs/vue3";
import swal from "sweetalert";

defineProps({product:Object})
const edit = (id) => {
    router.get(`/product/${id}/edit`);
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
            router.delete(`/product/${id}`,{
                preserveState:true,
                preserveScroll:true,
                onSuccess:()=>{
                    swal(`Poof! Product has been deleted!`, {
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
        <th>{{ product.name }}</th>
        <td>{{ product.category.name}}</td>
        <td class="text-end">Rp. {{ Number(product.price).toLocaleString('id') }}</td>
        <td class="text-end">{{ Number(product.quantity).toLocaleString('id') }}</td>
        <td>
            <div class="d-flex order-actions ms-3">
                <a @click="edit(product.id)"><i class="bx bxs-edit-alt"></i></a>
                <a class="ms-4" @click="onDelete(product.id)"><i
                    class="bx bxs-trash-alt"></i></a>
            </div>
        </td>
    </tr>
</template>
