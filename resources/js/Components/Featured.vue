<template>
    <q-carousel
        v-model="slide"
        swipeable
        animated
        infinite
        padding
        arrows
        navigation
        transition-next="slide-left"
        transition-prev="slide-right"
        height="500px"
        class="bg-transparent shadow-16 rounded-borders"
    >
        <q-carousel-slide v-for="phone in phones" :name="phones.indexOf(phone)" class="column no-wrap flex-center" img-src="https://images.unsplash.com/photo-1604160687499-0547fda285f6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80">
            <div class="text-white text-bold text-center glass-3 y-active-dark-white q-pa-sm rounded-borders">
                <h3>{{ phone.model }}</h3>
                <p>
                    In stunning Colors: {{ phone.misc_colors }} for only {{ phone.smartphone_prices[0].price }}{{ phone.smartphone_prices[0].currency.symbol }}
                </p>
            </div>
        </q-carousel-slide>
    </q-carousel>

</template>

<script>
import { ref } from 'vue'

export default {
    data() {
        return {
            phones: ''
        }
    },
    mounted() {
        axios
            .get(this.route('api.smartphone.getFeatured'))
            .then(response => (this.phones = response.data))
    },
    setup () {
        return {
            slide: ref(0),
        }
    }
}
</script>

<style scoped>

</style>
