<template>
    <article class="flex items-center pb-6 mb-8 border-b-2 border-white" :class="{ 'flex-row-reverse': is_odd }">
        <img
            class="w-64 md:mr-8"
            :class="{ 'md:mr-0 md:ml-8': is_odd }"
            :src="article.imageUrl"
            @error="article.imageUrl = '/no-image.png'"
        />
        <div class="flex-1 mr-2" :class="{ 'md:mr-0': is_odd }">
            <h3 class="font-semibold text-lg mb-1">{{ article.title }}</h3>

            <p class="flex items-center justify-between mb-6">
                {{ publishedAt }}
                <a href="" class="badge bg-secondary text-white uppercase">{{ article.newsSite }}</a>
            </p>

            <p class="text-truncate-summary mb-6">
                {{ article.summary }}
            </p>

            <a :href="article.url" class="font-semibold btn text-white bg-primary" target="_blank">Ver Mais</a>
        </div>
    </article>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        is_odd: {
            type: Boolean,
            default: false,
        },
        article: {
            type: Object,
            default: {},
        },
    },
    computed: {
        publishedAt() {
            var date = new Date(this.article.publishedAt);
            return date.toLocaleDateString();
        },
    },
});
</script>
<style></style>
