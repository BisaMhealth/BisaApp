
import 'package:flutter/material.dart';

class WaterHome extends StatefulWidget {
  const WaterHome({super.key});

  @override
  State<WaterHome> createState() => _WaterHomeState();
}

class _WaterHomeState extends State<WaterHome> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //backgroundColor: const Color.fromARGB(255, 137, 211, 245),
      appBar: AppBar(
        backgroundColor: Colors.lightBlueAccent,
        elevation: 0.0,
        centerTitle: true,
        surfaceTintColor: Colors.transparent,
        leading:  GestureDetector(
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
        title: Text(
          'Hydration',
          style: TextStyle(
            color: Colors.white,
          ),
          ),
      ),
      body: Container(
        padding: EdgeInsets.symmetric(
          vertical: 10
        ),
        child: Column(
          children: [
            Container(
              // padding: EdgeInsets.symmetric(
              //   horizontal: 10
              // ),
              decoration: BoxDecoration(),
              child: Container(
                height: 300,
                width: MediaQuery.of(context).size.width*0.9,
                //padding: EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: Colors.white.withOpacity(0.9),
                  borderRadius: BorderRadius.only(
                    bottomLeft: Radius.circular(40),
                    bottomRight: Radius.circular(20),
                    topRight: Radius.circular(20),
                    topLeft: Radius.circular(20)
                    )
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.stretch,
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    SizedBox(),
                    Container(
                      height: 140,
                      width: MediaQuery.of(context).size.width*0.9,
                      decoration: BoxDecoration(
                        image: DecorationImage(
                          image: AssetImage(
                            'assets/imgs/waves.png',
                            ),
                            fit: BoxFit.cover
                          )
                      ),
                      child: Text(""),
                    )
                  ],
                ),
              ),
            ),
            Container()
          ],
        ),
      ),
    );
  }
}