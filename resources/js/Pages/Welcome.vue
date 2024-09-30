<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Kenapa Tulisan nya begini?</h1>
        
        <PostCrud />
    </div>
</template>

<script setup>
import PostCrud from '@/Components/PostCrud.vue';
</script>

<style scoped>
.container {
    margin-top: 50px;
    text-align: center;
}
</style>
