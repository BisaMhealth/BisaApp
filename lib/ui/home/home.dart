import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/animation/loop_animation.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/chat/start_question.dart';
import 'package:bisa_app/ui/home/covid_page/main.dart';
import 'package:bisa_app/ui/vaccination/testing_region.dart';
import 'package:bisa_app/ui/vaccination/vaccine_home.dart';
import 'package:bisa_app/ui/widgets/call_oval_painter.dart';
import 'package:bisa_app/ui/home/faq_page.dart';
import 'package:bisa_app/ui/home/videos_page.dart';
import 'package:bisa_app/ui/tips/tip_details.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:intl/intl.dart';
import 'package:page_animation_transition/animations/fade_animation_transition.dart';
import 'package:page_animation_transition/animations/right_to_left_faded_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:transparent_image/transparent_image.dart';

class Home extends StatefulWidget {
  const Home({Key? key}) : super(key: key);

  @override
  HomeState createState() => HomeState();
}

class HomeState extends State<Home> with SingleTickerProviderStateMixin {
  late CurrentUser currentUser;

  late int articleCat;

  List<Color> selectedColor = [
    const Color.fromRGBO(181, 226, 85, 0.71),
    const Color.fromRGBO(88, 201, 0, 0.58),
  ];
  var unselectedColor = [Colors.white, Colors.white];

  // var selectedId;
  late TabController _tabController;

  @override
  void initState() {
    super.initState();

    // _askVal = 1.0;
    articleCat = 4;

    // selectedId = 1;
    _tabController = TabController(vsync: this, length: 6);
  }

  @override
  void dispose() {
    _tabController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    // ignore: unused_local_variable
    var now = DateTime.now();
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    return Container(
      color: Colors.white,
      width: 1.sw,
      height: 1.sh,
      child: LayoutBuilder(builder: (context, snapshot) {
        return Stack(
          children: [
            SingleChildScrollView(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    SizedBox(
                      height: 0.18.sh,
                    ),
                    FadeAnimation(
                      1.2,
                      0,
                      30,
                      Row(
                        mainAxisAlignment: MainAxisAlignment.start,
                        children: [
                          Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Text(
                              'How Can We Help?',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                                fontSize: 18.sp,
                                color: const Color.fromRGBO(99, 93, 93, 0.98),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    //help list
                    FadeAnimation(
                      1.4,
                      0,
                      30,
                      Padding(
                        padding: const EdgeInsets.all(5.0),
                        child: Container(
                          height: 120.h,
                          decoration: const BoxDecoration(boxShadow: [
                            BoxShadow(
                              color: Color.fromRGBO(0, 0, 0, .21),
                              blurRadius: 20,
                              offset: Offset(0, 10),
                            )
                          ]),
                          width: double.infinity,
                          child: ListView(
                            scrollDirection: Axis.horizontal,
                            children: [
                              //start question
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const StartQuestion(),
                                    ),
                                  );
                                },
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.25,
                                  height: 100.h,
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset('assets/imgs/experts1.png',
                                          height: 40.h, fit: BoxFit.cover),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        ' Ask a\nDoctor',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                        textAlign: TextAlign.center,
                                      )
                                    ],
                                  ),
                                ),
                              ),

                              SizedBox(
                                width: 8.w,
                              ),
                              //vaccines
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const VaccineHome(),
                                    ),
                                  );
                                },
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.27,
                                  height: 120.h,
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset('assets/imgs/vaccine1.png',
                                          height: 40.h, fit: BoxFit.cover),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        ' Vaccination Centers',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                        textAlign: TextAlign.center,
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              //testing centers
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const TestingRegion(),
                                    ),
                                  );
                                },
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.25,
                                  height: 120.h,
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset('assets/imgs/microscope.png',
                                          height: 40.h, fit: BoxFit.cover),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        ' Testing\nCenters',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                        textAlign: TextAlign.center,
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              //watch videos
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const VideoPage(),
                                    ),
                                  );
                                },
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.25,
                                  height: 120.h,
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset('assets/imgs/video1.png',
                                          height: 40.h, fit: BoxFit.cover),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        ' Watch\nVideos',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                        textAlign: TextAlign.center,
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const CovidPage(),
                                      // page: InAppWebViewExampleScreen(),
                                    ),
                                  );
                                },
                                // child: Showcase(
                                //   key: widget.one,
                                //   // description: 'Connect with Health Specialist at a fee',
                                //   description: 'Get information on Covid-19',
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.25,
                                  height: 100.h,
                                  decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset(
                                        // 'assets/imgs/stethoscope1.png',
                                        'assets/imgs/corona1.png',
                                        height: 30.h,
                                        fit: BoxFit.cover,
                                      ),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        // 'Bisa\nConnect',
                                        'Covid-19',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                        textAlign: TextAlign.center,
                                      )
                                    ],
                                  ),
                                ),
                                // ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              //faq
                              InkWell(
                                onTap: () {
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType:
                                          FadeAnimationTransition(),
                                      page: const FaqPage(),
                                    ),
                                  );
                                },
                                child: Container(
                                  width:
                                      MediaQuery.of(context).size.width * 0.25,
                                  height: 100.h,
                                  decoration: BoxDecoration(
                                    // gradient: LinearGradient(
                                    //   colors: [
                                    //     Color.fromRGBO(79, 199, 156, 1),
                                    //     Color.fromRGBO(103, 226, 45, 0.69),
                                    //   ],
                                    //   begin: Alignment.topLeft,
                                    //   end: Alignment.bottomRight
                                    // ),
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(10),
                                  ),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      Image.asset('assets/imgs/faq1.png'),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        'FAQS',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 14.sp,
                                          color: const Color.fromRGBO(
                                              92, 94, 86, 1),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 20.h,
                    ),
                    FadeAnimation(
                      1.6,
                      -30,
                      0,
                      Row(
                        mainAxisAlignment: MainAxisAlignment.start,
                        children: [
                          Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Text(
                              'Tips & Articles',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontWeight: FontWeight.w600,
                                fontSize: 17.sp,
                                color: const Color.fromRGBO(99, 93, 93, 0.98),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    FadeAnimation(
                      1.8,
                      0,
                      -30,
                      Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Container(
                          height: 40.h,
                          decoration: const BoxDecoration(boxShadow: [
                            BoxShadow(
                              color: Color.fromRGBO(0, 0, 0, .21),
                              blurRadius: 20,
                              offset: Offset(0, 10),
                            )
                          ]),
                          width: double.infinity,
                          child: ListView(
                            scrollDirection: Axis.horizontal,
                            children: [
                              InkWell(
                                onTap: () {
                                  // getArticles(data)
                                  setState(() {
                                    articleCat = 4;
                                  });
                                  _tabController.animateTo(0);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.25.sw,
                                  height: 20.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(4)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset(
                                        'assets/imgs/stethoscope1.png',
                                        height: 18.h,
                                      ),
                                      SizedBox(
                                        width: 4.w,
                                      ),
                                      Text(
                                        'General',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 15.sp,
                                          color: isSelected(4)
                                              ? Colors.white
                                              : const Color.fromRGBO(
                                                  0, 101, 163, 1),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  setState(() {
                                    articleCat = 10;
                                  });
                                  _tabController.animateTo(1);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.3.sw,
                                  height: 20.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(10)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(40),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset(
                                        'assets/imgs/pregnant.png',
                                        height: 18.h,
                                      ),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        'Pregnancy',
                                        style: TextStyle(
                                            fontFamily: 'Poppins',
                                            fontWeight: FontWeight.w600,
                                            fontSize: 15.sp,
                                            color: isSelected(10)
                                                ? Colors.white
                                                : Colors.brown),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  setState(() {
                                    articleCat = 12;
                                  });
                                  _tabController.animateTo(2);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.45.sw,
                                  height: 20.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(12)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(40),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset(
                                        'assets/imgs/tasks.png',
                                        height: 20.h,
                                      ),
                                      SizedBox(
                                        width: 8.w,
                                      ),
                                      Text(
                                        'Lifestyle Diseases',
                                        style: TextStyle(
                                            fontFamily: 'Poppins',
                                            fontWeight: FontWeight.w600,
                                            fontSize: 15.sp,
                                            color: isSelected(12)
                                                ? Colors.white
                                                : Colors.lightGreen),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  setState(() {
                                    articleCat = 2;
                                  });
                                  _tabController.animateTo(3);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.25.sw,
                                  height: 20.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(2)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(40),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset(
                                        'assets/imgs/red-ribbon.png',
                                        height: 18.h,
                                      ),
                                      SizedBox(
                                        height: 15.h,
                                      ),
                                      Text(
                                        'HIV-AIDS',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 12.sp,
                                          color: isSelected(2)
                                              ? Colors.white
                                              : const Color.fromRGBO(
                                                  238, 97, 97, 1),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  setState(() {
                                    articleCat = 5;
                                  });
                                  _tabController.animateTo(4);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.35.sw,
                                  height: 20.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(5)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset('assets/imgs/hospital1.png'),
                                      SizedBox(
                                        width: 10.w,
                                      ),
                                      Text(
                                        'Our Doctors',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 15.sp,
                                          color: isSelected(5)
                                              ? Colors.white
                                              : const Color.fromRGBO(
                                                  160, 217, 242, 1),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 8.w,
                              ),
                              InkWell(
                                onTap: () {
                                  setState(() {
                                    articleCat = 3;
                                  });
                                  _tabController.animateTo(5);
                                },
                                child: AnimatedContainer(
                                  duration: const Duration(milliseconds: 300),
                                  width: 0.25.sw,
                                  height: 25.h,
                                  decoration: BoxDecoration(
                                    gradient: LinearGradient(
                                        colors: isSelected(3)
                                            ? selectedColor
                                            : unselectedColor,
                                        begin: Alignment.topLeft,
                                        end: Alignment.bottomRight),
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                  child: Row(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    mainAxisSize: MainAxisSize.min,
                                    children: [
                                      Image.asset('assets/imgs/diet1.png'),
                                      SizedBox(
                                        width: 10.w,
                                      ),
                                      Text(
                                        'Diet',
                                        style: TextStyle(
                                          fontFamily: 'Poppins',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 15.sp,
                                          color: isSelected(3)
                                              ? Colors.white
                                              : const Color.fromRGBO(
                                                  54, 140, 14, 1),
                                        ),
                                      )
                                    ],
                                  ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ),
                    SizedBox(
                      height: 15.h,
                    ),
                    //articles
                    // buildArticleList(4),
                    Flexible(
                      child: SizedBox(
                        height: 340.h,
                        child: TabBarView(
                          physics: const NeverScrollableScrollPhysics(),
                          controller: _tabController,
                          children: [
                            buildArticleList(4),
                            buildArticleList(10),
                            buildArticleList(12),
                            buildArticleList(2),
                            buildArticleList(5),
                            buildArticleList(3),
                          ],
                        ),
                      ),
                    ),

                    SizedBox(
                      height: 10.h,
                    ),
                    //video

                    SizedBox(
                      height: 80.h,
                    ),
                  ],
                ),
              ),
            ),
            Stack(
              children: [
                Container(
                  color: Colors.white,
                  height: 145.h,
                ),
                Positioned(
                  top: -50.w,
                  right: -60.w,
                  child: FadeAnimation(
                    2.2,
                    -30,
                    0,
                    // Image.asset('assets/imgs/Ellipse_home.png',)
                    LoopWidget(
                        30,
                        Opacity(
                          opacity: 0.25,
                          child: Container(
                            width: 150.w,
                            height: 150.w,
                            decoration: const BoxDecoration(
                              shape: BoxShape.circle,
                              gradient: RadialGradient(colors: [
                                Color.fromRGBO(63, 133, 198, 0.85),
                                Color.fromRGBO(63, 198, 149, 0.76),
                              ]),
                            ),
                          ),
                        ),
                        700),
                  ),
                ),
                SizedBox(
                  height: 145.h,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      SizedBox(
                        height: 50.h,
                      ),
                      Row(
                        children: [
                          SizedBox(
                            width: 15.w,
                          ),
                          FadeAnimation(
                            1.2,
                            -30,
                            0,
                            Image.asset(
                              'assets/imgs/bisa_icon.png',
                              height: 65.h,
                              fit: BoxFit.cover,
                            ),
                          ),
                          SizedBox(
                            width: 15.w,
                          ),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              FadeAnimation(
                                1.2,
                                -30,
                                0,
                                Text(
                                  'Hi ${currentUser.fname},',
                                  style: TextStyle(
                                      fontWeight: FontWeight.w600,
                                      fontFamily: 'Poppins',
                                      fontSize: 26.sp),
                                ),
                              ),
                              SizedBox(
                                height: 2.h,
                              ),
                              FadeAnimation(
                                1.2,
                                -30,
                                0,
                                Text(
                                  'Welcome back',
                                  style: TextStyle(
                                    fontWeight: FontWeight.w400,
                                    fontFamily: 'Lato',
                                    fontSize: 16.sp,
                                  ),
                                ),
                              ),
                            ],
                          ),
                          const Spacer(),
                          // FadeAnimation(1.2, - 30,0,Icon(Icons.settings_outlined, size: 50,color: Colors.grey,),),
                          SizedBox(
                            width: 5.w,
                          ),
                        ],
                      ),
                      SizedBox(
                        height: 14.h,
                      ),
                    ],
                  ),
                ),
              ],
            ),
            Positioned(
              top: (0.18.sh),
              right: 0,
              child: InkWell(
                onTap: () {
                  //open call dialog
                  showCallDialog();
                },
                child: Container(
                  decoration: BoxDecoration(boxShadow: [
                    BoxShadow(
                      offset: const Offset(0, -10),
                      blurRadius: 60,
                      spreadRadius: 0,
                      color: Colors.black.withOpacity(0.05),
                    )
                  ]),
                  child: CustomPaint(
                    size: Size(
                      120.w,
                      (120.w * 2.8727272727272726).toDouble(),
                    ),
                    painter: CallOvalPainter(),
                  ),
                ),
              ),
            ),
          ],
        );
      }),
    );
  }

  FadeAnimation buildArticleList(int index) {
    return FadeAnimation(
      1.2,
      -30,
      0,
      FutureBuilder(
          future: getArticles({'id': index, 'token': currentUser.token}),
          builder: (context, AsyncSnapshot snapshot) {
            if (!snapshot.hasData) {
              return const Center(
                child: CircularProgressIndicator.adaptive(),
              );
            } else if (snapshot.hasError) {
              return const Center(
                child: Text('Sorry, unable to load articles'),
              );
            } else {
              List res = snapshot.data;
              return Column(
                mainAxisSize: MainAxisSize.min,
                children: res.reversed.take(3).map((e) {
                  var day = DateFormat('EEEE')
                      .format(
                        DateTime.parse(e['created_at']),
                      )
                      .substring(0, 3);
                  var num = DateFormat('d').format(
                    DateTime.parse(e['created_at']),
                  );

                  var desc = e['intro'] ??
                      "This is an awesome article to read. Check it out.";
                  return InkWell(
                    onTap: () {
                      Navigator.push(
                        context,
                        PageAnimationTransition(
                          pageAnimationType: RightToLeftFadedTransition(),
                          page: TipDetails(
                            article: e,
                          ),
                        ),
                      );
                    },
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        Container(
                          height: 100.h,
                          width: 1.sw - 25.w,
                          decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(15),
                              boxShadow: const [
                                BoxShadow(
                                  color: Color.fromRGBO(0, 0, 0, .21),
                                  blurRadius: 20,
                                  offset: Offset(0, 10),
                                )
                              ]),
                          child: Row(
                            children: [
                              ClipRRect(
                                borderRadius: BorderRadius.circular(15),
                                child: SizedBox(
                                  width: 120.w,
                                  child: Hero(
                                    tag: '${e['image']}',
                                    child: FadeInImage.memoryNetwork(
                                      placeholder: kTransparentImage,
                                      image: '${e['image']}',
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                ),
                              ),
                              SizedBox(
                                width: 12.w,
                              ),
                              Expanded(
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      '${e['title']}',
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontSize: 16.sp,
                                        fontWeight: FontWeight.w600,
                                        // letterSpacing: 2,
                                        height: 0.99,
                                        color: const Color.fromRGBO(
                                            97, 99, 95, 0.98),
                                      ),
                                      maxLines: 2,
                                    ),
                                    SizedBox(
                                      height: 5.h,
                                    ),
                                    // Html(
                                    //   data:'${e['content'].split('>')[2]}',
                                    //   shrinkWrap: true,
                                    // ),
                                    Text(
                                      desc,
                                      style: TextStyle(
                                        fontFamily: 'Lato',
                                        fontSize: 10.sp,
                                        fontWeight: FontWeight.w400,
                                        color: const Color.fromRGBO(
                                            109, 109, 109, 1),
                                      ),
                                      maxLines: 2,
                                      overflow: TextOverflow.ellipsis,
                                    ),
                                  ],
                                ),
                              ),
                              Container(
                                width: 40.w,
                                height: 60.h,
                                decoration: BoxDecoration(
                                    color: Colors.white,
                                    borderRadius: BorderRadius.circular(8),
                                    boxShadow: const [
                                      BoxShadow(
                                        color: Color.fromRGBO(0, 0, 0, .18),
                                        blurRadius: 20,
                                        offset: Offset(0, 10),
                                      )
                                    ]),
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Text(
                                      day.toUpperCase(),
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontSize: 13.sp,
                                        fontWeight: FontWeight.w400,
                                        color: const Color.fromRGBO(
                                            108, 112, 106, 1),
                                      ),
                                    ),
                                    SizedBox(
                                      height: 3.h,
                                    ),
                                    Text(
                                      num,
                                      style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontSize: 15.sp,
                                        fontWeight: FontWeight.w400,
                                        color: const Color.fromRGBO(
                                            108, 112, 106, 1),
                                      ),
                                    )
                                  ],
                                ),
                              ),
                              SizedBox(
                                width: 5.w,
                              )
                            ],
                          ),
                        ),
                        SizedBox(height: 10.h)
                      ],
                    ),
                  );
                }).toList(),
              );
            }
          }),
    );
  }

  isSelected(int i) {
    // bool isSelected(int i) {
    return articleCat == i ? true : false;
    // }
  }

  void showCallDialog() {
    showDialog(
        context: context,
        builder: (builder) {
          return Dialog(
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12),
            ),
            elevation: 5,
            backgroundColor: Colors.transparent,
            child: Container(
              padding: const EdgeInsets.all(18),
              width: 0.8.sw,
              decoration: BoxDecoration(
                shape: BoxShape.rectangle,
                color: Colors.white,
                borderRadius: BorderRadius.circular(12),
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  SizedBox(height: 10.h),
                  Text(
                    'Call GHS call center?',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      fontSize: 24.sp,
                      fontFamily: 'Lato',
                      fontWeight: FontWeight.w600,
                      color: const Color.fromRGBO(71, 69, 69, 1),
                    ),
                  ),
                  SizedBox(height: 20.h),
                  Text(
                    '0308249010',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      fontSize: 31.sp,
                      fontFamily: 'Lato',
                      fontWeight: FontWeight.w800,
                      color: const Color.fromRGBO(71, 69, 69, 1),
                    ),
                  ),
                  SizedBox(height: 30.h),
                  InkWell(
                    onTap: () {
                      launchUrl(
                        Uri.parse('tel:0308249010'),
                      );
                    },
                    child: Container(
                      height: 40.h,
                      width: 100.w,
                      decoration: BoxDecoration(
                        color: const Color.fromRGBO(142, 211, 55, 1),
                        borderRadius: BorderRadius.circular(25),
                      ),
                      child: Center(
                        child: Text(
                          'Yes',
                          style: TextStyle(
                              fontSize: 14.sp,
                              fontFamily: 'Lato',
                              fontWeight: FontWeight.w600,
                              color: Colors.white),
                        ),
                      ),
                    ),
                  ),
                  SizedBox(height: 20.h),
                ],
              ),
            ),
          );
        });
  }
}
