<template>
    <q-card class="y-scale-hover-2 y-hover-dark-white shadow-6 bg-accent text-white" style="border-radius: 12px;">

        <q-img :ratio="1" style="border-radius: 12px;" src="https://images.unsplash.com/photo-1611740677496-3e0ef378e189?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1040&q=80" />
        <q-card-section style="border-radius: 12px;">
            <q-btn @click="startLoading" :loading="loading" size="sm" color="primary" class="y-hover-primary y-ty-hover-up" style="position: absolute; top: -35px; border-radius: 12px;">
                <q-icon :name="icon" class="material-icons-outlined" />
            </q-btn>
            <div class="row no-wrap items-center">
                <div class="col text-h6 ellipsis">
                    {{ smartphone.model }}
                    <span class="text-caption q-ml-sm">{{ smartphone.brand.brand }}</span>
                </div>
            </div>

            <q-rating :model-value="getRating"
                      icon-selected="star"
                      icon-half="star_half"
                      color="warning"
                      :max="5"
                      size="32px" />
            <span class="text-caption text-grey-1 q-ml-sm">{{ getRating }} ({{ smartphone.ratings_count }})</span>
        </q-card-section>

        <q-card-section class="q-pt-none">
            <div class="text-subtitle1">
                {{ smartphone.smartphone_prices[0].price }}{{ smartphone.smartphone_prices[0].currency.symbol }}
            </div>
            <div class="text-caption text-grey">
                {{ smartphone.memory_internal }}
            </div>
            <div class="text-caption text-grey">
                {{ smartphone.display_size }}
            </div>
        </q-card-section>

        <q-separator/>

        <q-card-actions>
            <Link :href="route('phone.show', smartphone.id)">
                <q-btn color="primary" class="y-ty-hover-up" outline label="Details" />
            </Link>
        </q-card-actions>
    </q-card>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "ProductCardNew",
    components: { Link, },
    props: {
        smartphone: {
            default: null,
            type: Object
        },
    },
    data () {
        return {
            rating: this.smartphone.ratings_avg_stars || 0,
            loading: false,
            icon: 'shopping_cart',
        }
    },
    computed: {
        getRating() {
            return parseFloat(this.rating.toPrecision(2));
        }
    },
    methods: {
        startLoading() {
            if (this.$page.props.isAuth !== true) return this.emitter.emit('g:requiresLogin', true);

            this.loading = !this.loading;
            setTimeout(() => {
                this.emitter.emit('g:addItemToCart', this.smartphone.model);
                this.loading = !this.loading;
                this.icon = 'done';
            }, 2000)
        }
    }
}
</script>

<style scoped>

</style>
