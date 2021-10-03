<template>
    <q-layout view="hHh LpR lFf">
        <q-header reveal>
            <q-toolbar class="bg-accent">
                <q-btn dense flat icon="menu" round @click="toggleLeftDrawer"/>
                <q-toolbar-title>
                    <Link :href="this.route('shop.index')" class="">Smartphoneportal</Link>
                </q-toolbar-title>

                <!-- logged out -->
                <template v-if="this.$page.props.isAuth !== true">
                    <q-btn class="q-mr-xs" dense flat icon="login" round @click="authModal = true"/>
                </template>
                <!-- logged in -->
                <template v-else>
                    <q-btn :class="this.userShoppingCart.length > 0 ? 'y-active-text-primary' : ''" flat>
                        <q-icon class="material-icons-outlined" name="shopping_cart"/>
                        <q-badge v-if="this.userShoppingCart.length > 0" :label="this.userShoppingCart.length"
                                 color="primary" floating
                                 rounded/>
                    </q-btn>
                    <q-btn-dropdown
                        :icon="`img:https://avatars.dicebear.com/api/bottts/${this.$page.props.auth.user.id}.svg`" flat
                        rounded>
                        <q-list class="bg-accent text-white">
                            <q-item v-close-popup class="y-text-hover-dark-white" clickable>
                                <q-item-section>
                                    <q-item-label>Settings</q-item-label>
                                </q-item-section>
                            </q-item>

                            <q-separator/>

                            <q-item v-close-popup class="y-text-hover-dark-white" clickable @click="logout()">
                                <q-item-section>
                                    <q-item-label>Logout</q-item-label>
                                </q-item-section>
                            </q-item>
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
                <Link :href="this.route('shop.index')">
                    <q-item v-ripple
                            :active="this.route().current('shop.index')"
                            :class="this.route().current('shop.index') ? 'y-active-primary' : ''"
                            class="y-ty-hover-up y-hover-white" clickable>
                        <q-item-section avatar>
                            <q-icon :class="this.route().current('shop.index') ? 'y-active-text-primary' : ''"
                                    name="home"/>
                        </q-item-section>

                        <q-item-section :class="this.route().current('shop.index') ? 'y-active-text-primary' : ''">
                            Home
                        </q-item-section>
                    </q-item>
                </Link>
                <Link :href="this.route('shop.index')">
                    <q-item v-ripple
                            :active="this.route().current('shop.detail')"
                            :class="this.route().current('shop.show') ? 'y-active-primary' : ''"
                            class="y-ty-hover-up y-hover-white" clickable>
                        <q-item-section avatar>
                            <q-icon :class="this.route().current('shop.detail') ? 'y-active-text-primary' : ''"
                                    name="settings"/>
                        </q-item-section>

                        <q-item-section :class="this.route().current('shop.detail') ? 'y-active-text-primary' : ''">
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

    <AuthModal v-model:isOpen="authModal"/>

    <q-dialog v-model="showToast" class="q-pt-xl" position="top"
              transition-hide="scale" transition-show="scale">
        <q-card class="bg-positive text-white" style="width: 300px">

            <q-card-section class="row items-center justify-center">
                <q-icon class="q-mr-sm" name="check" size="24px"/>
                <span>{{ this.toastMsg }}</span>
                <q-space/>
                <q-btn v-close-popup dense flat icon="close" round/>
            </q-card-section>

        </q-card>
    </q-dialog>
    <q-dialog v-if="!$page.props.isAuth" v-model="openRequiresLogin" persistent transition-hide="scale"
              transition-show="scale">
        <q-card class="text-negative" style="width: 300px;border-left: 5px solid #fe4657;">
            <q-card-section class="" style="">
                <div class="text-h6">
                    <q-icon class="" color="negative" name="warning" size="48px"/>
                </div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                This action requires to be logged in!
            </q-card-section>


            <q-card-actions align="right" class="bg-white text-teal">
                <q-btn v-close-popup color="dark" flat label="Cancel"
                       @click="requiresLogin = false"/>
                <q-btn v-close-popup color="primary"
                       icon="login"
                       push
                       label="Login" @click="requiresLogin = false; authModal = true"/>
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
        requiresLogin: {type: Boolean, default: false}
    },
    setup() {
        const leftDrawerOpen = ref(false);
        const authModal = ref(false)
        return {
            leftDrawerOpen,
            authModal,
            miniState: ref(true),
            toggleLeftDrawer() {
                leftDrawerOpen.value = !leftDrawerOpen.value;
            },
        }
    },
    data() {
        return {
            openRequiresLogin: this.requiresLogin,
            showToast: false,
            toastMsg: '',
            userShoppingCart: []
        }
    },
    mounted() {
        this.emitter.on('g:requiresLogin', requiresLogin => {
            this.openRequiresLogin = requiresLogin
        });

        this.emitter.on('g:addItemToCart', item => {
            this.userShoppingCart.push(item);
        });

        this.emitter.on('g:showToast', msg => {
            this.toastMsg = msg;
            this.showToast = true;
            setTimeout(() => {
                this.showToast = false
            }, 2000)
        })
    },
    methods: {
        logout() {
            this.$inertia.visit(this.route('logout'), {
                method: 'post',
                onSuccess: () => this.emitter.emit('g:showToast', 'Logged out!')
            });
        }
    }
}
</script>
