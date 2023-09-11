import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/models/chat_list_response.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
// import 'package:bisa_app/ui/chat/chat_details.dart';
import 'package:bisa_app/ui/chat/chat_list.dart';
import 'package:bisa_app/ui/chat/start_question.dart';
import 'package:bisa_app/ui/home/home.dart';
import 'package:bisa_app/ui/profile/profile_page.dart';
import 'package:bisa_app/ui/tips/tips_page.dart';
// import 'package:bisa_app/ui/widgets/popup.dart';
import 'package:flutter/cupertino.dart';
// import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:badges/badges.dart' as badges;
// import 'package:page_animation_transition/animations/top_to_bottom_transition.dart';
// import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';
// import 'package:firebase_messaging/firebase_messaging.dart';
// import 'package:flutter_local_notifications/flutter_local_notifications.dart';
// import '../../main.dart';
import 'package:badges/badges.dart';
// import 'package:showcaseview/showcaseview.dart';

class HomePage extends StatefulWidget {
  const HomePage({Key? key}) : super(key: key);

  @override
  HomePageState createState() => HomePageState();
}

class HomePageState extends State<HomePage> {
  // late CurrentUser currentUser;
  late BottomNavProvider bottomNavVM;
  GlobalKey one = GlobalKey();
  GlobalKey two = GlobalKey();
  GlobalKey three = GlobalKey();
  GlobalKey four = GlobalKey();
  // ignore: unused_field
  final GlobalKey _five = GlobalKey();
  late List<Widget> _widgetOptions;

  bool isSelected(int pos) {
    return bottomNavVM.currentIndex == pos;
  }

  late CurrentUser currentUser;
  ChatListResponse initialData = ChatListResponse();

  @override
  void initState() {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    super.initState();
    _widgetOptions = <Widget>[
      const Home(),
      const ChatListScreen(),
      const TipsPage(),
      const ProfilePage()
    ];

    //Start showcase view after current widget frames are drawn.
    // WidgetsBinding.instance!.addPostFrameCallback((_) =>
    //     ShowCaseWidget.of(context)!
    //         .startShowCase([one ]));

    setupInteractedMessage();

    loadChat(currentUser.token).then((value) {
      if (mounted) {
        if (value.code == 200) {
          // print(value.data!.length);
          bottomNavVM.setChatData(value.data);
          setState(() {
            initialData = value;
          });
        }
      }
    });

    // FirebaseMessaging.onMessage.listen((RemoteMessage message) {
    //   print('Got a message whilst in the foreground!');
    //   print('Message data: ${message.data}');

    //   if (message.notification != null) {
    //     print('Message also contained a notification: ${message.notification}');
    //   }
    //   // if(message.data['type'] == 'chat'){
    //   //   int liveId = int.parse(message.data['question_id']);
    //   //   Navigator.push(context, PageAnimationTransition(child: ChatDetails(id: liveId), pageAnimationType: topToBottom));
    //   // }
    //   // getQuestionDetails({
    //   //   'id':int.parse(message.data['question_id']),
    //   //   'token': currentUser.token
    //   // });

    //   loadChat(currentUser.token).then((value) {
    //     if (mounted) {
    //       if (value.code == 200) {
    //         bottomNavVM.setChatData(value.data);
    //         setState(() {
    //           initialData = value;
    //         });
    //       }
    //     }
    //   });
    //   RemoteNotification notification = message.notification!;
    //   // AndroidNotification android = message.notification!.android!;
    //   if (!kIsWeb) {
    //     flutterLocalNotificationsPlugin.show(
    //         notification.hashCode,
    //         notification.title,
    //         notification.body,
    //         NotificationDetails(
    //           android: AndroidNotificationDetails(
    //             channel.id,
    //             channel.name,
    //             channel.description,
    //             // TODOd add a proper drawable resource to android, for now using
    //             //      one that already exists in example app.
    //             icon: 'bisa_icon',
    //           ),
    //         ));
    //   }
    // });
  }

  @override
  Widget build(BuildContext context) {
    // if (notificationSettings.authorizationStatus ==
    //     AuthorizationStatus.authorized) {
    //   print('User granted permission');
    // } else if (notificationSettings.authorizationStatus ==
    //     AuthorizationStatus.provisional) {
    //   print('User granted provisional permission');
    // } else {
    //   print('User declined or has not accepted permission');
    //   showDialog(
    //       context: context,
    //       builder: (BuildContext context) {
    //         return Popup(
    //           msg: 'Permission required to show notifications.',
    //         );
    //       });
    // }
    bottomNavVM = context.watch<BottomNavProvider>();
    // ignore: unused_local_variable
    var selectedColor = Colors.green;

    //  Stream<ChatListResponse> stream = Stream<ChatListResponse>.periodic(interval, callback);
    //  Stream<ChatListResponse> stream = Stream<ChatListResponse>

    // return ShowCaseWidget
    // (
    //   builder: Builder(builder: (context){
    return Scaffold(
      extendBody: true,
      // appBar: AppBar(),
      body: Container(
        child: _widgetOptions.elementAt(bottomNavVM.currentIndex),
      ),
      bottomNavigationBar: FadeAnimation(
          1.5,
          30,
          0,
          BottomAppBar(
            shape: const CircularNotchedRectangle(),
            notchMargin: 8,
            child: Row(
              //children inside bottom appbar
              mainAxisSize: MainAxisSize.max,
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: <Widget>[
                InkWell(
                    onTap: () {
                      _onItemTapped(0);
                    },
                    child: Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Image.asset(
                        'assets/imgs/home.png',
                        color: isSelected(0) ? Colors.green : null,
                      ),
                    )),
                FutureBuilder(
                    future: loadChat(currentUser.token),
                    builder:
                        (context, AsyncSnapshot<ChatListResponse> snapshot) {
                      var unans = snapshot.data?.data?.where((value) {
                        // return value?.lastresponse != null;
                        return value?.lastresponse != null &&
                            value?.lastresponse?.respondedBy != 0 &&
                            value?.lastresponse?.readStatus == 0;
                        // if(value?.lastresponse != null){
                        //   if(value?.lastresponse?.respondedBy != 0){
                        //     return value?.lastresponse?.)
                        //   }
                        // }
                        // value?.lastresponse != null? value?.lastresponse?.respondedBy == 0? 'false' : current.lastresponse!.readStatus == 1? 'false' : 'true',
                      });
                      return badges.Badge(
                        badgeStyle: const BadgeStyle(
                          badgeColor: Colors.red,
                        ),
                        // badgeColor: Colors.red,
                        badgeContent: Text(
                          '${unans?.length}',
                          style: const TextStyle(
                            fontFamily: 'Lato',
                            color: Colors.white,
                            // fontSize: 30
                          ),
                        ),
                        showBadge: unans == null
                            ? false
                            : unans.isEmpty
                                ? false
                                : true,
                        position: BadgePosition.topEnd(top: 10, end: 10),
                        child: InkWell(
                            onTap: () {
                              _onItemTapped(1);
                            },
                            child: Padding(
                              padding: const EdgeInsets.all(20.0),
                              // child: Image.asset('assets/imgs/cart.png',color: isSelected(1)? Colors.green:null,),
                              child: Icon(
                                CupertinoIcons.chat_bubble_2_fill,
                                color: isSelected(1)
                                    ? Colors.green
                                    : const Color.fromRGBO(186, 185, 208, 1),
                                size: 34,
                              ),
                            )),
                      );
                    }),
                InkWell(
                    onTap: () {
                      _onItemTapped(2);
                    },
                    child: Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Image.asset(
                        'assets/imgs/chart.png',
                        color: isSelected(2) ? Colors.green : null,
                      ),
                    )),
                InkWell(
                    onTap: () {
                      _onItemTapped(3);
                    },
                    child: Padding(
                      padding: const EdgeInsets.all(20.0),
                      child: Image.asset(
                        'assets/imgs/person.png',
                        color: isSelected(3) ? Colors.green : null,
                      ),
                    )),
              ],
            ),
          )),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
      floatingActionButton:
          // Showcase(
          //   key: one,
          //   title: 'Start a Question',
          //   description: 'Click here to compose a question',
          //   shapeBorder: CircleBorder(),
          //   child:
          FloatingActionButton(
        backgroundColor: Colors.white,
        child: Container(
          height: 50,
          decoration: const BoxDecoration(
              shape: BoxShape.circle,
              color: Colors.white,
              image: DecorationImage(
                  image: AssetImage('assets/imgs/add_icon.png'))),
        ),
        onPressed: () {
          Navigator.push(
            context,
            MaterialPageRoute<void>(
              builder: (BuildContext context) => const StartQuestion(),
            ),
          );
        },
      ),
      // ),
    );
    //   },
    //   )
    // );
  }

  void _onItemTapped(int value) {
    // setState(() {
    //   _selectedIndex = value;
    // });
    String? title;
    switch (value) {
      case 0:
        title = 'Home';
        break;
      case 1:
        title = 'Videos';
        break;
      case 2:
        title = 'Sermons';
        break;
      case 3:
        title = 'About';
        break;
      default:
    }
    bottomNavVM.changeView(value, title);
  }

  Future<void> setupInteractedMessage() async {
    // RemoteMessage? initialMessage =
    //     await FirebaseMessaging.instance.getInitialMessage();

    // // If the message also contains a data property with a "type" of "chat",
    // // navigate to a chat screen
    // if (initialMessage != null) {
    //   _handleMessage(initialMessage);
    // }

    // // Also handle any interaction when the app is in the background via a
    // // Stream listener
    // FirebaseMessaging.onMessageOpenedApp.listen(_handleMessage);
  }

  // void _handleMessage(RemoteMessage initialMessage) {
  //   if (initialMessage.data['type'] == 'chat') {
  //     print("type is chat");
  //     int liveId = int.parse(initialMessage.data['question_id']);
  //     Navigator.push(
  //       context,
  //       PageAnimationTransition(
  //         page: ChatDetails(id: liveId),
  //         pageAnimationType: TopToBottomTransition(),
  //       ),
  //     );
  //   }
  // }
}
