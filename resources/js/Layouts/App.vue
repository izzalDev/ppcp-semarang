<script setup>
import Sidebar from "./Partials/Sidebar.vue";
import Navbar from "./Partials/Navbar.vue";
import {ref} from "vue";
import Cookies from 'js-cookie';
document.documentElement.className = Cookies.get('theme')??'light-theme';
const isToggled = ref(false);
const handleMobileToggle = ()=> isToggled.value=!isToggled.value;
</script>
<template>
    <div class="wrapper" :class="{toggled:isToggled}">
        <Sidebar/>
        <Navbar @mobileToggle="handleMobileToggle"/>
        <div class="overlay toggle-icon" @click="handleMobileToggle"></div>
        <div class="page-wrapper">
            <div class="page-content">
                <slot/>
            </div>
        </div>
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. All right reserved.</p>
        </footer>
    </div>
</template>
