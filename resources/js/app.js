import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '../css/app.css'
import MainLayout from '../js/Layouts/MainLayout.vue'
import {ZiggyVue} from 'ziggy'
import { MotionPlugin } from '@vueuse/motion'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faL, faStar, faXmark, faMagnifyingGlass, faLocationDot, faUtensils, faGlobe, faCartShopping} from '@fortawesome/free-solid-svg-icons'



/* add icons to the library */
library.add(faStar,faXmark,faMagnifyingGlass, faLocationDot, faUtensils, faGlobe, faCartShopping)

/* add font awesome icon component */


createInertiaApp({
  progress: {
    delay: 0,
    color: '#29d',
  },
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page= await pages[`./Pages/${name}.vue`]
    // page.default.layout= page.default.layout || MainLayout

    return  page
  },
  setup({ el, App, props, plugin }) {
    const Vueapp = createApp({render: () => h(App, props)});

    Vueapp.config.globalProperties.$filters = {
      formattedCurrency(value){
        // value =(value/100)
        return value.toLocaleString('en-US',{
          style: 'currency', 
          currency: 'USD',
          minimumFractionDigits: 0
        })
      },
    }
    // createApp({ render: () => h(App, props) })
    Vueapp
      .component('font-awesome-icon', FontAwesomeIcon )
      .use(plugin)
      .use(ZiggyVue)
      .use(MotionPlugin)
      .mount(el)
  }
  
})
