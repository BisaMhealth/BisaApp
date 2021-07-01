<template>
  <Page class="page">
    <ActionBar backgroundColor="#8DC63F">
      <GridLayout class="header" rows="auto" columns="auto, *,auto,auto">
        <Image
          src="~/src/assets/icons/ic_keyboard_backspace_white_24dp.png"
          verticalAlignment="center"
          marginRight="15"
          row="0"
          col="0"
          height="30"
          @tap="goToChatList"
        />
        <Label text="Explore" row="0" col="1" fontSize="20" color="white" fontWeight="normal"
          verticalAlignment="middle"></Label>
        <Image
          src="~/src/assets/icons/ic_search_white_24dp.png"
          verticalAlignment="center"
          marginRight="15"
          row="0"
          col="2"
          height="30"
        />
      </GridLayout>
    </ActionBar>

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter />

      <ScrollView dock="top" scrollBarIndicatorVisible="false">
        <StackLayout orientation="vertical">
          <StackLayout class="content" margin="20">
            <Label text="Coming Soon..."
              horizontalAlignment="center" fontSize="30" />
          </StackLayout>
        </StackLayout>
      </ScrollView>
    </DockLayout>
  </Page>
</template>

<script>
import SharedFooter from './shared/Footer.vue';
import SharedHeaderBar from './shared/HeaderBar.vue';

const ExplorePage = {
  components: {
    SharedFooter,
    SharedHeaderBar,
  },

  data () {
    return {}
  }
};

export default ExplorePage;
</script>

<style scoped>

  .see-all {
      padding: 0 18;
  }

  .tabs {
      font-size: 13pt;
      font-weight: bold;
      padding: 0 9;
  }

  .tabs Label {
      border-bottom-color: #686871;
      border-bottom-width: 1;
      color: #979797;
      padding-bottom: 12;
      text-align: center;
  }

  .tabs Label.active {
      border-bottom-color: #ED2567;
      border-bottom-width: 1;
      color: #ED2567;
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
