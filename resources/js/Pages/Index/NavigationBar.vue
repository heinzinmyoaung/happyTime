<template>
    <!-- <nav class=""> -->
        <!-- <div>{{ search }}</div> -->
    <div class="bg-white sticky top-0 z-40  dark:bg-gray-800 border-b dark:border-gray-500/30" >
    <div class=" container m-auto">

        <div class="px-4 h-14 md:h-24 flex items-center justify-between">
            <div class=" flex flex-row">
                <div class="flex-none md:pr-6">
                    <!-- <img src="./images/0ad444434c311f280b22573097feb8ce.png" alt="" class=" h-12 md:h-16 "> -->
                    <span class="flex justify-center items-center h-12 md:h-16 text-green-600 font-mono">Cafe</span>
                </div>
                <div class=" hidden lg:flex">
                    <div class="flex grow  my-auto border border-gray-300/80  dark:border-black/20 mx-4 rounded-md">
                        <div class="flex items-center px-4 max-w-xs h-10">
                            <div class="pr-2 text-gray-500 dark:text-gray-300 text-xs">BYOD</div>
                            <font-awesome-icon icon="fa-solid fa-location-dot" class="pr-2" />
                            <div class="pr-2 text-sm font-semibold truncate ">Orchard GateWay</div>
                        </div>
                    </div>

                    <div class="flex grow  my-auto border border-gray-300/80  dark:border-black/20 rounded-md mx-2">
                        <div class="flex items-center max-w-xs h-10 px-4  ">
                            <div class=" pr-2  text-gray-500 dark:text-gray-300 text-xs">Table</div>
                            <font-awesome-icon icon="fa-solid fa-utensils" class=" pr-2"/>
                            <div class=" pr-2 text-sm font-semibold">46</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" flex-1 px-4 hidden" ref="searchfield">
                <span class="flex flex-row items-center">
                    <span class=" bg-gray-200/60 px-2 md:px-4 h-9 md:h-10 rounded-l-lg flex items-center" >
                        <font-awesome-icon :icon="['fas', 'magnifying-glass']" class=" text-xs md:text-sm" />
                    </span>
                    <input type="text" v-model="query" @input="search" ref="inputField" @click="searchCall" @blur="onSearchBarBlur" class=" w-full h-9 md:h-10 bg-gray-200/60 rounded-r-lg p-2 outline-0 text-xs md:text-base" placeholder="search"  />
                </span>
            </div>
            <div class=" flex flex-row items-center text-sm md:text-base ">
                <div v-if=" search"  class="md:pr-6  " @click="searchbar" >
                    <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                </div>
                <span v-else class=" md:pr-6 " @click="searchclear">
                    <font-awesome-icon icon="fa-solid fa-xmark" />
                </span>
                <div class=" flex-none relative hidden md:inline-block border bg-green-600   rounded-md text-xs md:text-base font-medium" :class="{ ' bg-transparent' : totalprice === 0}" @click="ClickCart">
                    <div class=" flex justify-center items-center px-4 h-10">
                        <div class=" px-1 bg-white ring-offset-2 ring-1 ring-green-600 absolute -translate-x-10 -translate-y-5 rounded-full flex justify-center items-center text-green-600 text-xs" :class="{ 'hidden' : cartcount === 0}">{{ cartcount }}</div>
                        <div class=" m-auto">
                            <span class="pr-1" :class="{ 'text-gray-500' : cartcount === 0}">
                                <font-awesome-icon icon="fa-solid fa-cart-shopping" />
                            </span>
                            <span class="text-white pl-1" :class="{ 'hidden' : totalprice === 0}">
                                {{ $filters.formattedCurrency(totalprice) }} 
                            </span>
                        </div>
                    </div>
                </div>
                <div class="pl-6 flex-none ">
                    <font-awesome-icon icon="fa-solid fa-globe" />
                </div>
            </div>
        </div>
        
            
        <div class="flex lg:hidden bg-gray-200/50 dark:bg-black/20 h-12 md:h-14 justify-center items-center rounded-sm">
        <div class=" float-left left-0 w-full ">
            <div class="flex items-center px-4">
                <font-awesome-icon icon="fa-solid fa-location-dot" class="pr-2 " /> 
                <div class="">
                    <div class="pr-2 text-gray-500 dark:text-gray-300 text-xs">BYOD</div>
                    <div class=" pr-2 text-sm w-44 md:w-96 truncate">Orchard GateWayfsfsfsfdfssdsdasdsadadsdadsadadasdsdsdsd</div>
                </div>
            </div>
        </div>

            <div class=" float-left left-0  w-full border-l border-gray-300/50">
            <div class="flex items-center px-4">
                <font-awesome-icon icon="fa-solid fa-utensils" class=" pr-2"/>
                <div class="">
                    <div class="pr-2 text-gray-500 dark:text-gray-300 text-xs">Table</div>
                    <div class=" pr-2 text-sm truncate ">46</div>
                </div>
            </div>
            </div>
 
    </div>
    
    </div>
    
</div>

<div class="md:hidden bg-white w-full h-16 fixed bottom-0  z-40  left-0 border-t border-gray-200  dark:border-black/20 shadow-inner p-4" @click="ClickCart" ref="confirmbtn" :class="{'hidden':length === 0}">
        <div class=" flex flex-row  w-full h-full justify-between items-center bg-green-600 px-3 rounded text-white" :class="{ ' bg-gray-200/80 text-black/20' : totalprice === 0}">
            <div class=" bg-white rounded-sm px-1 flex justify-center items-center text-green-600 text-xs md:text-sm" :class="{ ' text-transparent' : totalprice === 0}">
               {{ cartcount }}
            </div>
            <div class=" ">CONFIRM</div>
            <div class=" ">{{ $filters.formattedCurrency(totalprice) }}</div>
        </div>
    </div>


    <!-- <div class="flex justify-between w-full border-t border-gray-200">
        <div>01</div>
        <div>02</div>
        <div>03</div>
    </div> -->


</template>

<script >
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ref } from 'vue';

const search = ref(true);


export default {
    
    emits: ['myevent1','myevent2'],
    props: {
        totalprice: Number ,
        cartSlidebar: Boolean,
        cartcount: Number,
        length: Number
        // windowHeight: Number
    },
    data(){
        return{ 
            query: null,
        }
    },
    setup() {
         return {  
            search
        }
    },
    watch: {
        query: function(newText) {
      this.searchCall();
    }
},
    methods:{
        ClickCart(){
            const cartslidebar = !this.cartSlidebar
            this.aa(this.cartSlidebar)
            this.$emit('myevent2', cartslidebar)
            // console.log(cartslidebar);

        },
        searchCall(){
            const myValue = this.query
          
            if(this.query !== null){
                const windowHeight = window.innerHeight;
                const bottonHeight = this.$refs.confirmbtn.offsetHeight
                const test = windowHeight- bottonHeight
                this.$refs.confirmbtn.style.bottom = 'unset'
                this.$refs.confirmbtn.style.transform = `translateY(${test}px)`
            }
            

            this.$emit('myevent1', myValue)
            // console.log(this.query);
        },
        searchbar(){
            search.value = !search.value;
            // alert('aa');
            this.$refs.searchfield.style.display = "inline-block"
            this.$refs.inputField.focus();


          const windowHeight = window.innerHeight;
          const bottonHeight = this.$refs.confirmbtn.offsetHeight
          const test = windowHeight- bottonHeight
          this.$refs.confirmbtn.style.bottom = 'unset'
          this.$refs.confirmbtn.style.transform = `translateY(${test}px)`
            // const buttonTop = this.$refs.confirmbtn.offsetTop;
            // this.$refs.confirmbtn.style.top = `${buttonTop}px`
   
        },
        searchclear(){
            this.query = null
            // this.$refs.confirmbtn.style.top = 'unset'
            this.$refs.confirmbtn.style.transform = `unset`
            
            this.$refs.confirmbtn.style.bottom = '0px'
            // this.$refs.confirmbtn.style.transform = `unset`

            this.$refs.searchfield.style.display = "none"
            search.value = !search.value;
        },
        onSearchBarBlur(){
            this.$refs.confirmbtn.style.bottom = '0px'
          this.$refs.confirmbtn.style.transform = `unset`
            // this.$refs.confirmbtn.style.bottom = '0px'

            // this.$refs.confirmbtn.style.top = 'unset'

        },
        aa(para){
              // console.log(para)
              const body = document.body;
              if(para){
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