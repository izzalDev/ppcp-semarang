<script setup>
import SubMenuItem from "../../Components/SubMenuItem.vue";
import Sidebar from "../../Components/Sidebar.vue";
import MenuItem from "../../Components/MenuItem.vue";
</script>

<template>
    <Sidebar logo="/assets/images/logo-icon.png" title="syndron">
        <MenuItem title="Category" icon="bx bx-category" href="/category"/>
        <MenuItem title="Product" icon="bx bx-shopping-bag" href="/product"/>
        <MenuItem title="User Management" icon="bx bx-user-check" href="/user"/>
        <MenuItem title="Profile" icon="bx bx-user-circle" href="/profile"/>
        <MenuItem title="contoh menu" icon="bx bx-home-alt" href="#">
            <SubMenuItem title="contoh menu" href="#"/>
        </MenuItem>
    </Sidebar>
</template>

