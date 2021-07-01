<template>
  <Page class="page" actionBarHidden="true" backgroundSpanUnderStatusBar="true">
    <AbsoluteLayout>
      <ScrollView top="0" left="0" width="100%" height="100%">
        <StackLayout v-if="! fetchingArticle">
          <Image :src="article.thumbnail" width="100%" stretch="fill"
            marginTop="-90"
            v-if="article.thumbnail" />
          <Label text="" marginTop="30"
            v-if="! article.thumbnail" />

          <Label :text="article.title"
            fontSize="30" fontWeight="bold"
            textWrap="true"
            padding="20" />

          <StackLayout padding="20" paddingTop="10" @layoutChanged="refreshHtmlView">
            <HtmlView ref="htmlView"
              :html="article.content" fontSize="20"
              backgroundColor="transparent"></HtmlView>
          </StackLayout>
        </StackLayout>

        <ActivityIndicator width="50" :busy="fetchingArticle"></ActivityIndicator>
      </ScrollView>

      <StackLayout backgroundColor="#E2E8F0" top="0" left="0"
        width="40" height="40"
        borderRadius="100%"
        marginTop="10" marginLeft="10"
        @tap="$navigateBack">
        <Image src="~/src/assets/icons/ic_keyboard_backspace_black_24dp.png"
          height="30" width="30" marginTop="5"
          horizontalAlignment="center" />
      </StackLayout>
    </AbsoluteLayout>
  </Page>
</template>

<script>
import { mapGetters } from 'vuex';
import { isIOS } from 'tns-core-modules/platform';

const Article = {
  props: {
    articleId: {
      type: [ String, Number ],
      required: true,
    }
  },

  data () {
    return {
      fetchingArticle: false,
      article: {}
    }
  },

  computed: {
    ...mapGetters({
      token: 'currentUserToken'
    }),
  },

  mounted () {
    this.fetchArticle();
  },

  methods: {
    fetchArticle () {
      this.fetchingArticle = true;
      
      this.$apiServices.fetchArticle(this.token, this.articleId)
        .then((res) => {
          this.fetchingArticle = false;
          this.article = res.data;
        })
        .catch((err) => {
          this.fetchingArticle = false;
        });
    },

    refreshHtmlView() {
      this.isMounted = true;
      if (isIOS) {
        if (this.$refs.htmlView) {
          setTimeout(() => {
            console.log("refreshing");
            this.$refs.htmlView.nativeView.requestLayout();
          }, 50);
        }
      }
    }
  }
};

export default Article;
</script>