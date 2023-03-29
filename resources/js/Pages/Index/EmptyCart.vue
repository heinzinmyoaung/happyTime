<template>
    <div  class='w-full h-full bg-gray-600/50 fixed z-50  top-0 overflow-x-hidden overflow-y-auto '  :class="{ 'translate-x-full' : cartSlidebar}" @click=" clickbtn(),aa(cartSlidebar), cartSlidebar = !cartSlidebar">
  </div>
     <div  class=" bg-white w-full md:w-2/3 lg:w-2/4 xl:w-2/5 h-full right-0  z-50 fixed top-0 float-right   transform translate-x-0 transition duration-500 ease-in-out" :class="{ ' translate-x-full' : cartSlidebar}" >
          <div class=" absolute top-0 z-20 border-b border-gray-200/70 w-full h-10 lg:h-16 bg-white">     
              <button @click=" clickbtn(),aa(cartSlidebar), cartSlidebar = !cartSlidebar" as="button">+++ Timer</button>
          </div>
  
         
          <div id= "cartslidebar" class="overflow-y-auto    w-full  h-full right-0 absolute flex justify-center" >   
            <div class="m-auto">
                <div>
                    <img src="./images/undraw_empty_cart_co35.svg" alt="" class=" w-44 h-44 flex justify-center m-auto">
                </div>
                
                    <span class=" mt-3 text-lg font-bold m-auto flex justify-center ">Start Grabbing Food!</span>
                    <span class=" mt-1 m-auto flex justify-center text-gray-500">Add items to your basket and place order here.</span>
                    <div @click=" clickbtn(),aa(cartSlidebar), cartSlidebar = !cartSlidebar" class=" cursor-pointer" >
                        <span class="flex justify-center m-auto mt-4 text-cyan-600 font-bold text-sm">Browse Menu</span>
                    </div>
                </div>  
           </div>
      </div>
  </template>
  
<script setup>
  defineProps({
      cartSlidebar: Boolean,
  })
  </script>
  
  <script>




  export default {
    // setup(){
    //     return{
    //         cartSlidebar: Boolean,
    //     }
    // },
    // data(){
    //    return{ 
    //     id: null,
        
    //     };
    // },
  

      emits: ['myevent'],
      methods: {
      
          clickbtn(){
              this.$emit('myevent')
          },
          aa(para){
              // console.log(para)
              const body = document.body;
              // const slidebar = document.getElementById('slidebar')
              // const cartslidebar = document.getElementById('cartslidebar')
              if(para){
                  // slidebar.style.overflow = 'auto';
                  // cartslidebar.style.overflow = 'auto';
                  body.style.overflow='hidden';
                  
              }else{
                  body.style.overflowY='auto';
                  this.additionalarray = [];
                  this.shoppingcartindex = null;
                  this.addplus = 1;
              }
          },
      },
  }
  </script>
  
  
  
  
  