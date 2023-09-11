import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/home/home_page.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/bottom_to_top_transition.dart';
import 'package:page_animation_transition/animations/top_to_bottom_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';

class InterestPage extends StatefulWidget {
  const InterestPage({Key? key, required this.list}) : super(key: key);

  final List list;
  @override
  InterestPageState createState() => InterestPageState();
}

class InterestPageState extends State<InterestPage>
    with SingleTickerProviderStateMixin {
  late final AnimationController _controller =
      AnimationController(vsync: this, duration: const Duration(seconds: 2))
        ..repeat(reverse: true);

  late final Animation<Offset> _animation =
      Tween<Offset>(begin: Offset.zero, end: const Offset(1.0, 0.0))
          .animate(_controller);

  late List<Map<String, dynamic>> interestList;

  final bool _saving = false;

  void addInterests() {
    interestList = widget.list
        .map((e) => {'id': e['id'], 'name': e['name'], 'isSelected': 'false'})
        .toList();
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  void initState() {
    super.initState();
    addInterests();
  }

  late CurrentUser currentUser;

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    return Scaffold(
      resizeToAvoidBottomInset: true,
      backgroundColor: const Color.fromRGBO(255, 255, 255, 1),
      body: SingleChildScrollView(
        child: SizedBox(
          width: MediaQuery.of(context).size.width,
          height: MediaQuery.of(context).size.height,
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
                          25,
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
                          800))),
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
                          -15,
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
                          -30,
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
              Padding(
                padding: const EdgeInsets.all(18.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    SizedBox(
                      height: 40.h,
                    ),
                    FadeAnimation(
                      1.6,
                      -30,
                      0,
                      Image.asset('assets/imgs/bisa_icon.png',
                          height: 100.h, fit: BoxFit.cover),
                    ),
                    SizedBox(
                      height: 35.h,
                    ),
                    FadeAnimation(
                      1.8,
                      -30,
                      0,
                      Text(
                        'Let’s customize your experience.',
                        style: TextStyle(
                            fontSize: 30.sp,
                            fontWeight: FontWeight.w500,
                            fontFamily: 'Poppins'),
                      ),
                    ),
                    SizedBox(
                      height: 20.h,
                    ),
                    FadeAnimation(
                      1.9,
                      -30,
                      0,
                      Text(
                        'What do you like?',
                        style: TextStyle(
                            color: const Color.fromRGBO(141, 133, 133, 0.75),
                            fontSize: 15.sp,
                            fontWeight: FontWeight.w400,
                            fontFamily: 'Poppins'),
                      ),
                    ),
                    SizedBox(
                      height: 10.h,
                    ),
                    FadeAnimation(
                      2.2,
                      -30,
                      0,
                      Wrap(
                          spacing: 10,
                          children: interestList.map((e) {
                            // ignore: no_leading_underscores_for_local_identifiers
                            var _selected =
                                e['isSelected'] == 'false' ? false : true;
                            return InputChip(
                              labelPadding:
                                  const EdgeInsets.only(right: 2, left: 2),
                              showCheckmark: false,
                              side: const BorderSide(
                                  color: Color.fromRGBO(79, 199, 156, 1)),
                              backgroundColor: Colors.white,
                              label: Row(
                                mainAxisSize: MainAxisSize.min,
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Text(
                                    '${e['name']}',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontSize: 16.sp,
                                        fontWeight: FontWeight.w400,
                                        color: const Color.fromRGBO(
                                            79, 199, 156, 1)),
                                  ),
                                  SizedBox(
                                    width: 2.w,
                                  ),
                                  _selected
                                      ? const Icon(Icons.check_circle_outline)
                                      : const Icon(
                                          Icons.add_circle_outline,
                                          color:
                                              Color.fromRGBO(79, 199, 156, 1),
                                        ),
                                ],
                              ),
                              labelStyle: TextStyle(
                                  fontFamily: 'Poppins',
                                  fontSize: 16.sp,
                                  fontWeight: FontWeight.w400,
                                  color: const Color.fromRGBO(79, 199, 156, 1)),
                              selected: _selected,
                              selectedColor: Colors.blue.shade600,
                              onSelected: (bool selected) {
                                setState(() {
                                  e['isSelected'] = selected ? "true" : "false";
                                });
                              },
                            );
                          }).toList()),
                    ),
                    SizedBox(
                      height: 50.h,
                    ),
                    FadeAnimation(
                      2.4,
                      -30,
                      0,
                      SizedBox(
                        width: 1.sw - 40.w,
                        child: Center(
                          child: InkWell(
                            onTap: () {
                              var selected = interestList.where(
                                  (element) => element['isSelected'] == 'true');
                              if (selected.isEmpty) {
                                //show toast message
                              } else {
                                handleInterest();
                              }
                            },
                            child: Container(
                              width: 150.w,
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
                                  : Row(
                                      mainAxisAlignment:
                                          MainAxisAlignment.center,
                                      children: [
                                        Text(
                                          'Continue',
                                          style: TextStyle(
                                              fontFamily: 'Poppins',
                                              fontSize: 16.sp,
                                              fontWeight: FontWeight.w600,
                                              color: Colors.white),
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
                          ),
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 20.h,
                    ),
                    FadeAnimation(
                        2.6,
                        -30,
                        0,
                        SizedBox(
                          width: 1.sw - 40.w,
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          BottomToTopTransition(),
                                      page: const HomePage(),
                                    ),
                                  );
                                },
                                child: Text(
                                  'Skip',
                                  style: TextStyle(
                                      fontSize: 16.sp,
                                      fontFamily: 'Poppins',
                                      fontWeight: FontWeight.w600,
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

  void handleInterest() {
    var selectedlist = '';
    var selected =
        interestList.where((element) => element['isSelected'] == 'true');
    for (var element in selected) {
      var newStr =
          selectedlist.isEmpty ? '${element['id']}' : ',${element['id']}';
      selectedlist = selectedlist + newStr;
    }
    if (kDebugMode) {
      print(selectedlist);
    }

    Map<String, dynamic> dataMap = {
      "interest": selectedlist,
      "token": currentUser.token
    };

    sendInterest(dataMap).then((value) {
      if (kDebugMode) {
        print(value);
      }
      if (value['status'] == 'success') {
        Navigator.pop(context);
        Navigator.push(
          context,
          PageAnimationTransition(
            pageAnimationType: TopToBottomTransition(),
            page: const HomePage(),
          ),
        );
      }
    });
  }
}
