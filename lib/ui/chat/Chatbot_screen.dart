
import 'package:bisa_app/models/chatbotmessage.dart';
import 'package:chat_bubbles/message_bars/message_bar.dart';
import 'package:flutter/material.dart';

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


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //resizeToAvoidBottomInset: false,
      backgroundColor: Color.fromARGB(255, 238, 236, 236),
      appBar: AppBar(
        title: Text("Chatbot Assistant"),
      ),
      bottomNavigationBar: Container(
        width: MediaQuery.of(context).size.width,
        padding: EdgeInsets.all(20),
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
            ),
          ),
          //trailing: ElevatedButton(onPressed: (){}, child: Text("Send")),
          trailing: IconButton(
            icon: Icon(
              Icons.send,
              color: Colors.greenAccent,
              ),
            onPressed: (){},
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