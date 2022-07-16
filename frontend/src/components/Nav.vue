<template>
  <nav class="flex mb-6">
    <h2 class="text-4xl">Artigos</h2>
    <form
      action="/"
      id="form-search"
      class="ml-auto"
      @submit.prevent="handleSubmitSearch"
    >
      <label for="search" class="sr-only">Search</label>
      <div class="relative">
        <input
          type="search"
          v-model="filterText"
          id="search"
          class="block p-2 pr-12 w-full input-default"
          placeholder="Pesquisar artigos"
          required
        />
        <button
          type="submit"
          class="text-white absolute right-2.5 bottom-1.5 bg-primary focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-2 py-1"
          aria-label="Search"
        >
          <font-awesome-icon :icon="['fas', 'search']" />
        </button>
      </div>
    </form>

    <div class="ml-6 w-40">
      <label if="filter" class="sr-only">Filtro</label>
      <select
        id="filter"
        v-model="filterOrder"
        name="filter"
        class="w-full block p-2.5 input-default"
      >
        <option value="" disabled selected>Filtrar</option>
        <option value="old">Mais antigas</option>
        <option value="news">Mais novas</option>
      </select>
    </div>
  </nav>
  <p
    class="text-center py-6"
    v-if="articles.length === 0 && filterText.length > 0"
  >
    Nenhum registro foi encontrado para a busca informada.
  </p>
</template>
<script lang="ts">
import { defineComponent, ref, watch } from "vue";

export default defineComponent({
  props: ["articles"],
  emits: ["getSearchArticle", "getMoreArticle"],
  setup(props, { emit }) {
    const filterText = ref("");
    const filterOrder = ref("");

    function handleSubmitSearch() {
      emit("getSearchArticle", filterText.value, filterOrder.value);
    }

    watch(filterText, () => {
      if (filterText.value === "") {
        emit("getMoreArticle", true, filterText.value, filterOrder.value);
      }
    });

    watch(filterOrder, () => {
      emit("getMoreArticle", true, filterText.value, filterOrder.value);
    });

    return { filterText, filterOrder, handleSubmitSearch };
  },
});
</script>
