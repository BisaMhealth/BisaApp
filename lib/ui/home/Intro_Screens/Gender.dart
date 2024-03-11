

import 'package:bisa_app/animation/PageTransition.dart';
import 'package:bisa_app/ui/home/Intro_Screens/Weight.dart';
import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';
import 'package:scrollable_positioned_list/scrollable_positioned_list.dart';

class Intro_Gender extends StatefulWidget {
  const Intro_Gender({super.key});

  @override
  State<Intro_Gender> createState() => _Intro_GenderState();
}

class _Intro_GenderState extends State<Intro_Gender> {


  final ItemScrollController itemScrollController = ItemScrollController();
final ScrollOffsetController scrollOffsetController = ScrollOffsetController();
final ItemPositionsListener itemPositionsListener = ItemPositionsListener.create();
final ScrollOffsetListener scrollOffsetListener = ScrollOffsetListener.create();
bool checkvalue = false;


  @override
  Widget build(BuildContext context) {
    return Scaffold(

      body: Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 20
          ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(padding: EdgeInsets.only(
                  top: MediaQuery.of(context).padding.top + 20,
                  bottom: 20,
                ), 
                child: Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(5),
                      decoration: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.circular(10),
                        border: Border.all(
                          color: Color.fromRGBO(58, 75, 149, 1),
                          width: 1
                        )
                      ),
                      child: const Icon(
                        Icons.arrow_back_ios_outlined,
                        color: Color.fromRGBO(58, 75, 149, 1),
                      ),
                    ),
                    SizedBox(
                      width: 20,
                    ),
                    Container(
                      width: MediaQuery.of(context).size.width * 0.5,
                      child: LinearProgressIndicator(
                        value: 0.6,
                        valueColor: AlwaysStoppedAnimation<Color>(Color.fromARGB(255, 24, 44, 116)),
                        backgroundColor: Color.fromARGB(255, 24, 44, 116).withOpacity(0.1),
                      ),
                    ),
                   const Expanded(child: SizedBox()),
                    TextButton(onPressed: (){}, child: Text("Skip"))
                  ],
                )
                ),
                Text(
                  "What is your gender?",
                   style: const TextStyle(
                        fontFamily: "Sofia Pro",
                        fontSize: 24,
                        // fontWeight: FontWeight.w500,
                        color: Color.fromRGBO(58, 75, 149, 1),
                        height: 1.0
                        ),
                  ),
                  SizedBox(height: 5,),
                  Text(
                  "Please select your gender for better personalized healthcare experience ",
                   style: const TextStyle(
                        fontFamily: "Sofia Pro",
                        fontSize: 14,
                        // fontWeight: FontWeight.w500,
                        color: Color.fromRGBO(58, 75, 149, 1),
                        height: 1.0
                        ),
                  ),
                  SizedBox(
                    height: 60,
                  ),
                  Align(
                    alignment: Alignment.center,
                    child: Container(
                      height: 300,
                      child: ScrollablePositionedList.builder(
                        scrollDirection: Axis.horizontal,
                              itemCount: 2,
                              itemBuilder: (context, index) => GestureDetector(
                                onTap: (){
                                  itemScrollController.scrollTo(
                                 // alignment: 250,
                                  index: index,
                                  duration: Duration(seconds: 2),
                                  curve: Curves.easeInOutCubic);
                                  setState(() {
                                    checkvalue= !checkvalue;
                                  });
                                },
                                child: Container(
                                  margin: EdgeInsets.symmetric(
                                    horizontal: 10
                                  ),
                                  padding: EdgeInsets.only(
                                    left:20,
                                    top:20
                                  ),
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(20),
                                    color: index != 0 ? Color.fromRGBO(47, 72, 88, 1):
                                    //Color.fromARGB(255, 239, 124, 82).withOpacity(0.5)
                                    Color.fromARGB(255, 245, 163, 9).withOpacity(0.5).withBlue(80)
                                  ),
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Container(
                                        width: 250,
                                        child: Row(
                                          children: [
                                            Icon(
                                              index == 0? Icons.female : Icons.male,
                                              color: Colors.white,
                                              ),
                                            Text(
                                            index == 0? "Female" : "Male",
                                            style: TextStyle(
                                              color: Colors.white,
                                                            
                                            ),
                                              ),
                                              Expanded(child: SizedBox()),
                                               Checkbox(
                                                side: BorderSide(
                                                  color: Colors.white,
                                                ),
                                                                             activeColor: Color.fromARGB(255, 51, 211, 75),
                                                                             value:index!=1 ? checkvalue: !checkvalue, 
                                                                             onChanged: (check){
                                                                             setState(() {
                                        if(check!= null){
                                          checkvalue = !check;
                                        }
                                        //checkvalue = check!;
                                                                             });
                                            }
                                            ),
                                          ],
                                        ),
                                      ),
                                      Expanded(
                                        child: Container(
                                          width: 250,
                                          padding: EdgeInsets.all(10),
                                          decoration: BoxDecoration(
                                            
                                            image: DecorationImage(
                                              fit: BoxFit.cover,
                                              image: index == 0 ? const AssetImage('assets/imgs/female.png') : const AssetImage('assets/imgs/male.png')
                                              )
                                          ),
                                          child: Text("$index")
                                          ),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                    
                              itemScrollController: itemScrollController,
                              scrollOffsetController: scrollOffsetController,
                              itemPositionsListener: itemPositionsListener,
                              scrollOffsetListener: scrollOffsetListener,
                            ),
                    ),
                  ),
          ],
        ),
      ),
      bottomNavigationBar: GestureDetector(
        onTap: (){
          PagetransAnimate(context, PageTransitionType.rightToLeft, Intro_Weight());
        },
        child: Container(
          margin: const EdgeInsets.symmetric(
            horizontal: 20,
            vertical: 10
            ),
          padding: const EdgeInsets.symmetric(
            horizontal: 20,
            vertical: 20,
            ),
          decoration: BoxDecoration(
            color: const Color.fromRGBO(47, 72, 88, 1),
            borderRadius: BorderRadius.circular(10),
            boxShadow: [
              BoxShadow(
                color: Colors.grey.withOpacity(0.1),
                spreadRadius: 5,
                blurRadius: 7,
                offset: const Offset(0, -3), // changes position of shadow
              ),
            ],
          ),
          child: const Text(
            "Continue",
            style:  TextStyle(
              color: Colors.white,
              fontSize: 18,
              fontFamily: "Sofia Pro",
              fontWeight: FontWeight.w500
            ),
            textAlign: TextAlign.center,
            ),
        ),
      ),
    );
  }
}