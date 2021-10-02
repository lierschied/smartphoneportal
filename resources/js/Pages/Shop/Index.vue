<template>
    <Featured />
    <div class="row justify-center">
        <q-intersection v-for="smartphone in $page.props.smartphones.data"
                        :key="smartphone.id" style="width: 400px; height: 650px;">
            <ProductCard :smartphone="smartphone"
                         class="q-ma-md"/>
        </q-intersection>
    </div>
</template>

<style scoped>

</style>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import App from "@/Layouts/AppLayout";
import ProductCard from "@/Components/ProductCardNew";
import Featured from "@/Components/Featured";

export default {
    components: {
        Featured,
        App,
        ProductCard,
        Head,
        Link,
    },
    layout: [App],
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    }
}
</script>
