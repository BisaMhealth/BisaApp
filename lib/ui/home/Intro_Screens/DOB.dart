

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
// import 'package:syncfusion_flutter_datepicker/datepicker.dart';

class Intro_DOB extends StatefulWidget {
  const Intro_DOB({super.key});

  @override
  State<Intro_DOB> createState() => _Intro_DOBState();
}

class _Intro_DOBState extends State<Intro_DOB> {
  @override
  Widget build(BuildContext context) {
    return Scaffold( 
      body: Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 20
          ),
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
                    GestureDetector(
                      onTap: (){
                        Navigator.of(context).pop();
                      },
                      child: Container(
                        padding: const EdgeInsets.all(5),
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
                    ),
                    SizedBox(
                      width: 20,
                      ),
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
                  "What is your date of birth?",
                   style: const TextStyle(
                        fontFamily: "Sofia Pro",
                        fontSize: 24,
                        // fontWeight: FontWeight.w500,
                        color: Color.fromRGBO(58, 75, 149, 1),
                        height: 1.0
                        ),
                  ),
                  const SizedBox(height: 20),
                  // SfDateRangePicker(),
                Container(
                  height: MediaQuery.of(context).size.height * 0.5,
                 // child: SfDateRangePicker(),
                  child: DateRangePickerDialog(
                    firstDate: DateTime(1900), 
                    lastDate: DateTime.now()
                    )
                  // child: CupertinoDatePicker(
                  //   mode: CupertinoDatePickerMode.date,
                  //   onDateTimeChanged: (value){}
                  //   ),
                  )
          ],
        ),
      ),
      bottomNavigationBar: Container(
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
          ),
      ),);
  }
}