<template>
  <Page>
    <!-- <ActionBar title="Welcome to NativeScript-Vue!" android:flat="true" /> -->
    <ActionBar title="Home" class="action-bar"></ActionBar>

    <GridLayout>
      <GridLayout>
        <Tabs
          ref="tabs"
          selectedIndex="defaultSelected"
          v-on:selectedIndexChanged="onSelectedIndexChanged"
        >
          <TabContentItem :backgroundColor="tabList[0].backgroundColor">
            <StackLayout>
              <Label ref="testlabel" text="Bottom Nav Content 1" class="h1 text-center p-t-20"></Label>
              <Label :text="tabList[0].backgroundColor" />

              <Label :text="currentTabIndex" />
              <Label :text="defaultSelected" />
            </StackLayout>
          </TabContentItem>

          <TabContentItem :backgroundColor="tabList[1].backgroundColor">
            <StackLayout>
              <Label text="Bottom Nav Content 2" class="h1 text-center p-t-20"></Label>
            </StackLayout>
          </TabContentItem>

          <TabContentItem :backgroundColor="tabList[2].backgroundColor">
            <StackLayout>
              <Label text="Bottom Nav Content 3" class="h1 text-center p-t-20"></Label>
            </StackLayout>
          </TabContentItem>

          <TabContentItem :backgroundColor="tabList[3].backgroundColor">
            <StackLayout>
              <Label text="Bottom Nav Content 4" class="h1 text-center p-t-20"></Label>
            </StackLayout>
          </TabContentItem>

          <TabContentItem :backgroundColor="tabList[4].backgroundColor">
            <StackLayout>
              <Label text="Bottom Nav Content 5" class="h1 text-center p-t-20"></Label>
            </StackLayout>
          </TabContentItem>
        </Tabs>
      </GridLayout>

      <!-- bottom tabs -->
      <GridLayout height="auto" verticalAlignment="bottom" columns="*, *, *, *, *">
        <!-- base layer -->
        <AbsoluteLayout col="0" colspan="5" verticalAlignment="bottom">
          <GridLayout ref="tabBGContainer" columns="auto, 10, auto, 10, auto">
            <GridLayout
              ref="leftTabs"
              col="0"
              colspan="2"
              height="80"
              :backgroundColor="tabContainer.backgroundColor"
              verticalAlignment="bottom"
              borderRadius="0 68 0 0"
            ></GridLayout>
            <GridLayout
              ref="centerPatch"
              col="1"
              colspan="3"
              height="40"
              :backgroundColor="tabContainer.backgroundColor"
              verticalAlignment="bottom"
            ></GridLayout>
            <GridLayout
              ref="rightTabs"
              col="3"
              colspan="4"
              height="80"
              :backgroundColor="tabContainer.backgroundColor"
              verticalAlignment="bottom"
              borderRadius="68 0 0 0"
            ></GridLayout>

            <!-- focus circle -->
          </GridLayout>
        </AbsoluteLayout>

        <!-- tab contents -->
        <!-- <transition v-on:enter="enter()" v-on:leave="leaveAnimation()"> -->
          <GridLayout
            v-for="(item, i) in tabList" :key="i"
            :ref="`tabContents-${i}`"
            :col="i"
            marginTop="20"
            @tap="onBottomNavTap(i)"
            verticalAlignment="middle"
          >
              <!-- :text="item.text" -->
              <!-- class="fa-regular" -->
            <Label
              :text="i"
              verticalAlignment="middle"
              horizontalAlignment="center"
              :color="item.color"
              fontSize="20"
            ></Label>
          </GridLayout>
        
          <!-- pan layer -->
        <GridLayout
          ref="dragCircle"
          column="0"
          colspan="5"
          @pan="onCenterCirclePan($event)"
          verticalAlignment="center"
          horizontalAlignment="center"
          height="90"
          width="90"
          backgroundColor="transparent"
          borderRadius="45"
        ></GridLayout>
        <GridLayout
          ref="centerCircle"
          col="1"
          colspan="3"
          height="100"
          width="100"
          :backgroundColor="tabList[currentTabIndex].backgroundColor"
          borderRadius="50"
          verticalAlignment="bottom"
          marginBottom="10"
        >
          <GridLayout
            verticalAlignment="center"
            horizontalAlignment="center"
            height="90"
            width="90"
            :backgroundColor="tabContainer.focusColor"
            borderRadius="45"
          ></GridLayout>
        </GridLayout>
      </GridLayout>
    </GridLayout>
  </Page>
</template>

<script >
import { screen } from 'platform';

export default {
  data() {
    return {
      // Tab Contents and Properties
      tabContainer: {
        backgroundColor: '#fff',
        focusColor: '#fff'
      },
      tabList: [
        { text: String.fromCharCode(0xf080), backgroundColor: '#5B37B7', color: '#000' },
        { text: String.fromCharCode(0xf075), backgroundColor: '#E6A938', color: '#000' },
        { text: String.fromCharCode(0xf259), backgroundColor: '#C9449D', color: '#000' },
        { text: String.fromCharCode(0xf1d8), backgroundColor: '#4195AA', color: '#000' },
        { text: String.fromCharCode(0xf073), backgroundColor: '#4A9F6E', color: '#000' }
      ],
      currentTabIndex: 2,
      defaultSelected: 2,
    };
  },

  mounted () {
    setTimeout(() => {
      this.initializeTabBar();
    }, 10);
  },

  methods: {
    // enter(view) {
    //   console.log(view);
    //   view.animate({
    //     scale: {
    //       x: 1.2,
    //       y: 1.2
    //     },
    //     duration: 600,
    //   });
    // },
    
    // leave(view) {
    //   console.log(view);
    //   view.animate({
    //     scale: {
    //       x: 1.2,
    //       y: 1.2
    //     },
    //     duration: 600,
    //   });
    // },
    
    enter() {
      const view = this.$refs[`tabContents-${this.currentTabIndex}`];
      console.log(view);
      view.animate({
        scale: {
          x: 1.2,
          y: 1.2
        },
        duration: 600,
      });
    },

    leave () {
      const view = this.$refs[`tabContents-${this.currentTabIndex}`];
      console.log(view);
      view.animate({
        scale: {
          x: 1.2,
          y: 1.2
        },
        duration: 600,
      });
    },

    onSelectedIndexChanged(args) {
      if (args.newIndex !== this.currentTabIndex) {
        this.onBottomNavTap(args.newIndex);
      }
    },

    // Tap on a one of the tabs
    onBottomNavTap(index, duration) {
      duration = duration || 300;
      console.log(index, this.currentTabIndex);
      if (this.currentTabIndex !== index) {
        // set unfocus to previous index
        const previousTabContent = this.$refs[`tabContents-${this.currentTabIndex}`]
        // tabContentsArr[this.currentTabIndex].nativeElement.animate(
        if (previousTabContent) {
          // previousTabContent.animate(
          //   this.getUnfocusAnimation(this.currentTabIndex, duration)
          // );
        }

        // set focus to current index
        const currentTabContent = this.$refs[`tabContents-${index}`]
        // tabContentsArr[index].nativeElement.animate(this.getFocusAnimation(index, duration));
        if (currentTabContent) {
          // currentTabContent.animate(
          //   this.getFocusAnimation(index, duration)
          // );
        }
      }

      if (index) {
      // MY: Change the selected index of Tabs when tap on tab strip
      this.selectedIndex = index;
      // set current index to new index
      this.currentTabIndex = index;
      console.log("After setting current tab index", this.currentTabIndex);

      // this.$refs.centerCircle.animate(this.getSlideAnimation(index, duration));
      // this.$refs.leftTabs.animate(this.getSlideAnimation(index, duration));
      // this.$refs.rightTabs.animate(this.getSlideAnimation(index, duration));
      // this.$refs.centerPatch.animate(this.getSlideAnimation(index, duration));
      // this.$refs.dragCircle.animate(this.getSlideAnimation(index, duration));
      
      }
    },

    // Drag the focus circle to one of the tabs
    onCenterCirclePan (args) {
      return;
        // let grdLayout: GridLayout = <GridLayout>args.object;
        let newX = grdLayout.translateX + args.deltaX - this.prevDeltaX;

        if (args.state === 0) {
            // finger down
            this.prevDeltaX = 0;
        } else if (args.state === 2) {
            // finger moving
            grdLayout.translateX = newX;
            this.leftTabs.nativeElement.translateX = newX;
            this.rightTabs.nativeElement.translateX = newX;
            this.centerPatch.nativeElement.translateX = newX;
            this.centerCircle.nativeElement.translateX = newX;

            this.prevDeltaX = args.deltaX;
        } else if (args.state === 3) {
            // finger up
            this.prevDeltaX = 0;
            const tabWidth = screen.mainScreen.widthDIPs / this.tabList.length;
            const tabSelected = Math.round(Math.abs(newX / tabWidth));
            const translateX = tabSelected * tabWidth;
            if (newX < 0) {
                // pan left
                this.onBottomNavTap(this.defaultSelected - tabSelected, 50);
                // MY: Change the selected index of Tabs when pan left
                this.tabs.nativeElement.selectedIndex = this.defaultSelected - tabSelected;
            } else {
                // pan right
                this.onBottomNavTap(this.defaultSelected + tabSelected, 50);
                // MY: Change the selected index of Tabs when pan right
                this.tabs.nativeElement.selectedIndex = this.defaultSelected + tabSelected;
            }
        }
    },

    initializeTabBar () {
      // set up base layer
      this.$refs.leftTabs.width = screen.mainScreen.widthDIPs;
      this.$refs.rightTabs.width = screen.mainScreen.widthDIPs;
      this.$refs.centerPatch.width = 100;
      console.log("W: ", this.$refs.leftTabs.width);
      console.log("W: ", this.$refs.rightTabs.width);
      console.log("W: ", this.$refs.centerPatch.width);

      this.$refs.tabBGContainer.translateX = - (screen.mainScreen.widthDIPs / 2) - (80 / 2);
      console.log("W: ", this.$refs.tabBGContainer.translateX);

      // set default selected tab
      const currentTabContent = this.$refs[`tabContents-${this.defaultSelected}`];
      console.log(currentTabContent);
      if (currentTabContent) {
        currentTabContent[0].scaleX = 1.5;
        currentTabContent[0].scaleY = 1.5;
        currentTabContent[0].translateY = - 15;
      }

      this.currentTabIndex = this.defaultSelected;
    },

    getSlideAnimation(index, duration) {
        return {
            translate: { x: this.getTabTranslateX(index), y: 0 },
            curve: this.animationCurve,
            duration: duration
        };
    },

    getFocusAnimation(index, duration) {
        return {
            scale: { x: 1.5, y: 1.5 },
            translate: { x: 0, y: -15 },
            duration: duration
        };
    },

    getUnfocusAnimation (index, duration) {
        return {
            scale: { x: 1, y: 1 },
            translate: { x: 0, y: 0 },
            duration: duration
        };
    },

    getTabTranslateX(index) {
      return index * screen.mainScreen.widthDIPs / this.tabList.length - (screen.mainScreen.widthDIPs / 2) + (80 / 2)
    }
  }
};
</script>

<style scoped>
.home-panel{
    vertical-align: center;
    font-size: 20;
    margin: 15;
}

.description-label{
    margin-bottom: 15;
}

.fa-regular {
    font-family: 'Font Awesome 5 Free', 'fa-regular-400';
    font-weight: 400;
}
</style>
