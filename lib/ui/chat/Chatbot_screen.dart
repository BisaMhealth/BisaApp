
import 'package:bisa_app/models/chatbotmessage.dart';
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
      appBar: AppBar(
        title: Text("Chatbot Assistant"),
      ),
      bottomNavigationBar: Container(
        width: MediaQuery.of(context).size.width,
        height: 150,
        child: ListTile(
          title: Form(
            key: _formkey,
            child: TextFormField(
              controller: messagecontroller,
            ),
          ),
          trailing: ElevatedButton(onPressed: (){}, child: Text("Send")),
        ),
      ),
    );
  }
}