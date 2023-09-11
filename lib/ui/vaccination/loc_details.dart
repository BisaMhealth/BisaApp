import 'package:bisa_app/models/vaccination_res.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class LocDetails extends StatefulWidget {
  const LocDetails({Key? key, required this.centers, required this.name}) : super(key: key);
  final  List<Centerlist> centers;
  final String name;

  @override
  LocDetailsState createState() => LocDetailsState();
}

class LocDetailsState extends State<LocDetails> {
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
        title: Row(
          children: [
            Flexible(
              child: Padding(
                padding: const EdgeInsets.only(right:8.0),
                child: Text(
                  widget.name,
                  style: TextStyle(
                    fontFamily: 'Lato',
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
          padding: const EdgeInsets.all(22.0),
          child: Column(
            children: widget.centers.map((e){
              return Padding(
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
                      height: e.name!.length > 25? 165.h: 142.h,
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
                              children: [
                                SizedBox(width:20.h,height:20.h,child: Image.asset('assets/imgs/location.png')),
                                SizedBox(width: 8.h,),
                                Flexible(
                                  child: Text(
                                    "${e.name}",
                                    style: TextStyle(
                                      fontFamily: 'Lato',
                                      fontWeight: FontWeight.w700,
                                      fontSize: 22.sp,
                                      color: const Color.fromRGBO(36, 52, 99, 1)
                                    ),
                                    maxLines: 2,
                                    overflow: TextOverflow.ellipsis,
                                  ),
                                ),
                              ],
                            ),
                            SizedBox(height: 8.h,),
                            Row(
                              children: [
                                SizedBox(width:15.h,height:15.h,child: Image.asset('assets/imgs/clock.png')),
                                SizedBox(width: 8.h,),
                                Text(
                                  "Opening Times",
                                  style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w700,
                                    fontSize: 15.sp,
                                    color: const Color.fromRGBO(36, 52, 99, 1)
                                  ),
                                ),
                              ],
                            ),
                            SizedBox(height: 5.h,),
                            Align(
                              alignment: Alignment.centerLeft,
                              child: Padding(
                                padding: EdgeInsets.only(left:20.h),
                                child: Text(
                                  "8:00 AM to 4:00 PM",
                                  style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w500,
                                    fontSize: 15.sp,
                                    color: const Color.fromRGBO(155, 156, 159, 1)
                                  ),
                                ),
                              ),
                            ),
                            // SizedBox(height: 12.h,),
                            // Container(
                            //   decoration: BoxDecoration(
                            //     borderRadius: BorderRadius.circular(50),
                            //     gradient: LinearGradient(
                            //       colors: [Color.fromRGBO(0, 103, 219, 1), Color.fromRGBO(0, 103, 219, 0.6)],
                            //     ),
                            //   ),
                            //   child: Padding(
                            //     padding: const EdgeInsets.all(1.0),
                            //     child: Container(
                            //       width: 202.h,
                            //       height: 36.h,
                            //       decoration: BoxDecoration(
                            //         color: Color.fromRGBO(250, 250, 250, 1),
                            //         borderRadius: BorderRadius.circular(50),
                            //         boxShadow: [
                            //           BoxShadow(
                            //             offset: Offset(0,4),
                            //             color: Color.fromRGBO(0, 0, 0, 0.25),
                            //             blurRadius: 4
                            //           )
                            //         ]
                            //       ),
                            //       child: Center(
                            //         child: Text(
                            //           "See Location",
                            //           style: TextStyle(
                            //             fontFamily: 'Lato',
                            //             fontWeight: FontWeight.w700,
                            //             fontSize: 15.sp,
                            //             color: Color.fromRGBO(0, 0, 0, 1)
                            //           ),
                            //         ),
                            //       ),
                            //     ),
                            //   ),
                            // )
                          ],
                        ),
                      ),
                    ),
                  ),
                ),
              );
            }).toList(),
          ),
        ),
      ),
    );
  }
}