

import 'package:flutter/material.dart';
import 'package:textfield_tags/textfield_tags.dart';

class Intro_Allergies extends StatefulWidget {
  const Intro_Allergies({super.key});

  @override
  State<Intro_Allergies> createState() => _Intro_AllergiesState();
}

class _Intro_AllergiesState extends State<Intro_Allergies> {
  
  final _stringTagController = TextfieldTagsController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 230, 229, 229),
       body: Container(
        padding: const EdgeInsets.symmetric(
          horizontal: 20
          ),
        child: SingleChildScrollView(
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
                        padding: const EdgeInsets.all(10),
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
                          value: 0.7,
                          valueColor: AlwaysStoppedAnimation<Color>(Color.fromARGB(255, 24, 44, 116)),
                          backgroundColor: Color.fromARGB(255, 24, 44, 116).withOpacity(0.1),
                        ),
                      ),
                     const Expanded(child: SizedBox()),
                      TextButton(onPressed: (){}, child: Text("Skip"))
                    ],
                  )
                  ),
                const  Text(
                    "Do you have any symptoms/allergies",
                     style:  TextStyle(
                          fontFamily: "Sofia Pro",
                          fontSize: 24,
                          // fontWeight: FontWeight.w500,
                          color: Color.fromRGBO(58, 75, 149, 1),
                          height: 1.0
                          ),
                    ),
                  const  SizedBox(height: 30,),
                  Container(
                    height: 200,
                    width: MediaQuery.of(context).size.width,
                    decoration:const  BoxDecoration(
                      image: DecorationImage(
                        image: AssetImage("assets/imgs/Allergies.png"),
                        fit: BoxFit.contain
                      )
                    ),
                    child: const Text(""),
                  ),
                  SizedBox(height: 20,),
                  Container(
                    child: TextFieldTags(
                      textfieldTagsController: _stringTagController,
                      initialTags: ['test'],
                      validator: (tag){
                                if (tag == 'php'){
                                  return 'Php not allowed';
                                }
                                return null;
                              },
                      textSeparators: const [' ', ','],
                       inputFieldBuilder: (context, inputFieldValues){
                        print(inputFieldValues.tags);
                              return TextField(
                                controller: inputFieldValues.textEditingController,
                                focusNode: inputFieldValues.focusNode, 
                                // maxLines: 4,
                                // decoration: const InputDecoration(
                                //   border: OutlineInputBorder(),
                                //   hintText: "Add Allergies",
                                //   // constraints: BoxConstraints(
                                //   //   minHeight: 200,
                                //   //   minWidth: 100
                                //   // )
                                // ),
                              );
                            }
                       ),
                  )
            ],
          ),
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