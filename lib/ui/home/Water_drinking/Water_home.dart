
import 'package:bisa_app/animation/PageTransition.dart';
import 'package:bisa_app/ui/home/Water_drinking/Water_dash.dart';
import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';

class WaterHome extends StatefulWidget {
  const WaterHome({super.key});

  @override
  State<WaterHome> createState() => _WaterHomeState();
}

class _WaterHomeState extends State<WaterHome> {
  @override
  Widget build(BuildContext context) {
    return Container(
      decoration:const BoxDecoration(
        gradient: RadialGradient(
          colors: [
            Colors.lightBlueAccent,
            Colors.lightBlueAccent,
             Color.fromARGB(255, 230, 249, 249)
            
          ]
          )
      ),
      child: Scaffold(
        //backgroundColor: const Color.fromARGB(255, 137, 211, 245),
       // backgroundColor: Color.fromARGB(255, 207, 229, 237),
       backgroundColor: Colors.transparent,
        // appBar: AppBar(
        //   backgroundColor: Colors.lightBlueAccent,
        //   elevation: 0.0,
        //   centerTitle: true,
        //   surfaceTintColor: Colors.transparent,
        //   leading:  GestureDetector(
        //     onTap: (){
        //       Navigator.pop(context);
        //     },
        //     child: Container(
        //                   padding: const EdgeInsets.all(10),
        //                   decoration: BoxDecoration(
        //                     color: Colors.transparent,
        //                     borderRadius: BorderRadius.circular(10),
        //                   ),
        //                   child: const Icon(
        //                     Icons.arrow_back_ios_outlined,
        //                     color: Colors.white,
        //                   ),
        //                 ),
        //   ),
        //   title: Text(
        //     'Hydration',
        //     style: TextStyle(
        //       color: Colors.white,
        //     ),
        //     ),
        // ),
        body: Container(
          padding: EdgeInsets.symmetric(
            vertical: 10
          ),
          child: Center(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                SizedBox(
                  height: 30,
                ),
                Container(
                child:  Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      GestureDetector(
            onTap: (){
              Navigator.pop(context);
            },
            child: Container(
                          padding: const EdgeInsets.all(10),
                          decoration: BoxDecoration(
                            color: Colors.transparent,
                            borderRadius: BorderRadius.circular(10),
                          ),
                          child: const Icon(
                            Icons.arrow_back_ios_outlined,
                            color: Colors.lightBlueAccent,
                          ),
                        ),
          ),
          ],
                  )
                ),
                SizedBox(
                  height: 20,
                ),
                Container(
                  child: const Text(
                    "Welcome to your \nhydration companion", 
                  style: TextStyle(
                    fontSize: 25,
                    fontWeight: FontWeight.bold,
                    color: Colors.lightBlueAccent,
                    shadows: [
                      Shadow(
                        color: Colors.white,
                        blurRadius: 4,
                        offset: Offset(3, 2)
                      )
                    ]
                  ),
                  textAlign: TextAlign.center,
                  ),
                ),
                Center(
                  child: Container(
                    margin: EdgeInsets.symmetric(
                      vertical: 200
                    ),
                    child: TextButton(
                      onPressed: (){
                        PagetransAnimate(context, PageTransitionType.fade, WaterDash());
                      }, 
                      child: Text(
                        "Let\'s get Hydrated",
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 20
                        ),
                        )),
                  ),
                )
              ],
            ),
          ),
        ),
        bottomNavigationBar: Container(
          //color: const Color.fromARGB(255, 85, 192, 242),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.only(
              topRight: Radius.circular(20)
            ),
            gradient: LinearGradient(
              colors: [
                Colors.lightBlue,
                 Colors.lightBlue,
                  Colors.lightBlue,
                Colors.lightBlueAccent,
                Colors.lightBlueAccent,
                Colors.lightBlueAccent,
                Colors.lightBlueAccent,
                Color.fromARGB(255, 230, 249, 249)
                //Colors.white
              ]
              )
          ),
          child: Container(
            height: 150,
            decoration: BoxDecoration(
              image: DecorationImage(
                image: AssetImage('assets/imgs/waves.png'),
                fit: BoxFit.cover
                )
            ),
            child: Text(""),
          ),
        ),
      ),
    );
  }
}