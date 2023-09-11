import 'package:bisa_app/models/vaccination_res.dart';
import 'package:bisa_app/ui/vaccination/loc_details.dart';
// import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
// import 'package:flutter_html/style.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/right_to_left_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';

class VaccineLocation extends StatefulWidget {
  const VaccineLocation({Key? key, required this.districts}) : super(key: key);
  final List<Districtlist> districts;

  @override
  VaccineLocationState createState() => VaccineLocationState();
}

class VaccineLocationState extends State<VaccineLocation> {
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
          'Find a vaccination center',
          style: TextStyle(
            fontFamily: 'Lato',
            fontWeight: FontWeight.w700,
            fontSize: 25.sp,
            color: const Color.fromRGBO(36, 52, 99, 0.98)
          ),
        ),
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: const EdgeInsets.all(22.0),
          child: GridView.count(
            physics: const ScrollPhysics(),
            clipBehavior: Clip.none,
            crossAxisSpacing: 20,
            mainAxisSpacing: 15,
            shrinkWrap: true,
            crossAxisCount: 2,
            children: widget.districts.map((e){
              return InkWell(
                onTap: (){
                  Navigator.push(
                    context,
                    PageAnimationTransition(
                      pageAnimationType: RightToLeftTransition(),
                      page: LocDetails(centers: e.centerlist!,name: e.name!,)
                    )
                  );
                },
                child: Container(
                  decoration: const BoxDecoration(
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(10),
                      topRight:Radius.circular(10),
                      bottomLeft: Radius.circular(10),
                      bottomRight: Radius.circular(10) 
                    ),
                    gradient: LinearGradient(
                      colors: [Color.fromRGBO(162, 197, 88, 1), Color.fromRGBO(7, 129, 41, 0.35)],
                    ),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(1.0),
                    child: Container(
                      height: 110.h,
                      width: (1.sw - 34)/2 - 20,
                      alignment: Alignment.center,
                      decoration: const BoxDecoration(
                        borderRadius: BorderRadius.only(
                          topLeft: Radius.circular(10),
                          topRight:Radius.circular(10),
                          bottomLeft: Radius.circular(10),
                          bottomRight: Radius.circular(10) 
                        ),
                        color: Color.fromRGBO(255, 255, 255, 1),
                        boxShadow: [
                          BoxShadow(
                            color: Color.fromRGBO(195, 195, 195, 0.83),
                            offset: Offset(0,11),
                            blurRadius: 20,
                            spreadRadius: 0
                          )
                        ]
                      ),
                      child: Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Column(
                          mainAxisSize: MainAxisSize.max,
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            SizedBox(height: 12.h,),
                            SizedBox(
                              width: 20.h,
                              height: 20.h,
                              child: Image.asset("assets/imgs/location.png")
                            ),
                            SizedBox(height: 5.h,),
                            Text(
                              "${e.name}",
                              style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w700,
                                fontSize: 20.sp,
                                color: const Color.fromRGBO(36, 52, 99, 1)
                              ),
                            ),
                            SizedBox(height: 5.h,),
                            Text(
                              "${e.centerlist?.length} centers found",
                              style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w500,
                                fontSize: 18.sp,
                                color: const Color.fromRGBO(103, 98, 98, 1)
                              ),
                            ),
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