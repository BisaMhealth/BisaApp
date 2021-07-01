<template>
  <Page class="page">
    <!-- <SharedHeader :title="$t('healthTips')" :show-search="false" flat="true" /> -->

    <ActionBar title="Health Tips" flat="true" :show-back="true" backgroundColor="#8DC63F" color="#FFFFFF"/>

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter current-page="healthTips" show-search="false" />

      <ScrollView v-if="isIOS"
        dock="top" orientation="horizontal"
        backgroundColor="#8DC63F">
        <StackLayout orientation="horizontal">
          <Label v-for="category in categories" :key="category.category_id"
            :text="category.category_name"
            color="#FFFFFF" padding="20"
            @tap="setActiveCategory(category.category_id)" />
        </StackLayout>
      </ScrollView>
      
      <TabLatestArticles v-if="isIOS" :category-name="activeCategory"></TabLatestArticles>
      
      <TabView v-if="isAndroid"
        dock="bottom"
        tabBackgroundColor="#8DC63F" tabTextColor="#FFFFFF" selectedTabTextColor="#FFFFFF"
        androidSelectedTabHighlightColor="white">
        <TabViewItem v-for="category in categories" :key="category.category_id"
          :title="category.category_name">
          <TabLatestArticles :category-name="category.category_id"></TabLatestArticles>
        </TabViewItem>
      </TabView>
    </DockLayout>
  </Page>
</template>

<script>
import { isIOS, isAndroid } from 'tns-core-modules/platform';

import Home from './App.vue';
import SharedFooter from './shared/Footer.vue';
// import SharedHeader from './shared/HeaderBar.vue';
import TabLatestArticles from './tabs/LatestArticles.vue';

const HealthTipsPage = {
  name: 'HealthTipsPage',

  components: {
    SharedFooter,
    // SharedHeader,
    TabLatestArticles,
  },

  data () {
    return {
      isIOS,
      isAndroid,
      categories: [],
      activeCategory: null,
    }
  },

  mounted() {
    this.setCategories();
  },

  methods: {
    search() {},

    goToHome () {
      this.$navigateTo(Home);
    },

    setCategories() {
      const ghana = [
        {
          category_id: 1,
          category_name: "Diabetes"
        },
        {
          category_id: 2,
          category_name: "HIV-AIDS"
        },
        {
          category_id: 3,
          category_name: "Nutrition"
        },
        {
          category_id: 4,
          category_name: "General Health"
        },
        {
          category_id: 5,
          category_name: "Our Doctors Say"
        },
        {
          category_id: 6,
          category_name: "Others"
        },
        {
          category_id: 7,
          category_name: "Life Style"
        }
      ];
      const senegal = [
        {
          category_id: 1,
          category_name: "Diabète"
        },
        {
          category_id: 2,
          category_name: "VIH-SIDA"
        },
        {
          category_id: 3,
          category_name: "Nutrion"
        },
        {
          category_id: 4,
          category_name: "Santé générale"
        },
        {
          category_id: 5,
          category_name: "Nos médecins disent"
        }
      ]

      this.categories = this.$config.lang == 'en' ? ghana : senegal;

      let category = this.categories[0];
      this.setActiveCategory(category.category_id);
    },

    setActiveCategory(categoryId) {
      console.log("Selecting Category ID", categoryId);
      this.activeCategory = categoryId;
    }
  },
};

export default HealthTipsPage;
</script>

<style scoped>
  .see-all {
      padding: 0 18;
  }

  .content {
      padding: 32 0 0 0;
  }

  .content .h1,
  .content .h2 {
      padding-left: 18;
  }

  .room-list-header {
      margin-top: 24;
  }

  .see-all {
      color: #979797;
      font-size: 10pt;
      font-weight: 600;
      text-align: right;
  }

  .rooms {
      margin-top: 18;
  }

  .room {
      padding-right: 12;
  }

  .room.first-child {
      margin-left: 18;
  }

  .room .h2 {
      padding-left: 0;
  }

  .room Image {
      border-radius: 12;
  }

  .room Label.h2 {
      color: #CE9F70;
      margin-top: 8.29;
  }

  .stars {
      margin-top: 8;
  }

  .stars Image {
      padding-right: 1.71;
  }
</style>
