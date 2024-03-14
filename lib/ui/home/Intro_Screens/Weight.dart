


import 'package:bisa_app/animation/PageTransition.dart';
import 'package:bisa_app/ui/home/Intro_Screens/DOB.dart';
import 'package:bisa_app/ui/login/login_page.dart';
import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';
import 'package:scrollable_positioned_list/scrollable_positioned_list.dart';

class Intro_Weight extends StatefulWidget {
  const Intro_Weight({super.key});

  @override
  State<Intro_Weight> createState() => _Intro_WeightState();
}

class _Intro_WeightState extends State<Intro_Weight> {


    final ItemScrollController itemScrollController = ItemScrollController();
final ScrollOffsetController scrollOffsetController = ScrollOffsetController();
final ItemPositionsListener itemPositionsListener = ItemPositionsListener.create();
final ScrollOffsetListener scrollOffsetListener = ScrollOffsetListener.create();
double weight= 50;
 //late LinearMarkerPointer pointer;

@override
  void initState() {
  
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
   
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 242, 242, 243),
       body: Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 20
          ),
        child: Column(
          children: [
            Container(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Padding(
                    padding: EdgeInsets.only(
                        top: MediaQuery.of(context).padding.top + 20,
                        bottom: 20,
                      ), 
                      child: Row(
                        children: [
                          Container(
                            padding: EdgeInsets.all(5),
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
                         const SizedBox(
                            width: 20,
                          ),
                           Container(
                            width: MediaQuery.of(context).size.width * 0.5,
                            child: LinearProgressIndicator(
                              value: 0.7,
                              valueColor: const AlwaysStoppedAnimation<Color>(Color.fromARGB(255, 24, 44, 116)),
                              backgroundColor: const Color.fromARGB(255, 24, 44, 116).withOpacity(0.1),
                            ),
                          ),
                         const Expanded(child: SizedBox()),
                          TextButton(
                            onPressed: (){
                              PagetransAnimate(context, PageTransitionType.rightToLeft, LoginPage());
                            }, 
                            child: const Text(
                              "Skip",
                              style: TextStyle(
                                color: Color.fromRGBO(58, 75, 149, 1),
                                fontFamily: "Sofia Pro",
                                fontSize: 18,
                                fontWeight: FontWeight.w500
                              )
                              )
                            )
                        ],
                      )
                      ),
                      Text(
                        "What is your Weight?",
                         style: const TextStyle(
                              fontFamily: "Sofia Pro",
                              fontSize: 24,
                              // fontWeight: FontWeight.w500,
                              color: Color.fromRGBO(58, 75, 149, 1),
                              height: 1.0
                              ),
                        ),
                        
                ],
              ),
            ),
            SizedBox(height: 20,),
            Container(
              padding: const EdgeInsets.symmetric(
                horizontal: 60,
                vertical: 20
              ),
              decoration: BoxDecoration(
                color:  Colors.white,
                borderRadius: BorderRadius.circular(10),
                boxShadow: [
                  BoxShadow(
                    color: Colors.grey,
                    spreadRadius: 1,
                    blurRadius: 2,
                    offset: const Offset(0, 3), // changes position of shadow
                  ),
                ],
              ),
              child: Text("Kg"),
            ),
            SizedBox(height: 30,),
            Text(
              "$weight Kg",
              style: const TextStyle(
                fontSize: 40,
                fontFamily: "Sofia Pro",
                color: Color.fromRGBO(58, 75, 149, 1),
                fontWeight: FontWeight.w500
                )
              ),
            SizedBox(height: 20,),
            Center(
              child: Container(
                height: 40,
                width: 40,
                decoration: BoxDecoration(
                  image: DecorationImage(
                    image: AssetImage('assets/imgs/triangle.png'),
                    fit: BoxFit.fill
                    )
                ),
          
              ),
            ),
            
            Stack(
              children: [
                Center(
                  child: Container(
                    height: 250,
                    // child: Slider(
                    //   min: 0.0,
                    //   max: 100.0,
                    //   divisions: 100,
                
                    //   value: weight, onChanged: (value){
                    //     setState(() {
                    //       weight=value;
                    //     });
                    //   }
                    //   )
                    // child: SfLinearGauge(
                      
                    //   // barPointers: [
                    //   //   LinearBarPointer(value: 50)
                    //   //   ],
                    //   markerPointers: [
                    //               LinearShapePointer(
                    //                 width: 20,
                    //                 height: 20,
                    //       value: weight,
                    //       onChangeStart: (value){},
                    //       onChangeEnd: (value){
                    //         setState(() {
                    //           weight = value;
                    //         });
                    //       },
                    //     ),
                    //   ],
                    // ),
                    
                    child: NotificationListener(
                      onNotification: (notification){
                        if(notification is ScrollEndNotification){
                        itemPositionsListener.itemPositions.addListener(() {
                          final positions = itemPositionsListener.itemPositions.value;
                        positions.forEach((element) {
                          if(element.itemLeadingEdge>=0.5 && element.itemLeadingEdge<=0.55){
                            weight = element.index.toDouble();
                            setState(() {
                              
                            });
                          }
                        });
                    
                        });
                        }
                        return true;
                      },
                      child: ScrollablePositionedList.builder(
                              scrollDirection: Axis.horizontal,
                                    itemCount: 500,
                                    itemBuilder: (context, index) => GestureDetector(
                                      onTap: (){
                                        itemScrollController.scrollTo(
                                       // alignment: 250,
                                        index: index,
                                        duration: Duration(seconds: 2),
                                        curve: Curves.easeInOutCubic
                                        );
                                      },
                                      child: index% 5 == 0 ? Column(
                                        mainAxisAlignment: MainAxisAlignment.center,
                                        children: [
                                          Container(
                                            margin: const EdgeInsets.symmetric(
                                              horizontal: 20,
                                              //vertical: 40
                                            ),
                                            height: 180,
                                            width: 5,
                                            decoration: BoxDecoration(
                                              color: Colors.black
                                            ),
                                            child: Text(""),
                                          ),
                                          Text("$index")
                                        ],
                                      ) : Container(
                                        margin: EdgeInsets.symmetric(
                                          horizontal: 10,
                                          vertical: 60
                                        ),
                                        height: 30,
                                        width: 2,
                                        decoration: BoxDecoration(
                                          color: Colors.grey
                                        ),
                                      )
                                    ),
                          
                                    itemScrollController: itemScrollController,
                                    scrollOffsetController: scrollOffsetController,
                                    itemPositionsListener: itemPositionsListener,
                                    scrollOffsetListener: scrollOffsetListener,
                                  ),
                    ),
                  )
                  ),
                  Center(
                    child: Container(
                      height: 250,
                      width: 40,
                      decoration: BoxDecoration(
                        image: DecorationImage(
                          image: AssetImage('assets/imgs/weight.png'),
                          fit: BoxFit.cover
                        )
                      ),
                    ),
                  ),
              ],
            ),
              Center(
              child: Transform.rotate(
                angle: 3.14,
                child: Container(
                  height: 40,
                  width: 40,
                  decoration: BoxDecoration(
                    image: DecorationImage(
                      image: AssetImage('assets/imgs/triangle.png'),
                      fit: BoxFit.fill
                      )
                  ),
                          
                ),
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: GestureDetector(
        onTap: (){
           PagetransAnimate(context, PageTransitionType.rightToLeft, Intro_DOB());
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