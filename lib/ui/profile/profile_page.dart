import 'dart:io';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
// import 'package:bisa_app/ui/login/login_page.dart';
import 'package:bisa_app/ui/splash.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({Key? key}) : super(key: key);

  @override
  ProfilePageState createState() => ProfilePageState();
}

class ProfilePageState extends State<ProfilePage> {
  late CurrentUser currentUser;

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    return Scaffold(
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Column(
                children: [
                  SizedBox(
                    height: 0.17.sh,
                  ),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      CircleAvatar(
                        backgroundColor: const Color.fromRGBO(229, 229, 229, 1),
                        radius: 45.w,
                        child: const Icon(
                          CupertinoIcons.person_fill,
                          color: Color.fromRGBO(162, 164, 167, 1),
                        ),
                      ),
                      SizedBox(
                        height: 10.h,
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const Icon(
                            CupertinoIcons.person,
                            color: Color.fromRGBO(123, 128, 133, 1),
                          ),
                          SizedBox(
                            width: 10.w,
                          ),
                          Text(
                            '${currentUser.fname} ${currentUser.lname}',
                            style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w500,
                                fontSize: 19.sp),
                          )
                        ],
                      ),
                      SizedBox(
                        height: 10.h,
                      ),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const Icon(CupertinoIcons.location_fill,
                              color: Color.fromRGBO(123, 128, 133, 1)),
                          SizedBox(
                            width: 10.w,
                          ),
                          Text(
                            currentUser.city!.replaceAll('\n', ''),
                            style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w500,
                                fontSize: 18.sp),
                          )
                        ],
                      ),
                      SizedBox(
                        height: 16.h,
                      ),
                      SizedBox(
                        width: 0.9.sw,
                        child: Row(
                          mainAxisSize: MainAxisSize.max,
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Container(
                              width: 0.42.sw,
                              height: 40.h,
                              decoration: BoxDecoration(
                                  boxShadow: const [
                                    BoxShadow(
                                        color: Color.fromRGBO(
                                            109, 108, 108, .2),
                                        blurRadius: 20,
                                        offset: Offset(0, 4)),
                                  ],
                                  borderRadius: BorderRadius.circular(30),
                                  color: Colors.white),
                              child: Center(
                                  child: Text(
                                '${currentUser.fname}',
                                style: TextStyle(
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w600,
                                    fontSize: 14.sp,
                                    color: const Color.fromRGBO(101, 91, 91, 1)),
                              )),
                            ),
                            Container(
                              width: 0.42.sw,
                              height: 40.h,
                              decoration: BoxDecoration(
                                  boxShadow: const [
                                    BoxShadow(
                                        color: Color.fromRGBO(
                                            109, 108, 108, .2),
                                        blurRadius: 20,
                                        offset: Offset(0, 4)),
                                  ],
                                  borderRadius: BorderRadius.circular(30),
                                  color: Colors.white),
                              child: Center(
                                  child: Text(
                                '${currentUser.lname}',
                                style: TextStyle(
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w600,
                                    fontSize: 14.sp,
                                    color: const Color.fromRGBO(101, 91, 91, 1)),
                              )),
                            ),
                          ],
                        ),
                      ),
                      SizedBox(
                        height: 16.h,
                      ),
                      SizedBox(
                        width: 0.9.sw,
                        child: Container(
                          width: 0.9.sw,
                          height: 40.h,
                          decoration: BoxDecoration(
                              boxShadow: const [
                                BoxShadow(
                                    color:
                                        Color.fromRGBO(109, 108, 108, .2),
                                    blurRadius: 20,
                                    offset: Offset(0, 4)),
                              ],
                              borderRadius: BorderRadius.circular(30),
                              color: Colors.white),
                          child: Center(
                              child: Text(
                            '${currentUser.email}',
                            style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                                fontSize: 14.sp,
                                color: const Color.fromRGBO(101, 91, 91, 1)),
                          )),
                        ),
                      ),
                      SizedBox(
                        height: 80.h,
                      ),
                      InkWell(
                        onTap: () {
                          _showLogOutDialog(context);
                        },
                        child: Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: Text(
                            'Logout',
                            style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                                fontSize: 16.sp,
                                color: const Color.fromRGBO(191, 193, 186, 1)),
                          ),
                        ),
                      )
                    ],
                  ),
                  SizedBox(
                    height: 60.h,
                  ),
                ],
              ),
            ),
          ),
          Stack(
            children: [
              Container(
                height: 210.h,
              ),
              Positioned(
                  top: -50.w,
                  right: -50.w,
                  child: FadeAnimation(
                      2.2,
                      -30,
                      0,
                      LoopWidget(
                          30,
                          Opacity(
                            opacity: 0.25,
                            child: Container(
                              width: 200.w,
                              height: 200.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(63, 133, 198, 0.646),
                                    Color.fromRGBO(63, 198, 149, 0.76),
                                  ])),
                            ),
                          ),
                          700))),
              SizedBox(
                height: 210.h,
                child: FadeAnimation(
                  1.2,
                  -30,
                  0,
                  Column(
                    children: [
                      SizedBox(height: 70.h),
                      Padding(
                        padding: const EdgeInsets.all(18.0),
                        child: Text(
                          'Profile',
                          style: TextStyle(
                              fontWeight: FontWeight.w700,
                              fontFamily: 'Lato',
                              fontSize: 25.sp,
                              color: const Color.fromRGBO(85, 80, 80, 0.98)),
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          )
        ],
      ),
    );
  }

  Future<void> _showLogOutDialog(context) async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        if (Platform.isIOS) {
          return CupertinoAlertDialog(
            title: const Text(
              'Confirm LogOut',
              style: TextStyle(
                  fontFamily: 'Lato',
                  fontSize: 18,
                  fontWeight: FontWeight.w800),
            ),
            content: SingleChildScrollView(
              child: ListBody(
                children: <Widget>[
                  Text(
                    "Would you like to Sign out?",
                    textAlign: TextAlign.center,
                    style: TextStyle(
                        fontFamily: 'Lato',
                        fontSize: 16.sp,
                        fontWeight: FontWeight.w500),
                  ),
                ],
              ),
            ),
            actions: <Widget>[
              CupertinoDialogAction(
                isDefaultAction: true,
                child: const Text('NO'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
              CupertinoDialogAction(
                isDestructiveAction: true,
                child: const Text('YES'),
                onPressed: () {
                  _clearShearedPreference(context);

                  Navigator.of(context).pushAndRemoveUntil(
                      MaterialPageRoute(builder: (context) => const Splash()),
                      (Route<dynamic> route) => false);
                  context.read<CurrentUserProvider>().clearCurrentUser();
                  context.read<BottomNavProvider>().changeView(0, 'Home');
                },
              ),
            ],
          );
        } else {
          return AlertDialog(
            title: const Text(
              'Confirm LogOut',
              style: TextStyle(
                fontFamily: 'Lato',
                fontSize: 18,
                fontWeight: FontWeight.w800
              ),
            ),
            content: SingleChildScrollView(
              child: ListBody(
                children: <Widget>[
                  Text(
                    "Would you like to Sign out?",
                    textAlign: TextAlign.center,
                    style: TextStyle(
                        fontFamily: 'Lato',
                        fontSize: 16.sp,
                        fontWeight: FontWeight.w500),
                  ),
                ],
              ),
            ),
            actions: <Widget>[
              TextButton(
                child: const Text('NO'),
                onPressed: () {
                  Navigator.of(context).pop();
                },
              ),
              TextButton(
                child: const Text('YES'),
                onPressed: () {
                  _clearShearedPreference(context);

                  Navigator.of(context).pushAndRemoveUntil(
                      MaterialPageRoute(builder: (context) => const Splash()),
                      (Route<dynamic> route) => false);
                  context.read<CurrentUserProvider>().clearCurrentUser();
                  context.read<BottomNavProvider>().changeView(0, 'Home');
                },
              ),
            ],
          );
        }
      },
    );
  }

  _clearShearedPreference(context) async {
    final pref = await SharedPreferences.getInstance();
    pref.setBool('isLogin', false);
    pref.setString('user', '');
    await pref.clear();
  }
}
