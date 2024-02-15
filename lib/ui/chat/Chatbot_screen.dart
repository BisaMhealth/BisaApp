
import 'dart:convert';

import 'package:bisa_app/models/chatbotmessage.dart';
import 'package:bisa_app/utils/validator.dart';
import 'package:chat_bubbles/bubbles/bubble_normal.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class ChatbotScreen extends StatefulWidget {
  const ChatbotScreen({super.key});

  @override
  State<ChatbotScreen> createState() => _ChatbotScreenState();
}

class _ChatbotScreenState extends State<ChatbotScreen> {
  
TextEditingController messagecontroller = TextEditingController();
ScrollController scrollController = ScrollController();
List<chatbotmessages> msgs = [];
bool isTyping = false;
final _formkey = GlobalKey<FormState>();


     

void sendMsg() async {
    String text = messagecontroller.text;
    String apiKey = "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";
    messagecontroller.clear();
    try {
      if (text.isNotEmpty) {
        setState(() {
          msgs.insert(0, chatbotmessages(isSender: true, message: text));
          isTyping = true;
        });
        scrollController.animateTo(0.0,
            duration: const Duration(seconds: 1), curve: Curves.easeOut);
        

        var response = await http.post(
            Uri.parse("https://api.openai.com/v1/chat/completions"),
            headers: {
              "Authorization": "Bearer $apiKey",
              "Content-Type": "application/json"
            },
            body: jsonEncode({
              "model": "gpt-3.5-turbo",
              "messages": [
                {"role": "user", "content": text}
              ]
            }));
             print(response.statusCode);
            print(response.body);
        if (response.statusCode == 200) {
          var json = jsonDecode(response.body);
          
          setState(() {
            isTyping = false;
            msgs.insert(
                0,
                chatbotmessages(
                    isSender: false,
                   message: json["choices"][0]["message"]["content"]
                        .toString()
                        .trimLeft()));
          });
          scrollController.animateTo(0.0,
              duration: const Duration(seconds: 1), curve: Curves.easeOut);
        }
      }
    } on Exception {
      ScaffoldMessenger.of(context).showSnackBar(const SnackBar(
          content: Text("Some error occurred, please try again!")));
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //resizeToAvoidBottomInset: false,
      backgroundColor: Color.fromARGB(255, 238, 236, 236),
      appBar: AppBar(
        title: Text("Chatbot Assistant"),
      ),
      
          body:  Container(
              child: ListView.builder(
                  controller: scrollController,
                  itemCount: msgs.length,
                  shrinkWrap: true,
                  reverse: true,
                  itemBuilder: (context, index) {
                    return Padding(
                        padding: const EdgeInsets.symmetric(vertical: 4),
                        child: isTyping && index == 0
                            ? Column(
                                children: [
                                  BubbleNormal(
                                    text: msgs[0].message,
                                    isSender: true,
                                    color: Colors.blue.shade100,
                                  ),
                                  const Padding(
                                    padding: EdgeInsets.only(left: 16, top: 4),
                                    child: Align(
                                        alignment: Alignment.centerLeft,
                                        child: Text("Typing...")),
                                  )
                                ],
                              )
                            : BubbleNormal(
                                text: msgs[index].message,
                                isSender: msgs[index].isSender,
                                color: msgs[index].isSender
                                    ? Colors.blue.shade100
                                    : Colors.grey.shade200,
                              ));
                  }),
            ),
      bottomNavigationBar: Container(
        width: MediaQuery.of(context).size.width,
        padding: const EdgeInsets.all(20),
       height: 110,
       decoration: BoxDecoration(
         color: Colors.white,
         borderRadius: BorderRadius.only(
            topLeft: Radius.circular(20),
            topRight: Radius.circular(20)
          ),
         boxShadow: [
           BoxShadow(
             color: Colors.grey,
             blurRadius: 5,
             spreadRadius: 5,
             offset: Offset(0, 3)
           )
         ]
         ),
        child: ListTile(
          title: Form(
            key: _formkey,
            child: TextFormField(
              controller: messagecontroller,
              validator: (value) => Validator.textValidator(value),
              decoration: InputDecoration(
                          hintText: "Type your message here",
                          hintMaxLines: 1,
                          contentPadding: const EdgeInsets.symmetric(
                              horizontal: 8.0, vertical: 10),
                         // hintStyle: messageBarHintStyle,
                          fillColor: Colors.white,
                          filled: true,
                          enabledBorder: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(30.0),
                            borderSide: const BorderSide(
                              color: Colors.white,
                              width: 0.2,
                            ),
                          ),
                          focusedBorder: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(30.0),
                            borderSide: const BorderSide(
                              color: Colors.black26,
                              width: 0.2,
                            ),
                          ),
                        ),
            ),
          ),
          //trailing: ElevatedButton(onPressed: (){}, child: Text("Send")),
          trailing: IconButton(
            icon: Icon(
              Icons.send,
              color: Colors.greenAccent,
              size: 35,
              ),
            onPressed: (){
              sendMsg();
            },
          ),
        ),
        // child: MessageBar(
        //   replyWidgetColor: Colors.transparent,
        //   messageBarColor: Colors.transparent,
        //   onTapCloseReply: (){},
        //   onTextChanged: (message){},
        // )
      ),
    );
  }
}