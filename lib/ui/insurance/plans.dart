import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/ui/insurance/plan_card.dart';
import 'package:flutter/material.dart';

class PlansScreen extends StatefulWidget {
  const PlansScreen({Key? key}) : super(key: key);

  @override
  PlansScreenState createState() => PlansScreenState();
}

class PlansScreenState extends State<PlansScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios),
          onPressed: () {},
        ),
        title: const Text(
          'Choose a package',
          style: TextStyle(
              fontFamily: 'Lato',
              fontWeight: FontWeight.w700,
              fontSize: 25,
              color: Color.fromRGBO(30, 29, 29, 0.98)),
        ),
      ),
      body: const Column(
        children: [
          FadeAnimation(
              1.2,
              0,
              30,
              PlanCard(
                image: 'Rectangle8.png',
                title: 'Unicare Plan',
                desc:
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed.',
                color: Color.fromRGBO(0, 132, 137, 1),
              )),
          FadeAnimation(
              1.4,
              0,
              30,
              PlanCard(
                image: 'Rectangle8_1.png',
                title: 'Premier Care Plan',
                desc:
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed.',
                color: Color.fromRGBO(42, 189, 101, 1),
              )),
          FadeAnimation(
              1.6,
              0,
              30,
              PlanCard(
                image: 'Rectangle8_2.png',
                title: 'Supercare Plan',
                desc:
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed.',
                color: Color.fromRGBO(0, 116, 161, 1),
              )),
          FadeAnimation(
              1.8,
              0,
              30,
              PlanCard(
                image: 'Rectangle8_3.png',
                title: 'Supercare Plus Plan',
                desc:
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed.',
                color: Color.fromRGBO(0, 81, 100, 1),
              )),
        ],
      ),
    );
  }
}
