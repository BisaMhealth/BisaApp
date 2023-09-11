import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/providers/settings_provider.dart';
import 'package:bisa_app/ui/chat/chat_list.dart';
import 'package:bisa_app/ui/home/home_page.dart';
import 'package:bisa_app/ui/insurance/confirm_form.dart';
import 'package:bisa_app/ui/login/login_page.dart';
import 'package:bisa_app/ui/onboarding.dart';
import 'package:bisa_app/ui/splash.dart';
// import 'package:firebase_core/firebase_core.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:provider/provider.dart';
// import 'package:firebase_messaging/firebase_messaging.dart';
// import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:showcaseview/showcaseview.dart';

final CurrentUserProvider _currentUserProvider = CurrentUserProvider();
final BottomNavProvider _bottomNavProvider = BottomNavProvider();
final SettingsProvider _settingsProvider = SettingsProvider();

// / To verify things are working, check out the native platform logs.
// Future<void> _firebaseMessagingBackgroundHandler(RemoteMessage message) async {
//   await Firebase.initializeApp();
//   print('Handling a background message ${message.messageId}');
// }

// /// Create a [AndroidNotificationChannel] for heads up notifications
// late AndroidNotificationChannel channel;

// /// Initialize the [FlutterLocalNotificationsPlugin] package.
// late FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin;

// late NotificationSettings notificationSettings;

Future<void> main() async {
  _currentUserProvider.currentUser;
  // _settingsProvider.getSettings();
  WidgetsFlutterBinding.ensureInitialized();
  // await Firebase.initializeApp();

  // // Set the background messaging handler early on, as a named top-level function
  // FirebaseMessaging.onBackgroundMessage(_firebaseMessagingBackgroundHandler);

  // notificationSettings = await FirebaseMessaging.instance.requestPermission(
  //   alert: true,
  //   announcement: false,
  //   badge: true,
  //   carPlay: false,
  //   criticalAlert: false,
  //   provisional: true,
  //   sound: true,
  // );

  // if (!kIsWeb) {
  //   channel = const AndroidNotificationChannel(
  //     'high_importance_channel', // id
  //     'High Importance Notifications', // title
  //     'This channel is used for important notifications.', // description
  //     importance: Importance.high,
  //   );

  //   flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();

  //   /// Create an Android Notification Channel.
  //   ///
  //   /// We use this channel in the `AndroidManifest.xml` file to override the
  //   /// default FCM channel to enable heads up notifications.
  //   await flutterLocalNotificationsPlugin
  //       .resolvePlatformSpecificImplementation<
  //           AndroidFlutterLocalNotificationsPlugin>()
  //       ?.createNotificationChannel(channel);

  //   /// Update the iOS foreground notification presentation options to allow
  //   /// heads up notifications.
  //   await FirebaseMessaging.instance
  //       .setForegroundNotificationPresentationOptions(
  //     alert: true,
  //     badge: true,
  //     sound: true,
  //   );
  // }

  runApp(MultiProvider(
    providers: [
      ChangeNotifierProvider.value(value: _currentUserProvider),
      ChangeNotifierProvider.value(value: _bottomNavProvider),
      ChangeNotifierProvider.value(value: _settingsProvider),
    ],
    child: const MyApp(),
  ));
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  MyAppState createState() => MyAppState();
}

class MyAppState extends State<MyApp> {
  @override
  Widget build(BuildContext context) {
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle.dark);
    return ScreenUtilInit(
      designSize: const Size(375, 812),
      builder: (context, child) {
        return MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'Flutter Demo',
          theme: ThemeData(
            scaffoldBackgroundColor: const Color.fromRGBO(255, 255, 255, 0.98),
            // primarySwatch: Colors.blue,
            primaryColor: const Color(0xFFB5E255),
            // textTheme: MediaQuery.of(context).copyWith(textScaleFactor: 1.0)
          ),
          // builder: (context, widget) {
          //   return MediaQuery(
          //     //Setting font does not change with system font size
          //     data: MediaQuery.of(context).copyWith(textScaleFactor: 1.0),
          //     child: widget!,
          //   );
          // },
          builder: (context, widget) {
            return ShowCaseWidget(
                onStart: (index, key) {
                  if (kDebugMode) {
                    print('onStart: $index, $key');
                  }
                },
                onComplete: (index, key) {
                  if (kDebugMode) {
                    print('onComplete: $index, $key');
                  }
                  if (index == 4) {
                    SystemChrome.setSystemUIOverlayStyle(
                        SystemUiOverlayStyle.light.copyWith(
                            statusBarIconBrightness: Brightness.dark,
                            statusBarColor: Colors.white));
                  }
                },
                blurValue: 1,
                autoPlay: false,
                autoPlayDelay: const Duration(seconds: 3),
                // autoPlayLockEnable: false,
                builder: Builder(
                  builder: (context) {
                    return MediaQuery(
                        data: MediaQuery.of(context)
                            .copyWith(textScaleFactor: 1.0),
                        child: widget!);
                  },
                ));
          },
          // home: Splash(),
          initialRoute: '/splash',
          routes: {
            '/onboarding': (context) => const OnBoarding(),
            '/action': (context) => const ConfirmForm(),
            '/chat': (context) => const ChatListScreen(),
            '/login': (context) => const LoginPage(),
            '/splash': (context) => const Splash(),
            '/home': (context) => const HomePage()
          },
        );
      },
    );
  }
}
