<template>
    <q-card bordered class="bg-transparent" flat>
        <q-card-section horizontal>
            <q-card-section>
                <div class="text-overline text-orange-9">{{ comment.created_at }}</div>
                <div class="text-h6 q-mt-sm q-mb-xs">@{{ comment.user.name }}</div>
                <div class="text-caption text-grey">
                    {{ comment.comment }}
                </div>
            </q-card-section>
            <q-space/>
            <q-card-actions>
                <div class="text-grey-8 q-mr-sm">
                    <q-btn v-ripple
                           :class="isLiked ? 'y-active-text-positive y-text-hover-dark-white' : 'y-text-hover-positive'"
                           :text-color="isLiked ? 'positive' : ''"
                           icon="thumb_up" @click="likeClick('Like')"/>
                    <q-linear-progress
                        :style="comment.likes_data.avg >= 0.5 ? 'box-shadow: 0 0 5px 1px #44c93a' : 'box-shadow: 0 0 5px 1px #fe4657'"
                        :value="comment.likes_data.avg" color="positive"
                        track-color="negative"/>
                    <q-btn
                        :class="isDisliked ? 'y-active-text-negative y-text-hover-dark-white' : 'y-text-hover-negative'"
                        :text-color="isDisliked ? 'negative' : ''"
                        icon="thumb_down" @click="likeClick('Dislike')"/>
                </div>
                <q-btn class="y-text-hover-primary" icon="reply" @click="this.$page.props.isAuth !== true ? this.emitter.emit('g:requiresLogin', true) : openReply = true"/>
            </q-card-actions>
        </q-card-section>
        <q-card-actions>
            <q-btn v-if="comment.comments.length > 0"
                   :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"
                   color="grey"
                   flat
                   label="replies"
                   @click="expanded = !expanded"
            />
        </q-card-actions>
        <q-slide-transition v-if="expanded">
            <div>
                <q-separator color="primary"/>
                <q-card-section v-for="subComment in comment.comments" :key="comment.id"
                                class="text-subitle2 y-hover-primary">
                    <div class="text-overline text-orange-9">{{ subComment.created_at }}</div>
                    <div class="text-h6 q-mt-sm q-mb-xs">@{{ subComment.user.name }}</div>
                    <div class="text-caption text-grey">
                        {{ subComment.comment }}
                    </div>
                </q-card-section>
                <q-separator color="primary"/>
            </div>
        </q-slide-transition>
    </q-card>
    <q-dialog v-model="openReply" persistent>
        <q-card class="bg-accent" style="min-width: 350px;">
            <q-card-section class="q-pt-none text-white">
                <q-input v-model="newComment" autofocus autogrow dark dense @keyup.enter="openReply = false"/>
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn v-close-popup flat label="Cancel"/>
                <q-btn v-close-popup flat label="Reply" @click="commentSubmit"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
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
            expanded: false,
            openReply: false,
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
        commentSubmit() {
            if (this.$page.props.isAuth !== true) return this.emitter.emit('g:requiresLogin', true);
            useForm({
                comment: this.newComment
            }).post(
                this.route('comment.create', this.comment.id),
                {
                    preserveScroll: true,
                    onSuccess: () => this.newComment = ''
                }
            )
        },
        likeClick(type) {
            if (this.$page.props.isAuth !== true) return this.emitter.emit('g:requiresLogin', true);
            if (type === this.comment.has_liked) {
                type = 'delete';
            }

            useForm({
                type: type
            }).post(
                this.route('comment.like', this.comment.id),
                {
                    preserveScroll: true,
                });
        }
    }
}
</script>
