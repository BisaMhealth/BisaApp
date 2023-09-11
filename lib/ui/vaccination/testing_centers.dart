import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/models/testing_res.dart';
import 'package:bisa_app/ui/vaccination/testing_details_popup.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class TestingCenters extends StatefulWidget {
  const TestingCenters({Key? key,required this.centers}) : super(key: key);
  final List<Testingcenters> centers;
  @override
  State<TestingCenters> createState() => _TestingCentersState();
}

class _TestingCentersState extends State<TestingCenters> {
  int? _selectedValue = 0;

  @override
  Widget build(BuildContext context) {
    // widget.centers.sort((a,b) => a.standardPrice!.compareTo(b.standardPrice!));
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
        title: Row(
          children: [
            Flexible(
              child: Padding(
                padding: const EdgeInsets.only(right:8.0),
                child: Text(
                  'Testing Centers',
                  style: TextStyle(
                    fontFamily: 'SofiaPro',
                    fontWeight: FontWeight.w700,
                    fontSize: 25.sp,
                    color: const Color.fromRGBO(36, 52, 99, 0.98)
                  ),
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ),
            Container(
              width: 12.h,
              height: 12.h,
              decoration: const BoxDecoration(
                shape: BoxShape.circle,
                color: Color.fromRGBO(56, 169, 101, 1)
              ),
            )
          ],
        ),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.only(bottom:22.0,right: 22.0,left: 22.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text('Sort By:',
                style: TextStyle(
                  color: const Color.fromRGBO(40, 56, 102, 1),
                  fontFamily: 'Lato',
                  fontWeight: FontWeight.w600,
                  fontSize: 16.sp
                ),
              ),
              const SizedBox(height: 4,),
              CupertinoSlidingSegmentedControl<int>(
                backgroundColor:  const Color.fromRGBO(207, 237, 245, 0.44),
                thumbColor: CupertinoColors.white,
                groupValue: _selectedValue,
                children: {
                  0: Container(
                    width: (1.sw - 44)/2,
                    padding: const EdgeInsets.all(8),
                    child: Center(
                      child: Text('Name',
                        style: TextStyle(
                          fontFamily: 'Lato',
                          fontSize: 16.sp,
                          fontWeight: FontWeight.w500,
                          color: const Color.fromRGBO(33, 72, 107, 1)
                        ),
                      )
                    ),
                  ),
                  1: Container(
                    width: (1.sw - 44)/2,
                    padding: const EdgeInsets.all(8),
                    child: Center(
                      child: Text('Price',
                        style: TextStyle(
                          fontFamily: 'Lato',
                          fontSize: 16.sp,
                          fontWeight: FontWeight.w500,
                          color: const Color.fromRGBO(33, 72, 107, 1)
                        ),
                      )),
                  ),
                }, 
                onValueChanged: (value){
                  if (kDebugMode) {
                    print(value);
                  }
                   
                  if(value == 0){
                    if (kDebugMode) {
                      print("o for");
                    }
                    setState(() {
                      _selectedValue =value;
                      widget.centers.sort((a,b)=>a.name!.compareTo(b.name!));
                    });
                  }else{
                    setState(() {
                      _selectedValue =value;
                      widget.centers.sort((a,b)=>a.standardPrice!.compareTo(b.standardPrice!));
                    });
                  }
                  // setState(() {
                  //   _selectedValue = value;
                  // });
                }
              ),
              FadeAnimation(1.2,-30,0,Column(
                children: widget.centers.map((e){
                  return
                    Padding(
                      padding: const EdgeInsets.symmetric(vertical:10),
                      child: Container(
                        decoration: const BoxDecoration(
                          borderRadius: BorderRadius.only(
                            topLeft: Radius.circular(10),
                            topRight:Radius.circular(10),
                            bottomLeft: Radius.circular(10),
                            bottomRight: Radius.circular(10) 
                          ),
                          gradient: LinearGradient(
                            colors: [Color.fromRGBO(38, 137, 228, 1), Color.fromRGBO(39, 191, 201, 0.38)],
                          ),
                        ),
                        child: Padding(
                          padding: const EdgeInsets.all(1.0),
                          child: Container(
                            width: (1.sw - 44),
                            height: e.name!.length > 25? 175.h: 160.h,
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(10),
                              boxShadow: const [
                                BoxShadow(
                                  offset: Offset(0,11),
                                  blurRadius: 20,
                                  spreadRadius: 0,
                                  color: Color.fromRGBO(195, 195, 195, 0.83)
                                )
                              ]
                            ),
                            child: Padding(
                              padding: EdgeInsets.only(left:15.h),
                              child: Column(
                                children: [
                                  SizedBox(height: 20.h,),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.start,
                                    mainAxisSize: MainAxisSize.max,
                                    children: [
                                      SizedBox(width:15.h,height:15.h,child: Image.asset('assets/imgs/location.png')),
                                      SizedBox(width: 8.h,),
                                      Expanded(
                                        child: Text(
                                          "${e.name}",
                                          style: TextStyle(
                                            fontFamily: 'SofiaPro',
                                            fontWeight: FontWeight.w900,
                                            fontSize: 18.sp,
                                            color: const Color.fromRGBO(36, 52, 99, 1)
                                          ),
                                          maxLines: 2,
                                          overflow: TextOverflow.ellipsis,
                                        ),
                                      ),
                                      Padding(
                                        padding: const EdgeInsets.only(right:10.0),
                                        child: Text("GHS ${e.standardPrice}",
                                          style: TextStyle(
                                            fontFamily: 'SofiaPro',
                                            fontWeight: FontWeight.w900,
                                            fontSize: 25.sp,
                                            color: const Color.fromRGBO(36, 52, 99, 1)
                                          ),
                                        ),
                                      )
                                    ],
                                  ),
                                  SizedBox(height: 10.h,),
                                  Row(
                                    children: [
                                      SizedBox(width:15.h,height:15.h,child: Image.asset('assets/imgs/clock.png')),
                                      SizedBox(width: 8.h,),
                                      Text(
                                        "Opening Times",
                                        style: TextStyle(
                                          fontFamily: 'SofiaPro',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 13.sp,
                                          color: const Color.fromRGBO(36, 52, 99, 1)
                                        ),
                                      ),
                                    ],
                                  ),
                                  SizedBox(height: 8.h,),
                                  Align(
                                    alignment: Alignment.centerLeft,
                                    child: Padding(
                                      padding: EdgeInsets.only(left:23.h),
                                      child: Text(
                                        "${e.workingHours}",
                                        style: TextStyle(
                                          fontFamily: 'SofiaPro',
                                          fontWeight: FontWeight.w600,
                                          fontSize: 15.sp,
                                          color: const Color.fromRGBO(155, 156, 159, 1)
                                        ),
                                      ),
                                    ),
                                  ),
                                  SizedBox(height: 2.h,),
                                  Row(
                                    mainAxisSize: MainAxisSize.max,
                                    mainAxisAlignment: MainAxisAlignment.end,
                                    children: [
                                      // Container(
                                      //   width: 113.h,
                                      //   height: 36.h,
                                      //   decoration: BoxDecoration(
                                      //     color: Color.fromRGBO(250, 250, 250, 1),
                                      //     borderRadius: BorderRadius.circular(5),
                                      //     boxShadow: [
                                      //       BoxShadow(
                                      //         offset: Offset(0,5),
                                      //         color: Color.fromRGBO(161, 161, 161, 0.25),
                                      //         blurRadius: 11
                                      //       )
                                      //     ]
                                      //   ),
                                      //   child: Center(
                                      //     child: Text(
                                      //       "View in maps",
                                      //       style: TextStyle(
                                      //         fontFamily: 'Lato',
                                      //         fontWeight: FontWeight.w400,
                                      //         fontSize: 15.sp,
                                      //         color: Color.fromRGBO(0, 0, 0, 1)
                                      //       ),
                                      //     ),
                                      //   ),
                                      // ),
                                      InkWell(
                                        onTap: (){
                                          showDetailsPopUp(e);
                                        },
                                        child: Container(
                                          width: 113.h,
                                          height: 36.h,
                                          decoration: BoxDecoration(
                                            color: const Color.fromRGBO(0, 44, 85, 0.87),
                                            borderRadius: BorderRadius.circular(5),
                                            boxShadow: const [
                                              BoxShadow(
                                                offset: Offset(0,5),
                                                color: Color.fromRGBO(161, 161, 161, 0.25),
                                                blurRadius: 11
                                              )
                                            ]
                                          ),
                                          child: Center(
                                            child: Text(
                                              "View details",
                                              style: TextStyle(
                                                fontFamily: 'Lato',
                                                fontWeight: FontWeight.w400,
                                                fontSize: 15.sp,
                                                color: Colors.white
                                              ),
                                            ),
                                          ),
                                        ),
                                      ),
                                      const SizedBox(width: 10,)
                                    ],
                                  )
                                ],
                              ),
                            ),
                          ),
                        ),
                      ),
                    );
                }).toList(),
              ),)
            ],
          ),
        ),
      ),
    );
  }

  showDetailsPopUp(Testingcenters center) {
    return showDialog(
      barrierDismissible: true,
      context: context,
      builder: (BuildContext context) {
        return DetailsPopUp(center: center);
      }
    );
  }
}