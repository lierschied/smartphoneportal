<template>
    <q-dialog v-model="isOpen" persistent transition-hide="slide-up" transition-show="slide-down">
        <q-card class="bg-gradient-dark-br text-white" style="width: 100%;">
            <q-card-actions align="right">
                <q-btn flat icon="close" @click="$emit('update:isOpen', false)"/>
            </q-card-actions>
            <q-card-section class="row items-center justify-center">
                <q-icon color="primary" name="account_circle" size="48px"/>
            </q-card-section>
            <q-tabs v-model="tab" class="text-primary">
                <q-tab label="Login" name="login"/>
                <q-tab label="Register" name="register"/>
            </q-tabs>
            <q-separator/>
            <q-tab-panels v-model="tab" animated class="q-mx-sm bg-transparent">
                <q-tab-panel class="overflow-hidden" name="login">
                    <span>Login</span>
                    <form class="text-white" @submit.prevent="loginSubmit">
                        <q-input v-model="login.email" :error="errorEmail !== ''" :error-message="errorEmail"
                                 :rules="rules.email" autocomplete="email" class="q-my-sm" dark item-aligned
                                 label="Email" required type="email">
                            <template v-slot:prepend>
                                <q-icon color="white" name="email"/>
                            </template>
                        </q-input>
                        <q-input v-model="login.password" :error="errorPassword !== ''" :error-message="errorPassword"
                                 :rules="rules.password" :type="isPwd ? 'password' : 'text'" class="q-my-sm"
                                 dark item-aligned label="Password" required>
                            <template v-slot:append>
                                <q-icon
                                    :name="isPwd ? 'visibility_off' : 'visibility'"
                                    class="cursor-pointer"
                                    @click="isPwd = !isPwd"
                                />
                            </template>
                            <template v-slot:prepend>
                                <q-icon name="password"/>
                            </template>
                        </q-input>
                        <q-toggle
                            v-model="login.remember"
                            checked-icon="check"
                            color="primary"
                            dark
                            label="Remember me"
                            unchecked-icon="clear"
                        />
                        <q-card-actions align="right">
                            <q-btn :class="{ 'disabled': login.processing }" :disabled="login.processing"
                                   class="q-my-sm"
                                   color="primary" flat icon="login" label="Login" type="submit"/>
                        </q-card-actions>
                    </form>
                </q-tab-panel>
                <q-tab-panel class="overflow-hidden" name="register">
                    <span>Register</span>
                    <form class="text-white" @submit.prevent="registerSubmit">
                        <q-input v-model="register.name" :error="errorUsername !== ''" :error-message="errorUsername"
                                 :rules="rules.name" class="q-my-sm" dark item-aligned label="Username"
                                 required type="text">
                            <template v-slot:prepend>
                                <q-icon name="person"/>
                            </template>
                        </q-input>
                        <q-input v-model="register.email" :error="errorEmail !== ''" :error-message="errorEmail"
                                 :rules="rules.email" class="q-my-sm" dark item-aligned label="Email" required
                                 type="email">
                            <template v-slot:prepend>
                                <q-icon name="email"/>
                            </template>
                        </q-input>
                        <q-input v-model="register.password" :error="errorPassword !== ''"
                                 :error-message="errorPassword"
                                 :rules="rules.password" :type="isPwd ? 'password' : 'text'" class="q-my-sm"
                                 counter dark hint="Min. 8 characters" item-aligned label="Password" required>
                            <template v-slot:append>
                                <q-icon
                                    :name="isPwd ? 'visibility_off' : 'visibility'"
                                    class="cursor-pointer"
                                    @click="isPwd = !isPwd"
                                />
                            </template>
                            <template v-slot:prepend>
                                <q-icon name="password"/>
                            </template>
                        </q-input>
                        <q-input v-model="register.password_confirmation" :rules="rules.password_confirmation"
                                 :type="isPwd ? 'password' : 'text'" class="q-my-sm" dark item-aligned
                                 label="Password Confirm" required>
                            <template v-slot:prepend>
                                <q-icon name="password"/>
                            </template>
                        </q-input>
                        <q-card-actions align="right" class="q-my-sm">
                            <q-btn color="primary" flat icon="send" label="Create Account" type="submit"/>
                        </q-card-actions>
                    </form>
                </q-tab-panel>
            </q-tab-panels>
        </q-card>
    </q-dialog>

</template>

<script>
import {ref} from "vue";

export default {
    name: "AuthModal",
    props: {
        isOpen: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        return {
            tab: ref('login'),
            isPwd: ref(true),
        }
    },
    data() {
        return {
            register: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            }),
            login: this.$inertia.form({
                email: '',
                password: '',
                remember: false,
            }),
            rules: {
                name: [
                    val => !!val || '* Required',
                    val => val.length >= 5 || 'Please use minimum 5 characters',
                ],
                email: [
                    val => !!val.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) || 'Not a valid email address'
                ],
                password: [
                    val => !!val || '* Required',
                    val => val.length >= 8 || 'Please use minimum 8 characters',
                ],
                password_confirmation: [
                    val => !!val || '* Required',
                ]
            },
        }
    },
    computed: {
        errorEmail() {
            return this.$page.props.errors.email || '';
        },
        errorPassword() {
            return this.$page.props.errors.password || '';
        },
        errorUsername() {
            return this.$page.props.errors.username || '';
        },
    },
    methods: {
        loginSubmit() {
            this.login.post(this.route('login'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.login.reset('password');
                    this.$emit('update:isOpen', false)
                },
            })
        },
        registerSubmit() {
            this.register.post(this.route('register'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.login.reset('password');
                    this.login.reset('password_confirmation');
                    this.$emit('update:isOpen', false);
                    this.emitter.emit('g:showToast', 'You have successfully registered!');
                }
            })
        }
    },
}
</script>

<style scoped>
</style>
