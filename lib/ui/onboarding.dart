import 'dart:async';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/fade_animation_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';

import 'login/login_page.dart';

class OnBoarding extends StatefulWidget {
  const OnBoarding({Key? key}) : super(key: key);

  @override
  OnBoardingState createState() => OnBoardingState();
}

class OnBoardingState extends State<OnBoarding> with TickerProviderStateMixin {
  final PageController _pageController = PageController(initialPage: 0);
  int _currentPage = 0;

  late final AnimationController _controller =
      AnimationController(vsync: this, duration: const Duration(seconds: 2))
        ..repeat(reverse: true);

  late final Animation<Offset> _animation =
      Tween<Offset>(begin: Offset.zero, end: const Offset(1.0, 0.0))
          .animate(_controller);

  late final AnimationController _positionController =
      AnimationController(vsync: this, duration: const Duration(milliseconds: 1000));

  late final Animation _positionAnimation =
      Tween<double>(begin: 0.0, end: 220.0).animate(_positionController)
        ..addStatusListener((status) {
          if (status == AnimationStatus.completed) {
            setState(() {
              hideIcon = true;
            });
            _scale2Controller.forward();
          }
        });

  late final AnimationController _scaleController =
      AnimationController(vsync: this, duration: const Duration(milliseconds: 800));

  late final AnimationController _widthController =
      AnimationController(vsync: this, duration: const Duration(milliseconds: 600));

  late final Animation _widthAnimation =
      Tween<double>(begin: 80.h, end: 300.w).animate(_widthController)
        ..addStatusListener((status) {
          if (status == AnimationStatus.completed) {
            _positionController.forward();
          }
        });

  // ignore: unused_field
  late final Animation _scaleAnimation = Tween<double>(
          begin: 1.0,
          // end: 100.0
          end: 0.8)
      .animate(_scaleController)
    ..addStatusListener((status) {
      if (status == AnimationStatus.completed) {
        _widthController.forward();
      }
      // Navigator.push(
      //   context,
      //   PageAnimationTransition(child: LoginPage(), pageAnimationType: fade)
      // );
    });

  late final AnimationController _scale2Controller =
      AnimationController(vsync: this, duration: const Duration(milliseconds: 1000));

  late final Animation _scale2Animation =
      Tween<double>(begin: 1.0, end: 80.0).animate(_scale2Controller)
        ..addStatusListener((status) {
          if (status == AnimationStatus.completed) {
            Navigator.push(
              context,
              PageAnimationTransition(
                page: const LoginPage(),
                pageAnimationType: FadeAnimationTransition(),
              ),
            );
          }
        });

  late bool startedClicked;

  bool hideIcon = false;

  @override
  void dispose() {
    _controller.dispose();
    _scaleController.dispose();
    _scale2Controller.dispose();
    _positionController.dispose();
    super.dispose();
  }

  @override
  void initState() {
    super.initState();
    startedClicked = false;
    Timer.periodic(const Duration(seconds: 3), (Timer timer) {
      if (_currentPage < 1) {
        _currentPage++;
        timer.cancel();
      }

      // else{
      //   Navigator.pushReplacement(context,MaterialPageRoute(builder:(context)=>SignIn(),),);
      //   // checkLoggedInUser();
      //   timer.cancel();
      // }

      _pageController.animateToPage(
        1,
        duration: const Duration(milliseconds: 350),
        curve: Curves.easeIn,
      );
    });
    // _pageController.animateToPage(1, duration: Duration(milliseconds: 500), curve: Curves.easeIn);
    // newColor = false;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: SizedBox(
      height: MediaQuery.of(context).size.height,
      child: PageView(
        controller: _pageController,
        children: [
          Container(
            height: MediaQuery.of(context).size.height,
            color: const Color.fromRGBO(142, 162, 234, 1),
            // color: Color(0x8C6887F4),
            child: Stack(
              children: [
                Positioned(
                    top: ScreenUtil().setHeight(80),
                    left: ScreenUtil().setWidth(5),
                    child: FadeAnimation(
                        1.1,
                        -30,
                        0,
                        Image.asset(
                          'assets/imgs/docBg.png',
                          height: 440.h,
                          fit: BoxFit.cover,
                        ))),
                Align(
                  alignment: Alignment.bottomCenter,
                  child: FadeAnimation(
                      1.3,
                      30,
                      0,
                      Container(
                        height: 350.h,
                        decoration: const BoxDecoration(
                            borderRadius: BorderRadius.only(
                                topLeft: Radius.elliptical(150, 80),
                                topRight: Radius.elliptical(150, 80)),
                            color: Colors.white,
                            boxShadow: [
                              BoxShadow(
                                  color: Color.fromRGBO(0, 0, 0, .8),
                                  blurRadius: 20,
                                  offset: Offset(0, 10))
                            ]),
                        child: Padding(
                          padding: EdgeInsets.only(
                              top: ScreenUtil().setHeight(40.0),
                              left: ScreenUtil().setWidth(20),
                              right: ScreenUtil().setWidth(20)),
                          child: Column(
                            children: [
                              FadeAnimation(
                                1.5,
                                -30,
                                0,
                                Text(
                                  'With us, you always have a doctor',
                                  style: TextStyle(
                                      fontSize: ScreenUtil().setSp(28),
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w500),
                                  textAlign: TextAlign.center,
                                ),
                              ),
                              SizedBox(
                                height: ScreenUtil().setHeight(20),
                              ),
                              FadeAnimation(
                                1.7,
                                -30,
                                0,
                                Text(
                                  'Get in touch with a doctor from the comfort of your home. No queues, safe & secure.',
                                  style: TextStyle(
                                      fontSize: ScreenUtil().setSp(19),
                                      fontFamily: 'Lato',
                                      fontWeight: FontWeight.w400),
                                  textAlign: TextAlign.center,
                                ),
                              ),
                              SizedBox(
                                height: ScreenUtil().setHeight(20),
                              ),
                              FadeAnimation(
                                1.9,
                                -30,
                                0,
                                Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    const Icon(
                                      Icons.radio_button_on_rounded,
                                      color: Color(0xFFB5E255),
                                    ),
                                    SizedBox(width: ScreenUtil().setWidth(15)),
                                    const Icon(Icons.radio_button_unchecked_outlined),
                                  ],
                                ),
                              ),
                              SizedBox(
                                height: ScreenUtil().setHeight(20),
                              ),
                              FadeAnimation(
                                  2.1,
                                  -30,
                                  0,
                                  InkWell(
                                    onTap: () {
                                      _pageController.animateToPage(1,
                                          duration: const Duration(milliseconds: 500),
                                          curve: Curves.easeIn);
                                    },
                                    child: Container(
                                      width: ScreenUtil().setWidth(150),
                                      height: ScreenUtil().setHeight(50),
                                      decoration: BoxDecoration(
                                          color: const Color(0xFFB5E255),
                                          borderRadius:
                                              BorderRadius.circular(50),
                                          boxShadow: const [
                                            BoxShadow(
                                                color: Color.fromRGBO(
                                                    0, 0, 0, .45),
                                                blurRadius: 20,
                                                offset: Offset(0, 10))
                                          ]),
                                      child: Row(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          Text(
                                            'NEXT',
                                            style: TextStyle(
                                                fontSize: 16.sp,
                                                fontWeight: FontWeight.w600,
                                                color: Colors.white,
                                                fontFamily: 'Poppins'),
                                          ),
                                          SizedBox(
                                            width: 10.w,
                                          ),
                                          SlideTransition(
                                            position: _animation,
                                            child: const Icon(
                                              Icons.arrow_forward,
                                              color: Colors.white,
                                            ),
                                          )
                                        ],
                                      ),
                                    ),
                                  ))
                            ],
                          ),
                        ),
                      )),
                )
              ],
            ),
          ),
          Container(
            height: MediaQuery.of(context).size.height,
            color: const Color.fromRGBO(0, 139, 123, 1),
            child: Stack(
              children: [
                Positioned(
                    top: 20.h,
                    left: 8.w,
                    child: FadeAnimation(
                        1.1,
                        -30,
                        0,
                        Image.asset('assets/imgs/pharmBg.png',
                            height: 580.h, fit: BoxFit.cover))),
                Align(
                    alignment: Alignment.bottomCenter,
                    child: FadeAnimation(
                      1.3,
                      30,
                      0,
                      Container(
                        height: 350.h,
                        decoration: const BoxDecoration(
                            borderRadius: BorderRadius.only(
                                topLeft: Radius.elliptical(150, 80),
                                topRight: Radius.elliptical(150, 80)),
                            color: Colors.white,
                            boxShadow: [
                              BoxShadow(
                                  color: Color.fromRGBO(0, 0, 0, .8),
                                  blurRadius: 20,
                                  offset: Offset(0, 10))
                            ]),
                        child: Padding(
                          padding: EdgeInsets.only(
                              top: 30.0.h, left: 20.w, right: 20.w),
                          child: Column(
                            children: [
                              FadeAnimation(
                                1.5,
                                -30,
                                0,
                                Text(
                                  'Order your\n prescriptions on Bisa.',
                                  style: TextStyle(
                                      fontSize: 28.sp,
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w500),
                                  textAlign: TextAlign.center,
                                ),
                              ),
                              SizedBox(
                                height: 20.h,
                              ),
                              FadeAnimation(
                                1.7,
                                -30,
                                0,
                                Text(
                                  'Order medications from pharmacies around you.',
                                  style: TextStyle(
                                      fontSize: 19.sp,
                                      fontFamily: 'Lato',
                                      fontWeight: FontWeight.w400),
                                  textAlign: TextAlign.center,
                                ),
                              ),
                              SizedBox(
                                height: 20.h,
                              ),
                              FadeAnimation(
                                1.9,
                                -30,
                                0,
                                Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    const Icon(Icons.radio_button_unchecked_outlined),
                                    SizedBox(width: 15.w),
                                    const Icon(
                                      Icons.radio_button_on_rounded,
                                      color: Color(0xFFB5E255),
                                    ),
                                  ],
                                ),
                              ),
                              SizedBox(
                                height: 20.h,
                              ),
                              // FadeAnimation(2.1, -30,0,InkWell(
                              //   onTap: (){
                              //     setState(() {
                              //       startedClicked = true;
                              //     });
                              //     _positionController.forward();
                              //   },
                              //   child: Container(
                              //     width: 180.w,
                              //     height: 55.h,
                              //     decoration: BoxDecoration(
                              //       color: Color(0xFFB5E255),
                              //       borderRadius: BorderRadius.circular(50),
                              //       boxShadow: [
                              //         BoxShadow(
                              //           color: Color.fromRGBO(0, 0, 0, .3),
                              //           blurRadius: 20,
                              //           offset: Offset(0,10)
                              //         )
                              //       ]
                              //     ),
                              //     child: Stack(
                              //       children: [
                              //         Center(
                              //           child:
                              //           !startedClicked?
                              //           Row(
                              //             mainAxisAlignment: MainAxisAlignment.center,
                              //             children: [
                              //               Text('Get Started',
                              //                 style: TextStyle(
                              //                   fontSize: 16.sp,
                              //                   fontFamily: 'Poppins',
                              //                   fontWeight: FontWeight.w600,
                              //                   color: Colors.white
                              //                 ),
                              //               ),
                              //               SizedBox(width: 10.w,),
                              //               SlideTransition(
                              //                 position: _animation,
                              //                 child: Icon(Icons.arrow_forward,color: Colors.white,),
                              //               )
                              //             ],
                              //           )
                              //           :SizedBox.shrink(),
                              //         ),
                              //         startedClicked?AnimatedBuilder(
                              //           animation: _positionController,
                              //           builder: (context,child)=>Positioned(
                              //             left: _positionAnimation.value,
                              //             top: 20.h,
                              //             child: Icon(Icons.arrow_forward,color: Colors.white,)
                              //           ),

                              //         ):SizedBox.shrink(),
                              //         newColor?AnimatedBuilder(
                              //           animation: _scaleController,
                              //           builder: (context,child)=> Transform.scale(
                              //             scale: _scaleAnimation.value,
                              //             child: Container(
                              //               width: 20.w,
                              //               height: 20.h,
                              //               decoration: BoxDecoration(
                              //                 color: Color.fromRGBO(255, 255, 255, 1),
                              //                 shape: BoxShape.circle
                              //               ),
                              //               // child: Icon(Icons.arrow_forward,color: Colors.white,),
                              //             ),
                              //           ),

                              //         ):SizedBox.shrink()
                              //       ],
                              //     ),
                              //   ),
                              // )),
                              AnimatedBuilder(
                                  animation: _scale2Controller,
                                  builder: (context, child) {
                                    return Transform.scale(
                                      scale: _scale2Animation.value,
                                      child: AnimatedBuilder(
                                          animation: _widthController,
                                          builder: (context, child) {
                                            return Center(
                                              child: Container(
                                                height: 80.h,
                                                width: _widthAnimation.value,
                                                // width: 80.h,
                                                decoration: BoxDecoration(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                            50.h),
                                                    color:
                                                        Colors.green.shade100),
                                                padding: EdgeInsets.all(10.h),
                                                child: InkWell(
                                                  onTap: () {
                                                    _widthController.forward();
                                                  },
                                                  child: Stack(
                                                    children: [
                                                      AnimatedBuilder(
                                                          animation:
                                                              _positionController,
                                                          builder:
                                                              (context, child) {
                                                            return Positioned(
                                                              left:
                                                                  _positionAnimation
                                                                      .value,
                                                              // top: 5.h,
                                                              child: Container(
                                                                height: 60.h,
                                                                width: 60.h,
                                                                decoration: const BoxDecoration(
                                                                    shape: BoxShape
                                                                        .circle,
                                                                    color: Colors
                                                                        .green),
                                                                child: const Icon(
                                                                  Icons
                                                                      .arrow_forward,
                                                                  color: Colors
                                                                      .white,
                                                                ),
                                                              ),
                                                            );
                                                          }),
                                                    ],
                                                  ),
                                                ),
                                              ),
                                            );
                                          }),
                                    );
                                  })
                            ],
                          ),
                        ),
                      ),
                    ))
              ],
            ),
          ),
        ],
      ),
    ));
  }
}
