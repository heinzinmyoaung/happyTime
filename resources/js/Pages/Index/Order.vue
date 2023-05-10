<template>
    <!-- <div class="w-full h-36 bg-white flex justify-center ">
        <div class=" w-2/5 inset-x-0 m-auto flex flex-col">
            <span class=" text-4xl font-base">Order accept</span> 
            <span class=" pt-3 text-xl font-base">HappyTime</span> 
        </div>
        
    </div> -->
<div class=" p-4 bg-gray-100 dark:bg-gray-800 ">
    <div  class="py-6">

        <div v-motion-pop class="mb-6">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class=" w-28 h-28 text-green-600 ">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class=" flex justify-center font-semibold text-base md:text-lg">Your order was successfully placed</span>
        </div> 

        <div id= "cartslidebar" class=" bg-white dark:bg-black/20 top-6 w-full  md:w-4/5 lg:w-3/5 xl:w-2/5  inset-x-0 mx-auto border border-gray-200 dark:border-none rounded-lg shadow-md " >   
            <!-- <div class=" overflow-y-auto pb-48 lg:pb-52"> -->
            <div  class=" flex flex-col p-4 bg-white dark:bg-black/20  border-b border-gray-200/70  dark:border-gray-500/30 rounded-t-lg">
                <div class=" flex">
                    <span class="flex-1 text-xs  text-gray-500">Order Created at : {{ moment(orders.created_at).format('h:mm, M-Do-YYYY') }}</span>
                    <span class=" text-green-600 font-light text-sm md:text-base">COMPLETED</span>
                </div>
                <div class="font-bold text-base">
                    # {{  orders.id }}
                </div>        
            </div >
            <div  class="px-4 bg-gray-50 dark:bg-black/20">
                <!-- <div v-for="cartfood in cartfood(carts.foodid)" :key="cartfood.id" class="flex" > -->
                
                <div v-for="orderdetail in orderdetails" class="flex py-6 ">
                
                    <div class=" flex-none  m-auto mr-3 font-normal text-sm md:text-base">
                        <span>{{ orderdetail.orderdetails_quantity }}x</span>
                    </div>
                    <div  v-for="menufilter in menufilter(orderdetail.menu_id)" class="pr-3 flex-1 m-auto" >
                        <div  class=" flex-auto m-auto">
                            <span class="font-semibold text-sm md:text-base"> {{menufilter.product_name}}</span>
                    
                        </div>
                    </div>
                    <div class="cursor-pointer flex-none m-auto text-sm md:text-base font-light">
                            {{ $filters.formattedCurrency(orderdetail.orderdetails_totalprice) }}
                    </div>
                    
                </div>
            </div>
            <div class="px-4 py-6 border-t border-gray-100  dark:border-gray-500/30">
                <div  class="pb-1 flex text-xs md:text-sm">
                    <div class="flex-1 font-normal">Sub Total <span class=" font-extralight">(Tax inclusive)</span></div>
                    <div class="flex-none font-light"> {{ $filters.formattedCurrency(orders.TotalAmount)}}</div>
                </div>
                <div  class="pb-6 flex text-lg md:text-xl font-medium">
                    <div class="flex-1 text-green-600 ">Total</div>
                    <div class="flex-none text-green-600 "> {{ $filters.formattedCurrency(orders.TotalAmount)}}</div>
                </div>
                <Link :href="route('menu.index')">
                    <div class="h-10  bg-green-600 rounded-sm flex justify-center cursor-pointer" > 
                        <span class="m-auto text-white ">ORDER AGAIN</span>      
                    </div>
                </Link>
            </div>
            <div class=" p-4 bg-gray-50 dark:bg-black/20 border-t  border-gray-100 dark:border-gray-500/30 text-center rounded-b-lg text-xl md:text-2xl">
                    <span class="block  text-gray-600">
                        <!-- <i class="fas fa-star"></i> -->
                        <font-awesome-icon icon="fa-solid fa-star" /> 
                        Cups to self collect at the bar counter. 
                        <font-awesome-icon icon="fa-solid fa-star" /> 
                    </span>
                    <span class="block  text-gray-600">
                        <!-- <i class="fas fa-star"></i> -->
                        <font-awesome-icon icon="fa-solid fa-star" /> 
                        Plain water is free.
                        <font-awesome-icon icon="fa-solid fa-star" /> 
                    </span>
            </div>
        </div>
        
    </div>   
</div>
 
</template>
  
<script setup>
import moment from 'moment';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3';


  defineProps({
      orders: Object,
      orderdetails: Object,
      menu: Object,
      
        
  })
  </script>
  
  
<script>
export default {
    setup(){
        return{
        orders: Object,
        orderdetails: Object,
        menu: Object,
        }
    },
  
    mounted() {
        // document.body.style.backgroundColor = 'rgb(245 247 245)';
        console.log(this.orderdetails);

    },
    methods:{
        menufilter($id){
            return this.menu.filter(el=>el.id==$id);
        },
    },

}

</script>
  
  