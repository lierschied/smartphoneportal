<template>
    <q-item class="y-hover-dark-white y-ty-hover-up">
        <q-item-section avatar>
            <q-avatar color="primary" text-color="white">
            </q-avatar>
        </q-item-section>

        <q-item-section>
            <q-item-label>{{ comment.created_at }}</q-item-label>
            {{ comment.comment }}
            <q-item-label class="text-grey-6" caption lines="1">{{ comment.user.name }}</q-item-label>

        </q-item-section>
        <q-separator class="q-ma-sm" inset vertical />
        <q-card-actions>
            <div class="">
                <q-btn icon="reply" />
                <q-popup-edit v-model="newComment" auto-save v-slot="scope" style="width: 50%;">
                    <q-input
                        type="textarea"
                        v-model="scope.value"
                        autofocus
                        counter
                        autogrow
                        @keyup.enter.stop
                    >
                        <template v-slot:hint>Reply to {{ comment.user.email }}</template>
                        <template v-slot:after>
                            <q-btn flat icon="send" />
                        </template>
                    </q-input>
                </q-popup-edit>
            </div>
        </q-card-actions>

        <q-item-section side>
            <q-btn v-ripple
                   :text-color="isLiked ? 'positive' : ''"
                   :class="isLiked ? 'y-active-text-positive y-text-hover-dark-white' : 'y-text-hover-positive'"
                   icon="thumb_up" @click="likeClick('Like')"/>
            <q-linear-progress :value="comment.likes_data.avg" color="positive" track-color="negative" :style="comment.likes_data.avg >= 0.5 ? 'box-shadow: 0 0 5px 1px #44c93a' : 'box-shadow: 0 0 5px 1px #fe4657'" />
            <q-btn :text-color="isDisliked ? 'negative' : ''"
                   :class="isDisliked ? 'y-active-text-negative y-text-hover-dark-white' : 'y-text-hover-negative'"
                   icon="thumb_down" @click="likeClick('Dislike')"/>
        </q-item-section>
    </q-item>
</template>
<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: 'CommentBox',
    props: {
        comment: {},
    },
    data() {
        return {
            newComment: '',
        }
    },
    computed: {
        isDisliked() {
            return this.comment.has_liked === 'Dislike'
        },
        isLiked() {
            return this.comment.has_liked === 'Like'
        },
    },
    methods: {
        likeClick(type) {
            if (this.$page.props.isAuth !== true) return this.emitter.emit('g:requiresLogin', true);
            if (type === this.comment.has_liked) {
                type = 'delete';
            }

            useForm({
                type: type
            }).post(
                route('comment.like', this.comment.id),
                {
                    preserveScroll: true,
                });
        }
    }
}
</script>
