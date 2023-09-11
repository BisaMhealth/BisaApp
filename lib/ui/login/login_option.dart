import 'package:flutter/material.dart';
import 'package:coast/coast.dart';

class LoginOptions extends StatefulWidget {
  const LoginOptions({Key? key}) : super(key: key);

  @override
  LoginOptionsState createState() => LoginOptionsState();
}

class LoginOptionsState extends State<LoginOptions> {
  // final _beaches = [
  //   Beach(builder: (context) => Login()),
  //   Beach(builder: (context) => ResetPassword()),
  //   // Beach(builder: (context) => Zoutelande()),
  // ];

  // ignore: unused_field
  final _coastController = CoastController(initialPage: 1);
  @override
  Widget build(BuildContext context) {
    return Container();
  }
}
