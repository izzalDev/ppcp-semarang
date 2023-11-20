<script setup>
import {Link} from "@inertiajs/vue3";
import {ref, useSlots} from "vue";
defineProps({
    href:String,
    title:String,
    icon:String,
})
const hasChild = useSlots().default;
const collapse = ref('collapse');
</script>
<template>
    <li :class="{ 'mm-active': $page.url === href }">
        <a v-if="hasChild" :class="{'has-arrow':hasChild}">
            <div class="parent-icon"><i :class="icon"></i>
            </div>
            <div class="menu-title">{{ title }}</div>
        </a>
        <Link v-if="!hasChild"  :href="href">
            <div class="parent-icon"><i :class="icon"></i>
            </div>
            <div class="menu-title">{{ title }}</div>
        </Link>
        <ul v-if="hasChild">
            <slot/>
        </ul>
    </li>
</template>
