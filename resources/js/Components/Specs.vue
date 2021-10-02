<template>
    <div class="full-width q-mt-md q-pa-md row no-wrap justify-center items-center y-scale-hover-1 y-trigger">
        <div class="col-1 offset-xs-0 offset-sm-0 offset-md-3 row justify-end">
            <q-icon class="y-specs-text-shadow" :name="icon" :size="size" :color="color" />
        </div>
        <q-separator class="q-mx-md y-specs-shadow" :color="color" vertical />
        <div class="col">
            {{ data }}
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Specs',
    props: {
        color: {type: String, default: 'primary'},
        data: {type: String, default: ''},
        icon: {type: String, default: 'star'},
        size: {type: String, default: '24px'}
    }
}
</script>
