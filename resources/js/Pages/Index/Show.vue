 <template>

  <div v-for="n in 10">{{ n }}</div>

</template>

<script setup>
import { ref } from 'vue';
 const a= defineProps({
    menus: Object,

    
})
</script>

