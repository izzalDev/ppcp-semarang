<script setup>
import Cookies from 'js-cookie';
import {handleError, ref, watch} from "vue";
let colorMode = ref(Cookies.get('theme'));

const handleColorToggle = function (){
    if(colorMode.value==='light-theme'){
        colorMode.value = 'dark-theme';
    } else {
        colorMode.value = 'light-theme';
    }
}
watch(colorMode,function (){
    Cookies.set('theme',colorMode.value);
    document.documentElement.className = colorMode.value
})
</script>

<template>
    <li class="nav-item dark-mode d-none d-sm-flex" @click="handleColorToggle">
        <a class="nav-link dark-mode-icon" href="javascript:;"><i :class="[colorMode === 'light-theme' ? 'bx bx-moon':'bx bx-sun']"></i>
        </a>
    </li>
</template>
