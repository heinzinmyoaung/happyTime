
<template >
<NavigationBar :categoriesfilter="categoriesfilter" :activeIndex="activeIndex" :cartSlidebar="cartSlidebar" @myevent1 ="searchAction" @myevent2 ="CartSlideFun" @myevent3 = "scrollToElement" :totalprice = "total()" :cartcount = "cartcount()"/>
<!-- <div ref="navbar"></div> -->
<!-- <nav class="z-50">
    
    <ul>
      <li v-for="(category, index) in categoriesfilter" :key="category.id" class=" relative" :class="{  'text-red-500' : index === activeIndex}" >
        <a @click="scrollToElement(category.id)" class=" cursor-pointer">{{ category.category_name }}</a>
      </li>
    </ul>
  </nav> -->
    <!-- <div>
     <input type="text" v-model="query" @input="search" class=" border border-gray-300 rounded-lg" />
   </div> -->
  
 <!-- kjllhnlsdnklndsklcnlksdnlskndlksdnckl -->
 <!-- <button @click=" shoppingCart,aa(cartSlidebar),cartSlidebar = !cartSlidebar"  class=" text-red-500 w-20 h-30 border border-r-neutral-800">Cart {{ cartSlidebar }} {{ showSidebar }} {{cartcount()}}</button>
 <div v-for="carts in cart">cartSlidebar
     {{ carts }}
 </div> -->

 <div>{{ cart.count }}</div>
 
 <!-- ///////Start => Filter menu data by Category -->
 <!-- :class="{ '-translate-x-full' : showSidebar}" @click="showSidebar = !showSidebar" -->
 <!-- <div > -->
    <EmptySearch v-if="categoriesfilter.length <= 0"/>
    <div v-else class=" bg-gray-50  dark:bg-gray-800">
     <div  v-for="category in categoriesfilter" :key="category.id" :id="category.id" class="container m-auto px-4 py-2" >
         <span class=" font-medium text-lg md:text-2xl ">{{ category.category_name }}</span>
         <div class=" grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 md:gap-6 gap-4 py-4 md:py-8  cursor-pointer">
         
            <div v-for="menu in menufilter(category.id)" :key="menu.id">  <!-- to given the parameter in menufilter=>located (export default=>methods) -->
                 <Loadingpage v-if="isLoading" />
                <div v-else class="bg-white dark:bg-gray-800 rounded-md px-2 py-2 ring-1 ring-slate-900/5 shadow-md border dark:border-gray-400/60 hover:border-green-500 hover:dark:border-green-800">
                     <div>
                         <a @click="showDetail(menu.id),aa(showSidebar),addonfilter(menu.id),showSidebar = !showSidebar, fakekeid = menu.id" >
                             <img :src="`./images/${ menu.product_image }`" >
                         </a>
                     </div>
     
                     <h3 class=" mt-2 text-sm md:text-base tracking-tight truncate" >{{ menu.product_name }}</h3>
                     <p class="text-gray-500 dark:text-gray-300 text-xs ">{{ menu.product_description }}</p>
     
                     <div class="flex justify-between mt-3 lg:mt-5 text-sm md:text-base lg:text-lg  text-green-500">
                         <p class="inline-block">{{ $filters.formattedCurrency(menu.product_price) }}</p>
     
                         <button>sdd</button>
                     </div>
                 </div>  
                
            </div>
         </div>
     </div>
    </div>
 <!-- </div> -->
 <!-- ///////End => Filter menu data by Category -->
 
 
 <!-- 
 <div class="container m-auto p-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 relative">
    
     <div v-for="menu in menus" :key="menu.id">
         {{ menu.category_id }}
         <div class="bg-white dark:bg-gray-800 rounded-md px-2 py-2 ring-1 ring-slate-900/5 shadow-md">
             <div>
                 <a @click="showDetail(`${menu.id}`),showSidebar = !showSidebar">
                     <img :src="`./images/${ menu.product_image }`">
                 </a>
             </div>
             <h3 class="text-slate-700 dark:text-white mt-2 text-base tracking-tight">{{ menu.product_name }}</h3>
             <p class="text-slate-500 dark:text-slate-400 text-xs">{{ menu.product_description }}</p>
 
             <div class="flex justify-between mt-6">
                 <p class="inline-block text-green-500">{{ menu.product_price }}</p>
 
                 <button>sdd</button>
             </div>
         
         </div>
 
     </div>
 </div> -->
 
 
 <!-- ------ product Detail Slidebar -->
 <div  class='w-full h-full bg-gray-600/50 fixed z-50 top-0 overflow-x-hidden overflow-y-auto '  :class="{ 'translate-x-full' : showSidebar}" @click="aa(showSidebar),showSidebar = !showSidebar">
 </div>
 <div  class=" bg-white  dark:bg-gray-800 w-full h-full md:w-2/3 lg:w-2/4 xl:w-2/5 right-0 z-50 fixed float-right top-0  transform translate-x-0 transition duration-500 ease-in-out" :class="{ ' translate-x-full' : showSidebar}" >    
        <div class=" absolute flex text-center px-4 top-0 z-20 border-b border-gray-200/70 bg-white  dark:bg-gray-800 dark:border-black/20 w-full h-12 lg:h-16 text-base md:text-lg text-green-500">     
            <span class="flex-1 justify-center m-auto">Select Modifiers</span>
            <button @click="aa(showSidebar), showSidebar = !showSidebar" as="button" class="flex-none m-auto float-right right-0 "> 
                    <font-awesome-icon icon="fa-solid fa-xmark" />
            </button>
        </div>
         <div id= "showSidebar" class="overflow-y-auto top-11 lg:top-14 w-full  h-full pb-40 right-0 absolute  " >
            
             <div class="flex p-4 font-semibold text-sm md:text-base">
                 <div id="imgDiv" class="flex-none pr-4">
                     <img id="imgUpload" src="" ref="image" alt="" class="rounded-md w-16 h-16 md:w-24 md:h-24 ">
                 </div>
                <div ref="name" class="flex-1 "></div>
                <div ref="price" class="flex-none"></div> 
             </div>
             
             <div v-for="addon in addonfilter(clickfoodid)" :key="addon.id" class="p-4 border-t-4 border-gray-100 dark:border-black/20">
                 <span class="font-bold text-red-600/90 dark:text-red-700/95 text-sm md:text-base">Add On {{ addon.addon_name}}</span>
                 <div v-for="addondetail in addondetails" :key="addondetail.id">
                     <div v-if="addondetail.addon_id == addon.id" class= " py-4 border-b border-gray-200/70 dark:border-gray-500/30 text-gray-600 dark:text-gray-300">
                         <input type="checkbox" class=" h-5 w-5 md:h-6 md:w-6  align-middle" :id="addondetail.id" v-model="additionalarray" :value="addondetail.id" >
                         <span class=" pl-4 align-middle text-xs md:text-sm ">{{ addondetail.addondetail_name }}</span>
                        
                         <span class="float-right">{{ $filters.formattedCurrency(addondetail.addondetail_price) }}</span>
                     </div>
                 </div>
             </div>
         </div>

         <div class=" w-full h-20 md:h-24  z-20 absolute bottom-0 border-t bg-inherit border-gray-200  dark:border-black/20 shadow-inner flex p-4">
             <div class="flex flex-row w-32 my-auto pr-4 md:pr-6 ">
                 <button class=" w-7 h-7 md:w-10 md:h-10 rounded-md border border-gray-300 shadow-sm" @click=" addoneplus">+</button> 
                 <p ref="p" class=" w-8 md:w-11 text-center my-auto">{{addplus}}</p>
                 <button class="w-7 h-7 md:w-10 md:h-10 rounded-md border border-gray-300 shadow-sm" @click="addoneminus">-</button> 
 
             </div>
             <div class="flex-auto w-full h-10 md:h-12 my-auto font-normal text-sm md:text-base">
                 <button class="w-full h-full bg-green-600 rounded-md" @click="menucart(),aa(showSidebar),showSidebar = !showSidebar">Add to basket {{  $filters.formattedCurrency((basedprice+additionprice)*addplus)}}</button>
             </div> 
         </div>
 
     </div>
   
 <!-- -------------- -->
 
 <!-- <Checkout :orders="orders" :orderdetails="orderdetails" /> //v-if="0" -->
 <EmptyCart :cartSlidebar="cartSlidebar" v-if="!cart.length" @myevent="myAction()" />
 <!-- ------ Shopping cart Detail Slidebar --> 
 <div v-else>
 <div  class='w-full h-full bg-gray-600/50 fixed z-40  top-0 overflow-x-hidden overflow-y-auto '  :class="{ 'translate-x-full' : cartSlidebar}" @click="aa(cartSlidebar),cartSlidebar = !cartSlidebar">
 </div>
    <div  class=" container m-auto bg-white dark:bg-gray-800 w-full md:w-2/3 lg:w-2/4 xl:w-2/5 h-full right-0  z-40 fixed top-0 float-right   transform translate-x-0 transition duration-500 ease-in-out" :class="{ ' translate-x-full' : cartSlidebar}" >
        <div class=" absolute flex text-center px-4 top-0 z-20 border-b border-gray-200/70  dark:border-black/20 w-full h-12 lg:h-16 text-base md:text-lg text-green-500">     
            <span class="flex-1 justify-center m-auto">Shopping Cart</span>
            <button @click="aa(cartSlidebar), cartSlidebar = !cartSlidebar" as="button" class="flex-none m-auto float-right right-0 "> 
                    <font-awesome-icon icon="fa-solid fa-xmark" />
            </button>
        </div>
 
         <div id= "cartslidebar" class="overflow-y-auto top-12 lg:top-16 w-full h-full right-0 absolute " >   
             <div class=" overflow-y-auto pb-48 lg:pb-52 ">
             <div v-for="(carts,index) in cart" :key="carts.foodid" class=" flex px-4 pb-4 pt-4">
                 <!-- <div v-for="cartfood in cartfood(carts.foodid)" :key="cartfood.id" class="flex" > -->
                     <div  class="flex flex-row flex-none  align-content-center pr-3">
                         <button class=" text-cyan-500 text-base md:text-lg" @click="minus(index,carts.quantity,carts.foodprice,carts.additionprice, carts.totalprice)">-</button> 
                         <div :key="carts.foodid" class="mx-1 text-sm w-6 md:w-11 text-center my-auto" ref="qty">{{ quantity(carts.quantity)}}</div>
                         <button class="text-cyan-500 text-base md:text-lg" @click="add(index,carts.foodprice, carts.additionprice,carts.totalprice)">+</button> 
                     </div>
 
                 
                     <div  class="pr-3 flex-none m-auto hidden md:block" @click=" shoppingcartindexasign(index,carts.quantity), showDetail(carts.foodid), showSidebar = !showSidebar, additionalarray = carts.additionalarray" >
                         <img  :src= "`./images/${carts.foodimage}`"  alt="" class="w-16 h-16 md:w-20 md:h-20 rounded-md" >
                     </div>
 
                     <div  class=" flex-auto text-sm md:text-base" @click=" shoppingcartindexasign(index,carts.quantity), showDetail(carts.foodid), showSidebar = !showSidebar, additionalarray = carts.additionalarray" >
                         <span class="font-semibold">{{ carts.foodname }}</span>
                         <p v-for="additionalnames in carts.additionalname"  class="text-xs text-gray-600 dark:text-gray-300">
                             {{ additionalnames }}
                         </p>
                     </div>
                    <div  v-if="carts.quantity == 0" @click="remove(index)" class="cursor-pointer flex-none text-sm md:text-base font-bold text-red-600">
                        remove
                    </div>
                    <div v-else  class=" flex-none text-sm md:text-base">
                        {{  $filters.formattedCurrency(carts.totalprice) }}
                    </div>
                 <!-- </div> -->
             </div>
             
                 <div  class="p-4 flex border-t border-gray-200/70 dark:border-gray-500/30 text-sm md:text-base">
                     <div class="flex-1">Subtotal</div>
                     <div class="flex-none">{{  $filters.formattedCurrency(total()) }}</div>
                 </div>
             
             </div>
         </div>
        <div class=" p-4 h-20 md:h-28 lg:h-32 w-full z-20 absolute bottom-0 flex border-t bg-inherit border-gray-200  dark:border-black/20 shadow-inner">
            <div class=" flex-none flex-row my-auto">
                <div class=" text-base md:text-lg  font-medium pr-6">
                    <p class=" font-normal ">Total</p>
                    <p>{{  $filters.formattedCurrency(total()) }}</p>
                </div>
            </div>

            <Link :href="route('menu.checkout')" class="flex flex-1"> 
                <div class=" h-9 md:h-12  bg-green-600 rounded-md flex flex-1 my-auto justify-center text-center" @click="orderdetail = !orderdetail ,cartSlidebar = !cartSlidebar ">
                    <button class="align-middle bg-green-600 rounded-md text-sm md:text-base" >Confirm</button>  
                </div>
            </Link>
        
        </div>
     </div>
 
 </div>
 
 
 <!-- -------------------------- -->
 
 
 
 </template>
 
 <script setup>
 
 import Show from './Show.vue';
 import EmptyCart from './EmptyCart.vue'
 import Checkout from './Checkout.vue';
 import EmptySearch from './EmptySearch.vue'
 import NavigationBar from './NavigationBar.vue';
 import Loadingpage from './Loadingpage.vue'
//   const a= defineProps({
//      menus: Object,
//      categories: Object,
//      foodaddons: Object,
//      addons: Object,
//      addondetails: Object,
//      cart: Object,
//      orders: Object,
//      orderdetails: Object,

     
//  })
 
//  const addonfilter = (id)=>{
//      const foodaddonid = a.foodaddons.filter(el=>el.menu_id == id).map(el=>el)
 
//      let nowGraduated = []
 
//      function graduateStudent(id, index) {
 
//          const addon = a.addons.filter(el=>el.id == id).reduce(el=>el);
//          let object = { id: addon.id ,addon_name: addon.addon_name}
//          nowGraduated[index] = object
//      }
 
//      foodaddonid.forEach((name, index) => graduateStudent(name.id, index));
//      // const object = new addonfilter(id);
//      return nowGraduated
 
//  }
 
 // ///////// scroll is fixed when the sliderbar is shown
 // const aa = (para)=>{
 //     // console.log(para)
 //     const body = document.body
 //     // const slidebar = document.getElementById('slidebar')
 //     // const cartslidebar = document.getElementById('cartslidebar')
 //     if(para){
 //         // slidebar.style.overflow = 'auto';
 //         // cartslidebar.style.overflow = 'auto';
 //         body.style.overflow='hidden';
         
 //     }else{
 //         additionalarray = [];
 //         body.style.overflowY='auto';
 //     }
 // }
 // // end
 
 
 </script>
 
 <script>
 
 import { useForm, Link } from '@inertiajs/vue3';
 import { ref } from 'vue';
 import axios from 'axios';
 
 
 const showSidebar = ref(true)
 const cartSlidebar = ref(true)
 // const orderdetail = ref(true)
 const fakekeid = ref(0)
 const cost = ref(100)
 const agrement = ref(false)
 const currentsection = ref('')
 
 export default {
    inheritAttrs: false,

    props: {
     menus: Object,
     categories: Object,
     foodaddons: Object,
     addons: Object,
     addondetails: Object,
    //  cart: Object,
     orders: Object,
     orderdetails: Object,
  },
   
     setup() {
         return {     
         orderdetail,
        //  showSidebar: true,
        //  addondetails: Object,
         agrement: false,
         
     };
   },
     data(){
        return{ 
         
         clickfoodid: null,
         message: '',
         addplus: 1,
         foodid: 0,
         additionalarray: [],
         basedprice: 0,
         additionprice: 0,
         shoppingcartindex: null,
         storequantity: 1,
         checkid: null,
         // additionalname: []
         timeoutId: null,
         query: '',
         activeIndex: -1,
         myValue:null,
         cart: [],
         isLoading: true,
        //  windowHeight: window.innerHeight
         // cid: []
         
         };
     },
     
     methods: { 
         addonfilter(id){
            const foodaddonid = this.foodaddons.filter(el=>el.menu_id == id).map(el=>el)

            let nowGraduated = []
            
            const addons = this.addons;
            function graduateStudent(id, index) {

                const addon = addons.filter(el=>el.id == id).reduce(el=>el);
                let object = { id: addon.id ,addon_name: addon.addon_name}
                nowGraduated[index] = object
            }

            foodaddonid.forEach((name, index) => graduateStudent(name.id, index));
            // const object = new addonfilter(id);
            // console.log(nowGraduated)
            return nowGraduated
 
 },
         
         myAction(){
             cartSlidebar.value = true,
             console.log(cartSlidebar.value,'data accept');
 
         },
         shoppingcartindexasign(cartarrayindex, cartarrayquantity){
                 this.shoppingcartindex = cartarrayindex
                 this.addplus = cartarrayquantity
                 console.log(this.shoppingcartindex, this.addplus);
         },
 
         showDetail(id){
             const arr = this.menus.filter(el=>el.id == id).reduce(el=> el.id)
             
             this.clickfoodid = arr.id;
             // const a = this.clickfoodid
             const formattedprice = arr.product_price.toLocaleString('en-US',{
                                 style: 'currency', 
                                 currency: 'USD',
                                 minimumFractionDigits: 0
                             });
             this.$refs.name.innerHTML=arr.product_name;
             this.$refs.price.innerHTML= formattedprice;
             this.$refs.image.src = `./images/${arr.product_image}`
 
             //assign to foodprice varibale productprice in menus table
             this.basedprice = arr.product_price
         },
         // categoriesfilter(){
             
         //     console.log( this.categories.filter(el=>el.id == this.menus.map(el=>el.category_id)))
         // },
         menufilter(fakeId){
             const a = this.menus.filter(n=>n.category_id == fakeId) ;
             if(this.query){
                 
                     const b =  a.filter(el=> el.product_name.toLowerCase().trim().includes( this.query.toLowerCase().trim()))
                 //    this.cid= b.map(el=>el.category_id)
                 console.log(b);
                     return b;
                    
                 }else{
                     
                     return a;
                 }
             
             // return this.menus.filter(n=>n.category_id == fakeId) // fakeId is accepted the parameter given above
             },
        
 
 ///////// scroll is fixed when the sliderbar is shown
         aa(para){
             // console.log(para)
             const body = document.body;
             // const slidebar = document.getElementById('slidebar')
             // const cartslidebar = document.getElementById('cartslidebar')
            //  alert(showSidebar.value)
             if(para){
                //  slidebar.style.overflow = 'auto';
                //  cartslidebar.style.overflow = 'auto';
                 body.style.overflow='hidden';
                 
             }else if( showSidebar.value == false && cartSlidebar.value == false){
                body.style.overflow='hidden';

             }
             else{
                body.style.overflowY='auto';
                 this.additionalarray = [];
                 this.shoppingcartindex = null;
                 this.addplus = 1;
             }
         },
         // end
 
         checkboxdata(id){
             console.log(id)
             console.log(this.addondetails)
             // console.log(cost.value)
             
             const addondetailfilter = this.addondetails.filter(el=>el.id == id).reduce(el=>el)
             console.log(addondetailfilter.addondetail_price+cost.value)
             console.log(this.$refs.checkbox)
             console.log(agrement.value)
             console.log(this.$refs.one.innertext)
 
             if(!agrement.value){
                 this.foodprice = this.foodprice + addondetailfilter.addondetail_price
                 console.log(addondetailfilter.addondetail_price+cost.value)
                 this.message =addondetailfilter.addondetail_price+cost.value
                 console.log(this.foodprice )
 
             }else if(agrement.value){
                 this.foodprice = this.foodprice - addondetailfilter.addondetail_price
                 console.log(this.foodprice )
             }
             //additionalarray
             console.log(this.additionalarray)
 
 
 
 
         },
         menusfilterindetail(){
             const foodfilterindetail = this.menus.filter(el=>el.id == this.foodprice).reduce(el=>el)
             console.log(foodfilterindetail.id)
             this.foodprice= foodfilterindetail.product_price
         },
 
         addoneplus(){
             this.addplus++
             // console.log(this.addplus);
         },
         addoneminus(){
             console.log(this.addplus)
             if(this.addplus > 1){
                 this.addplus--
             }
         },
         
        //  menucart(action){

        
        //  // console.log(this.addplus,this.clickfoodid,this.shoppingcartindex, this.additionalarray)
         
        //  const cartarray= useForm(
             
        //      {
        //          'index' : this.shoppingcartindex,
        //          'foodid': this.clickfoodid,
        //          'action': action,
        //          // 'foodname': tocart.product_name,
        //          // 'foodimage': tocart.product_image,
        //          // 'foodprice': tocart.product_price,
        //          // 'additionprice': this.additionprice,
        //          'quantity': this.addplus,
        //          'additionalarray': this.additionalarray,
        //          // 'additionalname': this.additionalname
        //      }
         
        //  );
         
        //  this.additionprice = 0
        //  this.additionalarray = []
        //  this.addplus = 1
        //  this.shoppingcartindex= null
 
        //  return cartarray.post(route('menu.store'));
        //  },
        pageload(){
            
            this.isLoading = true;
            axios.post(route('menu.update'), {
                'cart' : JSON.parse(localStorage.cart),
            }).then(response => {
                this.isLoading = false;
                localStorage.removeItem('cart');
                this.cart = response.data;
            });
            return cartarray.post(route('menu.update'));
        },

        loadData(){
            axios.get(route('menu.getdata')).then(response => {
                this.isLoading = false;
                this.cart = response.data;
            })
            
        },
        menucart(action){
          
                // this.isLoading = true;
                
                axios.post(route('menu.store'), {
                    'index' : this.shoppingcartindex,
                    'foodid': this.clickfoodid,
                    'action': action,
                    'quantity': this.addplus,
                    'additionalarray': this.additionalarray,
                }).then (response => {  
                    this.loadData();
                    this.additionprice = 0
                    this.additionalarray = []
                    this.addplus = 1
                    this.shoppingcartindex= null
                  
                    })
                    
            },
         remove(index){
            axios.post(route('menu.remove'),{
                'index' : index,
            }).then(response => {
                this.loadData();
            })
            //  const cartarray = useForm(
            //      {
            //          'index' : index,
            //      }
            //  );
            //  return cartarray.post(route('menu.remove'));
         },
         quantity(quantity){
             
             return quantity
         },
 
         add(index,foodprice,additionprice, totalprice){
                 
                 // console.log(this.cart);
                 if(index !== -1){
                    
                     console.log(this.cart[index].quantity += 1)
                     console.log(this.cart[index].totalprice = foodprice + additionprice + totalprice)
                     
                     this.array =this.cart
                     
                     localStorage.setItem('cart', JSON.stringify(this.cart))
                     console.log(JSON.parse(localStorage.cart));
     
                 }
               
             },
             minus(index,quantity,foodprice,additionprice, totalprice){
                 console.log(this.cart);
                 if(quantity > 0){
                     console.log(this.cart[index].quantity -= 1)
                     console.log(this.cart[index].totalprice =  totalprice- (foodprice + additionprice) )
                     localStorage.setItem('cart', JSON.stringify(this.cart))
                     console.log(JSON.parse(localStorage.cart));
     
                     if(this.cart[index].quantity  == 0){
                         localStorage.removeItem('cart');
                     }
                 }
             },
        total(){ 
             // return this.filterprice.reduce((total, item) => total + item, 0);
             let totalPrice = this.filterprice.length > 0 ? this.filterprice.reduce((total, item) => total + item, 0) : 0
             // console.log(this.filterprice)
             return totalPrice
        },
        cartcount(){
            // const quantityarray= this.cart.map( (el) => el.quantity)
            // return this.cart.length > 0 ? quantityarray.reduce((count, storecount)=> count + storecount) : 0
            // return count
            if(this.cart.length > 0){
                const quantityarray= this.cart.map( (el) => el.quantity)
                const count = quantityarray.reduce((count, storecount)=> count + storecount,0)
                return count

                 }else{
                     return 0
                 }
        },
        onForwardNavigation() {
            this.showSidebar = true
        },
        searchAction(myValue){
            // this.myValue = value

            this.query = myValue
        },
        CartSlideFun(cartslidebar){
            cartSlidebar.value = cartslidebar
            // console.log(cartslidebar)
        },
        ////////////////////click Cateogry title in Navbar and Scroll to this title///////
        handleScroll(){
            const scrollY = window.scrollY; // get the current scroll Y position
            // const navbarheight = this.$refs.navheight.$refs.navheight.offsetHeight
            const navbarheight = document.getElementById('navbarheight').offsetHeight

            const heights = this.categoriesfilter.map(el => document.getElementById(el.id).offsetTop - navbarheight -2 );// get the offsetTop of each content section
            // console.log(heights)
            const activeIndex = heights.findIndex((height, index) => height > scrollY )-1; // find the index of the active section based on the scroll position
            if (activeIndex !== this.activeIndex) {
                this.activeIndex = activeIndex; // update the active index
                if(this.activeIndex == -2){
                    this.activeIndex = heights.length - 1
                }

            }
            this.scrlltoElementInNav(activeIndex+1)
           
        },
        scrollToElement(categroyid){
            // const navbarheight = this.$refs.navheight.$refs.navheight.offsetHeight
            const navbarheight = document.getElementById('navbarheight').offsetHeight
            const el = document.getElementById(categroyid).offsetTop - navbarheight;
            window.scrollTo({top: el ,behavior: 'smooth' });
           
        },
        scrlltoElementInNav(navcategroyid){
            const navbar = document.getElementById("navbarCategoryName");
            const categoryIdOffset = document.getElementById('id-' + navcategroyid).offsetLeft - (navbar.offsetWidth/4); //Navbar Category Title Center
            navbar.scrollTo({left: categoryIdOffset ,inline: 'center'})
            
        }
        ///////////////  End  /////////////////
        
    },
     
    // unmounted: function(){
    //     orderdetail = true
    //      showSidebar= true
    // },
    mounted: function(){
        console.log(this.cart)
        // this.loadData();
        window.onpopstate = () => {  // if you click he browser defaullt back and forward button, run this  
            showSidebar.value = true;
            cartSlidebar.value = true;
        };
         document.getElementById("app").removeAttribute('data-page'); // delete data-page attribute in console
       
        window.addEventListener('scroll', this.handleScroll); // scroll and run the handScroll function
        // localStorage.removeItem('cart');
        // if(localStorage.getItem('cart') !== null){
        //     // alert(localStorage.cart)
        //     const cartarray= useForm(
            
        //     {
        //         'cart' : JSON.parse(localStorage.cart),
        //     }
        //     );
        //     localStorage.removeItem('cart');
        //     return cartarray.post(route('menu.update'));
        // }

        if(localStorage.getItem('cart') !== null){
            this.pageload();
        }else{
            this.loadData();
        }

    },
    
    
         computed: {
             categoriesfilter(){
                 if(this.query){
                     const MenusFilterwithSearch =  this.menus.filter(el=> el.product_name.toLowerCase().trim().includes( this.query.toLowerCase().trim())).map(el=>el.category_id);
                     const MenusFilterwithSearchArr =  Array.from(new Set(MenusFilterwithSearch)); //  to Array
                     return this.categories.filter(el=>MenusFilterwithSearchArr.includes(el.id));
                 }else{
                     const CatergoriesFilterId = new Set(this.menus.map(el=>el.category_id)); //filterid in menu 
                     const CatergoriesFilterIdArr = Array.from(CatergoriesFilterId); //  to Array
                     return this.categories.filter(el=>CatergoriesFilterIdArr.includes(el.id));
                 }
             
         },
             price(){
                 this.additionprice = 0
                 this.additionalname =[]
                 console.log(this.additionalarray)
                 for(let i=0;i<this.additionalarray.length;i++){
                     console.log(this.additionalarray[i])
 
                     // this.additionalarray.filter(el=>el[i] == )
                     const price = this.addondetails.filter(el=>el.id == this.additionalarray[i]).reduce(el=>el)
                     console.log(price.addondetail_price)
 
                     this.additionprice += price.addondetail_price
                     this.additionalname[i] = price.addondetail_name
 
                     console.log(this.additionprice)
                     console.log(this.additionalname)
                     
                 }
             },
             filterprice(){
                 if(this.cart.length >0){
                     return this.cart.map( (el) => el.totalprice)
                 }else{
                     return 0
                 }
                 
             }
             
 
 }
 
 }
 
 
 </script>


<style>
nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #ffffff;
  opacity: 0.5;
  z-index: 1;
}

ul {
  display: flex;
  justify-content: center;
  list-style: none;
  margin: 0;
  padding: 0;
}

li {
  margin: 0 1rem;
  font-size: 1.2rem;
}

.active {
  color: #ff0000;
}
</style>
