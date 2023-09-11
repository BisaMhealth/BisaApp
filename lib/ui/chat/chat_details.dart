import 'dart:io';

// import 'package:audioplayers/audioplayers.dart';
// import 'package:bisa_app/animation/fade_animation.dart';
// import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/animation/scale_widget.dart';
import 'package:bisa_app/models/chat_thread.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/chat/audio_screen.dart';
import 'package:bisa_app/ui/widgets/popup.dart';
// import 'package:bisa_app/ui/chat/audio_screen.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/scheduler.dart';
// import 'package:flutter_chat_bubble/bubble_type.dart';
import 'package:flutter_chat_bubble/chat_bubble.dart';
// import 'package:flutter_chat_bubble/clippers/chat_bubble_clipper_9.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:path_provider/path_provider.dart';
import 'package:provider/provider.dart';
import 'package:image_picker/image_picker.dart';
import 'package:cloudinary_public/cloudinary_public.dart';
import 'package:record/record.dart';
// import 'package:transparent_image/transparent_image.dart';

class ChatDetails extends StatefulWidget {
  const ChatDetails({Key? key, required this.id}) : super(key: key);

  final int id;

  @override
  ChatDetailsState createState() => ChatDetailsState();
}

class ChatDetailsState extends State<ChatDetails> {
  final cloudinary = CloudinaryPublic('dzh1cgxjd', 'ooc0zhbu', cache: false);
  final _audioRecorder = Record();
  final ScrollController _scrollController = ScrollController();
  final TextEditingController _editingController = TextEditingController();
  bool _saving = false;
  bool isPlaying = false;
  late Stream<ChatThread> stream;

  // final Map<String,bool> playerState = <String,bool>{};

  ChatThread initialData = ChatThread();

  bool isRecording = false;

  late BottomNavProvider bottomNavVM;

  @override
  void initState() {
    super.initState();
    SchedulerBinding.instance.addPostFrameCallback((_) {
      if (kDebugMode) {
        print('here');
      }
      setState(() {
        if (_scrollController.hasClients) {
          _scrollController.animateTo(
              _scrollController.position.maxScrollExtent,
              duration: const Duration(milliseconds: 1500),
              curve: Curves.easeIn);
        }

        // _scrollController.animateTo(_scrollController.position.maxScrollExtent, duration: Duration(seconds: 2), curve: Curves.easeIn);
        // _scrollController.jumpTo(_scrollController.position.maxScrollExtent);
      });

      getQuestionDetails({'id': widget.id, 'token': currentUser.token})
          .then((value) {
        setState(() {
          initialData = value;
        });
      });
    });

    //   WidgetsBinding.instance!.addPostFrameCallback((_){
    //   //write or call your logic
    //   //code will run when widget rendering complete

    // });
    // _scrollController  = new  ScrollController();
    // if(_scrollController.hasClients){
    // _scrollController.animateTo(0.0, duration: Duration(seconds: 1), curve: Curves.easeIn);
    // }

    // super.initState();
  }

  @override
  void dispose() {
    _scrollController.dispose();
    _audioRecorder.dispose();
    super.dispose();
  }

  late CurrentUser currentUser;
  Duration interval = const Duration(seconds: 2);

  ChatThread callback(int i) {
    if (kDebugMode) {
      print('hello');
    }
    getQuestionDetails({'id': widget.id, 'token': currentUser.token})
        .then((value) {
      if (mounted) {
        if (value.code == 200) {
          setState(() {
            initialData = value;
          });
        }
      }
    });
    // return getMessage();
    return initialData;
  }

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    bottomNavVM = context.read<BottomNavProvider>();
    stream = Stream<ChatThread>.periodic(interval, callback);
    return StreamBuilder<ChatThread>(
        // initialData: initialData,
        stream: stream,
        builder: (context, AsyncSnapshot<ChatThread> snapshot) {
          if (snapshot.hasError) {
            return Scaffold(
              resizeToAvoidBottomInset: true,
              appBar: AppBar(
                backgroundColor: Colors.white,
                leading: const BackButton(
                  color: Colors.black,
                ),
                title: Text(
                  'Chat',
                  style: TextStyle(
                      fontWeight: FontWeight.w700,
                      fontFamily: 'Lato',
                      fontSize: 30.sp,
                      color: const Color.fromRGBO(85, 80, 80, 0.98)),
                ),
                elevation: 0,
              ),
              body: Center(
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Image.asset('assets/imgs/notify.png'),
                    SizedBox(
                      height: 10.h,
                    ),
                    Text(
                      "Sorry we encountered an error",
                      style: TextStyle(
                          fontFamily: 'Lato',
                          fontSize: 18.sp,
                          fontWeight: FontWeight.w400),
                      textAlign: TextAlign.center,
                    ),
                  ],
                ),
              ),
            );
          } else if (snapshot.hasData) {
            if (snapshot.data!.code == 200) {
              ChatThreadData chatThread = snapshot.data!.data!;
              var chatthreadItems = chatThread.followups!;
              // [... chatthreadItems];
              // chatthreadItems.map().g
              // chatthreadItems.add(chatThread.question);
              // if(chatThread.followups!.isNotEmpty){
              //   chatthreadItems.addAll(chatThread.followups!.take(chatThread.followups!.length));
              // }

              // ChatThreadDataQuestion rr;
              // rr.

              return Scaffold(
                resizeToAvoidBottomInset: true,
                appBar: AppBar(
                  backgroundColor: Colors.white,
                  leading: const BackButton(
                    color: Colors.black,
                  ),
                  title: Text(
                    'Chat',
                    style: TextStyle(
                        fontWeight: FontWeight.w700,
                        fontFamily: 'Lato',
                        fontSize: 30.sp,
                        color: const Color.fromRGBO(85, 80, 80, 0.98)),
                  ),
                  elevation: 0,
                ),
                body: SafeArea(
                  top: false,
                  child: Stack(
                    children: [
                      SingleChildScrollView(
                        controller: _scrollController,
                        child: Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: Column(
                            children: [
                              // SizedBox(height: 0.12.sh,),
                              ListView.builder(
                                shrinkWrap: true,
                                physics: const NeverScrollableScrollPhysics(),
                                itemCount: chatThread.followups!.length,
                                itemBuilder: (context, pos) {
                                  // return Text('${chatthreadItems[pos].response}');
                                  if (pos == 0) {
                                    if (chatthreadItems[pos]!
                                            .mediaType!
                                            .toLowerCase() ==
                                        'image') {
                                      return ChatBubble(
                                        clipper: ChatBubbleClipper9(
                                            type: BubbleType.sendBubble),
                                        alignment: Alignment.topRight,
                                        margin: const EdgeInsets.only(top: 10),
                                        backGroundColor: Colors.green.shade100,
                                        child: Container(
                                          constraints: BoxConstraints(
                                              maxWidth: MediaQuery.of(context)
                                                      .size
                                                      .width *
                                                  0.7,
                                              maxHeight: 300.h),
                                          child: Image(
                                            loadingBuilder:
                                                (BuildContext context,
                                                    Widget child,
                                                    ImageChunkEvent?
                                                        loadingProgress) {
                                              if (loadingProgress == null) {
                                                return child;
                                              }
                                              return Center(
                                                child: CircularProgressIndicator
                                                    .adaptive(
                                                  value: loadingProgress
                                                              .expectedTotalBytes !=
                                                          null
                                                      ? loadingProgress
                                                              .cumulativeBytesLoaded /
                                                          loadingProgress
                                                              .expectedTotalBytes!
                                                      : null,
                                                ),
                                              );
                                            },
                                            image: NetworkImage(
                                                "${chatthreadItems[pos]!.mediaUrl}",
                                                headers: {
                                                  'Content-type': 'image/jpg'
                                                }),
                                          ),
                                          // child: FadeInImage.memoryNetwork(
                                          //   placeholder: kTransparentImage,
                                          //   image:  "${chatthreadItems[pos]!.mediaUrl}",
                                          // )
                                        ),
                                      );
                                    } else if (chatthreadItems[pos]!
                                            .mediaType!
                                            .toLowerCase() ==
                                        'audio') {
                                      // var maxD = duration.inSeconds.toDouble() != 0.0? duration.inSeconds.toDouble():1.0;
                                      // setState(() {
                                      //   isPlaying =  true;
                                      // });

                                      var audioFile =
                                          '${chatthreadItems[pos]!.mediaUrl}';

                                      return ChatBubble(
                                        clipper: ChatBubbleClipper9(
                                            type: BubbleType.sendBubble),
                                        alignment: Alignment.topRight,
                                        margin: const EdgeInsets.only(top: 10),
                                        backGroundColor: Colors.green.shade100,
                                        child: Container(
                                            constraints: BoxConstraints(
                                                maxWidth: MediaQuery.of(context)
                                                        .size
                                                        .width *
                                                    0.7,
                                                maxHeight: 300.h),
                                            width: MediaQuery.of(context)
                                                    .size
                                                    .width *
                                                0.3,
                                            height: 60.h,
                                            child: Row(
                                              children: [
                                                InkWell(
                                                  onTap: () {
                                                    Navigator.push(
                                                      context,
                                                      MaterialPageRoute(
                                                        builder: (context) =>
                                                            AudioScreen(
                                                                fileUrl:
                                                                    audioFile),
                                                      ),
                                                    );
                                                    // playAudio(audioFile,chatthreadItems[pos]!.hasFile!);
                                                  },
                                                  child: Container(
                                                      height: 60.h,
                                                      decoration:
                                                          const BoxDecoration(
                                                              shape: BoxShape
                                                                  .circle,
                                                              color: Colors
                                                                  .white60),
                                                      child: Icon(
                                                        isPlaying
                                                            ? Icons
                                                                .pause_rounded
                                                            : Icons
                                                                .play_arrow_rounded,
                                                        size: 50,
                                                      )),
                                                ),
                                                // Container(
                                                //   width: 0.5.sw,
                                                //   child: Slider.adaptive(
                                                //     value: position.inSeconds.toDouble(),
                                                //     inactiveColor: Colors.white54,
                                                //     activeColor: Colors.green,
                                                //     max: duration.inSeconds.toDouble() != 0.0? duration.inSeconds.toDouble():1.0,
                                                //     // mouseCursor: ,
                                                //     onChanged:(value){
                                                //       setState(() {
                                                //         audioPlayer.seek(new Duration(seconds: value.toInt(),),);
                                                //       });
                                                //     }
                                                //   )
                                                // )
                                              ],
                                            )),
                                      );
                                    } else {
                                      return ChatBubble(
                                        clipper: ChatBubbleClipper9(
                                            type: BubbleType.sendBubble),
                                        alignment: Alignment.topRight,
                                        margin: const EdgeInsets.only(top: 10),
                                        backGroundColor: Colors.green.shade100,
                                        child: Container(
                                          constraints: BoxConstraints(
                                            maxWidth: MediaQuery.of(context)
                                                    .size
                                                    .width *
                                                0.7,
                                          ),
                                          child: Text(
                                            '${chatthreadItems[pos]!.response}',
                                            style: TextStyle(
                                                color: Colors.black,
                                                fontFamily: 'Lato',
                                                fontWeight: FontWeight.w600,
                                                fontSize: 17.sp),
                                          ),
                                        ),
                                      );
                                    }
                                  } else {
                                    if (chatthreadItems[pos]!.respondedBy ==
                                        0) {
                                      if (chatthreadItems[pos]!
                                              .mediaType!
                                              .toLowerCase() ==
                                          'image') {
                                        return ChatBubble(
                                          clipper: ChatBubbleClipper9(
                                              type: BubbleType.sendBubble),
                                          alignment: Alignment.topRight,
                                          margin:
                                              const EdgeInsets.only(top: 10),
                                          backGroundColor:
                                              Colors.green.shade100,
                                          child: Container(
                                              constraints: BoxConstraints(
                                                  maxWidth:
                                                      MediaQuery.of(context)
                                                              .size
                                                              .width *
                                                          0.7,
                                                  maxHeight: 300.h),
                                              child: Image(
                                                loadingBuilder:
                                                    (BuildContext context,
                                                        Widget child,
                                                        ImageChunkEvent?
                                                            loadingProgress) {
                                                  if (loadingProgress == null) {
                                                    return child;
                                                  }
                                                  return Center(
                                                    child:
                                                        CircularProgressIndicator
                                                            .adaptive(
                                                      value: loadingProgress
                                                                  .expectedTotalBytes !=
                                                              null
                                                          ? loadingProgress
                                                                  .cumulativeBytesLoaded /
                                                              loadingProgress
                                                                  .expectedTotalBytes!
                                                          : null,
                                                    ),
                                                  );
                                                },
                                                image: NetworkImage(
                                                    "${chatthreadItems[pos]!.mediaUrl}",
                                                    headers: {
                                                      'Content-type':
                                                          'image/jpg'
                                                    }),
                                              )
                                              // child: FadeInImage.memoryNetwork(
                                              //   placeholder: kTransparentImage,
                                              //   image:  "${chatthreadItems[pos]!.mediaUrl}",
                                              // )
                                              ),
                                        );
                                      } else if (chatthreadItems[pos]!
                                              .mediaType!
                                              .toLowerCase() ==
                                          'audio') {
                                        var audioFile =
                                            '${chatthreadItems[pos]!.mediaUrl}';
                                        return ChatBubble(
                                          clipper: ChatBubbleClipper9(
                                              type: BubbleType.sendBubble),
                                          alignment: Alignment.topRight,
                                          margin:
                                              const EdgeInsets.only(top: 10),
                                          backGroundColor:
                                              Colors.green.shade100,
                                          child: Container(
                                              constraints: BoxConstraints(
                                                  maxWidth:
                                                      MediaQuery.of(context)
                                                              .size
                                                              .width *
                                                          0.7,
                                                  maxHeight: 300.h),
                                              width: MediaQuery.of(context)
                                                      .size
                                                      .width *
                                                  0.3,
                                              height: 60.h,
                                              child: Row(
                                                children: [
                                                  InkWell(
                                                    onTap: () {
                                                      Navigator.push(
                                                        context,
                                                        MaterialPageRoute(
                                                          builder: (context) =>
                                                              AudioScreen(
                                                                  fileUrl:
                                                                      audioFile),
                                                        ),
                                                      );
                                                      // playAudio(audioFile,chatthreadItems[pos]!.hasFile!);
                                                    },
                                                    child: Container(
                                                        height: 60.h,
                                                        decoration:
                                                            const BoxDecoration(
                                                                shape: BoxShape
                                                                    .circle,
                                                                color: Colors
                                                                    .white60),
                                                        child: Icon(
                                                          isPlaying
                                                              ? Icons
                                                                  .pause_rounded
                                                              : Icons
                                                                  .play_arrow_rounded,
                                                          size: 50,
                                                        )),
                                                  ),
                                                  // Container(
                                                  //   width: 0.5.sw,
                                                  //   child: Slider.adaptive(
                                                  //     value: position.inSeconds.toDouble(),
                                                  //     inactiveColor: Colors.white54,
                                                  //     activeColor: Colors.green,
                                                  //     max: duration.inSeconds.toDouble() != 0.0? duration.inSeconds.toDouble():1.0,
                                                  //     // mouseCursor: ,
                                                  //     onChanged:(value){
                                                  //       setState(() {
                                                  //         audioPlayer.seek(new Duration(seconds: value.toInt(),),);
                                                  //       });
                                                  //     }
                                                  //   )
                                                  // )
                                                ],
                                              )),
                                        );
                                      } else {
                                        return ChatBubble(
                                          clipper: ChatBubbleClipper9(
                                              type: BubbleType.sendBubble),
                                          alignment: Alignment.topRight,
                                          margin:
                                              const EdgeInsets.only(top: 10),
                                          backGroundColor:
                                              Colors.green.shade100,
                                          child: Container(
                                            constraints: BoxConstraints(
                                              maxWidth: MediaQuery.of(context)
                                                      .size
                                                      .width *
                                                  0.7,
                                            ),
                                            child: Text(
                                              '${chatthreadItems[pos]!.response}',
                                              style: TextStyle(
                                                  color: Colors.black,
                                                  fontFamily: 'Lato',
                                                  fontWeight: FontWeight.w600,
                                                  fontSize: 17.sp),
                                            ),
                                          ),
                                        );
                                      }
                                    } else {
                                      if (chatthreadItems[pos]!
                                              .mediaType!
                                              .toLowerCase() ==
                                          'audio') {
                                        var audioFile =
                                            '${chatthreadItems[pos]!.mediaUrl}';
                                        return ChatBubble(
                                          clipper: ChatBubbleClipper9(
                                              type: BubbleType.receiverBubble),
                                          backGroundColor:
                                              const Color(0xffE7E7ED),
                                          margin:
                                              const EdgeInsets.only(top: 10),
                                          child: Container(
                                              constraints: BoxConstraints(
                                                  maxWidth:
                                                      MediaQuery.of(context)
                                                              .size
                                                              .width *
                                                          0.7,
                                                  maxHeight: 300.h),
                                              width: MediaQuery.of(context)
                                                      .size
                                                      .width *
                                                  0.3,
                                              height: 60.h,
                                              child: Row(
                                                children: [
                                                  InkWell(
                                                    onTap: () {
                                                      Navigator.push(
                                                        context,
                                                        MaterialPageRoute(
                                                          builder: (context) =>
                                                              AudioScreen(
                                                                  fileUrl:
                                                                      audioFile),
                                                        ),
                                                      );
                                                      // playAudio(audioFile,chatthreadItems[pos]!.hasFile!);
                                                    },
                                                    child: Container(
                                                        height: 60.h,
                                                        decoration:
                                                            const BoxDecoration(
                                                                shape: BoxShape
                                                                    .circle,
                                                                color: Colors
                                                                    .white60),
                                                        child: Icon(
                                                          isPlaying
                                                              ? Icons
                                                                  .pause_rounded
                                                              : Icons
                                                                  .play_arrow_rounded,
                                                          size: 50,
                                                        )),
                                                  ),
                                                  // Container(
                                                  //   width: 0.5.sw,
                                                  //   child: Slider.adaptive(
                                                  //     value: position.inSeconds.toDouble(),
                                                  //     inactiveColor: Colors.white54,
                                                  //     activeColor: Colors.green,
                                                  //     max: duration.inSeconds.toDouble() != 0.0? duration.inSeconds.toDouble():1.0,
                                                  //     // mouseCursor: ,
                                                  //     onChanged:(value){
                                                  //       setState(() {
                                                  //         audioPlayer.seek(new Duration(seconds: value.toInt(),),);
                                                  //       });
                                                  //     }
                                                  //   )
                                                  // )
                                                ],
                                              )),
                                        );
                                      } else {
                                        return ChatBubble(
                                          clipper: ChatBubbleClipper9(
                                              type: BubbleType.receiverBubble),
                                          backGroundColor:
                                              const Color(0xffE7E7ED),
                                          margin:
                                              const EdgeInsets.only(top: 10),
                                          child: Container(
                                            constraints: BoxConstraints(
                                              maxWidth: MediaQuery.of(context)
                                                      .size
                                                      .width *
                                                  0.7,
                                            ),
                                            child: Text(
                                              '${chatthreadItems[pos]!.response}',
                                              style: TextStyle(
                                                  color: Colors.black,
                                                  fontFamily: 'Lato',
                                                  fontWeight: FontWeight.w600,
                                                  fontSize: 17.sp),
                                            ),
                                          ),
                                        );
                                      }
                                    }
                                  }
                                },
                                //   ChatBubble(
                                //     clipper: ChatBubbleClipper9(type: BubbleType.receiverBubble),
                                //     backGroundColor: Color(0xffE7E7ED),
                                //     margin: EdgeInsets.only(top: 20),
                                //     child: Container(
                                //       constraints: BoxConstraints(
                                //         maxWidth: MediaQuery.of(context).size.width * 0.7,
                                //       ),
                                //       child: Text(
                                //         "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat",
                                //         style: TextStyle(color: Colors.black),
                                //       ),
                                //     ),
                                //   ),
                                //   SizedBox(height: 0.08.sh,),

                                // ],
                              ),
                              SizedBox(
                                height: 90.h,
                              ),
                              // ... chatthreadItems.map((e) => Text('e')),
                            ],
                          ),
                        ),
                      ),
                      Align(
                        alignment: Alignment.bottomCenter,
                        child: Container(
                          padding: const EdgeInsets.only(
                              left: 10, bottom: 10, top: 10),
                          height: 60.h,
                          width: double.infinity,
                          color: Colors.white,
                          child: Row(
                            children: <Widget>[
                              SizedBox(
                                width: 10.w,
                              ),
                              Expanded(
                                child: Container(
                                  // height:420.h ,
                                  child: isRecording
                                      ? Row(
                                          children: [
                                            const CircularProgressIndicator
                                                .adaptive(
                                              valueColor:
                                                  AlwaysStoppedAnimation<Color>(
                                                      Colors.green),
                                            ),
                                            SizedBox(
                                              width: 10.w,
                                            ),
                                            const Text(
                                              'Recording...',
                                              style: TextStyle(
                                                  fontFamily: 'Lato',
                                                  fontWeight: FontWeight.w400,
                                                  fontSize: 18),
                                            )
                                          ],
                                        )
                                      : TextField(
                                          controller: _editingController,
                                          enabled: !_saving,
                                          // expands: true,
                                          // maxLines: 3,
                                          // minLines: null,
                                          decoration: const InputDecoration(
                                            hintText: "Write message...",
                                            hintStyle: TextStyle(
                                                color: Colors.black54,
                                                fontFamily: 'Lato',
                                                fontWeight: FontWeight.w400,
                                                fontSize: 18),
                                            border: InputBorder.none,
                                            contentPadding: EdgeInsets.all(8),
                                          ),
                                        ),
                                ),
                              ),
                              SizedBox(
                                width: 6.w,
                              ),
                              if (_saving) ...[
                                const CircularProgressIndicator.adaptive(
                                  valueColor: AlwaysStoppedAnimation<Color>(
                                      Colors.green),
                                )
                              ] else ...[
                                _editingController.text.isNotEmpty
                                    ? const SizedBox.shrink()
                                    : isRecording
                                        ? InkWell(
                                            onTap: () {
                                              // setState(() {
                                              //   isRecording = false;
                                              // });
                                              cancelRecording();
                                            },
                                            child: const Icon(
                                                CupertinoIcons.delete,
                                                color: Colors.green,
                                                size: 30),
                                          )
                                        : IconButton(
                                            iconSize: 28.w,
                                            onPressed: () async {
                                              var image = await ImagePicker
                                                  .platform
                                                  .getImageFromSource(
                                                      source:
                                                          ImageSource.gallery);

                                              if (image != null) {
                                                setState(() {
                                                  _saving = true;
                                                });

                                                uploadFile(
                                                    image.path,
                                                    CloudinaryResourceType
                                                        .Image);
                                              }
                                            },
                                            icon: const Icon(
                                              CupertinoIcons.camera,
                                              color: Colors.green,
                                            )),
                                SizedBox(
                                  width: 5.w,
                                ),
                                _editingController.text.isEmpty
                                    ? isRecording
                                        ? FloatingActionButton(
                                            onPressed: () {
                                              stopRecording();
                                            },
                                            backgroundColor: Colors.green,
                                            elevation: 0,
                                            child: const Icon(
                                              Icons.send,
                                              color: Colors.white,
                                              size: 24,
                                            ),
                                          )
                                        : IconButton(
                                            iconSize: 28.w,
                                            onPressed: () {
                                              // setState(() {
                                              //   isRecording = true;
                                              // });
                                              if (kDebugMode) {
                                                print('record');
                                              }
                                              startRecording();
                                            },
                                            icon: const Icon(CupertinoIcons.mic,
                                                color: Colors.green))
                                    : FloatingActionButton(
                                        onPressed: () {
                                          if (_editingController
                                                  .text.isNotEmpty &&
                                              !_saving) {
                                            setState(() {
                                              _saving = true;
                                            });
                                            handleFollowUp();
                                          }
                                        },
                                        backgroundColor: Colors.green,
                                        elevation: 0,
                                        child: const Icon(
                                          Icons.send,
                                          color: Colors.white,
                                          size: 24,
                                        ),
                                      ),
                                SizedBox(
                                  width: 5.w,
                                ),
                              ],
                              SizedBox(
                                width: 5.w,
                              ),
                            ],
                          ),
                        ),
                      )
                    ],
                  ),
                ),
              );
            } else {
              return Scaffold(
                resizeToAvoidBottomInset: true,
                appBar: AppBar(
                  backgroundColor: Colors.white,
                  leading: const BackButton(
                    color: Colors.black,
                  ),
                  title: Text(
                    'Chat',
                    style: TextStyle(
                        fontWeight: FontWeight.w700,
                        fontFamily: 'Lato',
                        fontSize: 30.sp,
                        color: const Color.fromRGBO(85, 80, 80, 0.98)),
                  ),
                  elevation: 0,
                ),
                body: Center(
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Image.asset('assets/imgs/notify.png'),
                      SizedBox(
                        height: 10.h,
                      ),
                      Text(
                        "Sorry we encountered an error",
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18.sp,
                            fontWeight: FontWeight.w400),
                        textAlign: TextAlign.center,
                      ),
                    ],
                  ),
                ),
              );
            }
          } else {
            return Scaffold(
                resizeToAvoidBottomInset: true,
                appBar: AppBar(
                  backgroundColor: Colors.white,
                  leading: const BackButton(
                    color: Colors.black,
                  ),
                  title: Text(
                    'Chat',
                    style: TextStyle(
                        fontWeight: FontWeight.w700,
                        fontFamily: 'Lato',
                        fontSize: 30.sp,
                        color: const Color.fromRGBO(85, 80, 80, 0.98)),
                  ),
                  elevation: 0,
                ),
                body: Center(
                  child: Column(
                    // mainAxisSize: MainAxisSize.min,
                    children: [
                      ScaleWidget(
                          time: 800,
                          offsetX: 40,
                          offsetY: 40,
                          child: Image.asset('assets/imgs/bisa_icon.png')),
                    ],
                  ),
                ));
          }
        });
    // );
  }

  void handleFollowUp() {
    if (kDebugMode) {
      print('saving');
    }
    Map<String, dynamic> dataMap = {
      "msg": _editingController.text,
      "id": widget.id,
      "token": currentUser.token
    };

    sendFollowUp(dataMap).then((value) {
      _editingController.text = "";
      if (value['status'] == 'success') {
        getQuestionDetails({'id': widget.id, 'token': currentUser.token})
            .then((value) {
          if (mounted) {
            setState(() {
              initialData = value;
            });
          }
        });
        setState(() {
          _saving = false;
        });
      }
    });
  }

  Future<String?> _findLocalPath() async {
    final directory = Platform.isAndroid
        ? await getExternalStorageDirectory()
        // ? await
        : await getApplicationDocumentsDirectory();
    if (kDebugMode) {
      print("File path: ${directory?.path}");
    }
    return directory?.path;
  }

  void startRecording() async {
    if (kDebugMode) {
      print('in start recording');
    }
    var platformExtension = Platform.isAndroid ? 'm4a' : 'caf';
    var pathV = await _findLocalPath();
    try {
      if (await _audioRecorder.hasPermission()) {
        await _audioRecorder.start(
            path:
                '${pathV!}${Platform.pathSeparator}recording_${DateTime.now()}.$platformExtension');

        if (kDebugMode) {
          print('in start recording try');
        }
        bool isRecordingAudio = await _audioRecorder.isRecording();
        if (kDebugMode) {
          print(isRecordingAudio);
        }
        setState(() {
          isRecording = isRecordingAudio;
          // _recordDuration = 0;
        });

        // _startTimer();
      }
    } catch (e) {
      if (kDebugMode) {
        print(e);
      }
    }
  }

  void cancelRecording() async {
    await _audioRecorder.stop();
    bool isRecordingAudio = await _audioRecorder.isRecording();
    setState(() {
      isRecording = isRecordingAudio;
      // _recordDuration = 0;
    });
  }

  void stopRecording() async {
    final path = await _audioRecorder.stop();
    bool isRecordingAudio = await _audioRecorder.isRecording();
    setState(() {
      isRecording = isRecordingAudio;
    });
    if (kDebugMode) {
      print(path);
    }
    setState(() {
      _saving = true;
    });
    uploadFile(path!, CloudinaryResourceType.Auto).then((value) {});
  }

  Future<void> uploadFile(
    String path,
    CloudinaryResourceType type,
  ) async {
    // var path = type == CloudinaryResourceType.Image? image
    try {
      CloudinaryResponse response = await cloudinary.uploadFile(
        CloudinaryFile.fromFile(path, resourceType: type),
      );

      if (kDebugMode) {
        print(response.secureUrl);
      }
      sendMediaFollowUp(response.secureUrl);
      // return response.secureUrl;
    } on CloudinaryException catch (e) {
      if (kDebugMode) {
        print(e.message);
        print(e.request);
      }
      // return 'error';
      return showDialog(
          context: context,
          builder: (BuildContext context) {
            return Popup(
              msg: e.message,
            );
          });
    }
  }

  void sendMediaFollowUp(String secureUrl) {
    Map<String, dynamic> dataMap = {
      "media_url": secureUrl,
      "id": widget.id,
      "token": currentUser.token
    };

    sendFollowUp(dataMap).then((value) {
      // print(value);
      setState(() {
        _saving = true;
      });

      if (value['status'] == 'success') {
        getQuestionDetails({'id': widget.id, 'token': currentUser.token})
            .then((value) {
          if (mounted) {
            setState(() {
              initialData = value;
            });
          }
        });
        setState(() {
          _saving = false;
        });

        loadChat(currentUser.token).then((value) {
          if (mounted) {
            if (value.code == 200) {
              bottomNavVM.setChatData(value.data);
              // setState(() {
              //   initialData = value;
              // });
            }
          }
        });
      } else {
        setState(() {
          _saving = true;
        });
        // snak
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('${value['message']}'),
            // action: SnackBarAction(
            //   label: 'Action',
            //   onPressed: () {
            //     // Code to execute.
            //   },
            // ),
          ),
        );
        // return showDialog(
        //   context: context,
        //   builder: (BuildContext context){
        //     return Popup(msg: '${value['message']}',);
        //   }
        // );
      }
    });
  }
}

// Stack(
//   children: [
//     Container(
//       height: 210.h,
//     ),
//     Positioned(
//       top: -50.w,
//       right: -50.w,
//       child: FadeAnimation(2.2,-30,0,
//         LoopWidget(30,Opacity(
//           opacity: 0.25,
//           child: Container(
//             width: 200.w,
//             height: 200.w,
//             decoration: BoxDecoration(
//               shape: BoxShape.circle,
//               gradient: RadialGradient(
//                 colors: [
//                   Color.fromRGBO(63, 133, 198, 0.646),
//                   Color.fromRGBO(63, 198, 149, 0.76),
//                 ]
//               )
//             ),
//           ),
//         ),700)
//       )
//     ),
//     Container(
//       height: 210.h,
//       child: FadeAnimation(1.2, - 30,0,Column(
//         children: [
//           SizedBox(height: 70.h),
//           Padding(
//             padding: EdgeInsets.all(18.0),
//             child: Row(
//               children: [
//                 InkWell(
//                   onTap: (){
//                     Navigator.pop(context);
//                   },
//                   child: Icon(CupertinoIcons.chevron_back)
//                 ),
//                 SizedBox(width: 10.w,),
//                 Text('Chat',
//                   style: TextStyle(
//                     fontWeight: FontWeight.w700,
//                     fontFamily: 'Lato',
//                     fontSize: 25.sp,
//                     color: Color.fromRGBO(85, 80, 80, 0.98)
//                   ),
//                 ),
//               ],
//             ),
//           ),
//         ],
//       ),),
//     ),
//   ],
// ),
