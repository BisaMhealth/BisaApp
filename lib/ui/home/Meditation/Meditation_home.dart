

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/ui/home/Meditation/Meditation_card.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:waterfall_flow/waterfall_flow.dart';

class MeditationHome extends StatefulWidget {
  const MeditationHome({super.key});

  @override
  State<MeditationHome> createState() => _MeditationHomeState();
}

class _MeditationHomeState extends State<MeditationHome> {

  List images = ['assets/imgs/focus.png','','',''];
  List titles = ['Focus','','',''];


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        child: SingleChildScrollView(
          child: Column(
            children: [
              SizedBox(height: 50,),
               Center(
                 child: FadeAnimation(
                        1.2,
                        0,
                        30,
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.center,
                          children: [
                            Padding(
                              padding: const EdgeInsets.all(8.0),
                              child: Text(
                                'Meditate',
                                style: TextStyle(
                                  fontFamily: 'Poppins',
                                  fontWeight: FontWeight.w600,
                                  fontSize: 22.sp,
                                  color: const Color.fromRGBO(99, 93, 93, 0.98),
                                ),
                                textAlign: TextAlign.center,
                              ),
                            ),
                            Text(
                              "Ease your worries, be present in the moment.",
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 12.sp,
                                color: const Color.fromRGBO(99, 93, 93, 0.98),
                              ),
                              textAlign: TextAlign.center,
                              )
                          ],
                        ),
                      ),
               ),
               SizedBox(height: 20,),
               WaterfallFlow.builder(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      padding: const EdgeInsets.symmetric(
        horizontal: 10,
        vertical: 10,
      ),
      gridDelegate: const SliverWaterfallFlowDelegateWithFixedCrossAxisCount(
        crossAxisCount: 2,
        crossAxisSpacing: 5.0,
        mainAxisSpacing: 15.0,
      ),
      itemCount: images.length,
      itemBuilder: (BuildContext context, int index) {
        return Meditation_Card(
          title: titles[index],
          image: images[0],
        );
      },
    )
            ],
          ),
        ),
      ),
    );
  }
}