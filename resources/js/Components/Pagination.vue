<template>
    <ul class="pagination">
        <template v-for="(link, index) in links">
            <li class="page-item">
                <Link class="page-link"
                      :class="{'bg-primary text-white':link.active,'disabled':!link.url}"
                      :href="link.url??'#'" v-html="link.label" :key="index" preserve-scroll
                      preserve-state replace/>
            </li>
        </template>
    </ul>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";
defineProps({links:Object});
</script>
