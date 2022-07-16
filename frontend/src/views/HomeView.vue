<template>
  <main>
    <section>
      <div
        class="container max-w-screen-lg mx-auto flex justify-between items-center flex-col md:flex-row"
        style="min-height: 460px; height: 50vh"
      >
        <h1 class="text-white text-6xl">Space Flight News</h1>
        <img
          src="../../src/assets/img/mirage-astronaut.png"
          alt="Astronauta"
          class="h-60 md:h-auto"
        />
      </div>
    </section>

    <section class="max-w-screen-md mx-auto">
      <NavFilter
        :articles="articles"
        @getSearchArticle="getSearchArticle"
        @getMoreArticle="getMoreArticle"
      />

      <ArticleSpace
        v-for="(article, i) in articles"
        :article="article"
        :key="i"
        :is_odd="(i + 1) % 2 === 0"
      />

      <div class="text-center pb-8" v-if="count < total">
        <button class="btn bg-secondary" @click="getMoreArticle()">
          Ver mais artigos
        </button>
      </div>
    </section>
  </main>
</template>

<script lang="ts">
import Article from "@/components/Article.vue";
import Nav from "@/components/Nav.vue";
import { useArticleList } from "../composable/useArticleList.js";
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    const { articles, getMoreArticle, getSearchArticle, count, total } =
      useArticleList();

    return {
      articles,

      getMoreArticle,
      getSearchArticle,
      count,
      total,
    };
  },
  components: {
    NavFilter: Nav,
    ArticleSpace: Article,
  },
});
</script>
