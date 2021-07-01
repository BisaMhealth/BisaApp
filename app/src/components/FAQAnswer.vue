<template>
  <Page class="page">
    <!-- <SharedHeader title="Most Popular Questions" 
      :show-logout="false"
      :show-search="false" /> -->

    <ActionBar title="Most Popular Questions" flat="true" backgroundColor="#8DC63F" color="#FFFFFF">
    </ActionBar>

    <ScrollView width="100%" height="100%">
      <StackLayout >
        <Label :text="question.question"
          fontSize="30" fontWeight="bold"
          textWrap="true"
          padding="20" />

        <TextView :text="question.answer"
          backgroundColor="transparent"
          editable="false"
          padding="20"
          borderWidth="0"></TextView>
      </StackLayout>
    </ScrollView>
  </Page>
</template>

<script>
import SharedHeader from './shared/HeaderBar';

const FAQAnswer = {
  components: {
    SharedHeader,
  },

  props: {
    question: {
      type: [ Object ],
      required: true,
    }
  },

  data () {
    return {}
  },
};

export default FAQAnswer;
</script>