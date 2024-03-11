

import 'package:flutter/material.dart';
import 'package:textfield_tags/textfield_tags.dart';
import 'package:material_tag_editor/tag_editor.dart';

class Intro_Allergies extends StatefulWidget {
  const Intro_Allergies({super.key});

  @override
  State<Intro_Allergies> createState() => _Intro_AllergiesState();
}

class _Intro_AllergiesState extends State<Intro_Allergies> {
  
  final _stringTagController = StringTagController();
  List values=[];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color.fromARGB(255, 244, 244, 244),
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
                    padding: const EdgeInsets.symmetric(
                      horizontal: 10,
                      vertical: 10
                    ),
                    decoration: BoxDecoration(
                      boxShadow: [
                        BoxShadow(
                          color: Colors.grey.withOpacity(0.1),
                          spreadRadius: 5,
                          blurRadius: 7,
                          offset: const Offset(0, 3), // changes position of shadow
                        ),
                      ],
                      borderRadius: BorderRadius.circular(10),
                      color: values.isEmpty? Colors.transparent: Colors.white,
                      border: values.isNotEmpty ? Border.all(
                        color:  Colors.black,
                        width: 1
                      ):Border(

                      ),
                    ),
                    child: TagEditor(
                      maxLines: 4,
                      length: values.length,
                      delimiters: [',', ' '],
                      hasAddButton: false,
                      inputDecoration:  InputDecoration(
                        counter: Row(
                          mainAxisAlignment: MainAxisAlignment.end,
                          children: [
                           const Icon(
                              Icons.receipt,
                              color: Colors.grey,
                            ),
                            Text(
                              "${values.length}/10",
                              style: const TextStyle(
                                fontFamily: "Sofia Pro",
                                fontSize: 12,
                                fontWeight: FontWeight.w500,
                                color: Colors.grey,
                              ),
                              )
                          ],
                        ),
                       // counterText: "${values.length}/10",
                        fillColor: Colors.white,
                        filled: true,
                        border: values.isEmpty?OutlineInputBorder(
                          // borderSide: BorderSide(
                          //   color: Colors.black,
                          //   width: 1
                          // ),
                          borderRadius: BorderRadius.circular(10)
                        ): InputBorder.none,
                        hintText: 'Add an allergy...',
                      ),
                      onTagChanged: (newValue) {
                        setState(() {
                          values.add(newValue);
                        });
                      },
                      tagBuilder: (context, index) => _Chip(
                        index: index,
                        label: values[index],
                        onDeleted: (index){
                          setState(() {
                            values.removeAt(index);
                          });
                        },
                      ),
                    ),
                  )
                  // Container(
                  //   child: TextFieldTags(
                  //     textfieldTagsController: _stringTagController,
                  //     initialTags: ['test'],
                  //    // focusNode: _stringTagController.getFocusNode, 
                  //     validator: (tag){
                  //               if (tag == 'php'){
                  //                 return 'Php not allowed';
                  //               }
                  //               return null;
                  //             },
                  //     textSeparators: const [' ', ','],
                  //      inputFieldBuilder: (context, inputFieldValues){
                  //       print(inputFieldValues.tags);
                  //             return TextField(
                  //               controller: inputFieldValues.textEditingController,
                  //               focusNode: inputFieldValues.focusNode, 
                  //               onChanged: (value) {
                  //                if(value.endsWith(",")|| value.endsWith(" ")) {
                  //                   inputFieldValues.tags.add(value.trimRight());
                  //                   inputFieldValues.textEditingController.clear();
                  //                   setState(() {
                                      
                  //                   });
                  //                }
                  //               },
                  //               maxLines: 4,
                  //               decoration:  InputDecoration(
                  //                 border: OutlineInputBorder(),
                  //                 hintText: "Add Allergies",
                  //                 // constraints: BoxConstraints(
                  //                 //   minHeight: 200,
                  //                 //   minWidth: 100
                  //                 // )
                  //                 prefix:inputFieldValues.tags.isNotEmpty
                  //           ? Container(
                  //             width: 200,
                  //             child: SingleChildScrollView(
                  //               //  controller: sc,
                  //                 scrollDirection: Axis.horizontal,
                  //                 child: Row(
                  //                     children: inputFieldValues.tags.map((String tag) {
                  //                   return Container(
                  //                     decoration: const BoxDecoration(
                  //                       borderRadius: BorderRadius.all(
                  //                         Radius.circular(20.0),
                  //                       ),
                  //                       color: Color.fromARGB(255, 74, 137, 92),
                  //                     ),
                  //                     margin: const EdgeInsets.symmetric(
                  //                         horizontal: 5.0),
                  //                     padding: const EdgeInsets.symmetric(
                  //                         horizontal: 10.0, vertical: 5.0),
                  //                     child: Row(
                  //                       mainAxisAlignment:
                  //                           MainAxisAlignment.spaceBetween,
                  //                       children: [
                  //                         InkWell(
                  //                           child: Text(
                  //                             '#$tag',
                  //                             style: const TextStyle(
                  //                                 color: Colors.white),
                  //                           ),
                  //                           onTap: () {
                  //                             print("$tag selected");
                  //                           },
                  //                         ),
                  //                         const SizedBox(width: 4.0),
                  //                         InkWell(
                  //                           child: const Icon(
                  //                             Icons.cancel,
                  //                             size: 14.0,
                  //                             color: Color.fromARGB(
                  //                                 255, 233, 233, 233),
                  //                           ),
                  //                           onTap: () {
                  //                            // onTagDelete(tag);
                  //                           },
                  //                         )
                  //                       ],
                  //                     ),
                  //                   );
                  //                 }).toList()),
                  //               ),
                  //           )
                  //           : null,
                  //               ),
                                
                  //             );
                  //           }
                  //      ),
                  // )
               //   MyWidget()
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


class _Chip extends StatelessWidget {
  const _Chip({
    required this.label,
    required this.onDeleted,
    required this.index,
  });

  final String label;
  final ValueChanged<int> onDeleted;
  final int index;

  @override
  Widget build(BuildContext context) {
    return Chip(
      backgroundColor: Color.fromARGB(255, 92, 211, 235).withOpacity(0.2),
      shape: RoundedRectangleBorder(
        side: BorderSide(
          color: Color.fromARGB(255, 92, 211, 235).withOpacity(0.2),
          width: 0,
        ),
        borderRadius: BorderRadius.circular(10),
      ),
      labelPadding: const EdgeInsets.only(left: 8.0),
      label: Text(label),
      deleteIcon: Icon(
        Icons.close,
        size: 18,
      ),
      onDeleted: () {
        onDeleted(index);
      },
    );
  }
}