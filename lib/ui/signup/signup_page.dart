import 'dart:convert';
import 'dart:io';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/providers/settings_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/home/home_page.dart';
import 'package:bisa_app/ui/login/login_page.dart';
// import 'package:bisa_app/ui/signup/interest_page.dart';
import 'package:bisa_app/ui/widgets/custom_text_form.dart';
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

class SignUp extends StatefulWidget {
  const SignUp({Key? key}) : super(key: key);

  @override
  SignUpState createState() => SignUpState();
}

class SignUpState extends State<SignUp> {
  final emailController = TextEditingController();
  final fnameController = TextEditingController();
  final lnameController = TextEditingController();
  final phoneController = TextEditingController();
  // final confirmPController = TextEditingController();
  final passwordController = TextEditingController();

  final emailFocusNode = FocusNode();
  final fnameFocusNode = FocusNode();
  final lnameFocusNode = FocusNode();
  final phoneFocusNode = FocusNode();
  final genderFocusNode = FocusNode();
  final cityFocusNode = FocusNode();
  final regionFocusNode = FocusNode();
  final passwordFocusNode = FocusNode();

  bool _saving = false;
  late SharedPreferences prefs;

  Object? _genderVal;

  int? _regionVal;
  int? _cityVal;

  final _formKey = GlobalKey<FormState>();
  String? token;
  dynamic settings;

  List interests = [];
  List regions = [];
  List cities = [];

  @override
  void dispose() {
    emailController.dispose();
    fnameController.dispose();
    lnameController.dispose();
    phoneController.dispose();
    // confirmPController.dispose();
    passwordController.dispose();
    emailFocusNode.dispose();
    fnameFocusNode.dispose();
    lnameFocusNode.dispose();
    phoneFocusNode.dispose();
    genderFocusNode.dispose();
    cityFocusNode.dispose();
    regionFocusNode.dispose();
    passwordFocusNode.dispose();
    super.dispose();
  }

  @override
  void initState() {
    _getSharedPref();
    _getFirebaseToken();
    super.initState();
    _regionVal = 6;
    _cityVal = 178;
    cities = [];
  }

  @override
  Widget build(BuildContext context) {
    settings = context.read<SettingsProvider>().settings;
    if (settings != null) {
      regions = settings['regions'];
      // print('cities: $cities');
      cities = _regionVal != null
          ? regions
              .firstWhere((element) => element['id'] == _regionVal)['cities']
          : [];
      // print(cities);
      interests = settings['interest'];
    }
    // else{
    //   return showDialog(
    //     context: context,
    //     builder: (BuildContext context){
    //       return Popup(msg: 'Sorry',);
    //     }
    //   );
    // }

    return Scaffold(
      resizeToAvoidBottomInset: true,
      backgroundColor: const Color.fromRGBO(255, 255, 255, 1),
      body: SingleChildScrollView(
        child: SizedBox(
          width: MediaQuery.of(context).size.width,
          // height: MediaQuery.of(context).size.height,
          child: Stack(
            children: [
              Positioned(
                  bottom: -160.w,
                  right: 10.w,
                  child: FadeAnimation(
                      1.2,
                      30,
                      0,
                      // Image.asset('assets/imgs/sign22.png',fit: BoxFit.cover)
                      LoopWidget(
                          20,
                          Container(
                            width: 199.w,
                            height: 199.w,
                            decoration: const BoxDecoration(
                                shape: BoxShape.circle,
                                gradient: RadialGradient(colors: [
                                  Color.fromRGBO(0, 139, 123, 0.67),
                                  Color.fromRGBO(0, 139, 123, 1),
                                ])),
                          ),
                          600))),
              Positioned(
                  bottom: -90.w,
                  left: -90.w,
                  child: FadeAnimation(
                      1,
                      30,
                      0,
                      // Image.asset('assets/imgs/sign23.png')
                      LoopWidget(
                          -20,
                          Container(
                            width: 190.w,
                            height: 190.w,
                            decoration: const BoxDecoration(
                                shape: BoxShape.circle,
                                gradient: RadialGradient(colors: [
                                  Color.fromRGBO(213, 238, 205, 0.67),
                                  Color.fromRGBO(222, 248, 214, 1),
                                ])),
                          ),
                          600))),
              Positioned(
                  bottom: -150.w,
                  left: 50.w,
                  child: FadeAnimation(
                      1.4,
                      30,
                      0,
                      // Image.asset('assets/imgs/sign24.png')
                      LoopWidget(
                          -20,
                          Container(
                            width: 190.w,
                            height: 190.w,
                            decoration: const BoxDecoration(
                                shape: BoxShape.circle,
                                gradient: RadialGradient(colors: [
                                  Color.fromRGBO(255, 206, 146, 0.67),
                                  Color.fromRGBO(255, 206, 146, 1),
                                ])),
                          ),
                          500))),
              Positioned(
                  bottom: -180.w,
                  right: -185.w,
                  child: FadeAnimation(
                      1.6,
                      30,
                      0,
                      // Image.asset('assets/imgs/sign21.png')
                      LoopWidget(
                          -20,
                          Container(
                            width: 280.w,
                            height: 280.w,
                            decoration: const BoxDecoration(
                                shape: BoxShape.circle,
                                gradient: RadialGradient(colors: [
                                  Color.fromRGBO(140, 198, 63, 0.67),
                                  Color.fromRGBO(140, 198, 63, 1),
                                ])),
                          ),
                          700))),
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(
                    height: 50.h,
                  ),
                  Padding(
                    padding: EdgeInsets.only(left: 0.04.sw, bottom: 8),
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
                    height: 15.h,
                  ),
                  Padding(
                    padding: EdgeInsets.only(left: 0.04.sw, bottom: 8),
                    child: FadeAnimation(
                      1.8,
                      -30,
                      0,
                      Text(
                        'Sign Up',
                        style: TextStyle(
                            fontSize: 28.sp,
                            fontFamily: 'Poppins',
                            color: const Color.fromRGBO(0, 0, 0, 0.75),
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
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                                  isEnabled: !_saving,
                                  fieldController: fnameController,
                                  fieldValidator: Validator.textValidator,
                                  currentFocus: fnameFocusNode,
                                  fieldHintText: "Firstname*",
                                  fieldTextInputAction: TextInputAction.next),
                            ),
                          ),
                          SizedBox(
                            height: 14.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                                  isEnabled: !_saving,
                                  fieldController: lnameController,
                                  fieldValidator: Validator.textValidator,
                                  currentFocus: lnameFocusNode,
                                  fieldHintText: "Lastname*",
                                  fieldTextInputAction: TextInputAction.next),
                            ),
                          ),
                          SizedBox(
                            height: 14.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                              child: DropdownButtonFormField(
                                  focusNode: genderFocusNode,
                                  decoration: InputDecoration(
                                      border: InputBorder.none,
                                      contentPadding: EdgeInsets.all(12.h)),
                                  icon: const Icon(
                                      Icons.keyboard_arrow_down_rounded),
                                  hint: Text(
                                    'Gender',
                                    style: TextStyle(
                                        fontWeight: FontWeight.w500,
                                        color: const Color(0xFFC8C7C7),
                                        fontSize: 15.sp,
                                        fontFamily: 'Lato'),
                                  ),
                                  // value: 2,
                                  items: const [
                                    DropdownMenuItem(
                                      value: 1,
                                      child: Column(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          Text(
                                            'Male',
                                            style: TextStyle(
                                                fontWeight: FontWeight.w400,
                                                fontFamily: 'Lato'),
                                          ),
                                        ],
                                      ),
                                    ),
                                    DropdownMenuItem(
                                      value: 2,
                                      child: Column(
                                        children: [
                                          Text(
                                            'Female',
                                            style: TextStyle(
                                                fontWeight: FontWeight.w400,
                                                fontFamily: 'Lato'),
                                          ),
                                        ],
                                      ),
                                    )
                                  ],
                                  onChanged: (value) {
                                    setState(() {
                                      _genderVal = value;
                                    });
                                  }),
                            ),
                          ),
                          SizedBox(
                            height: 10.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                                  fieldHintText: "Email*",
                                  fieldTextInputAction: TextInputAction.next),
                            ),
                          ),
                          SizedBox(
                            height: 10.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                                  keyboardType: TextInputType.phone,
                                  isEnabled: !_saving,
                                  fieldController: phoneController,
                                  fieldValidator:
                                      Validator.phoneNumberValidator,
                                  currentFocus: phoneFocusNode,
                                  fieldHintText: "Phone Number*",
                                  fieldTextInputAction: TextInputAction.next),
                            ),
                          ),
                          SizedBox(
                            height: 10.h,
                          ),

                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                              child: DropdownButtonFormField(
                                focusNode: regionFocusNode,
                                decoration: InputDecoration(
                                    border: InputBorder.none,
                                    contentPadding: EdgeInsets.all(12.h)),
                                icon: const Icon(
                                    Icons.keyboard_arrow_down_rounded),
                                hint: Text(
                                  'Region',
                                  style: TextStyle(
                                      fontWeight: FontWeight.w500,
                                      color: const Color(0xFFC8C7C7),
                                      fontSize: 15.sp,
                                      fontFamily: 'Lato'),
                                ),
                                // value: 2,
                                items: regions.map((e) {
                                  return DropdownMenuItem(
                                    value: e['id'],
                                    child: Text(
                                      '${e['name']}',
                                      style: const TextStyle(
                                          fontWeight: FontWeight.w400,
                                          fontFamily: 'Lato'),
                                    ),
                                  );
                                }).toList(),
                                onChanged: (value) {
                                  setState(() {
                                    _regionVal = int.parse(value.toString());
                                    cities = regions.firstWhere((element) =>
                                        element['id'] == _regionVal)['cities'];
                                    _cityVal = cities[0]['id'];
                                  });
                                  if (kDebugMode) {
                                    print(cities);
                                  }
                                },
                                value: _regionVal,
                              ),
                            ),
                          ),
                          SizedBox(
                            height: 10.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                              child: DropdownButtonFormField(
                                focusNode: cityFocusNode,
                                decoration: InputDecoration(
                                    border: InputBorder.none,
                                    contentPadding: EdgeInsets.all(12.h)),
                                icon: const Icon(
                                    Icons.keyboard_arrow_down_rounded),
                                hint: Text(
                                  'City',
                                  style: TextStyle(
                                      fontWeight: FontWeight.w500,
                                      color: const Color(0xFFC8C7C7),
                                      fontSize: 15.sp,
                                      fontFamily: 'Lato'),
                                ),
                                // value: 2,
                                items: cities.map((e) {
                                  return DropdownMenuItem(
                                    value: e['id'],
                                    child: Text(
                                      e['name'].toString().replaceAll('\n', ''),
                                      style: const TextStyle(
                                          fontWeight: FontWeight.w400,
                                          fontFamily: 'Lato'),
                                    ),
                                  );
                                }).toList(),
                                onChanged: (value) {
                                  setState(() {
                                    _cityVal = int.parse(value.toString());
                                  });
                                },
                                value: _cityVal,
                              ),
                            ),
                          ),
                          SizedBox(
                            height: 10.h,
                          ),
                          FadeAnimation(
                            2.0,
                            -30,
                            0,
                            Container(
                              width: 0.88.sw,
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
                              child: CustomPasswordField(
                                  isEnabled: !_saving,
                                  fieldController: passwordController,
                                  fieldValidator: Validator.passwordValidator,
                                  currentFocus: passwordFocusNode,
                                  fieldHintText: "Password*",
                                  fieldTextInputAction: TextInputAction.done),
                            ),
                          ),
                          // SizedBox(height: 10.h,),
                          // FadeAnimation(2.0, -30,0,Container(
                          //   width: 0.88.sw,
                          //   height: 50.h,
                          //   decoration: BoxDecoration(
                          //     boxShadow: [
                          //       BoxShadow(
                          //         color: Color.fromRGBO(109, 108, 108, .2),
                          //         blurRadius: 20,
                          //         offset: Offset(0,4)
                          //       ),
                          //     ],
                          //     borderRadius: BorderRadius.circular(30),
                          //     color: Colors.white
                          //   ),
                          //   child: CustomPasswordField(
                          //     isEnabled: !_saving,
                          //     fieldController: confirmPController,
                          //     fieldValidator: Validator.passwordConfirm(password, confirm),
                          //     currentFocus: confirmPFocusNode,
                          //     fieldHintText: "Confirm Password",
                          //     fieldTextInputAction: TextInputAction.done
                          //   ),
                          // ),),
                          SizedBox(
                            height: 20.h,
                          ),
                          FadeAnimation(
                            2.6,
                            -30,
                            0,
                            SizedBox(
                              width: MediaQuery.of(context).size.width - 40,
                              child: Center(
                                child: InkWell(
                                  onTap: () {
                                    if (!_saving) {
                                      setState(() {
                                        _saving = true;
                                      });

                                      if (Platform.isIOS) {
                                        if (emailController.text.isEmpty ||
                                            passwordController.text.isEmpty ||
                                            fnameController.text.isEmpty ||
                                            phoneController.text.isEmpty ||
                                            lnameController.text.isEmpty) {
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
                                                            Navigator.of(
                                                                    context)
                                                                .pop();
                                                            setState(() {
                                                              _saving = false;
                                                            });
                                                          },
                                                          child:
                                                              const Text('Ok'))
                                                    ],
                                                  );
                                                });
                                          } else if (Validator
                                                  .phoneNumberValidator(
                                                      phoneController.text) !=
                                              null) {
                                            showCupertinoDialog(
                                                context: context,
                                                builder: (context) {
                                                  return CupertinoAlertDialog(
                                                    title: const Text('Error'),
                                                    content: Text(
                                                        '${Validator.phoneNumberValidator(phoneController.text)}'),
                                                    actions: <Widget>[
                                                      TextButton(
                                                          onPressed: () {
                                                            Navigator.of(
                                                                    context)
                                                                .pop();
                                                            setState(() {
                                                              _saving = false;
                                                            });
                                                          },
                                                          child:
                                                              const Text('Ok'))
                                                    ],
                                                  );
                                                });
                                          } else {
                                            if (kDebugMode) {
                                              print('signing up');
                                            }
                                            handlesignup();
                                          }
                                        }
                                      } else {
                                        if (kDebugMode) {
                                          print('signing up');
                                        }
                                        handlesignup();
                                      }
                                    }
                                  },
                                  child: Container(
                                    width: 120,
                                    height: 40,
                                    decoration: BoxDecoration(
                                        color: const Color(0xFFB5E255),
                                        borderRadius: BorderRadius.circular(50),
                                        boxShadow: const [
                                          BoxShadow(
                                              color:
                                                  Color.fromRGBO(0, 0, 0, .25),
                                              blurRadius: 20,
                                              offset: Offset(0, 10))
                                        ]),
                                    child: _saving
                                        ? Center(
                                            child: SizedBox(
                                              height: 20.w,
                                              width: 20.w,
                                              child:
                                                  const CircularProgressIndicator
                                                      .adaptive(
                                                strokeWidth: 3,
                                                backgroundColor: Colors.white,
                                              ),
                                            ),
                                          )
                                        : const Center(
                                            child: Text(
                                              'SIGN UP',
                                              style: TextStyle(
                                                  fontSize: 15,
                                                  fontWeight: FontWeight.w600,
                                                  color: Colors.white),
                                            ),
                                          ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 20,
                          ),
                          FadeAnimation(
                              2.8,
                              -30,
                              0,
                              SizedBox(
                                width: 1.sw - 40.w,
                                child: Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Text(
                                      'Already have an account? ',
                                      style: TextStyle(
                                          fontSize: 16.sp,
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          color: const Color.fromRGBO(
                                              151, 197, 134, 1)),
                                    ),
                                    InkWell(
                                      onTap: () {
                                        Navigator.push(
                                          context,
                                          PageAnimationTransition(
                                            pageAnimationType:
                                                BottomToTopTransition(),
                                            page: const LoginPage(),
                                          ),
                                        );
                                      },
                                      child: Text(
                                        'Sign in',
                                        style: TextStyle(
                                            decoration:
                                                TextDecoration.underline,
                                            fontSize: 16.sp,
                                            fontFamily: 'Poppins',
                                            fontWeight: FontWeight.w700,
                                            color: const Color.fromRGBO(
                                                151, 197, 134, 1)),
                                      ),
                                    )
                                  ],
                                ),
                              )),
                          SizedBox(
                            height: 80.h,
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  void handlesignup() {
    var form = _formKey.currentState!;
    if (kDebugMode) {
      print('in signup');
      print(token);
    }

    if (form.validate()) {
      Map<String, dynamic> dataMap = {
        "first_name": fnameController.text,
        "last_name": lnameController.text,
        "telephone_number": phoneController.text,
        "gender": _genderVal,
        "region_id": _regionVal,
        "city_id": _cityVal,
        "email": emailController.text,
        "password": passwordController.text,
        "token": token,
      };

      registerUser(dataMap).then((value) {
        // print(value.data?.user?.email);
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
          // Navigator.push(
          //     context,
          //     PageAnimationTransition(
          //         pageAnimationType: TopToBottomTransition(),
          //         page: InterestPage(list: interests),),);
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

  Future<void> _getSharedPref() async {
    prefs = await SharedPreferences.getInstance();
  }

  void _getFirebaseToken() {
    // FirebaseMessaging.instance.subscribeToTopic('all');
    // FirebaseMessaging.instance.getToken().then((value) {
    //   print('value: $value');

    //   token = value;
    // });
  }
}
