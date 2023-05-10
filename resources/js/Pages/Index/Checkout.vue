<template>
    <LoadingSpinner class="z-10" :loading="isLoading"/>
<div class=" bg-gray-100 dark:bg-gray-800">
    <div class="bg-white dark:bg-gray-800  w-full h-28 md:h-36  flex justify-center p-4">
        <div class="w-full  md:w-4/5 lg:w-3/5 xl:w-2/5 inset-x-0 m-auto flex flex-col">
            <span class=" text-lg md:text-4xl font-base">Last Step-Checkout</span> 
            <span class=" pt-3 text-sm md:text-xl font-base">HappyTime</span> 
        </div>
        
    </div>
    <div class=" w-full relative py-6 mb-8 p-4">
        <div id= "cartslidebar" class="bg-white dark:bg-black/20 top-6 w-full md:w-4/5 lg:w-3/5 xl:w-2/5 inset-x-0 mx-auto rounded-md" >   
            <!-- <div class=" overflow-y-auto pb-48 lg:pb-52"> -->
            <div class=" px-6 py-4 md:py-5  border-b-2   border-gray-200/70 dark:border-gray-500/30 w-full">
            <span class="text-lg md:text-xl font-semibold">Order Detail</span>
        </div>
        <div  class="px-3 md:px-6 mb-12 md:mb-20 ">
            <!-- <div v-for="cartfood in cartfood(carts.foodid)" :key="cartfood.id" class="flex" > -->
            <div v-for=" (carts,index) in cart" class="flex py-6 border-b  border-gray-200/70 dark:border-gray-500/30">
                <div  class="flex flex-row flex-none  align-content-center pr-3">
                    <button class=" text-cyan-500 text-lg"  :disabled="isButtonDisabled" @click="reduce(index, 'reduce')">-</button> 
                    <div  class="my-auto mx-2 text-sm w-6 text-center">{{carts.quantity}}</div>
                    <button class="text-cyan-500 text-lg" @click.prevent="add(index,'add')" >+</button> 
                </div>
                <div  class="pr-3 flex-none m-auto hidden md:block" >
                    <img  :src= "`./images/${carts.foodimage}`"  alt="" class=" w-16 h-16 md:w-16 md:h-16 rounded-md " >
                </div>

                <div  class=" flex-auto m-auto text-sm md:text-base">
                    <span class="font-semibold">{{ carts.foodname }}</span>
                    <p v-for="additionalnames in carts.additionalname"  class="text-xs text-gray-600 dark:text-gray-300">
                            {{ additionalnames }}
                    </p>
                </div>
                <div  v-if="carts.quantity == 0" @click="remove(index)" class="cursor-pointer flex-none m-auto text-base font-bold text-red-600">
                        remove
                </div>
                <div v-else  class=" flex-none  text-base">
                        {{  $filters.formattedCurrency(carts.totalprice) }}
                </div>
            </div>
            <div  class="py-6 flex dark:border-gray-500/30 text-sm md:text-base">
                <div class="flex-1">Subtotal</div>
                <div class="flex-none"> {{ $filters.formattedCurrency(total()) }}</div>
            </div>

        </div>
        </div>
    </div>

    

    <div class=" h-20 md:h-28 flex justify-center w-full bg-white dark:bg-gray-800  fixed bottom-0 border-t border-gray-200/70 dark:border-gray-500/20">
        <div class=" px-4 w-full md:w-4/5 lg:w-3/5 xl:w-2/5 inset-x-0 m-auto">
            <div class=" md:py-5 flex">
                <div class="flex flex-1 flex-col pr-4 text-base md:text-lg font-medium">
                    <p class="font-normal">Total</p>
                    <p>{{ $filters.formattedCurrency(total()) }}</p>
                </div>
               
                <div class="flex-initial w-64 h-9 md:h-12 bg-green-600 rounded-md flex justify-center m-auto" @click="order()">
                    <button class=" bg-green-600 rounded-md text-sm md:text-base text-white" >Place Order </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { defineComponent } from 'vue';
import LoadingSpinner from './LoadingSpinner.vue'



defineProps({
    cart: Object,
    // orderdetail: Boolean

    
})

</script>

<script>

export default defineComponent({

    setup(){
        return{
            cart: Object,
            
        }
    },
    data(){
        return{
            isLoading: false,
            isButtonDisabled: false,
           
        }
        
    },
   
    methods:{
        async add(index,action) {
      try {
        this.isLoading = true;
        if(action == 'add'){
            this.cart[index]['quantity'] += 1;
            // this.isButtonDisabled = false; 
        }else if(action == 'reduce'){
            if(this.cart[index]['quantity'] >=1){
                this.cart[index]['quantity'] -= 1; 

            }else if(this.cart[index]['quantity'] == 0){
                
                this.cart[index]['quantity'] = 0;
                console.log('aaa');
            }
        }
        const response = await axios.post(route('menu.checkoutupdate'), {
            'index' : index,
            'action' : action
        });

        if (response.data.success) {      
      this.cart[index]['totalprice'] = response.data.totalprice; 
      this.isLoading = false;
    }
      } catch (error) {
        console.log(error);
      }
    },
        reduce(index,action){
            this.add(index,action);
            // console.log('a');
            // this.$refs.myButton.disabled = true;
            
        },
        remove(index){
            const cartarray = useForm(
                {
                    'index' : index,
                }
            );
            return cartarray.post(route('menu.remove'));
        },
        // order(){
        //     const cartarray = useForm(
        //         {
        //             'cart' : this.cart
        //         }
        //     );
        //     return cartarray.post(route('menu.order'));
        // },
        async order() {
        try {
            this.isLoading = true;
            const response = await axios.post(route('menu.order'), {
                'cart' : this.cart
            });

            if (response.data.success) { 
                this.isLoading = false;
                
                window.location = '/checkout/'+response.data.id        
        }
        } catch (error) {
            console.log(error);
        }
    },
    total(){ 
            // return this.filterprice.reduce((total, item) => total + item, 0);
            let totalPrice = this.filterprice.length > 0 ? this.filterprice.reduce((total, item) => total + item, 0) : 0
            // console.log(this.filterprice)
            return totalPrice
        },
    
    }, 
    mounted: function(){
        document.body.style.overflowY = 'auto';
        if(localStorage.getItem('cart') !== null){
            // alert(localStorage.cart)
            const cartarray= useForm(
            
            {
                
                'cart' : JSON.parse(localStorage.cart),
            }
            );
            localStorage.removeItem('cart');
            return cartarray.post(route('menu.update'));
        }
    },
  
    computed:{
        // total(){
                
        //         if(this.cart){
        //             console.log(this.cart);
        //             const a = this.cart.map( (el) => {
        //             return el.totalprice
        //         }).reduce((el,els)=>el+els);
        //             return a;
        //         }else{
        //             return 0;
        //         }
        //     },
        filterprice(){
                if(this.cart){
                    return this.cart.map( (el) => el.totalprice)
                }else{
                    return 0
                }
                
            }
    }
})
</script>