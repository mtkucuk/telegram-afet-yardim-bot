<template>

    <div id="general"  >
        <app-header></app-header>
        <div class="container p-4 mx-auto   bg-gray-100">
        <router-view/>
        </div>
    </div>

</template>

<script>
import header from "../partials/header.vue";

export default {
    name: "App",
    components: {
        'app-header': header
    }
}
</script>

<style scoped>

</style>
