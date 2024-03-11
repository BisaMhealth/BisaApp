
import 'package:bisa_app/animation/PageTransition.dart';
import 'package:bisa_app/ui/splashes/splash4.dart';
import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';

class Splash3 extends StatefulWidget {
  const Splash3({super.key});

  @override
  State<Splash3> createState() => _Splash3State();
}

class _Splash3State extends State<Splash3> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: [
          Container(
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
                      width: MediaQuery.of(context).size.width * 0.5,
                      child: LinearProgressIndicator(
                        value: 0.4,
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
                  "All your medications at one place",
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
                  "Easily track yoour medication and diet with the power of AI",
                   style: const TextStyle(
                        fontFamily: "Sofia Pro",
                        fontSize: 14,
                        // fontWeight: FontWeight.w500,
                        color: Color.fromRGBO(58, 75, 149, 1),
                        height: 1.0
                        ),
                  ),
              ],
            ),
          ),
          Container(
            width: MediaQuery.of(context).size.width,
            height: (MediaQuery.of(context).size.height *0.8741) - 102,
            decoration: const BoxDecoration(
              image: DecorationImage(
                image: AssetImage('assets/imgs/splash3.png'),
                fit: BoxFit.fill,
              ),
            ),
          ),
        ],
      ),
      floatingActionButton: Padding(
        padding: const EdgeInsets.symmetric(
          vertical: 30,
          horizontal: 20
        ),
        child: GestureDetector(
          onTap: (){
           // PageAnimationTransition(page: page, pageAnimationType: pageAnimationType)
           PagetransAnimate(context, PageTransitionType.rightToLeft, Splash4());
          //    Navigator.push(
          //   context,
          //   MaterialPageRoute<void>(
            
          //   builder: (BuildContext context) => Splash2(),
          //   ),
          // );
          },
          child: Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(15),
              boxShadow: const [
                BoxShadow(
                  color: Color.fromRGBO(0, 0, 0, 0.1),
                  blurRadius: 10,
                  offset: Offset(0, 5),
                ),
              ],
            ),
            child: const Icon(
              Icons.arrow_forward_ios_outlined,
              color: Colors.yellowAccent,
            ),
          ),
        ),
      ),
    );
  }
}