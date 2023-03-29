
<template >

<nav>
    <ul>
      <li v-for="(category, index) in categoriesfilter" :key="category.id" class=" relative" :class="{  'text-red-500' : index === activeIndex}" >
        <a @click="scrollToElement(category.id)" class=" cursor-pointer">{{ category.category_name }}</a>
      </li>
    </ul>
  </nav>
    <div>
     <input type="text" v-model="query" @input="search" class=" border border-gray-300 rounded-lg" />
     <!-- <ul>
       <li>
         {{ result.name }} - {{ result.email }}
         ssssss
       </li>
     </ul> -->
   </div>
     <button class=" h-20 w-14 bg-gray-900" @click="test(1)">sldjlsjl</button>
 <!-- kjllhnlsdnklndsklcnlksdnlskndlksdnckl -->
 <button @click=" shoppingCart,aa(cartSlidebar),cartSlidebar = !cartSlidebar"  class=" text-red-500 w-20 h-30 border border-r-neutral-800">Cart {{ cartSlidebar }} {{ showSidebar }} </button>
 <div v-for="carts in cart">cartSlidebar
     {{ carts }}
 </div>
 <Show :menus="menus"/>
 <!-- <div>sfsfsf{{ array }}</div> -->
 <!-- <div>{{ session('cart') }}</div> -->
 <div  class=" text-lg text-blue-600 font-bold" ref="one">
     {{ message }}
 </div>
 <div>Checked additionalid: {{ additionalarray }}</div>
 <div>Checked additionalid: {{ shoppingcartindex }}</div>
 <!-- <div>Checked additionalnames: {{ additionalname }}</div>-->
 <div>Checked names: {{ price, categoriesfilter}}</div> 
 <!-- <div>Checked names: {{ subtotal }}</div> -->
 
 <div >
     <h3>All</h3>
     <!-- <button @click="scrollToElement">Scroll to {{targetId}}</button> -->
     <div v-for="category in categories" :key="category.id">
         <button @click="scrollToElement(category.id)">{{ category.category_name }}</button>
     </div>
 
 </div>
 
 
 
 <!-- ///////Start => Filter menu data by Category -->
 <!-- :class="{ '-translate-x-full' : showSidebar}" @click="showSidebar = !showSidebar" -->
 <!-- <div > -->
     <EmptySearch v-if="categoriesfilter.length <= 0"/>
     <div v-else v-for="category in categoriesfilter" :key="category.id" :id="category.id" class=" relative h-full" >
         <span>{{ category.category_name }}</span>
         <div class="container m-auto p-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 relative ">
         
            <div v-for="menu in menufilter(category.id)" :key="menu.id">  <!-- to given the parameter in menufilter=>located (export default=>methods) -->
                 <div class="bg-white dark:bg-gray-800 rounded-md px-2 py-2 ring-1 ring-slate-900/5 shadow-md">
                     <div>
                         <a @click="showDetail(menu.id),aa(showSidebar),addonfilter(menu.id),showSidebar = !showSidebar, fakekeid = menu.id" >
                             <img :src="`./images/${ menu.product_image }`">
                         </a>
                     </div>
     
                     <h3 class="text-slate-700 dark:text-white mt-2 text-base tracking-tight">{{ menu.product_name }}</h3>
                     <p class="text-slate-500 dark:text-slate-400 text-xs">{{ menu.product_description }}</p>
     
                     <div class="flex justify-between mt-6">
                         <p class="inline-block text-green-500">{{ $filters.formattedCurrency(menu.product_price) }}</p>
     
                         <button>sdd</button>
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
 <div  class='w-full h-full bg-gray-600/50 fixed z-40 top-0 overflow-x-hidden overflow-y-auto '  :class="{ 'translate-x-full' : showSidebar}" @click="aa(showSidebar),showSidebar = !showSidebar">
 </div>
 <div  class=" bg-white w-full h-full md:w-2/3 lg:w-2/4 xl:w-2/5 right-0 z-50 fixed float-right top-0  transform translate-x-0 transition duration-500 ease-in-out" :class="{ ' translate-x-full' : showSidebar}" >    
             <div class=" border-b  border-gray-200/70 w-full h-10 lg:h-16 bg-white">     
                 <button @click="aa(showSidebar), showSidebar = !showSidebar" as="button">+++ Timer</button>
                 <div>{{ showSidebar }}</div>
             </div>
         <div id= "showSidebar" class="overflow-y-auto top-16 w-full  h-full pb-40 right-0 absolute  " >
             <div class="grid grid-cols-4 p-6 bg-white">
                 <div id="imgDiv" class="pr-6">
                     <img id="imgUpload" src="" ref="image" alt="" class="rounded-md ">
                 </div>
                 <div ref="name" class="col-span-2 font-semibold text-lg "></div>
                 <div ref="price" class=" font-semibold text-lg flex justify-end"></div>
             </div>
             
             <div v-for="addon in addonfilter(clickfoodid)" :key="addon.id" class="p-6 bg-white my-2">
                 <span class=" text-lg font-bold text-red-600">Add On {{ addon.addon_name}}</span>
                 <div v-for="addondetail in addondetails" :key="addondetail.id">
                     <div v-if="addondetail.addon_id == addon.id" class= " py-4 border-b border-gray-200/70">
                         <input type="checkbox" class=" h-6 w-6 align-middle" :id="addondetail.id" v-model="additionalarray" :value="addondetail.id" >
                         <span class=" pl-4 align-middle">{{ addondetail.addondetail_name }}</span>
                        
                         <span class="float-right">{{ $filters.formattedCurrency(addondetail.addondetail_price) }}</span>
                     </div>
                 </div>
             </div>
         </div>
 
         <div class=" w-full h-24 bg-white z-20 absolute bottom-0 border-t border-gray-200  shadow-inner shadow-gray-200/50 grid grid-cols-3 p-4">
             <div class=" flex flex-row justify-around mr-4 py-3 pl-2">
                 <button class="w-11 rounded-md border border-gray-300 shadow-sm" @click="addoneplus">+</button> 
                 <p ref="p" class="m-auto">{{addplus}}</p>
                 <button class="w-11 rounded-md border border-gray-300 shadow-sm" @click="addoneminus">-</button> 
 
             </div>
             <div class=" col-span-2 ml-4 p-2">
                 <button class="w-full h-full bg-green-600 rounded-md" @click="menucart(),aa(showSidebar),showSidebar = !showSidebar">Add to basket {{  $filters.formattedCurrency((basedprice+additionprice)*addplus)}}</button>
             </div> 
         </div>
 
     </div>
   
 <!-- -------------- -->
 
 <!-- <Checkout :orders="orders" :orderdetails="orderdetails" /> //v-if="0" -->
 <EmptyCart :cartSlidebar="cartSlidebar" v-if="!cart" @myevent="myAction()" />
 <!-- ------ Shopping cart Detail Slidebar --> 
 <div v-else>
 <div  class='w-full h-full bg-gray-600/50 fixed z-10  top-0 overflow-x-hidden overflow-y-auto '  :class="{ 'translate-x-full' : cartSlidebar}" @click="aa(cartSlidebar),cartSlidebar = !cartSlidebar">
 </div>
    <div  class=" bg-white w-full md:w-2/3 lg:w-2/4 xl:w-2/5 h-full right-0  z-10 fixed top-0 float-right   transform translate-x-0 transition duration-500 ease-in-out" :class="{ ' translate-x-full' : cartSlidebar}" >
   
         <div class=" absolute top-0 z-20 border-b border-gray-200/70 w-full h-10 lg:h-16 bg-white">     
             <button @click="aa(cartSlidebar), cartSlidebar = !cartSlidebar" as="button">+++ Timer</button>
             <div>{{ cartSlidebar }}</div>
         </div>
 
         <div id= "cartslidebar" class="overflow-y-auto top-10 lg:top-16   w-full  h-full right-0 absolute" >   
             <div class=" overflow-y-auto pb-48 lg:pb-52">
             <div v-for="(carts,index) in cart" :key="carts.foodid" class=" flex p-6 bg-white  ">
                 <!-- <div v-for="cartfood in cartfood(carts.foodid)" :key="cartfood.id" class="flex" > -->
                     <div  class="flex flex-row flex-none  align-content-center pr-3">
                         <button class=" text-cyan-500 text-lg" @click="minus(index,carts.quantity,carts.foodprice,carts.additionprice, carts.totalprice)">-</button> 
                         <div :key="carts.foodid" class="my-auto mx-2 text-sm w-6 text-center" ref="qty">{{ quantity(carts.quantity)}}</div>
                         <button class="text-cyan-500 text-lg" @click="add(index,carts.foodprice, carts.additionprice,carts.totalprice)">+</button> 
                     </div>
 
                 
                     <div  class="pr-3 flex-none m-auto" @click=" shoppingcartindexasign(index,carts.quantity), showDetail(carts.foodid), showSidebar = !showSidebar, additionalarray = carts.additionalarray">
                         <img  :src= "`./images/${carts.foodimage}`"  alt="" class="w-20 h-20 rounded-md" >
                     </div>
 
                     <div  class=" flex-auto ">
                         <span class="font-semibold text-md">{{ carts.foodname }}</span>
                         <p v-for="additionalnames in carts.additionalname"  class="text-xs">
                             {{ additionalnames }}
                         </p>
                     </div>
                     <div  v-if="carts.quantity == 0" @click="remove(index)" class="cursor-pointer flex-none text-base font-bold text-red-600">
                         remove
                     </div>
                     <div v-else  class=" flex-none text-base">
                         {{  $filters.formattedCurrency(carts.totalprice) }}
                     </div>
                         
                 <!-- </div> -->
             </div>
             
                 <div  class="p-6 flex border-t border-gray-200/70">
                     <div class="flex-1">Subtotal</div>
                     <div class="flex-none">{{  $filters.formattedCurrency(total()) }}</div>
                 </div>
             
             </div>
         </div>
        <div class="h-36 w-full px-6 bg-white z-20 absolute bottom-0  border-t border-gray-200/70  shadow-inner shadow-gray-200/50 ">
             <div class="text-xl py-5 font-medium flex">
                 <p class="flex flex-1">Total</p>
                 <p>{{  $filters.formattedCurrency(total()) }}</p>
             </div>
       
             <Link :href="route('menu.checkout')">
             <div class=" h-12 bg-green-600 rounded-md flex justify-center" @click="orderdetail = !orderdetail ,cartSlidebar = !cartSlidebar ">
                 <button class="align-middle bg-green-600 rounded-md" >Confirm </button>
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
 
 
 
 
 const scrollToElement = (ac) =>  {
   const el = document.getElementById(ac);
     // console.log(ac)
   if (el) {
     el.scrollIntoView({ behavior: 'smooth' });
   }
 }
 
 
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
     cart: Object,
     orders: Object,
     orderdetails: Object,
  },
   
     setup() {
         return {     
         orderdetail,
         showSidebar: true,
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
         activeIndex: -1
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
            console.log(nowGraduated)
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
         
         menucart(action){
         // console.log(this.addplus,this.clickfoodid,this.shoppingcartindex, this.additionalarray)
         
         const cartarray= useForm(
             
             {
                 'index' : this.shoppingcartindex,
                 'foodid': this.clickfoodid,
                 'action': action,
                 // 'foodname': tocart.product_name,
                 // 'foodimage': tocart.product_image,
                 // 'foodprice': tocart.product_price,
                 // 'additionprice': this.additionprice,
                 'quantity': this.addplus,
                 'additionalarray': this.additionalarray,
                 // 'additionalname': this.additionalname
             }
         
         );
         
         this.additionprice = 0
         this.additionalarray = []
         this.addplus = 1
         this.shoppingcartindex= null
 
         return cartarray.post(route('menu.store'));
         },
         remove(index){
             const cartarray = useForm(
                 {
                     'index' : index,
                 }
             );
             return cartarray.post(route('menu.remove'));
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
        
        handleScroll(){
            const scrollY = window.scrollY; // get the current scroll Y position
            const heights = this.categoriesfilter.map(el => document.getElementById(el.id).offsetTop );// get the offsetTop of each content section
            const activeIndex = heights.findIndex((height, index) => height > scrollY )-1; // find the index of the active section based on the scroll position
            if (activeIndex !== this.activeIndex) {
                this.activeIndex = activeIndex; // update the active index
                if(this.activeIndex == -2){
                    this.activeIndex = heights.length-1
                }

            }
           
        }
        
    },
        
    mounted: function(){
      
         document.getElementById("app").removeAttribute('data-page'); // delete data-page attribute in console
       
    window.addEventListener('scroll', this.handleScroll); // scroll and run the handScroll function
        // localStorage.removeItem('cart');
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
                 if(this.cart){
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
