<template>
    <q-layout view="hHh LpR lFf">
        <q-header reveal>
            <q-toolbar class="bg-accent">
                <q-btn dense flat icon="menu" round @click="toggleLeftDrawer"/>
                <q-toolbar-title>
                    <Link :href="route('phones')" class="">Smartphoneportal</Link>
                </q-toolbar-title>

                <!-- logged out -->
                <template v-if="$page.props.isAuth !== true">
                    <q-btn class="q-mr-xs" dense flat icon="login" round @click="authModal = true"/>
                    <AuthModal v-model:isOpen="authModal" @update:isOpen="authModal"/>
                </template>
                <!-- logged in -->
                <template v-else>
                    <q-btn :class="this.userShoppingCart.length > 0 ? 'y-active-text-primary' : ''" flat>
                        <q-icon class="material-icons-outlined" name="shopping_cart"/>
                        <q-badge v-if="this.userShoppingCart.length > 0" :label="this.userShoppingCart.length" color="primary" floating
                                 rounded/>
                    </q-btn>
                    <q-btn-dropdown :icon="`img:https://avatars.dicebear.com/api/bottts/${this.$page.props.auth.user.id}.svg`" flat
                                    rounded>
                        <q-list class="bg-accent text-white">
                            <q-item v-close-popup clickable class="y-text-hover-dark-white">
                                <q-item-section>
                                    <q-item-label>Settings</q-item-label>
                                </q-item-section>
                            </q-item>

                            <q-separator />

                            <Link :href="route('logout')" method="post" @click="logout">
                                <q-item v-close-popup clickable class="y-text-hover-dark-white">
                                    <q-item-section>
                                        <q-item-label>Logout</q-item-label>
                                    </q-item-section>
                                </q-item>
                            </Link>
                        </q-list>
                    </q-btn-dropdown>
                </template>

            </q-toolbar>
        </q-header>
        <q-drawer v-model="leftDrawerOpen" :mini="miniState"
                  class="bg-accent text-white"
                  side="left">
            <!-- drawer content -->
            <q-list padding>
                <Link :href="route('phones')">
                    <q-item v-ripple
                            :active="route().current('phones')" :class="route().current('phones') ? 'y-active-primary' : ''"
                            class="y-ty-hover-up y-hover-white" clickable>
                        <q-item-section avatar>
                            <q-icon :class="route().current('phones') ? 'y-active-text-primary' : ''" name="home"/>
                        </q-item-section>

                        <q-item-section :class="route().current('phones') ? 'y-active-text-primary' : ''">
                            Home
                        </q-item-section>
                    </q-item>
                </Link>
                <Link :href="route('phones')">
                <q-item v-ripple
                        :active="route().current('phone.show')" :class="route().current('phone.show') ? 'y-active-primary' : ''"
                        class="y-ty-hover-up y-hover-white" clickable>
                    <q-item-section avatar>
                        <q-icon :class="route().current('phone.show') ? 'y-active-text-primary' : ''" name="settings"/>
                    </q-item-section>

                    <q-item-section :class="route().current('phone.show') ? 'y-active-text-primary' : ''">
                        Settings
                    </q-item-section>
                </q-item>
                </Link>
                <div class="absolute" style="bottom: 65px; right: -17px">
                    <q-btn
                        v-ripple
                        :class="miniState ? 'y-active-dark-white' : 'y-active-primary'"
                        :icon="miniState ? 'chevron_right' : 'chevron_left'"
                        class="y-ty-hover-up"
                        round
                        size="sm"
                        text-color="white"
                        unelevated
                        @click="miniState = !miniState"
                    />
                </div>
            </q-list>
        </q-drawer>

        <q-page-container>
            <q-page class="bg-dark" padding>
                <slot></slot>
            </q-page>
        </q-page-container>

        <q-footer class="text-black bg-accent" reveal>
            <q-toolbar>
                <q-toolbar-title>
                    <div>Footer</div>
                </q-toolbar-title>
            </q-toolbar>
        </q-footer>

    </q-layout>

    <q-dialog v-model="showLoggedOut" position="top" transition-hide="scale"
              transition-show="scale" class="q-pt-xl">
        <q-card class="bg-positive text-white" style="width: 300px">

            <q-card-section class="row items-center justify-center">
                <q-icon class="q-mr-sm" name="check" size="24px"/>
                <span>Logged out!</span>
                <q-space/>
                <q-btn v-close-popup dense flat icon="close" round/>
            </q-card-section>

        </q-card>
    </q-dialog>
    <q-dialog v-if="!$page.props.isAuth" v-model="openRequiresLogin" persistent transition-hide="scale"
              transition-show="scale">
        <q-card class="bg-negative text-white" style="width: 300px">
            <q-card-section>
                <div class="text-h6">
                    <q-icon class="" color="white" name="warning" size="48px"/>
                </div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                This action requires to be logged in!
            </q-card-section>

            <q-card-actions align="right" class=" text-teal">
                <q-btn v-close-popup color="dark" flat label="Cancel"
                       @click="$emit('update:requiresLogin', false)"/>
                <q-btn v-close-popup color="primary"
                       label="Login" @click="$emit('update:requiresLogin', false); authModal = true"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script>
import {ref} from 'vue';
import AuthModal from '@/Pages/Auth/AuthModal';
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "App",
    components: {AuthModal, Link},
    props: {
        authModal: {type: Boolean, default: false},
        requiresLogin: {type: Boolean, default: false}
    },
    data() {
        return {
            openRequiresLogin: this.requiresLogin,
            showLoggedOut: false,
            userShoppingCart: []
        }
    },
    methods: {
        logout() {
            this.showLoggedOut = true;
            setTimeout(() => {
                this.showLoggedOut = false
            }, 2000)
        },
    },
    setup() {
        const leftDrawerOpen = ref(false);

        return {
            leftDrawerOpen,
            miniState: ref(true),
            toggleLeftDrawer() {
                leftDrawerOpen.value = !leftDrawerOpen.value;
            },
        }
    },
    mounted() {
        this.emitter.on('g:requiresLogin', requiresLogin => {
            this.openRequiresLogin = requiresLogin
        });

        this.emitter.on('g:addItemToCart', item => {
            this.userShoppingCart.push(item);
        });
    }
}
</script>

<style scoped>

</style>
