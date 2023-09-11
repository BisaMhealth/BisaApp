import 'dart:async';

import 'package:carousel_slider/carousel_slider.dart';
import 'package:bisa_app/models/chat_list_response.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/chat/chat_details.dart';
import 'package:bisa_app/ui/chat/chat_list_item.dart';
import 'package:bisa_app/utils/date_formatter.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/scheduler.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/top_to_bottom_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';

class ChatListScreen extends StatefulWidget {
  const ChatListScreen({Key? key}) : super(key: key);

  @override
  ChatListScreenState createState() => ChatListScreenState();
}

class ChatListScreenState extends State<ChatListScreen> {
  late CurrentUser currentUser;
  List<ChatListResponseData?> chatlist = [];
  ChatListResponse initialData = ChatListResponse();

  late BottomNavProvider bottomNavVM;

  FutureOr onGoBack(dynamic value) {
    if (kDebugMode) {
      print('ok');
    }

    loadChat(currentUser.token).then((value) {
      if (kDebugMode) {
        print(value.data?.length);
      }
      if (mounted) {
        if (value.code == 200) {
          if (kDebugMode) {
            print('returned from ok');
          }
          setState(() {
            chatlist = value.data!;
          });

          bottomNavVM.setChatData(value.data);
          // setState(() {
          //   initialData = value;
          // });
        }
      }
    });
    // setState(() {

    // });
  }

  // Duration interval = Duration(seconds: 2);

  // ChatListResponse callback(int i) {
  //   print('hello');
  //   loadChat(currentUser.token).then((value){
  //     if(mounted){
  //       setState(() {
  //         initialData = value;
  //       });
  //     }

  //   });
  //   // return getMessage();
  //   return initialData;
  // }

  @override
  void initState() {
    super.initState();

    SchedulerBinding.instance.addPostFrameCallback((_) {
      // print(currentUser.token);
      loadChat(currentUser.token).then((value) {
        if (kDebugMode) {
          print(value.data?.length);
        }
        if (mounted) {
          if (value.code == 200) {
            // setState(() {

            // });
            if (kDebugMode) {
              print('returned');
            }
            setState(() {
              chatlist = value.data!;
            });

            // bottomNavVM.setChatData(value.data);
            // setState(() {
            //   initialData = value;
            // });
          }
        }
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    bottomNavVM = context.watch<BottomNavProvider>();
    if (chatlist.isEmpty) {
      chatlist = context.watch<BottomNavProvider>().chatList!;
    }
    // chatlist = context.watch<BottomNavProvider>().chatList!;

    if (kDebugMode) {
      print('loading chat');
    }

    // var list = [1,2,3];
    // var widList  = list.map((e) => Text('e')).toList();
    // widList.add(Text('ok'
    //
    // ));

    // setState(() {

    // });

    var chats = chatlist;
    chats.sort((a, b) {
      var aDate =
          a!.lastresponse == null ? a.askedOn! : a.lastresponse!.askedOn!;
      var bDate =
          b!.lastresponse == null ? b.askedOn! : b.lastresponse!.askedOn!;

      return DateTime.parse(bDate).compareTo(DateTime.parse(aDate));
    });
    // Stream<ChatListResponse> stream = Stream<ChatListResponse>.periodic(interval, callback);
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        automaticallyImplyLeading: false,
        title: Text(
          'Chats',
          style: TextStyle(
              fontWeight: FontWeight.w700,
              fontFamily: 'Lato',
              fontSize: 28.sp,
              color: const Color.fromRGBO(85, 80, 80, 0.98)),
        ),
        // flexibleSpace: Container(
        //   // height: 500.h,
        //   child: Stack(
        //     children: [
        //       Container(
        //         height: 0.16.sh,
        //         color: Colors.white,
        //       ),
        //       Positioned(
        //         top: -130.w,
        //         right: -50.w,
        //         child: FadeAnimation(2.2,-30,0,
        //           LoopWidget(30,Opacity(
        //             opacity: 0.25,
        //             child: Container(
        //               width: 150.w,
        //               height: 150.w,
        //               decoration: BoxDecoration(
        //                 shape: BoxShape.circle,
        //                 gradient: RadialGradient(
        //                   colors: [
        //                     Color.fromRGBO(63, 133, 198, 0.646),
        //                     Color.fromRGBO(63, 198, 149, 0.76),
        //                   ]
        //                 )
        //               ),
        //             ),
        //           ),700)
        //         )
        //       ),
        //       Container(
        //         height: 0.16.sh,
        //         child: FadeAnimation(1.2, - 30,0,Padding(
        //           padding: const EdgeInsets.all(8.0),
        //           child: Text('Chats',
        //             style: TextStyle(
        //               fontWeight: FontWeight.w700,
        //               fontFamily: 'Lato',
        //               fontSize: 30.sp,
        //               color: Color.fromRGBO(85, 80, 80, 0.98)
        //             ),
        //           ),
        //         ),),
        //       ),
        //     ],
        //   ),
        // ),
        elevation: 0,
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Container(
              // height: 1.sh,
              color: Colors.white,
              child: Column(
                children: [
                  // SizedBox(height: 0.12.sh,),
                  chats.isNotEmpty
                      ? Column(
                          children: [
                            ListView.builder(
                              scrollDirection: Axis.vertical,
                              physics: const NeverScrollableScrollPhysics(),
                              shrinkWrap: true,
                              itemCount: chats.length,
                              itemBuilder: (context, pos) {
                                var current = chats[pos];
                                var lastmsg = {
                                  'hasUnRead': current!.lastresponse == null
                                      ? 'false'
                                      : current.lastresponse!.respondedBy == 0
                                          ? 'false'
                                          : current.lastresponse!.readStatus ==
                                                  1
                                              ? 'false'
                                              : 'true',
                                  'msg': current.lastresponse == null
                                      ? current.question
                                      : current.lastresponse!.mediaType ==
                                              "none"
                                          ? current.lastresponse!.response
                                          : current.lastresponse!.mediaType,
                                  'date': current.lastresponse == null
                                      ? current.askedOn
                                      : current.lastresponse!.askedOn,
                                  'mediaType': current.lastresponse == null
                                      ? current.mediaType
                                      : current.lastresponse!.mediaType
                                };
                                // print(lastmsg);
                                return
                                    // FadeAnimation(
                                    //     (1.2 + (pos) / 10),
                                    //     -30,
                                    //     0,
                                    InkWell(
                                  onTap: () {
                                    if (kDebugMode) {
                                      print('${current.id}');
                                    }
                                    Navigator.push(
                                            context,
                                            PageAnimationTransition(
                                                page: ChatDetails(
                                                    id: current.id!),
                                                pageAnimationType: TopToBottomTransition()))
                                        .then((value) => onGoBack(value));
                                  },
                                  child: ChatListItem(
                                    category: '${current.category}',
                                    lastmsg: '${lastmsg['msg']}',
                                    time: DateFormatter().getVerboseDate(
                                        DateTime.parse('${lastmsg['date']}')),
                                    isClosed:
                                        current.state! == 0 ? false : true,
                                    media: '${lastmsg['mediaType']}',
                                    hasUnRead: '${lastmsg['hasUnRead']}',
                                  ),
                                );
                                // );
                              },
                              // children: chats!.map((e){
                              //   var lastmsg  = {
                              //     'msg':e!.lastresponse == null?e.question:e.lastresponse!.mediaType == null?e.lastresponse!.response : e.lastresponse!.mediaType,
                              //     'date':e.lastresponse == null?e.askedOn:e.lastresponse!.askedOn,
                              //     'mediaType': e.lastresponse == null?null:e.lastresponse!.mediaType
                              //   };
                              //   print(lastmsg);
                              //   // dynamic lastmsg = e!.lastresponse == null?e.question:e.lastresponse!.response;
                              //   return FadeAnimation(1.2,-30,0,InkWell(
                              //     onTap: (){
                              //       print('${e.id}');
                              //       Navigator.push(context, PageAnimationTransition(child: ChatDetails(id: e.id!), pageAnimationType: topToBottom));
                              //     },
                              //     child: ChatListItem(
                              //       category: 'Child Health',
                              //       lastmsg: '${lastmsg['msg']}',
                              //       time: DateFormatter().getVerboseDate(DateTime.parse(e.askedOn!)),
                              //       isClosed: e.state! == 0?false:true,
                              //       media:lastmsg['mediaType']
                              //     ),
                              //   ));
                              // }).toList(),
                            ),
                          ],
                        )
                      : Container(
                          height: 1.sh - 100.h,
                          color: Colors.white,
                          child: Center(
                              child: Column(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              CarouselSlider(
                                items: [
                                  Image.asset('assets/imgs/doctors.png'),
                                  Image.asset('assets/imgs/empty_chat.png'),
                                ],
                                options: CarouselOptions(
                                    autoPlayInterval: const Duration(seconds: 3),
                                    height: 300.h,
                                    // aspectRatio: ,
                                    viewportFraction: 1,
                                    enlargeCenterPage: true,
                                    autoPlay: true),
                              ),
                              Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Text(
                                  'Your Chat list is empty. Ask a question, our Doctors are waiting 😊 ',
                                  style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontSize: 18.sp,
                                    fontWeight: FontWeight.w400
                                  ),
                                  textAlign: TextAlign.center,
                                ),
                              )
                            ],
                          )
                        )
                      ),
                  // StreamBuilder(
                  //   // initialData: initialData,
                  //   stream: stream,
                  //   builder: (context, AsyncSnapshot<ChatListResponse>snapshot) {
                  //     if(snapshot.hasData){
                  //       var response = snapshot.data;
                  //       if(response!.code == 200){
                  //         if(response.data!.isNotEmpty){
                  //           var chats = response.data;
                  //           chats?.sort((a,b){
                  //             var aDate = a!.lastresponse == null?a.askedOn!:a.lastresponse!.askedOn!;
                  //             var bDate = b!.lastresponse == null?b.askedOn!:b.lastresponse!.askedOn!;

                  //             return DateTime.parse(bDate).compareTo(DateTime.parse(aDate));
                  //           });
                  //           return Column(
                  //             children: [
                  //               ListView.builder(
                  //                 scrollDirection: Axis.vertical,
                  //                 physics: NeverScrollableScrollPhysics(),
                  //                 shrinkWrap: true,
                  //                 itemCount: chats!.length,
                  //                 itemBuilder: (context,pos){
                  //                   var current = chats[pos];
                  //                   var lastmsg  = {
                  //                     'hasUnRead': current!.lastresponse == null? 'false' : current.lastresponse!.respondedBy == 0? 'false' : current.lastresponse!.readStatus == 1? 'false' : 'true',
                  //                     'msg':current.lastresponse == null?current.question:current.lastresponse!.mediaType == "none"?current.lastresponse!.response : current.lastresponse!.mediaType,
                  //                     'date':current.lastresponse == null?current.askedOn:current.lastresponse!.askedOn,
                  //                     'mediaType': current.lastresponse == null?"none":current.lastresponse!.mediaType

                  //                   };
                  //                   // print(lastmsg);
                  //                   return FadeAnimation((1.2 + (current.id)!/10),-30,0,InkWell(
                  //                     onTap: (){
                  //                       print('${current.id}');
                  //                       Navigator.push(context, PageAnimationTransition(child: ChatDetails(id: current.id!), pageAnimationType: topToBottom)).then((value)=>onGoBack(value));
                  //                     },
                  //                     child: ChatListItem(
                  //                       category: '${current.category}',
                  //                       lastmsg: '${lastmsg['msg']}',
                  //                       time: DateFormatter().getVerboseDate(DateTime.parse('${lastmsg['date']}')),
                  //                       isClosed: current.state! == 0?false:true,
                  //                       media:'${lastmsg['mediaType']}',
                  //                       hasUnRead: '${lastmsg['hasUnRead']}',
                  //                     ),
                  //                   ));
                  //                 },
                  //                 // children: chats!.map((e){
                  //                 //   var lastmsg  = {
                  //                 //     'msg':e!.lastresponse == null?e.question:e.lastresponse!.mediaType == null?e.lastresponse!.response : e.lastresponse!.mediaType,
                  //                 //     'date':e.lastresponse == null?e.askedOn:e.lastresponse!.askedOn,
                  //                 //     'mediaType': e.lastresponse == null?null:e.lastresponse!.mediaType
                  //                 //   };
                  //                 //   print(lastmsg);
                  //                 //   // dynamic lastmsg = e!.lastresponse == null?e.question:e.lastresponse!.response;
                  //                 //   return FadeAnimation(1.2,-30,0,InkWell(
                  //                 //     onTap: (){
                  //                 //       print('${e.id}');
                  //                 //       Navigator.push(context, PageAnimationTransition(child: ChatDetails(id: e.id!), pageAnimationType: topToBottom));
                  //                 //     },
                  //                 //     child: ChatListItem(
                  //                 //       category: 'Child Health',
                  //                 //       lastmsg: '${lastmsg['msg']}',
                  //                 //       time: DateFormatter().getVerboseDate(DateTime.parse(e.askedOn!)),
                  //                 //       isClosed: e.state! == 0?false:true,
                  //                 //       media:lastmsg['mediaType']
                  //                 //     ),
                  //                 //   ));
                  //                 // }).toList(),
                  //               ),
                  //             ],
                  //           );
                  //         }else{
                  //           return Container(
                  //             height: 1.sh - 200.h ,
                  //             color: Colors.white,
                  //             child: Center(
                  //               child: Column(
                  //                 mainAxisSize: MainAxisSize.min,
                  //                 children: [
                  //                   Image.asset('assets/imgs/empty_chat.png'),
                  //                   Padding(
                  //                     padding: const EdgeInsets.all(8.0),
                  //                     child: Text('Your Chat list is empty. Ask a question, our Doctors are waiting 😊 ',
                  //                       style: TextStyle(
                  //                         fontFamily: 'Lato',
                  //                         fontSize: 18.sp,
                  //                         fontWeight: FontWeight.w400
                  //                       ),
                  //                       textAlign: TextAlign.center,
                  //                     ),
                  //                   )
                  //                 ],
                  //               )
                  //             )
                  //           );
                  //         }

                  //       }else{
                  //         // return Container(
                  //         //   height: 1.sh - 250.h ,
                  //         //   child: Center(
                  //         //     child: Text('response.message.toString()'),
                  //         //   ),
                  //         // );
                  //         return Container(
                  //           height: 1.sh - 250.h ,
                  //           child: Center(
                  //             child: CircularProgressIndicator.adaptive(strokeWidth: 4,),
                  //           ),
                  //         );
                  //       }
                  //     }else{
                  //       return Container(
                  //         height: 1.sh - 250.h ,
                  //         child: Center(
                  //           child: CircularProgressIndicator.adaptive(strokeWidth: 4,),
                  //         ),
                  //       );
                  //     }
                  //     // return Column(
                  //     //   children: widList
                  //     // );
                  //   }
                  // ),
                  SizedBox(
                    height: 140.h,
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
