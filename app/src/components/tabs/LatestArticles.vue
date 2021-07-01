<template>
  <DockLayout stretchLastChild="true">
    <ScrollView scrollBarIndicatorVisible="false" dock="top">
      <StackLayout>
        <StackLayout class="content" marginTop="20">
          <label :text="$t('mostRecentArticles')"
            paddingLeft="20" fontSize="18" fontWeight="bold" />
          <StackLayout padding="20">
            <AbsoluteLayout v-for="(article, ind) in articles"
              :key="ind"
              height="100" backgroundColor="transparent"
              width="100%" borderRadius="15" marginBottom="20"
              @tap="goToArticle(article)">
              <Image height="100" :src="article.thumbnail" stretch="fill" 
                borderRadius="15"
                top="0" left="0" width="100"
                />
              <GridLayout top="0" left="0" width="100%"
                height="100%" borderRadius="15 10"
                paddingLeft="115">
                <Label :text="article.title" fontSize="18"
                  verticalAlignment="top" textWrap="true" width="100%" />
              </GridLayout>
            </AbsoluteLayout>
          </StackLayout>
        </StackLayout>
      </StackLayout>
    </ScrollView>
    <!-- <ActivityIndicator v-if="fetchingArticles" width="50" :busy="fetchingArticles"></ActivityIndicator> -->
  </DockLayout>
</template>

<script>
  import { mapGetters } from 'vuex';

  import Article from './../Article.vue';

  const LatestArticlesTab = {
    props: {
      categoryName: {
        type: [ String, Number ],
        required: false,
      }
    },

    data () {
      return {
        fetchingArticles: false,
        articles: []
      }
    },

    computed: {
      ...mapGetters({
        token: 'currentUserToken'
      }),

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
        this.$apiServices.fetchArticlesByCategory(this.token, this.categoryName)
          .then((res) => {
            console.log("Response Received: ", res);
            if(res.data != null){
              this.fetchingArticles = false;
              this.articles = res.data;
            }
            
          })
          .catch((err) => {
            this.fetchingArticles = false;
            console.log(err);
          });
      },
    },

    watch: {
      categoryName() {
        console.log("About to REFRESH category with id", this.categoryName);
        this.fetchArticles();
      }
    }
  };

  export default LatestArticlesTab;
</script>