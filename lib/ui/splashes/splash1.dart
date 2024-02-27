

import 'package:flutter/material.dart';

class Splash1 extends StatefulWidget {
  const Splash1({super.key});

  @override
  State<Splash1> createState() => _Splash1State();
}

class _Splash1State extends State<Splash1> {
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
                        value: 0.2,
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
                  "Professional medical experts at your service",
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
                  "Achieve your wellness goals with our AI-powered platform to your unique needs",
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
            height: MediaQuery.of(context).size.height - 205,
            decoration: const BoxDecoration(
              image: DecorationImage(
                image: AssetImage('assets/imgs/splash1.png'),
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
          onTap: (){},
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
              color: Color.fromARGB(255, 24, 44, 116),
            ),
          ),
        ),
      ),
    );
  }
}