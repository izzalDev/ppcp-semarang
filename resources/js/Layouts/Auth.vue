<template>
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-4">
                                    <slot/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</template>
<script setup>
const preferDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
document.documentElement.className = preferDarkScheme.matches?'dark-theme':'light-theme';
preferDarkScheme.addEventListener("change", () => {
    document.documentElement.className = preferDarkScheme.matches?'dark-theme':'light-theme';
});
</script>
