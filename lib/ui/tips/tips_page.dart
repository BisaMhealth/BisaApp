import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/tips/tip_details.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/right_to_left_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:provider/provider.dart';
import 'package:transparent_image/transparent_image.dart';

class TipsPage extends StatefulWidget {
  const TipsPage({Key? key}) : super(key: key);

  @override
  TipsPageState createState() => TipsPageState();
}

class TipsPageState extends State<TipsPage> {
  late CurrentUser currentUser;

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    return DefaultTabController(
      length: 7,
      child: Scaffold(
        appBar: AppBar(
          backgroundColor: Colors.white,
          leadingWidth: 0,
          bottom: TabBar(
            isScrollable: true,
            labelStyle: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 18.sp,
              fontWeight: FontWeight.w600,
              // color: Colors.green.shade600
            ),
            labelColor: Colors.green.shade600,
            indicatorColor: Colors.green.shade600,
            unselectedLabelStyle: TextStyle(
              fontFamily: 'Poppins',
              fontSize: 18.sp,
              fontWeight: FontWeight.w600,
              // color: Colors.red
            ),
            unselectedLabelColor: Colors.black,
            tabs: const [
              Tab(
                child: Text(
                  'Diabetes',
                ),
              ),
              Tab(child: Text('Pregnancy')),
              Tab(child: Text('Lifestyle Diseases')),
              Tab(child: Text('HIV-AIDS')),
              Tab(child: Text('Nutrition')),
              Tab(child: Text('General Health')),
              Tab(child: Text('Our Doctors Say')),
            ],
          ),
          title: Text(
            'Health Tips',
            style: TextStyle(
                fontWeight: FontWeight.w700,
                fontFamily: 'Lato',
                fontSize: 27.sp,
                color: const Color.fromRGBO(85, 80, 80, 0.98)),
          ),
          automaticallyImplyLeading: false,
        ),
        body: TabBarView(
          children: [
            articlesPage(1),
            articlesPage(10),
            articlesPage(12),
            articlesPage(2),
            articlesPage(3),
            articlesPage(4),
            articlesPage(5),
          ],
        ),
      ),
    );
  }

  articlesPage(int id) {
    return Padding(
      padding: const EdgeInsets.all(18.0),
      child: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisSize: MainAxisSize.max,
          children: [
            Text(
              'Most Recent Articles',
              style: TextStyle(
                  fontFamily: 'Poppins',
                  fontWeight: FontWeight.w600,
                  fontSize: 17.sp),
            ),
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: FutureBuilder(
                  future: getArticles({'id': id, 'token': currentUser.token}),
                  builder: (context, AsyncSnapshot snapshot) {
                    if (!snapshot.hasData) {
                      return const CircularProgressIndicator.adaptive();
                    } else if (snapshot.hasError) {
                      return SizedBox(
                        height: 1.sh,
                        width: 1.sw,
                        child: const Center(
                          child: Text(
                              'Sorry, we encountered an error. Please try again.'),
                        ),
                      );
                    } else {
                      List results = snapshot.data;
                      if (results.isEmpty) {
                        return SizedBox(
                          height: 1.sh,
                          width: 1.sw,
                          child: const Center(
                            child: Text('Sorry, This category is empty.'),
                          ),
                        );
                      } else {
                        return Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: results.map((e) {
                            return InkWell(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  PageAnimationTransition(
                                    pageAnimationType: RightToLeftTransition(),
                                    page: TipDetails(
                                      article: e,
                                    ),
                                  ),
                                );
                              },
                              child: Column(
                                children: [
                                  Container(
                                    height: 90.h,
                                    width: 1.sw - 40.w,
                                    decoration: BoxDecoration(
                                        color: Colors.white,
                                        borderRadius: BorderRadius.circular(15),
                                        boxShadow: const [
                                          BoxShadow(
                                              color:
                                                  Color.fromRGBO(0, 0, 0, .21),
                                              blurRadius: 20,
                                              offset: Offset(0, 10))
                                        ]),
                                    child: Row(
                                      children: [
                                        // Image.asset('assets/imgs/article_pic.png',fit: BoxFit.cover,),
                                        ClipRRect(
                                          borderRadius:
                                              BorderRadius.circular(15),
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
                                            mainAxisAlignment:
                                                MainAxisAlignment.center,
                                            crossAxisAlignment:
                                                CrossAxisAlignment.start,
                                            children: [
                                              Text(
                                                '${e['title']}',
                                                style: TextStyle(
                                                    fontFamily: 'Poppins',
                                                    fontSize: 15.sp,
                                                    fontWeight: FontWeight.w600,
                                                    color: const Color.fromRGBO(
                                                        97, 99, 95, 0.98)),
                                              ),
                                              SizedBox(
                                                height: 8.h,
                                              ),
                                              // Text('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse habitasse. Lorem ipsum dolor sit amet.',
                                              //   style: TextStyle(
                                              //     fontFamily: 'Lato',
                                              //     fontSize: 10.sp,
                                              //     fontWeight: FontWeight.w400,
                                              //     color: Color.fromRGBO(109, 109, 109, 1)
                                              //   ),
                                              //   maxLines: 3,
                                              //   overflow: TextOverflow.ellipsis,
                                              // ),
                                            ],
                                          ),
                                        ),
                                        // Container(
                                        //   width: 40.w,
                                        //   height: 60.h,
                                        //   decoration: BoxDecoration(
                                        //     color: Colors.white,
                                        //     borderRadius: BorderRadius.circular(8),
                                        //     boxShadow: [
                                        //       BoxShadow(
                                        //         color: Color.fromRGBO(0, 0, 0, .18),
                                        //         blurRadius: 20,
                                        //         offset: Offset(0,10)
                                        //       )
                                        //     ]
                                        //   ),
                                        //   child: Column(
                                        //     mainAxisAlignment: MainAxisAlignment.center,
                                        //     children: [
                                        //       Text('FRI',
                                        //         style: TextStyle(
                                        //           fontFamily: 'Poppins',
                                        //           fontSize: 13.sp,
                                        //           fontWeight: FontWeight.w400,
                                        //           color: Color.fromRGBO(108, 112, 106, 1)
                                        //         ),
                                        //       ),
                                        //       SizedBox(height: 3.h,),
                                        //       Text('21',
                                        //         style: TextStyle(
                                        //           fontFamily: 'Poppins',
                                        //           fontSize: 15.sp,
                                        //           fontWeight: FontWeight.w400,
                                        //           color: Color.fromRGBO(108, 112, 106, 1)
                                        //         ),
                                        //       )
                                        //     ],
                                        //   ),
                                        // ),
                                        // SizedBox(width: 10.w,)
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
                    }
                  }),
            ),
            SizedBox(
              height: 60.h,
            )
          ],
        ),
      ),
    );
  }
}
