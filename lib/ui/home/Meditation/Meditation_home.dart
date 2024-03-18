

import 'dart:math';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/ui/home/Meditation/Meditating_screen.dart';
import 'package:bisa_app/ui/home/Meditation/Meditation_card.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:page_animation_transition/animations/fade_animation_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:waterfall_flow/waterfall_flow.dart';

class MeditationHome extends StatefulWidget {
  const MeditationHome({super.key});

  @override
  State<MeditationHome> createState() => _MeditationHomeState();
}

class _MeditationHomeState extends State<MeditationHome> {

  Random random = Random();
  List images = ['assets/imgs/focus.png','assets/imgs/happiness.png','assets/imgs/growth.png','assets/imgs/performance.png','assets/imgs/anexiety.png','assets/imgs/stress.png'];
  List titles = ['Focus','Happiness','Personal\nGrowth','Performance\nBoost','Relieve\n Anxiety','Relieve\nStress'];
  List Colrs = [Color.fromARGB(255, 201, 138, 214),
                Color.fromARGB(255, 233, 147, 26),
                Colors.transparent,
                Color.fromARGB(255, 244, 85, 57).withOpacity(0.8),
                Color.fromARGB(255, 245, 190, 39).withOpacity(0.8),
                Colors.transparent,
                   ];


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        //toolbarHeight: 20,
        leading: GestureDetector(
          onTap: (){
            Navigator.pop(context);
          },
          child: Container(
                        padding: const EdgeInsets.all(10),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(10),
                        ),
                        child: const Icon(
                          Icons.arrow_back_ios_outlined,
                          color: Color.fromRGBO(58, 75, 149, 1),
                        ),
                      ),
        ),
        backgroundColor: Colors.white,
        elevation: 0.0,
      ),
      body: Container(
        padding: const EdgeInsets.symmetric(horizontal: 10,vertical: 2),
        color: Colors.white,
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
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
               const SizedBox(height: 20,),
               FadeAnimation(
                1.2,
                0,
                30, 
                Text(
                  "Choose an atmosphere",
                  style: TextStyle(
                 fontFamily: 'Poppins',
                 fontSize: 14.sp,
                 color:  Colors.black,
                 ),
                 textAlign: TextAlign.left,
               ),
               ),
               const SizedBox(height: 20,),
               WaterfallFlow.builder(
      shrinkWrap: true,
    //  physics: const NeverScrollableScrollPhysics(),
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
        return InkWell(
          onTap: (){
            Navigator.push(
                      context,
                      PageAnimationTransition(
                        pageAnimationType:
                            FadeAnimationTransition(),
                        page: Meditating_Screen(
                          index: index,
                          title: titles[index],
                          ),
                      ),
                    );
          },
          child: Meditation_Card(
            title: titles[index],
            image: images[index],
            color: Colrs[index],
          ),
        );
      },
    )
            ],
          ),
        ),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
      floatingActionButton: GestureDetector(
        onTap: (){
          var index = random.nextInt(5);
          Navigator.push(
                      context,
                      PageAnimationTransition(
                        pageAnimationType:
                            FadeAnimationTransition(),
                        page: Meditating_Screen(
                          index: index,
                          title: titles[index],
                        ),
                      ),
                    );
        },
        child: Container(
          height: 50,
          width: 200,
          margin: const EdgeInsets.only(bottom: 10),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(30),
            boxShadow: [
              BoxShadow(
                color: Color(0xFFB5E255),
                spreadRadius: 1,
                blurRadius: 2,
                offset: const Offset(0, 2), // changes position of shadow
              ),
            ],
          ),
          child:const Center(
            child: Text(
              "Surprise Me",
              style: TextStyle(
              color: Colors.black,
              fontSize: 16,
              fontWeight: FontWeight.w600
            ),
            textAlign: TextAlign.center,
            ),
          )
        ),
      )
    );
  }
}