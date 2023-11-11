<script setup>
import {onMounted} from "vue";
import MetisMenu from "metismenujs";
import 'simplebar';
defineProps({
    logo:String,
    title:String,
});
onMounted(()=>{
    new MetisMenu('#menu');
})
</script>
<template>
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img :src="logo" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">{{title}}</h4>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <slot/>
        </ul>
        <!--end navigation-->
    </div>
</template>
<style scoped>
.simplebar-scrollbar:before {
    top: 62px;
}
</style>
