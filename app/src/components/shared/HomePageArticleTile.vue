<template>
  <StackLayout>
    <GridLayout row="auto" columns="*, auto" marginBottom="20">
      <label :text="title" fontSize="20" fontWeight="bold"
        row="0" column="0" />
    </GridLayout>
    <ScrollView orientation="vertical" scrollBarIndicatorVisible="false"
      v-if="articles.length > 0">
      <StackLayout orientation="vertical" marginBottom="20">
        <StackLayout v-for="(article, ind) in articles" :key="ind"
          marginBottom="30">

          <AbsoluteLayout height="auto" backgroundColor="transparent"
            width="100%" borderRadius="10"
            @tap="goToArticle(article)">
            <Image height="auto" :src="article.thumbnail" stretch="fill" 
              borderRadius="15"
              top="0" left="0" width="100%" />
          </AbsoluteLayout>
          <Label :text="article.title" fontSize="18" color="black"
            verticalAlignment="bottom" fontWeight="bold"
            textWrap="true" width="100%"
            marginTop="10" />
        </StackLayout>
      </StackLayout>
    </ScrollView>

    <Label v-if="articles.length < 1"
      :text="fetchingArticles ? 'Fetching Articles ...' : 'No Available Articles'" 
      fontSize="26" marginBottom="40" />
  </StackLayout>
</template>

<script>
  import { mapGetters } from 'vuex';

  import Article from './../Article.vue';

  const HomePageTile = {
    props: {
      title: {
        type: String,
        required: true,
      },

      endpoint: {
        type: String,
        required: true
      },

      limit: {
        type: [String, Number],
        required: false,
        default: 3
      }
    },

    data () {
      return {
        fetchingArticles: true,
        articles: []
      }
    },

    computed: {
      ...mapGetters({
        'token': 'currentUserToken'
      })
    },

    mounted () {
      this.fetchArticles();
    },

    methods: {
      goToArticle (article) {
        this.$navigateTo(Article, {
          props: {
            articleId: article.id
          }
        });
      },

      fetchArticles () {
        if (! this.token) {
          console.log("Token missing");
          return false;
        }

        this.fetchingArticles = true;
        this.$apiServices.fetchArticlesByCategory(this.token, this.endpoint)
          .then((res) => {
            console.log("Response Received: ", res);
            this.fetchingArticles = false;
            let articles = res.data;
            this.articles = articles.slice(0, this.limit);
          })
          .catch((err) => {
            this.fetchingArticles = false;
            console.log(err);
          });
      },
    }
  };

  export default HomePageTile;
</script>