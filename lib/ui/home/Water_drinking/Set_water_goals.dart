import 'package:flutter/material.dart';

class WaterGoals extends StatefulWidget {
  const WaterGoals({super.key});

  @override
  State<WaterGoals> createState() => _WaterGoalsState();
}

class _WaterGoalsState extends State<WaterGoals> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.lightBlueAccent,
      body: Container(
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
                child:  Row(
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
                padding: const EdgeInsets.symmetric(
                  vertical: 10,
                  horizontal: 10
                ),
                width: MediaQuery.of(context).size.width,
                height: MediaQuery.of(context).size.height - 100,
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(50),
                    topRight: Radius.circular(50)
                  )
                ),
                child: Column(
                  children: [
                    Center(
                      child: Text(
                        "Set Water Goals",
                        style: TextStyle(
                          color: Colors.lightBlueAccent,
                          fontSize: 30,
                          fontWeight: FontWeight.bold
                          )
                        ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
      floatingActionButton: InkWell(
        onTap: (){},
        child: Container(
          height: 170,
          width: 170,
          decoration: BoxDecoration(
            image: DecorationImage(
              image: AssetImage('assets/imgs/waterdrop.png'),
              fit: BoxFit.cover
              )
          ),
        ),
      ),
    );
  }
}