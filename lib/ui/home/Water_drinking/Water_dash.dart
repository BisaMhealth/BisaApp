

import 'package:flutter/material.dart';

class WaterDash extends StatefulWidget {
  const WaterDash({super.key});

  @override
  State<WaterDash> createState() => _WaterDashState();
}

class _WaterDashState extends State<WaterDash> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //backgroundColor: Colors.lightBlueAccent,
      body: Container(
        color: Colors.lightBlueAccent,
        padding: EdgeInsets.symmetric(
          vertical: 10
        ),
        child: SingleChildScrollView(
          child: Column(
            children: [
              Container(
                padding: EdgeInsets.symmetric(
                  horizontal: 10
                ),
                width: MediaQuery.of(context).size.width,
                height: 100,
                decoration: BoxDecoration(
                  color: Colors.lightBlueAccent,
                  // borderRadius: BorderRadius.only(
                  //   bottomLeft: Radius.circular(30),
                  //   bottomRight: Radius.circular(30)
                  // )
                ),
                child: Row(
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
                            color: Colors.white,
                          ),
                        ),
          ),
                  ],
                ),
              ),
              Container(
                width: MediaQuery.of(context).size.width,
                height: MediaQuery.of(context).size.height - 100,
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(50),
                    topRight: Radius.circular(50)
                  )
                ),
                child: Padding(
                  padding: EdgeInsets.symmetric(
                    horizontal: 10,
                    vertical: 20
                  ),
                  child: Column(
                    children: [
                      Text("sdsd")
                    ],
                  ),
                ),
              )
            ],
          ),
        ),
      ),
      );
  }
}