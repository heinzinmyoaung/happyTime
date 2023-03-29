<template > 
<div v-if="user">
  <label for="">Currect User: {{ user.name }}</label>
  <!-- <label>{{ cart }}</label> -->

  

  <label class="text-sm pl-2 text-red-400"> 
  <Link :href="route('logout')" method="DELETE" as="button">
        logout
  </Link>
  </label>
</div>

<div>this is {{ data }}</div>
  <div>ddd</div>


    <slot>Default</slot>
    
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { computed } from 'vue';



const data = ref(0);
    setInterval(()=> data.value++, 1000)

const user = computed(
  () => usePage().props.user
)


// const cart = computed(
//   () => usePage().props.ex
// )


</script>
