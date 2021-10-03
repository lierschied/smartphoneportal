<template>
    <div class="full-width bg-gradient-gray-l shadow-gray-3 row wrap justify-start items-center content-start">
        <div class="col-xs-12 col-sm-12 col-md-6">
            <q-carousel
                v-model="slide"
                animated
                infinite
                swipeable
                thumbnails
                transition-next="slide-left"
                transition-prev="slide-right"
            >
                <q-carousel-slide :name="1"
                                  img-src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=934&q=80"/>
                <q-carousel-slide :name="2"
                                  img-src="https://images.unsplash.com/photo-1616410011236-7a42121dd981?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1400&q=80"/>
                <q-carousel-slide :name="3"
                                  img-src="https://images.unsplash.com/photo-1581795669633-91ef7c9699a8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=934&q=80"/>
                <q-carousel-slide :name="4"
                                  img-src="https://images.unsplash.com/photo-1571380401583-72ca84994796?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"/>
            </q-carousel>
        </div>
        <div class="col q-ml-md text-white">
            <div>
                <span class="q-dialog__title">
                    {{ this.$page.props.smartphone.model }}
                    <q-icon :name="brandIcon" size="24px"/>
                    <span class="text-subtitle1"> {{ this.$page.props.smartphone.brand.brand }} </span>
                </span>
            </div>
            <div class="q-mt-lg">
                <q-rating v-model="rating" :max="5"
                          class="y-active-text-primary"
                          color="warning"
                          icon="star_border"
                          icon-half="star_half"
                          icon-selected="star"
                          size="24px"
                          @click="ratingClick"/>
                <span class="text-caption q-ml-sm">
                    {{ getRating }} ({{ this.$page.props.smartphone.ratings_count }})
                </span>
                <span v-if="this.$page.props.smartphone.has_user_rating !== false">
                    Your rating: {{ this.$page.props.smartphone.has_user_rating }}
                </span>
                <p class="q-mt-lg">
                    {{ this.$page.props.smartphone.launch_status }}
                    <br/>
                    {{ this.$page.props.smartphone.features }}
                </p>
            </div>
        </div>
    </div>

    <div class="q-mt-xl text-white">
        <Specs :data="this.$page.props.smartphone.platform_chipset" :icon="brandIcon"/>
        <Specs :data="this.$page.props.smartphone.memory_internal" icon="memory"/>
        <Specs :data="this.$page.props.smartphone.display_size" icon="screenshot"/>
        <Specs :data="this.$page.props.smartphone.battery_talk_time" icon="battery_charging_full"/>
        <Specs :data="this.$page.props.smartphone.misc_colors" icon="palette">
            <div class="row">
                <template v-for="color in colors" v-if="colors">
                    <span v-if="Array.isArray(color)"
                          :style="`background: linear-gradient(135deg, ${color[0]} 50%, ${color[1]} 50%);`"
                          class="col-auto q-ma-lg color-dots y-ty-hover-up y-scale-hover-4">
                    </span>
                    <span v-else
                          :style="`background-color: ${color}; box-shadow: 0 10px 20px -5px ${color}; color: ${color}`"
                          class="col-auto q-ma-lg color-dots y-ty-hover-up y-scale-hover-5">
                    </span>
                </template>
            </div>
        </Specs>
    </div>
    <q-separator id="comment-section" class="q-my-xl bg-accent"/>
    <div class="row full-width justify-center content-center content-center text-white">
        <q-btn v-if="this.$page.props.smartphone.comments.length > 0"
               :class="showComments ? 'y-active-primary' : ''"
               class="q-mb-sm y-ty-hover-up y-hover-dark-white y-text-hover-dark-white"
               href="#comment-section"
               type="a" @click="showComments = !showComments">
            <q-icon v-if="showComments" class="y-active-text-primary" name="comment"/>
            <q-icon v-else name="comments_disabled"/>
        </q-btn>
    </div>
    <div v-if="showComments" class="full-width column wrap justify-start items-stretch content-center text-white">
        <q-intersection v-for="comment in this.$page.props.smartphone.comments" :key="comment.id"
                        class="wrap-xs y-hover-dark-white" style="min-height: 100px; min-width: 200px;"
                        transition="scale">
            <CommentBox :comment="comment"/>
        </q-intersection>
    </div>
</template>

<script>
import {ref} from 'vue';
import App from "@/Layouts/AppLayout";
import Specs from "@/Components/Specs";
import {useForm} from '@inertiajs/inertia-vue3';
import CommentBox from "@/Components/CommentBox";

export default {
    name: "Detail",
    components: {CommentBox, Specs},
    props: {
        requiresLogin: {type: Boolean, default: false},
    },
    setup() {
        const form = useForm({
            stars: null,
        })
        return {
            form,
            slide: ref(1),
        }
    },
    data() {
        return {
            likes: {},
            fill: 'none',
            rating: this.$page.props.smartphone.ratings_avg_stars || 0,
            colors: [],
            showComments: false,
            newComment: ''
        }
    },
    computed: {
        brandIcon() {
            return this.$page.props.smartphone.brand.brand === 'Apple' ? 'apple' : 'android';
        },
        getRating() {
            return parseFloat(this.rating.toPrecision(2));
        },
    },
    mounted() {
        let colors = this.$page.props.smartphone.misc_colors.split(',');

        colors.forEach((e, i) => {
            e = e.toLowerCase()
                .replace('gray', 'grey')
                .trim();

            if (e.match('space grey')) {
                this.colors.push('#7D7D7D');
                return;
            }

            if (e.match('\/')) {
                let split = []
                e.split('/').forEach((x) => {
                    axios.get(`https://api.color.pizza/v1/names/${x}`)
                        .then((res) => {
                            res.data.colors[0].hex ? this.colors[i].push(res.data.colors[0].hex) : '#000';

                        }).catch((e) => console.error(e))
                });
                this.colors.push(split);
                return;
            }

            axios.get(`https://api.color.pizza/v1/names/${e}`)
                .then((res) => {
                    res.data.colors[0].hex ? this.colors[i] = res.data.colors[0].hex : '#000';
                }).catch((e) => console.error(e))
        })
    },
    methods: {
        isLoggedId() {
            return this.$page.props.isAuth === false ? this.emitter.emit('g:requiresLogin', true) : true;
        },
        likeClick(id, type) {
            if (!this.isLoggedId()) return
            switch (type) {
                case 'Like':
                    type = 'Like';
                    break
                case 'Dislike':
                    type = 'Dislike';
                    break
                default:
                    type = 'delete';
            }
            useForm({
                type: type
            }).post(
                route('comment.like', id),
                {
                    preserveScroll: true,
                });
        },
        ratingClick() {
            if (this.$page.props.isAuth !== true) return this.emitter.emit('g:requiresLogin', true);
            this.form.stars = this.rating;
            this.form.post(
                this.route('smartphone.rating.update', this.$page.props.smartphone.id),
                {
                    preserveScroll: true,
                }
            );
        }
    },
    layout: [App]
}
</script>

<style scoped>
.color-dots {
    width: 24px !important;
    height: 24px !important;
    display: block !important;
    border-radius: 50% !important;
    box-shadow: 0 10px 20px -5px rgba(255, 255, 255, 1);
    transition: all 0.4s ease-in-out;
}

.y-trigger:hover .color-dots {
    transition: all 0.4s ease-in-out;
    box-shadow: -10px 10px 20px -5px, 0 10px 20px -5px, 10px 10px 20px -5px !important;
}
</style>
