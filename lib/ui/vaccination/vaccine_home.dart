import 'package:bisa_app/ui/vaccination/basic_info.dart';
// import 'package:bisa_app/ui/vaccination/testing_region.dart';
// import 'package:bisa_app/ui/vaccination/vaccine_location.dart';
import 'package:bisa_app/ui/vaccination/vaccine_region.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/right_to_left_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';

class VaccineHome extends StatefulWidget {
  const VaccineHome({Key? key}) : super(key: key);

  @override
  VaccineHomeState createState() => VaccineHomeState();
}

class VaccineHomeState extends State<VaccineHome> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(
            Icons.arrow_back_ios,
            color: Colors.black,
          ),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        title: Text(
          'Vaccination',
          style: TextStyle(
            fontFamily: 'Lato',
            fontWeight: FontWeight.w700,
            fontSize: 28.sp,
            color: const Color.fromRGBO(36, 52, 99, 0.98)
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.all(10.w),
          child: Column(
            children: [
              InkWell(
                onTap: (){
                  Navigator.push(
                    context,
                    PageAnimationTransition(
                      pageAnimationType: RightToLeftTransition(),
                      page: const VaccineRegion()
                    )
                  );
                },
                child: Container(
                  height: 280.h,
                  width: (1.sw - 20.w),
                  decoration: const BoxDecoration(
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(15),
                      topRight:Radius.circular(65),
                      bottomLeft: Radius.circular(15),
                      bottomRight: Radius.circular(15) 
                    ),
                    color: Color.fromRGBO(36, 52, 99, 1),
                    boxShadow: [
                      BoxShadow(
                        color: Color.fromRGBO(81, 71, 71, 0.25),
                        offset: Offset(0,10),
                        blurRadius: 30,
                        spreadRadius: 10
                      )
                    ]
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.max,
                    children: [
                      SizedBox(
                        width: (1.sw - 34.w)/2 - 8.w,
                        child: Padding(
                          padding: EdgeInsets.symmetric(horizontal: 4.w,vertical: 2),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              // SizedBox(height: 50.h,),
                              Text(
                                "COVID-19",
                                style: TextStyle(
                                  fontFamily: 'Lato',
                                  fontWeight: FontWeight.w700,
                                  fontSize: 28.sp,
                                  color: Colors.white
                                ),
                              ),
                              SizedBox(height: 12.h,),
                              Text(
                                "VACCINATIONS ONGOING",
                                style: TextStyle(
                                  fontFamily: 'Lato',
                                  fontWeight: FontWeight.w700,
                                  fontSize: 10.sp,
                                  color: const Color.fromRGBO(191, 245, 138, 1)
                                ),
                              ),
                              SizedBox(height: 25.h,),
                              InkWell(
                                onTap: (){
                                  Navigator.push(
                                    context,
                                    PageAnimationTransition(
                                      pageAnimationType: RightToLeftTransition(),
                                      page: const VaccineRegion()
                                    )
                                  );
                                },
                                child: Padding(
                                  padding: EdgeInsets.all(8.w),
                                  child: Container(
                                    width: (1.sw - 34.w)/2 - 12.w,
                                    decoration: BoxDecoration(
                                      borderRadius: BorderRadius.circular(50),
                                      border: Border.all(color: Colors.white)
                                    ),
                                    child: Center(
                                      child: Padding(
                                        padding: EdgeInsets.symmetric(vertical: 10,horizontal: 25.w),
                                        child: Text(
                                          "Find a center",
                                          style: TextStyle(
                                            fontFamily: 'Lato',
                                            fontWeight: FontWeight.w500,
                                            fontSize: 12.sp,
                                            color: const Color.fromRGBO(255, 255, 255, 1)
                                          ),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              )
                            ],
                          ),
                        ),
                      ),
                      Image.asset(
                        "assets/imgs/vaccinebro.png",
                        fit: BoxFit.fitWidth,
                        width: (1.sw - 34.w)/2 - 8.w,
                      )
                    ],
                  ),
                ),
              ),
              SizedBox(height: 30.h,),
              Align(
                alignment: Alignment.topLeft,
                child: Text(
                  "KNOWLEDGE CENTER",
                  style: TextStyle(
                    fontFamily: 'Lato',
                    fontWeight: FontWeight.w700,
                    fontSize: 18.sp,
                    color: const Color.fromRGBO(0, 0, 0, 0.98)
                  ),
                ),
              ),
              SizedBox(height: 12.h,),
              InkWell(
                onTap: (){
                   Navigator.push(
                    context,
                    PageAnimationTransition(
                      pageAnimationType: RightToLeftTransition(),
                      page: const BasicInfo()
                    )
                  );
                },
                child: Container(
                  decoration: const BoxDecoration(
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(10),
                      topRight:Radius.circular(40),
                      bottomLeft: Radius.circular(10),
                      bottomRight: Radius.circular(10) 
                    ),
                    gradient: LinearGradient(
                      colors: [Color.fromRGBO(191, 207, 146, 1), Color.fromRGBO(141, 199, 96, 0.37)],
                    ),
                    // border: Border.all(
                    //   color: Colors.amber, //kHintColor, so this should be changed?
                    // )
                  ),
                  padding: const EdgeInsets.all(1.0),
                  child: Container(
                    height: 81.h,
                    width: (1.sw - 34),
                    decoration: const BoxDecoration(
                      borderRadius: BorderRadius.only(
                        topLeft: Radius.circular(10),
                        topRight:Radius.circular(40),
                        bottomLeft: Radius.circular(10),
                        bottomRight: Radius.circular(10) 
                      ),
                      color: Color.fromRGBO(255, 255, 255, 1),
                      boxShadow: [
                        BoxShadow(
                          color: Color.fromRGBO(178, 159, 159, 0.25),
                          offset: Offset(0,4),
                          blurRadius: 32,
                          spreadRadius: 4
                        )
                      ]
                    ),
                    child: Row(
                      mainAxisSize: MainAxisSize.max,
                      children: [
                        SizedBox(width: 12.w,),
                        SizedBox(
                          width: 47.h,
                          height: 47.h,
                          child: Image.asset("assets/imgs/to_do_list.png")
                        ),
                        SizedBox(width: 18.w,),
                        Text(
                          "Basic information",
                          style: TextStyle(
                            fontFamily: 'Poppins',
                            fontWeight: FontWeight.w500,
                            fontSize: 18.sp,
                            color: const Color.fromRGBO(36, 52, 99, 1)
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              // SizedBox(height: 12.h,),
              // InkWell(
              //   onTap: (){
              //     Navigator.push(
              //       context,
              //       PageAnimationTransition(
              //         pageAnimationType: RightToLeftTransition(),
              //         child: TestingRegion()
              //       )
              //     );
              //   },
              //   child: Container(
              //     decoration: BoxDecoration(
              //       borderRadius: BorderRadius.only(
              //         topLeft: Radius.circular(10),
              //         topRight:Radius.circular(40),
              //         bottomLeft: Radius.circular(10),
              //         bottomRight: Radius.circular(10) 
              //       ),
              //       gradient: LinearGradient(
              //         colors: [Color.fromRGBO(191, 207, 146, 1), Color.fromRGBO(141, 199, 96, 0.37)],
              //       ),
              //       // border: Border.all(
              //       //   color: Colors.amber, //kHintColor, so this should be changed?
              //       // )
              //     ),
              //     child: Padding(
              //       padding: const EdgeInsets.all(1.0),
              //       child: Container(
              //         height: 81.h,
              //         width: (1.sw - 34),
              //         decoration: BoxDecoration(
              //           borderRadius: BorderRadius.only(
              //             topLeft: Radius.circular(10),
              //             topRight:Radius.circular(40),
              //             bottomLeft: Radius.circular(10),
              //             bottomRight: Radius.circular(10) 
              //           ),
              //           color: const Color.fromRGBO(255, 255, 255, 1),
              //           boxShadow: [
              //             BoxShadow(
              //               color: const Color.fromRGBO(178, 159, 159, 0.25),
              //               offset: Offset(0,4),
              //               blurRadius: 32,
              //               spreadRadius: 4
              //             )
              //           ]
              //         ),
              //         child: Row(
              //           mainAxisSize: MainAxisSize.max,
              //           children: [
              //             SizedBox(width: 12.w,),
              //             SizedBox(
              //               width: 47.h,
              //               height: 47.h,
              //               child: Image.asset("assets/imgs/microscope.png")
              //             ),
              //             SizedBox(width: 18.w,),
              //             Text(
              //               "Testing",
              //               style: TextStyle(
              //                 fontFamily: 'Poppins',
              //                 fontWeight: FontWeight.w500,
              //                 fontSize: 18.sp,
              //                 color: Color.fromRGBO(36, 52, 99, 1)
              //               ),
              //             ),
              //           ],
              //         ),
              //       ),
              //     ),
              //   ),
              // ),
              SizedBox(height: 12.h,),
              // Container(
              //   decoration: BoxDecoration(
              //     borderRadius: BorderRadius.only(
              //       topLeft: Radius.circular(10),
              //       topRight:Radius.circular(40),
              //       bottomLeft: Radius.circular(10),
              //       bottomRight: Radius.circular(10) 
              //     ),
              //     gradient: LinearGradient(
              //       colors: [Color.fromRGBO(191, 207, 146, 1), Color.fromRGBO(141, 199, 96, 0.37)],
              //     ),
              //     // border: Border.all(
              //     //   color: Colors.amber, //kHintColor, so this should be changed?
              //     // )
              //   ),
              //   child: Padding(
              //     padding: const EdgeInsets.all(1.0),
              //     child: Container(
              //       height: 81.h,
              //       width: (1.sw - 34),
              //       decoration: BoxDecoration(
              //         borderRadius: BorderRadius.only(
              //           topLeft: Radius.circular(10),
              //           topRight:Radius.circular(40),
              //           bottomLeft: Radius.circular(10),
              //           bottomRight: Radius.circular(10) 
              //         ),
              //         color: const Color.fromRGBO(255, 255, 255, 1),
              //         boxShadow: [
              //           BoxShadow(
              //             color: const Color.fromRGBO(178, 159, 159, 0.25),
              //             offset: Offset(0,4),
              //             blurRadius: 32,
              //             spreadRadius: 4
              //           )
              //         ]
              //       ),
              //       child: Row(
              //         mainAxisSize: MainAxisSize.max,
              //         children: [
              //           SizedBox(width: 12.w,),
              //           SizedBox(
              //             width: 47.h,
              //             height: 47.h,
              //             child: Image.asset("assets/imgs/face_mask.png")
              //           ),
              //           SizedBox(width: 18.w,),
              //           Text(
              //             "Protecting yourself",
              //             style: TextStyle(
              //               fontFamily: 'Poppins',
              //               fontWeight: FontWeight.w500,
              //               fontSize: 18.sp,
              //               color: Color.fromRGBO(36, 52, 99, 1)
              //             ),
              //           ),
              //         ],
              //       ),
              //     ),
              //   ),
              // ),
            ],
          ),
        ),
      ),
    );
  }
}