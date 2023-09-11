import 'dart:convert';
import 'dart:io';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/providers/settings_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/home/home_page.dart';
import 'package:bisa_app/ui/signup/signup_page.dart';
import 'package:bisa_app/ui/widgets/custom_text_form.dart';
import 'package:bisa_app/ui/widgets/multi_popup.dart';
import 'package:bisa_app/ui/widgets/password_field.dart';
import 'package:bisa_app/ui/widgets/popup.dart';
import 'package:bisa_app/utils/validator.dart';
// import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/bottom_to_top_transition.dart';
import 'package:page_animation_transition/animations/top_to_bottom_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:coast/coast.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  LoginPageState createState() => LoginPageState();
}

class LoginPageState extends State<LoginPage> {
  late SharedPreferences prefs;

  dynamic settings;

  List interests = [];
  List regions = [];
  List cities = [];

  dynamic loggedinUser;

  // final _beaches = [
  //   Beach(builder: (context) => Login()),
  //   Beach(builder: (context) => ResetPassword()),
  //   // Beach(builder: (context) => Zoutelande()),
  // ];

  final _coastController = CoastController(initialPage: 0);

  @override
  void initState() {
    // ignore: avoid_print
    _getSharedPref().then((value) => print('pref initialized'));
    // _getFirebaseToken();
    _loadSettings();
    // _checkLoggedIn();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Coast(
        beaches: [
          Beach(builder: (context) => Login(coastController: _coastController)),
          Beach(
              builder: (context) =>
                  ResetPassword(coastController: _coastController)),
        ],
        controller: _coastController,
        observers: [
          CrabController(),
        ],
      ),
    );
  }

  Future<void> _getSharedPref() async {
    prefs = await SharedPreferences.getInstance();
  }

  // ignore: unused_element
  void _checkLoggedIn() async {
    final prefs = await SharedPreferences.getInstance();
    var storedUser = prefs.getString('user');

    if (storedUser != null) {
      setState(() {
        loggedinUser = jsonDecode(storedUser);
      });

      if (loggedinUser.toString().isNotEmpty) {
        var currentUser = CurrentUser(
            id: loggedinUser['id'],
            fname: loggedinUser['fname'],
            lname: loggedinUser['lname'],
            email: loggedinUser['email'],
            city: loggedinUser['city'],
            phone: loggedinUser['phone'],
            gender: loggedinUser['gender'],
            region: loggedinUser['region'],
            cityId: loggedinUser['cityId'],
            regionId: loggedinUser['regionId'],
            token: loggedinUser['token']);

        // ignore: use_build_context_synchronously
        context.read<CurrentUserProvider>().setCurrentUser(currentUser);
        // await Future.delayed(Duration(seconds: 4), () {
        // ignore: use_build_context_synchronously
        Navigator.pop(context);
        // ignore: use_build_context_synchronously
        Navigator.push(
          context,
          PageAnimationTransition(
            pageAnimationType: TopToBottomTransition(),
            page: const HomePage(),
          ),
        );
        // });
      } else {
        // await Future.delayed(Duration(seconds: 4), () {
        // Navigator.pop(context);
        // // Navigator.pushNamed(context, '/signin');
        // Navigator.pushNamed(context, '/onboarding');
        // });
      }
    } else {
      // await Future.delayed(Duration(seconds: 4), () {
      // Navigator.pop(context);
      // // Navigator.pushNamed(context, '/signin');
      // Navigator.pushNamed(context, '/onboarding');
      // });
    }
  }

  void _loadSettings() {
    loadSettings().then((value) {
      if (value != null) {
        if (value['status'] == 'success') {
          context.read<SettingsProvider>().setSettings(value['data']);
          // notifyListeners();
        } else {
          return showDialog(
              context: context,
              builder: (BuildContext context) {
                return Popup(
                  msg: value['message'],
                );
              });
        }
      } else {
        return showDialog(
            context: context,
            builder: (BuildContext context) {
              return const Popup(
                msg: 'Sorry, encountered an error. Please try again',
              );
            });
      }
    }).catchError((onError) {
      if (mounted) {
        return showDialog(
            context: context,
            builder: (BuildContext context) {
              return Popup(
                msg: onError,
              );
            });
      }
      return null;
    });
    // context.read<SettingsProvider>().settings;
  }
}

class Login extends StatefulWidget {
  const Login({Key? key, required this.coastController}) : super(key: key);

  final CoastController coastController;
  @override
  LoginState createState() => LoginState();
}

class LoginState extends State<Login> {
  late SharedPreferences prefs;
  final _formKey = GlobalKey<FormState>();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();

  // final PageController _pageController = PageController(initialPage: 0);
  // int _currentPage = 0;

  final emailFocusNode = FocusNode();
  final passwordFocusNode = FocusNode();

  dynamic loggedinUser;
  String? token;

  bool _saving = false;

  @override
  void initState() {
    // ignore: avoid_print
    _getSharedPref().then((value) => print('pref initialized'));
    _getFirebaseToken();
    // _loadSettings();
    // _checkLoggedIn();
    super.initState();
  }

  @override
  void dispose() {
    emailController.dispose();
    passwordController.dispose();
    emailFocusNode.dispose();
    passwordFocusNode.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // settings  =  context.read<SettingsProvider>().settings;
    // regions = settings?['regions'];
    // cities = regions.firstWhere((element) => element['id'] == 2)['cities'];
    // interests = settings['interest'];
    // print('regions: $regions');
    // print('cities: $cities');

    return Scaffold(
      resizeToAvoidBottomInset: true,
      backgroundColor: const Color.fromRGBO(255, 255, 255, 1),
      body: SingleChildScrollView(
        child: SizedBox(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          // color: Color(0xFFFFFF),
          child: Stack(
            children: [
              Positioned(
                  right: -120,
                  top: 160.w,
                  child:
                      // FadeAnimation(1.1, -30,0,
                      //Image.asset('assets/imgs/Ellipse_22.png',height: 199.h,fit: BoxFit.cover,)
                      LoopWidget(
                          10,
                          Crab(
                            tag: 'bottom',
                            child: Container(
                              width: 200.w,
                              height: 220.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(0, 139, 123, 0.67),
                                    Color.fromRGBO(0, 139, 123, 1),
                                  ])),
                            ),
                          ),
                          700)
                  // )
                  ),
              Positioned(
                  left: -20.w,
                  top: -90.w,
                  child:
                      // FadeAnimation(1.4,-30,0,
                      // Image.asset('assets/imgs/Ellipse_23.png')
                      LoopWidget(
                          20,
                          Crab(
                            tag: 'top',
                            child: Container(
                              width: 190.w,
                              height: 190.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(213, 238, 205, 0.67),
                                    Color.fromRGBO(222, 248, 214, 1),
                                  ])),
                            ),
                          ),
                          500)
                  // )
                  ),
              Positioned(
                  top: -73.h,
                  right: -35.w,
                  child:
                      // FadeAnimation(2.2,-30,0,
                      // Image.asset('assets/imgs/Ellipse_21.png',height: 427.h,)
                      LoopWidget(
                          20,
                          Crab(
                            tag: 'corner',
                            child: Container(
                              width: 280.w,
                              height: 280.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(140, 198, 63, 0.67),
                                    Color.fromRGBO(140, 198, 63, 1),
                                  ])),
                            ),
                          ),
                          800)
                  // )
                  ),
              Positioned(
                top: 190.h,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Padding(
                      padding: EdgeInsets.only(left: 0.07.sw, bottom: 8),
                      child: FadeAnimation(
                        1.6,
                        -30,
                        0,
                        Image.asset(
                          'assets/imgs/bisa_icon.png',
                          height: 100.h,
                          fit: BoxFit.cover,
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 20.h,
                    ),
                    Padding(
                      padding: EdgeInsets.only(left: 0.07.sw, bottom: 8),
                      child: FadeAnimation(
                        1.8,
                        -30,
                        0,
                        Text(
                          'Sign In',
                          style: TextStyle(
                              fontSize: 34.sp,
                              fontFamily: 'Poppins',
                              fontWeight: FontWeight.w500),
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 20.h,
                    ),
                    SizedBox(
                      width: 1.sw,
                      child: Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            FadeAnimation(
                              1.9,
                              -30,
                              0,
                              Container(
                                width: 0.84.sw,
                                height: 50.h,
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
                                child: CustomTextField(
                                    keyboardType: TextInputType.emailAddress,
                                    isEnabled: !_saving,
                                    fieldController: emailController,
                                    fieldValidator: Validator.emailValidator,
                                    currentFocus: emailFocusNode,
                                    fieldHintText: "Email",
                                    fieldTextInputAction: TextInputAction.next),
                              ),
                            ),
                            SizedBox(
                              height: 18.h,
                            ),
                            FadeAnimation(
                              2.0,
                              -30,
                              0,
                              Container(
                                width: 0.84.sw,
                                height: 50.h,
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(30),
                                  color: Colors.white,
                                  boxShadow: const [
                                    BoxShadow(
                                        color:
                                            Color.fromRGBO(109, 108, 108, .2),
                                        blurRadius: 20,
                                        offset: Offset(0, 4))
                                  ],
                                ),
                                child: CustomPasswordField(
                                    isEnabled: !_saving,
                                    fieldController: passwordController,
                                    fieldValidator: Validator.passwordValidator,
                                    currentFocus: passwordFocusNode,
                                    fieldHintText: "Password",
                                    fieldTextInputAction: TextInputAction.done),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 25.h,
                    ),
                    FadeAnimation(
                      2.4,
                      -30,
                      0,
                      SizedBox(
                        width: 1.sw - 40.w,
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          mainAxisSize: MainAxisSize.max,
                          children: [
                            InkWell(
                              onTap: () {
                                // emailController.dispose();
                                widget.coastController.animateTo(
                                    beach: 1,
                                    duration:
                                        const Duration(milliseconds: 1200));
                              },
                              child: Text(
                                'Forgot password?',
                                style: TextStyle(
                                    decoration: TextDecoration.underline,
                                    fontSize: 14.sp,
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w300,
                                    color:
                                        const Color.fromRGBO(151, 197, 134, 1)),
                              ),
                            )
                          ],
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 25.h,
                    ),
                    FadeAnimation(
                      2.6,
                      -30,
                      0,
                      SizedBox(
                        width: 1.sw,
                        child: Center(
                          child: InkWell(
                            onTap: () {
                              if (!_saving) {
                                setState(() {
                                  _saving = true;
                                });
                                if (Platform.isIOS) {
                                  if (emailController.text.isEmpty ||
                                      passwordController.text.isEmpty) {
                                    showCupertinoDialog(
                                        context: context,
                                        builder: (context) {
                                          return CupertinoAlertDialog(
                                            title: const Text('Error'),
                                            content: const Text(
                                                'Required Field(s) is Empty'),
                                            actions: <Widget>[
                                              TextButton(
                                                  onPressed: () {
                                                    Navigator.of(context).pop();
                                                    setState(() {
                                                      _saving = false;
                                                    });
                                                  },
                                                  child: const Text('Ok'))
                                            ],
                                          );
                                        });
                                  } else {
                                    if (Validator.emailValidator(
                                            emailController.text) !=
                                        null) {
                                      showCupertinoDialog(
                                          context: context,
                                          builder: (context) {
                                            return CupertinoAlertDialog(
                                              title: const Text('Error'),
                                              content: Text(
                                                  '${Validator.emailValidator(emailController.text)}'),
                                              actions: <Widget>[
                                                TextButton(
                                                    onPressed: () {
                                                      Navigator.of(context)
                                                          .pop();
                                                      setState(() {
                                                        _saving = false;
                                                      });
                                                    },
                                                    child: const Text('Ok'))
                                              ],
                                            );
                                          });
                                    } else {
                                      handlesignin();
                                    }
                                    // handlesignin();
                                  }
                                } else {
                                  handlesignin();
                                }
                              }
                            },
                            child: Container(
                              width: 120.w,
                              height: 40.h,
                              decoration: BoxDecoration(
                                  color: const Color(0xFFB5E255),
                                  borderRadius: BorderRadius.circular(50),
                                  boxShadow: const [
                                    BoxShadow(
                                        color: Color.fromRGBO(0, 0, 0, .25),
                                        blurRadius: 20,
                                        offset: Offset(0, 10))
                                  ]),
                              child: _saving
                                  ? Center(
                                      child: SizedBox(
                                        height: 20.w,
                                        width: 20.w,
                                        child: const CircularProgressIndicator
                                            .adaptive(
                                          strokeWidth: 3,
                                          backgroundColor: Colors.white,
                                        ),
                                      ),
                                    )
                                  : Center(
                                      child: Text(
                                        'SIGN IN',
                                        style: TextStyle(
                                            fontSize: 15.sp,
                                            fontFamily: 'Poppins',
                                            fontWeight: FontWeight.w600,
                                            color: Colors.white),
                                      ),
                                    ),
                            ),
                          ),
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 40.h,
                    ),
                    FadeAnimation(
                        2.8,
                        -30,
                        0,
                        SizedBox(
                          width: 1.sw,
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Text(
                                'New user? ',
                                style: TextStyle(
                                    fontSize: 16.sp,
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w600,
                                    color:
                                        const Color.fromRGBO(151, 197, 134, 1)),
                              ),
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          BottomToTopTransition(),
                                      page: const SignUp(),
                                    ),
                                  );
                                },
                                child: Text(
                                  'Sign up',
                                  style: TextStyle(
                                      decoration: TextDecoration.underline,
                                      fontSize: 16.sp,
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w700,
                                      color: const Color.fromRGBO(
                                          151, 197, 134, 1)),
                                ),
                              )
                            ],
                          ),
                        ))
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Future<void> _getSharedPref() async {
    prefs = await SharedPreferences.getInstance();
  }

  void handlesignin() {
    var form = _formKey.currentState!;

    if (form.validate()) {
      if (kDebugMode) {
        print('${emailController.text},${passwordController.text}');
      }

      Map<String, dynamic> dataMap = {
        "email": emailController.text,
        "password": passwordController.text,
        "token": token
      };

      if (kDebugMode) {
        print(dataMap);
      }

      loginUser(dataMap).then((value) {
        if (kDebugMode) {
          print(value);
        }
        // if (value != null) {
        if (value.status == 'success') {
          if (kDebugMode) {
            print('its a success');
          }
          CurrentUser newUser = CurrentUser(
              email: value.data?.user?.email,
              id: value.data?.user?.id,
              fname: value.data?.user?.firstName,
              lname: value.data?.user?.lastName,
              phone: value.data?.user?.telephoneNumber,
              gender: value.data?.user?.gender,
              region: value.data?.user?.region,
              city: value.data?.user?.city,
              regionId: value.data?.user?.regionId,
              cityId: value.data?.user?.cityId,
              token: value.data?.token);

          Map<String, dynamic> userMap = {
            'email': value.data?.user?.email,
            'id': value.data?.user?.id,
            'fname': value.data?.user?.firstName,
            'lname': value.data?.user?.lastName,
            'phone': value.data?.user?.telephoneNumber,
            'gender': value.data?.user?.gender,
            'region': value.data?.user?.region,
            'city': value.data?.user?.city,
            'regionId': value.data?.user?.regionId,
            'cityId': value.data?.user?.cityId,
            'token': value.data?.token
          };

          // Provider.of<CurrentUserProvider>(context,listen: false).setCurrentUser(newUser);
          _storeUserData(userMap);
          context.read<CurrentUserProvider>().setCurrentUser(newUser);

          setState(() {
            _saving = false;
          });

          Navigator.pop(context);
          Navigator.push(
            context,
            PageAnimationTransition(
              pageAnimationType: TopToBottomTransition(),
              page: const HomePage(),
            ),
          );
        } else {
          setState(() {
            _saving = false;
          });
          return showDialog(
              context: context,
              builder: (BuildContext context) {
                return Popup(
                  msg: value.message,
                );
              });
        }
        // }
        // else {
        //   setState(() {
        //     _saving = false;
        //   });
        //   return showDialog(
        //       context: context,
        //       builder: (BuildContext context) {
        //         return Popup(
        //           msg: 'Sorry, encountered an error. Please try again.',
        //         );
        //       });
        // }
      });
    } else {
      setState(() {
        _saving = false;
      });
    }
  }

  void _storeUserData(Map<String, dynamic> userMap) {
    prefs.setBool('isLogin', true);
    prefs.setString('user', jsonEncode(userMap));
  }

  void _getFirebaseToken() {
    // FirebaseMessaging.instance.subscribeToTopic('chat');
    // FirebaseMessaging.instance.subscribeToTopic('article');
    // FirebaseMessaging.instance.getToken().then((value) {
    //   print('value: $value');

    //   token = value;
    // });
    // // print('token: $token');
  }
}

class ResetPassword extends StatefulWidget {
  const ResetPassword({Key? key, required this.coastController})
      : super(key: key);

  final CoastController coastController;

  @override
  ResetPasswordState createState() => ResetPasswordState();
}

class ResetPasswordState extends State<ResetPassword> {
  final _formKey = GlobalKey<FormState>();
  final emailPController = TextEditingController();

  final emailPFocusNode = FocusNode();

  dynamic loggedinUser;
  // String? token;

  @override
  void dispose() {
    emailPController.dispose();
    emailPFocusNode.dispose();
    super.dispose();
  }

  bool _saving = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: true,
      backgroundColor: const Color.fromRGBO(255, 255, 255, 1),
      body: SingleChildScrollView(
        child: SizedBox(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
          // color: Color(0xFFFFFF),
          child: Stack(
            children: [
              Positioned(
                  left: -120,
                  top: 160.w,
                  child:
                      // FadeAnimation(1.1, -30,0,
                      //Image.asset('assets/imgs/Ellipse_22.png',height: 199.h,fit: BoxFit.cover,)
                      LoopWidget(
                          10,
                          Crab(
                            tag: 'bottom',
                            child: Container(
                              width: 200.w,
                              height: 220.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(0, 139, 123, 0.67),
                                    Color.fromRGBO(0, 139, 123, 1),
                                  ])),
                            ),
                          ),
                          700)
                  // )
                  ),
              Positioned(
                  right: -20.w,
                  top: -90.w,
                  child:
                      // FadeAnimation(1.4,-30,0,
                      // Image.asset('assets/imgs/Ellipse_23.png')
                      LoopWidget(
                          20,
                          Crab(
                            tag: 'top',
                            child: Container(
                              width: 190.w,
                              height: 190.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(213, 238, 205, 0.67),
                                    Color.fromRGBO(222, 248, 214, 1),
                                  ])),
                            ),
                          ),
                          500)
                  // )
                  ),
              Positioned(
                  top: -73.h,
                  left: -35.w,
                  child:
                      // FadeAnimation(2.2,-30,0,
                      // Image.asset('assets/imgs/Ellipse_21.png',height: 427.h,)
                      LoopWidget(
                          20,
                          Crab(
                            tag: 'corner',
                            child: Container(
                              width: 280.w,
                              height: 280.w,
                              decoration: const BoxDecoration(
                                  shape: BoxShape.circle,
                                  gradient: RadialGradient(colors: [
                                    Color.fromRGBO(140, 198, 63, 0.67),
                                    Color.fromRGBO(140, 198, 63, 1),
                                  ])),
                            ),
                          ),
                          800)
                  // )
                  ),
              Positioned(
                top: 1.sh / 3,
                child: SizedBox(
                  height: 1.sh,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      // Padding(
                      //   padding: EdgeInsets.only(left:0.07.sw,bottom: 8),
                      //   child: FadeAnimation(1.6, - 30,0,Image.asset('assets/imgs/bisa_icon.png',height: 100.h,fit: BoxFit.cover,),),
                      // ),
                      SizedBox(
                        height: 50.h,
                      ),
                      SizedBox(
                        width: 1.sw,
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Padding(
                              padding:
                                  EdgeInsets.only(left: 0.07.sw, bottom: 8),
                              child: FadeAnimation(
                                1.8,
                                -30,
                                0,
                                Text(
                                  'Reset Password',
                                  style: TextStyle(
                                      fontSize: 34.sp,
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w500),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                      SizedBox(
                        height: 10.h,
                      ),
                      SizedBox(
                        width: 1.sw,
                        child: Form(
                          key: _formKey,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            children: [
                              FadeAnimation(
                                1.9,
                                -30,
                                0,
                                Container(
                                  width: 0.84.sw,
                                  height: 50.h,
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
                                  child: CustomTextField(
                                      keyboardType: TextInputType.emailAddress,
                                      isEnabled: !_saving,
                                      fieldController: emailPController,
                                      fieldValidator: Validator.emailValidator,
                                      currentFocus: emailPFocusNode,
                                      fieldHintText: "Email",
                                      fieldTextInputAction:
                                          TextInputAction.done),
                                ),
                              ),
                              SizedBox(
                                height: 18.h,
                              ),
                            ],
                          ),
                        ),
                      ),

                      SizedBox(
                        height: 10.h,
                      ),
                      FadeAnimation(
                        2.6,
                        -30,
                        0,
                        SizedBox(
                          width: 1.sw,
                          child: Center(
                            child: InkWell(
                              onTap: () {
                                if (!_saving) {
                                  setState(() {
                                    _saving = true;
                                  });
                                  if (Platform.isIOS) {
                                    if (emailPController.text.isEmpty) {
                                      showCupertinoDialog(
                                          context: context,
                                          builder: (context) {
                                            return CupertinoAlertDialog(
                                              title: const Text('Error'),
                                              content: const Text(
                                                  'Required Field is Empty'),
                                              actions: <Widget>[
                                                TextButton(
                                                    onPressed: () {
                                                      Navigator.of(context)
                                                          .pop();
                                                      setState(() {
                                                        _saving = false;
                                                      });
                                                    },
                                                    child: const Text('Ok'))
                                              ],
                                            );
                                          });
                                    } else {
                                      if (Validator.emailValidator(
                                              emailPController.text) !=
                                          null) {
                                        showCupertinoDialog(
                                            context: context,
                                            builder: (context) {
                                              return CupertinoAlertDialog(
                                                title: const Text('Error'),
                                                content: Text(
                                                    '${Validator.emailValidator(emailPController.text)}'),
                                                actions: <Widget>[
                                                  TextButton(
                                                      onPressed: () {
                                                        Navigator.of(context)
                                                            .pop();
                                                        setState(() {
                                                          _saving = false;
                                                        });
                                                      },
                                                      child: const Text('Ok'))
                                                ],
                                              );
                                            });
                                      } else {
                                        handlereset();
                                      }
                                      handlereset();
                                    }
                                  } else {
                                    handlereset();
                                  }
                                }
                              },
                              child: Container(
                                width: 120.w,
                                height: 40.h,
                                decoration: BoxDecoration(
                                    color: const Color(0xFFB5E255),
                                    borderRadius: BorderRadius.circular(50),
                                    boxShadow: const [
                                      BoxShadow(
                                          color: Color.fromRGBO(0, 0, 0, .25),
                                          blurRadius: 20,
                                          offset: Offset(0, 10))
                                    ]),
                                child: _saving
                                    ? Center(
                                        child: SizedBox(
                                          height: 20.w,
                                          width: 20.w,
                                          child: const CircularProgressIndicator
                                              .adaptive(
                                            strokeWidth: 3,
                                            backgroundColor: Colors.white,
                                          ),
                                        ),
                                      )
                                    : Center(
                                        child: Text(
                                          'Submit',
                                          style: TextStyle(
                                              fontSize: 15.sp,
                                              fontFamily: 'Poppins',
                                              fontWeight: FontWeight.w600,
                                              color: Colors.white),
                                        ),
                                      ),
                              ),
                            ),
                          ),
                        ),
                      ),
                      SizedBox(
                        height: 40.h,
                      ),
                      FadeAnimation(
                          2.8,
                          -30,
                          0,
                          SizedBox(
                            width: 1.sw,
                            child: Center(
                              child: InkWell(
                                onTap: () {
                                  // emailController.dispose();
                                  widget.coastController.animateTo(
                                      beach: 0,
                                      duration:
                                          const Duration(milliseconds: 1200));
                                },
                                child: Text(
                                  'Cancel',
                                  style: TextStyle(
                                      // decoration: TextDecoration.underline,
                                      fontSize: 16.sp,
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w700,
                                      color: Colors.red),
                                ),
                              ),
                            ),
                          ))
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  void handlereset() {
    var form = _formKey.currentState!;

    if (form.validate()) {
      if (kDebugMode) {
        print(emailPController.text);
      }

      Map<String, dynamic> dataMap = {
        "email": emailPController.text,
        // "password":passwordController.text,
        // "token":token
      };

      if (kDebugMode) {
        print(dataMap);
      }

      resetPwd(dataMap).then((value) {
        if (kDebugMode) {
          print(value);
        }
        if (value != null) {
          if (value['status'] == 'success') {
            if (kDebugMode) {
              print('its a success');
            }

            emailPController.text = '';
            // context.read<CurrentUserProvider>().setCurrentUser(newUser);

            setState(() {
              _saving = false;
            });

            return showDialog(
                context: context,
                builder: (BuildContext context) {
                  return MultiPopup(
                    onTap: () {
                      Navigator.pop(context);
                      widget.coastController.animateTo(
                          beach: 0,
                          duration: const Duration(milliseconds: 1200));
                    },
                    img: 'assets/imgs/bisa_icon.png',
                    title: 'Success',
                    msg: value['message'],
                  );
                });

            // Navigator.pop(context);
            // Navigator.push(
            //   context,
            //   PageAnimationTransition(pageAnimationType: TopToBottomTransition(),child: HomePage())
            // );
          } else {
            setState(() {
              _saving = false;
            });
            return showDialog(
                context: context,
                builder: (BuildContext context) {
                  return Popup(
                    msg: value['message'],
                  );
                });
          }
        } else {
          setState(() {
            _saving = false;
          });
          return showDialog(
              context: context,
              builder: (BuildContext context) {
                return const Popup(
                  msg: 'Sorry, encountered an error. Please try again.',
                );
              });
        }
      });
    } else {
      setState(() {
        _saving = false;
      });
    }
  }
}
