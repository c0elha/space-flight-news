import { ref, computed, pushScopeId } from "vue";

export function useArticleList() {
  const articles = ref([]);
  const countArticlesShow = ref(0);
  const totalArticles = ref(0);
  const lastResponse = ref({
    next: "http://0.0.0.0/api/article",
    count: null,
  });

  const allArticleFound = computed(() => {
    return articles.value.length === lastResponse.value.count;
  });

  getMoreArticle();

  function resetCount(search, filter = "") {
    lastResponse.value = {
      next: `http://0.0.0.0/api/article?search=${search}&filter=${filter}`,
      count: null,
    };
    countArticlesShow.value = 0;
    totalArticles.value = 0;
    articles.value = [];
  }

  function getMoreArticle(reset = false, search = "", filter = "") {
    if (reset) {
      resetCount(search, filter);
    }

    if (allArticleFound.value) return;

    fetch(lastResponse.value.next)
      .then((response) => response.json())
      .then(({ data, to, total, next_page_url }) => {
        articles.value.push(...data);

        lastResponse.value.next = next_page_url;

        countArticlesShow.value = to;
        totalArticles.value = total;
      });
  }

  function getSearchArticle(search, filter = "") {
    fetch(`http://0.0.0.0/api/article?search=${search}&filter=${filter}`)
      .then((response) => response.json())
      .then(({ data, to, total, next_page_url }) => {
        articles.value = [...data];
        lastResponse.value.next = next_page_url;
        countArticlesShow.value = to;
        totalArticles.value = total;
      });
  }

  return {
    articles,
    getMoreArticle,
    allArticleFound,
    getSearchArticle,
    resetCount,
    count: countArticlesShow,
    total: totalArticles,
  } ;
}
