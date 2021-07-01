<template>
  <Page class="page">
    <!-- <SharedHeader :title="$t('chat')"
      :show-logout="false"
      :show-search="false"
      :show-upload-image="true"
      v-on:upload-image="selectAndUploadAPicture" /> -->
    <ActionBar title="Chat" flat="true" show-back="true" backgroundColor="#8DC63F" color="#FFFFFF">
      <NavigationButton text="Back" android.systemIcon="ic_menu_back" @tap="onNavBtnTap"/>
    </ActionBar>
    <DockLayout class="screen" stretchLastChild="true"
      backgroundColor="#FCF9F5">
      <GridLayout dock="bottom" columns="*,auto" rows="auto"
        width="100%" marginTop="0"
        paddingRight="10" paddingLeft="10" paddingTop="10">
        <StackLayout row="0" col="0" height="60">
          <GridLayout rows="48" columns="*,auto"
            width="100%" v-if="! isRecording"
            backgroundColor="#FFF" borderColor="#E3E3E3" borderRadius="30"
            borderWidth="1" >
            <TextView row="0" col="0"
              width="100%" borderRadius="30" multiline="true"
              :hint="$t('tapToReply')"
              android:padding="10"
              ios:fontSize="15"
              ios:padding="5"
              paddingLeft="15"
              v-model="newReply"></TextView>
          </GridLayout>

        </StackLayout>
        <StackLayout row="0" col="1" marginLeft="5"
          height="50" width="50"
          borderRadius="100%"
          backgroundColor="#8DC63F"
          verticalAlignment="top"
          paddingTop="10">
          <!-- <Image -->
          <Image v-if="newReply"
            src="~/src/assets/icons/ic_send_white_24dp.png" strethc="fill"
            height="30"
            horizontalAlignment="center"
            verticalAlignment="center"
            @tap="sendMessage" />
        </StackLayout>
      </GridLayout>

      <ScrollView ref="chatContentScrollView" dock="top" scrollBarIndicatorVisible="false">
        <StackLayout ref="chatContentStackLayout" marginTop="10"
          ios:marginBottom="60">
          <ActivityIndicator width="50" :busy="fetchingMessages"
            marginTop="200"
            v-if="fetchingMessages"></ActivityIndicator>
          <StackLayout 
            v-for="(message, messageInd) in messages" :key="messageInd"
            width="100%" marginBottom="7">
            <StackLayout
              :borderRadius="messageSentByMe(message) ? '20 20 0 20' : '20 20 20 0'"
              marginBottom="5" marginTop="5"
              :marginLeft="messageSentByMe(message) ? 60 : 10"
              :marginRight="messageSentByMe(message) ? 10 : 60">
              <!-- v-shadow="{ elevation: 4 }"> -->
              <TextView v-if="message.file_type == 'n/a'"
                :text="message.question_content"
                borderWidth="0"
                :borderRadius="messageSentByMe(message) ? '20 20 0 20' : '20 20 20 0'" 
                padding="20" paddingTop="10" paddingBottom="15"
                fontSize="16" fontWeight="normal"
                :backgroundColor="messageSentByMe(message) ? '#8DC63F' : 'white'"
                :editable="false" :readonly="true"
                />
              
              <Image v-if="message.file_type == 'image'"
                :src="message.question_media_url"
                width="100%" />

              <GridLayout v-if="message.file_type == 'audio'"
                rows="30" columns="auto,*"
                @tap="togglePlay(message)"
                borderWidth="0"
                :borderRadius="messageSentByMe(message) ? '20 20 0 20' : '20 20 20 0'" 
                padding="20" paddingTop="10" paddingBottom="15"
                fontSize="16" fontWeight="normal"
                :backgroundColor="messageSentByMe(message) ? '#8DC63F' : 'white'">
                <Image v-if="audioIsPlaying && currentAudioFile == message.question_media_url"
                  src="~/src/assets/icons/ic_pause_black_24dp.png" strethc="fill"
                  height="30" marginRight="10" marginTop="8"
                  row="0" col="0" />
                <ActivityIndicator v-else-if="loadingProcess && currentAudioFile == message.question_media_url" 
                  :busy="loadingProcess" width="30" 
                  row="0" col="0"></ActivityIndicator>
                <Image v-else
                  src="~/src/assets/icons/ic_play_arrow_black_24dp.png" strethc="fill"
                  height="30" marginRight="10" marginTop="8"
                  row="0" col="0" />
                <StackLayout row="0" col="1"
                  paddingTop="10" >
                  <Progress v-if="currentAudioFile == message.question_media_url"
                    :value="audioProgress" :max="audioDuration"
                    />
                  <Progress v-else value="0" max="10" />
                </StackLayout>
              </GridLayout>
            </StackLayout>

            <GridLayout v-if="! sameAuthorAsNextMessage(message, messageInd)"
              v-show="! messageSentByMe(message)"
              rows="30"
              columns="auto,auto,auto,*"
              marginTop="6"
              marginLeft="10"
              marginRight=" 0" >
              <Image src="~/src/assets/icons/user.png"
                row="0" 
                col="0"
                borderRadius="30" height="30" width="30" />
              <Label :text="message.creator" fontWeight="bold"
                row="0" 
                col="1"
                verticalAlignment="middle" fontSize="16"
                marginLeft="10"
                marginRight=" 0"/>
              <Label :text="message.sentAt"
                row="0" 
                col="2"
                verticalAlignment="middle" fontSize="16"
                marginLeft="10"
                marginRight=" 0" />
            </GridLayout>

            <GridLayout v-if="! sameAuthorAsNextMessage(message, messageInd)"
              v-show="messageSentByMe(message)"
              rows="30"
              columns="*,auto,auto,auto"
              marginTop="10"
              marginLeft="0"
              marginRight="10" >
              <StackLayout row="0" col="3">
                <Image src="~/src/assets/icons/user.png"
                  borderRadius="30" height="30" width="30" />
              </StackLayout>
              <Label :text="message.creator" fontWeight="bold"
                row="0" 
                col="2"
                verticalAlignment="middle" fontSize="16"
                marginLeft="0"
                marginRight="10"/>
              <Label :text="message.sentAt"
                row="0" 
                col="1"
                verticalAlignment="middle" fontSize="16"
                marginLeft="0"
                marginRight="10" />
            </GridLayout>
          </StackLayout>
        </StackLayout>
      </ScrollView>
    </DockLayout>
  </Page>
</template>

<script>
  import { mapGetters } from 'vuex';
  import * as timer from 'tns-core-modules/timer'
  import { knownFolders, path,File } from 'tns-core-modules/file-system'
  import { isIOS, isAndroid } from 'tns-core-modules/platform'
  import { ImageSource } from 'tns-core-modules/image-source'
  const imageSourceModule = require("tns-core-modules/image-source");
  import { TNSPlayer, TNSRecorder } from 'nativescript-audio'
  import * as backgroundHttp from 'nativescript-background-http'
  import * as imagePicker from 'nativescript-imagepicker'
  import * as sha1 from 'js-sha1'

  import ChatList from './ChatList.vue';

  const ChatPage = {
    components: {
      // SharedHeader,
    },

    props: {
      questionId: {
        type: Number,
        required: true
      }
    },

    data () {
      return {
        fetchingMessages: false,
        showFullQuestion: false,
        newReply: null,
        newReplyImage: null,
        newReplyAudio: null,
        question: null,
        loadingProcess: false,

        currentAudioFile: null,
        audioIsPlaying: false,
        audioProgress: 0,
        audioDuration: 0,
        _player: null,
        _checkInterval: null,

        _recorder: null,

        audioRecorder: null,
        isRecording: false,
        _meterInterval: null,
        audioMeter: 0,
        latestAudioFileName: null,
      }
    },

    created () {
      this.fetchQuestionAndChatDetails();
      // this._recorder = new AudioRecorder();
      this._player = new TNSPlayer();
    },

    destroyed() {
      timer.clearInterval(this._checkInterval)
      this._checkInterval = null;
      this.audioRecorder = null;
      this._recorder = null;
      this._player = null;
    },

    computed: {
      ...mapGetters({
        token: 'currentUserToken',
        userId: 'currentUserId',
        userName: 'currentUsername',
      }),

      messages () {
        return this.question ? this.question.question_threads : [];
      }
    },

    methods: {
      onNavBtnTap(){
        this.$navigateBack()
      },
      startTyping() {
        console.log("Starting to type!");
      },

      messageSentByMe(message) {
        return message.creator == this.userName;
      },

      goToChatList () {
        this.$navigateTo(ChatList);
      },

      fetchQuestionAndChatDetails () {
        console.log("Fetching details and chat for question: ", this.questionId);
        this.fetchingMessages = true;
        this.$apiServices.fetchChat(this.token, this.userId, this.questionId)
          .then((res) => {
            this.fetchingMessages = false;
            console.log("Response: ", res);
            this.question = res.data;
          })
          .catch((err) => {
            this.fetchingMessages = false;
            console.log("Error occurred: ", err);
          });
      },

      toggleFullQuestionView () {
        this.showFullQuestion = ! this.showFullQuestion;
      },

      togglePlay(message) {
        console.log("Play button toggled!");
        this.loadingProcess = true;
        this.currentAudioFile = message.question_media_url;

        // this._player = new TNSPlayer();
        this._player.debug = true;

        const playerOptions = {
          audioFile: this.currentAudioFile,
          loop: false,
          autoplay: false,

          completeCallback() {
            console.log('finished playing')
            timer.clearInterval(this._checkInterval)
            this._checkInterval = null
            console.log("Cleared callback")
          },

          errorCallback(errorObject) {
            console.log("An error occurrred", JSON.stringify(errorObject));
          },

          infoCallback(args) {
            console.log("Info callback", JSON.stringify(args));
          },

          setOnPreparedListener(args) {
            console.log("On Prepared", args);
          }
        };

        this._player.playFromUrl(playerOptions)
          .then((res) => {
            this._checkInterval = timer.setInterval(() => {
              this._player.getAudioTrackDuration()
                .then(duration => {
                  this.loadingProcess = false;
                  console.log("Player duration", duration)
                  // iOS: duration is in seconds
                  // Android: duration is in milliseconds
                  let current = this._player.currentTime
                  console.log("Current time", current);
                  if (isIOS) {
                    duration *= 1000
                    current *= 1000
                  }
                  console.log("After iOS", duration, current)

                  this.audioDuration = duration;
                  this.audioProgress = Math.ceil(current / duration * 100);
                  console.log("Calculating current play progress", this.audioProgress)

                  this.audioIsPlaying = this._player.isAudioPlaying()
                });
            }, 500);
          })
          .catch((err) => {
            this.loadingProcess = false;
            console.log("something went wrong...", err);
          });

      },

      sendMessage () {
        // if(this.newReply == null){
        //    alert('Message cannot be empty');
        //    return;
        // }
        console.log("Sending Reply!!!");
        const data = {
          questionId: this.questionId,
          userId: this.userId,
          patientId: this.userId,
          questionContent: this.newReply,
          mediaUrl: "n/a",
          fileType:"n/a",
          fileExtention:"n/a",
          responderType:"user",
          token: this.token,
        };

        if (this.newReplyImage) {
          data.mediaUrl = this.newReplyImage;
          data.fileType = 'image'
        }

        if (this.newReplyAudio) {
          data.mediaUrl = this.newReplyAudio;
          data.fileType = 'audio'
        }

        console.log("Sending Reply", data)

        this.$apiServices.submitQuestionReply(this.token, data)
          .then((res) => {
            let response = JSON.parse(res.content);

            console.log("Success", response);
            this.question.question_threads.push(response.question_thread);
            this.$forceUpdate();
          })
          .catch((err) => {
            console.log("Error: ", err);
          });

        this.newReply = null;
        this.newReplyImage = null;
        this.newReplyAudio = null;

        let scrollHeight = this.$refs['chatContentStackLayout'].nativeView.height;
        console.log("Scroll height", scrollHeight);
        this.$refs.chatContentScrollView.nativeView.scrollToVerticalOffset(scrollHeight);
      },

      sameAuthorAsNextMessage (message, index) {
        if (index + 1 >= this.messages.length) {
          return false;
        }
        const nextMessage = this.messages[index + 1];
        // return message.sender.firstName === nextMessage.sender.firstName;
        return message.creator == nextMessage.creator;
      },

      processImageUpload(fileUri, resourceType) {
        this.fetchingMessages = true;
        this.loadingProcess = true;
        resourceType = resourceType || 'image'
        let uploadNotificationMessage = `Uploading ${resourceType == 'image' ? 'image':'audio'}...`;
        return new Promise((resolve, reject) => {
          const CLOUD_NAME = ''

          // body...
          var request = {
            url: `https://api.cloudinary.com/v1_1/${CLOUD_NAME}/${resourceType}/upload`,
            method: "POST",
            headers: {
                "Content-Type": "application/octet-stream",
            },
            description: uploadNotificationMessage,
            androidAutoDeleteAfterUpload: false,
            androidNotificationTitle: uploadNotificationMessage
          }

          const API_KEY = ''
          const API_SECRET = ''
          let currentTimestamp = (new Date()).getTime()
          let params = [
            {
              name: 'file',
              filename: fileUri
            },
            {
              name: 'api_key',
              value: API_KEY
            },
            {
              name: 'timestamp',
              value: currentTimestamp
            }
          ]

          let paramString = 'timestamp=' + currentTimestamp + API_SECRET
          let hash = sha1(paramString)
          let paramString2 = `timestamp=${currentTimestamp}`
          let hash2 = sha1(paramString2)
          console.log("Hashes: ", hash, paramString)
          console.log("Hashes: ", hash2, paramString2)

          params.push({
            name: 'signature',
            value: hash
          })
          console.log("Parameters: ", params)

          var backgroundSession = backgroundHttp.session('image-upload');
          var task = backgroundSession.multipartUpload(params, request);

          task.on("progress", (e) => {
              // console log data
              console.log(`uploading... ${e.currentBytes} / ${e.totalBytes}`);
          });

          task.on("error", (e) => {
              // console log data
              console.log(`Error processing upload ${e} code.`, e);
              reject(`Error uploading file!`);
              alert(`An error occurred while uploading ${resourceType == 'image' ? 'image' : 'audio'}`)
              this.loadingProcess = false;
          });

          task.on("responded", (e) => {
              this.loadingProcess = false;
              // console log data
              console.log(`received ${e.responseCode} code. Server sent: ${e.data}`);
              switch (e.responseCode) {
                case 200:
                  var uploaded_response = JSON.parse(e.data);
                  console.log("Uploaded Response", uploaded_response)
                  if (resourceType == 'image') {
                    this.newReplyImage = uploaded_response.secure_url;
                  } else {
                    this.newReplyAudio = uploaded_response.secure_url;
                  }
                  console.log("Updated", this.newReplyImage, this.newReplyAudio)
                  break;

                case 400:
                  console.log(e)
                  alert(e.data.toString())
                  break;
                default:
                  break;
              }
          });

          task.on("complete", (e) => {
              this.loadingProcess = false;
              this.fetchingMessages = false;
              if(e.responseCode == 200){
                alert("Message Upload Successful")
              }else{
                alert('Error During Upload!!')
              }
              
              // console log data
              console.log(`upload complete!`);
              console.log(`received ${e.responseCode} code`);

          });

          resolve(task);
        });
      },
      
      _initMeter() {
        this._resetMeter();
        this._meterInterval = timer.setInterval(() => {
          this.audioMeter = this.audioRecorder.getMeters();
          console.log(this.audioMeter);
        }, 300);
      },

      _resetMeter() {
        if (this._meterInterval) {
          this.audioMeter = '0';
          timer.clearInterval(this._meterInterval);
          this._meterInterval = undefined;
        }
      }
    },

    watch: {
      newReplyImage (val) {
        console.log("Image value updated", val)
        if (val) {
          this.sendMessage()
        }
      },
      newReplyAudio (val) {
        console.log("Audio value updated", val)
        if (val) {
          this.sendMessage()
        }
      }
    }
  };

  export default ChatPage;
</script>

<style scoped>
  .question-text {
    text-align: center;
    /* text-decoration: italic; */
  }
</style>