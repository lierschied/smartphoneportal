<template>
    <Featured/>
    <div class="row justify-center">
        <q-intersection v-for="smartphone in $page.props.smartphones.data"
                        :key="smartphone.id" style="width: 400px; height: 650px;">
            <ProductCard :smartphone="smartphone"
                         class="q-ma-md"/>
        </q-intersection>
    </div>
    <div class="q-pa-lg flex flex-center">
        <q-pagination
            v-model="currentPage"
            :max="this.$page.props.smartphones.last_page"
            :max-pages="6"
            boundary-numbers
            direction-links
            outline />
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import App from "@/Layouts/AppLayout";
import ProductCard from "@/Components/ProductCard";
import Featured from "@/Components/Featured";

export default {
    components: {
        Featured,
        App,
        ProductCard,
        Head,
        Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    data() {
        return {
            currentPage: this.$page.props.smartphones.current_page,
        }
    },
    watch: {
        currentPage(newPage, oldPage) {
            if (newPage !== oldPage) {
                this.$inertia.visit(this.route('shop.index', {page: newPage}, {
                    preserveState: true,
                }));
            }
        }
    },
    layout: [App]
}
</script>
