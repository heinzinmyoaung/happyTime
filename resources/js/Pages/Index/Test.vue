<template>

<div class=" h-1/2 w-56 border border-red-600 relative">
    <div class=" h-14 w-56 border border-green-600  ">

    </div>
    <div class=" overflow-auto h-14 w-56 border border-green-600 absolute" v-for="v in 40">
    <div class=" absolute">{{ v }}</div>
    </div>
    <div class=" h-14 w-56 border border-green-600">

    </div>
</div>
</template>

<script setup>


defineProps(

)
</script>