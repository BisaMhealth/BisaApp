
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
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            Container()
          ],
        ),
      ),
      bottomNavigationBar: Container(
        //color: const Color.fromARGB(255, 85, 192, 242),
        decoration: BoxDecoration(
          gradient: RadialGradient(
            colors: [
              Colors.lightBlue,
              Colors.lightBlueAccent
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
    );
  }
}