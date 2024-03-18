
import 'package:bisa_app/ui/home/Water_drinking/Water_quantity_card.dart';
import 'package:flutter/material.dart';
import 'package:waterfall_flow/waterfall_flow.dart';

class WaterGoals extends StatefulWidget {
  const WaterGoals({super.key});

  @override
  State<WaterGoals> createState() => _WaterGoalsState();
}

class _WaterGoalsState extends State<WaterGoals> {

final _formkey = GlobalKey<FormState>();
TextEditingController _goalController = TextEditingController();
final goalfocusNode = FocusNode();
 int Selectedindex = 6;
List images = [
  'assets/imgs/cup.png',
  'assets/imgs/glass1.png',
  'assets/imgs/mug.png',
  'assets/imgs/bottle1.png',
  'assets/imgs/bottle2.png',
  'assets/imgs/jar.png'
  ];

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
                  crossAxisAlignment: CrossAxisAlignment.start,
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
                    SizedBox(
                      height: 20,
                    ),
                    Container(
                      width: MediaQuery.of(context).size.width * 0.8,
                      child: Form(
                        key: _formkey,
                        // child: CustomTextField(
                        //   isEnabled: true,
                        //   fieldController: _goalController, 
                        //   fieldValidator: Validator.textValidator, 
                        //   currentFocus: goalfocusNode, 
                        //   fieldHintText: "Set your daily goal", 
                        //   fieldTextInputAction: TextInputAction.done
                        //   ),
                        child: TextFormField(
                          controller: _goalController,
                          decoration: InputDecoration(
                            
                          ),
                        )
                        ),
                    ),
                    SizedBox(
                      height: 40,
                    ),
                    Text(
                      "Choose your water container size:",
                      style: TextStyle(
                        color: Colors.lightBlueAccent,
                        fontSize: 17,
                        fontWeight: FontWeight.bold
                        ),
                        textAlign: TextAlign.start,
                      ),
                     SizedBox(
                      height: 20,
                    ),
                    WaterfallFlow.builder(
      shrinkWrap: true,
    //  physics: const NeverScrollableScrollPhysics(),
      padding: const EdgeInsets.symmetric(
        horizontal: 10,
        vertical: 10,
      ),
      gridDelegate: const SliverWaterfallFlowDelegateWithFixedCrossAxisCount(
        crossAxisCount: 3,
        crossAxisSpacing: 15.0,
        mainAxisSpacing: 55.0,
      ),
      itemCount: 6,
      itemBuilder: (BuildContext context, int index) {
        return InkWell(
          onTap: (){
            setState(() {
              Selectedindex = index;
            });
          },
          child: Container(
            decoration: BoxDecoration(
              boxShadow: Selectedindex == index? [
                BoxShadow(
                  color: Colors.grey.withOpacity(0.5),
                  spreadRadius: 2,
                  blurRadius: 7,
                  offset: const Offset(0, 3), // changes position of shadow
                ),
              ]:null,
            ),
            child: WaterQuantity(
              image: images[index],
              quantity: (index + 1) * 100,
            ),
          ),
        );
      },
    )
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