<template>
    <v-card class="w-100 d-flex justify-content-center align-items-center bg-secondary background" elevation="0">
        <router-view class="w-100"/>
    </v-card>
</template>

<script>
export default {
}
</script>       
<style lang="scss" scoped>
    .background{
       
        height: 100vh;
    }
</style>
