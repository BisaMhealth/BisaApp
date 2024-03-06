

import 'package:flutter/material.dart';

class Intro_Bloodtype extends StatefulWidget {
  const Intro_Bloodtype({super.key});

  @override
  State<Intro_Bloodtype> createState() => _Intro_BloodtypeState();
}

class _Intro_BloodtypeState extends State<Intro_Bloodtype> {


  int Selectedindex = 0;
  List bloodgroups = ["A","B","AB","O"];
  int SelectedRhesus = 0;
  List RhesusFactors = ["+","-"];


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 230, 229, 229),
       body: Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 20
          ),
        child: Column(
          children: [
            Padding(
              padding: EdgeInsets.only(
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
                          color: const Color.fromRGBO(58, 75, 149, 1),
                          width: 1
                        )
                      ),
                      child: const Icon(
                        Icons.arrow_back_ios_outlined,
                        color: Color.fromRGBO(58, 75, 149, 1),
                      ),
                    ),
                   const SizedBox(width: 20,),
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
                  "What is your official blood type?",
                   style: const TextStyle(
                        fontFamily: "Sofia Pro",
                        fontSize: 24,
                        // fontWeight: FontWeight.w500,
                        color: Color.fromRGBO(58, 75, 149, 1),
                        height: 1.0
                        ),
                  ),
                const  SizedBox(height: 10,),
                Container(
                  height: 56,
                  padding: EdgeInsets.zero,
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(10),
                    color: Colors.white,
                    ),
                  child: ListView.builder(
                    // padding: EdgeInsets.zero,
                    scrollDirection: Axis.horizontal,
                    itemCount: 4,
                    itemBuilder: (context,index) =>  GestureDetector(
                      onTap: (){
                        setState(() {
                          Selectedindex = index;
                        });
                      },
                      child: Container(
                          padding: const EdgeInsets.symmetric(
                            vertical: 10,
                            horizontal: 30
                          ),
                          decoration: BoxDecoration(
                            color:  Selectedindex==index ?Color.fromRGBO(58, 75, 149, 1) :Colors.white,
                            borderRadius: BorderRadius.circular(10),
                            border: Border.all(
                              color: Selectedindex==index ? Color.fromARGB(255, 230, 229, 229):Colors.white,
                              width: Selectedindex==index? 5 : 1
                            )
                          ),
                          child: Column(
                            children:  [
                              Text(
                                bloodgroups[index],
                                style: TextStyle(
                                  color: Selectedindex ==index ? Colors.white : Color.fromRGBO(58, 75, 149, 1),
                                  fontSize: 18,
                                  fontFamily: "Sofia Pro",
                                  fontWeight: FontWeight.w500
                                ),
                              ),
                            ],
                          ),
                        ),
                    ),
                    ),
                ),
                SizedBox(
                  height: 20,
                ),
                 RichText(text: TextSpan(
                  children: [
                    TextSpan(
                      text: bloodgroups[Selectedindex],
                      style: TextStyle(
                        color: Color.fromRGBO(58, 75, 149, 1),
                        fontSize: 160,
                        fontFamily: "Sofia Pro",
                        fontWeight: FontWeight.w500
                      )
                    ),
                    WidgetSpan(
                      child: Transform.translate(
                        offset: const Offset(0.0, -10.0),
                        child: Text(
                          RhesusFactors[SelectedRhesus],
                          style: const TextStyle(
                            fontSize: 100,
                            fontFamily: "Sofia Pro",
                        fontWeight: FontWeight.w500,
                        color:  Color(0xFFB5E255)
                            ),
                        ),
                      ),
                    ),
                  ]
                 ),
                 ),
                const SizedBox(height: 20,),
                Row(
                  children: [
                    GestureDetector(
                      onTap: (){
                        setState(() {
                          SelectedRhesus = 0;
                        });
                      },
                      child: Container(
                        height: 60,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(10),
                          color: SelectedRhesus == 0 ? const Color(0xFFB5E255):Colors.grey
                        ),
                        padding: const EdgeInsets.symmetric(
                          horizontal: 20,
                          vertical: 10
                        ),
                        child: const Text(
                          "+",
                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 16,
                          ),
                        ),
                      ),
                    )
                  ],
                )
          ],
        ),
      ),
      bottomNavigationBar: GestureDetector(
        onTap: (){},
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