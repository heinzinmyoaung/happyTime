<template>
    <div class="w-full h-3/5 bg-gray-100 flex justify-center">
        <div class="m-auto">
            <div>
                <img src="./images/undraw_empty_cart_co35.svg" alt="" class=" w-44 h-44 flex justify-center m-auto">
            </div>
            
                <span class=" mt-3 text-lg font-bold m-auto flex justify-center ">Start Grabbing Food!</span>
                <span class=" mt-1 m-auto flex justify-center text-gray-500">Add items to your basket and place order here.</span>
                <Link :href="route('menu.index')" >
                    <span class="flex justify-center m-auto mt-4 text-cyan-600 font-bold text-sm">Browse Menu</span>
                </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<script>


export default {
 
   mounted() {
        document.body.style.backgroundColor = 'white';
        console.log(this.orderdetails);

    },
}
</script>