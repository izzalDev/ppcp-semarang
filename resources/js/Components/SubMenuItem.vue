<script setup>
import {Link} from "@inertiajs/vue3";
import {useSlots} from "vue";
defineProps({href:String,title:String});
const hasChild = useSlots().default
</script>

<template>
    <li> <Link :class="{'has-arrow':hasChild}" :href="href"><i class='bx bx-radio-circle'></i>{{ title }}</Link></li>
    <ul><slot/></ul>
</template>

