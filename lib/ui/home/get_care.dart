import 'package:bisa_app/animation/fade_animation.dart';
import 'package:flutter/material.dart';

class GetCare extends StatelessWidget {
  const GetCare({Key? key}) : super(key: key);

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
          'Get Care',
          style: TextStyle(
              fontFamily: 'Lato',
              fontWeight: FontWeight.w700,
              fontSize: 25,
              color: Color.fromRGBO(30, 29, 29, 0.98)),
        ),
      ),
      body: SingleChildScrollView(
        child: SizedBox(
          width: MediaQuery.of(context).size.width,
          child: Column(
            // mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              FadeAnimation(
                  1.2,
                  -30,
                  0,
                  Padding(
                    padding: const EdgeInsets.all(6.0),
                    child: Container(
                      width: MediaQuery.of(context).size.width - 25,
                      height: 100,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(131, 215, 184, 1),
                              Color.fromRGBO(63, 133, 198, 0.69),
                            ],
                            begin: Alignment.centerLeft,
                            end: Alignment.centerRight,
                          ),
                          borderRadius: BorderRadius.circular(15),
                          boxShadow: const [
                            BoxShadow(
                                color: Color.fromRGBO(0, 0, 0, .18),
                                blurRadius: 20,
                                offset: Offset(0, 10))
                          ]),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          Image.asset('assets/imgs/doctor1.png'),
                          const Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(
                                height: 10,
                              ),
                              Text(
                                'Speak to a doctor',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w700,
                                    fontSize: 17,
                                    color: Color.fromRGBO(255, 255, 255, 0.98)),
                              ),
                              SizedBox(
                                height: 8,
                              ),
                              Text(
                                'Chat with a medical Professional',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w300,
                                    fontSize: 14,
                                    color: Color.fromRGBO(0, 0, 0, 0.98)),
                              ),
                              SizedBox(
                                height: 5,
                              ),
                              Text(
                                'Max. waiting time: <15min',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w700,
                                    fontSize: 12,
                                    color: Color.fromRGBO(0, 0, 0, 0.98)),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                            ],
                          ),
                          const Icon(
                            Icons.arrow_forward_ios_rounded,
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  )),
              FadeAnimation(
                  1.4,
                  -30,
                  0,
                  Padding(
                    padding: const EdgeInsets.all(6.0),
                    child: Container(
                      width: MediaQuery.of(context).size.width - 25,
                      height: 100,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(131, 215, 184, 1),
                              Color.fromRGBO(63, 133, 198, 0.69),
                            ],
                            begin: Alignment.centerLeft,
                            end: Alignment.centerRight,
                          ),
                          borderRadius: BorderRadius.circular(15),
                          boxShadow: const [
                            BoxShadow(
                                color: Color.fromRGBO(0, 0, 0, .2),
                                blurRadius: 20,
                                offset: Offset(0, 10))
                          ]),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          Image.asset('assets/imgs/safe1.png'),
                          const Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(
                                height: 10,
                              ),
                              Text(
                                'Get a health insurance policy',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w700,
                                    color: Color.fromRGBO(255, 255, 255, 0.98),
                                    fontSize: 17),
                              ),
                              SizedBox(
                                height: 8,
                              ),
                              Text(
                                'Get info on medical insurance',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w300,
                                    fontSize: 14,
                                    color: Color.fromRGBO(0, 0, 0, 0.98)),
                              ),
                              SizedBox(
                                height: 5,
                              ),
                              Text(
                                'Select provider and make inquiry',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w300,
                                    fontSize: 12,
                                    color: Color.fromRGBO(0, 0, 0, 0.55)),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                            ],
                          ),
                          const Icon(
                            Icons.arrow_forward_ios_rounded,
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  )),
              FadeAnimation(
                  1.6,
                  -30,
                  0,
                  Padding(
                    padding: const EdgeInsets.all(6.0),
                    child: Container(
                      width: MediaQuery.of(context).size.width - 25,
                      height: 100,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(131, 215, 184, 1),
                              Color.fromRGBO(63, 133, 198, 0.69),
                            ],
                            begin: Alignment.centerLeft,
                            end: Alignment.centerRight,
                          ),
                          borderRadius: BorderRadius.circular(15),
                          boxShadow: const [
                            BoxShadow(
                                color: Color.fromRGBO(0, 0, 0, .18),
                                blurRadius: 20,
                                offset: Offset(0, 10))
                          ]),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceAround,
                        children: [
                          Image.asset('assets/imgs/doctor-fem.png'),
                          const Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(
                                height: 10,
                              ),
                              Text(
                                'Book a medical appointment',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w700,
                                    color: Color.fromRGBO(255, 255, 255, 0.98),
                                    fontSize: 17),
                              ),
                              SizedBox(
                                height: 8,
                              ),
                              Text(
                                'Book appt. to meet with a doctor.',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w300,
                                    fontSize: 14,
                                    color: Color.fromRGBO(0, 0, 0, 0.98)),
                              ),
                              SizedBox(
                                height: 5,
                              ),
                              Text(
                                'Select medical facility and time',
                                style: TextStyle(
                                    fontFamily: 'Lato',
                                    fontWeight: FontWeight.w300,
                                    fontSize: 12,
                                    color: Color.fromRGBO(0, 0, 0, 0.55)),
                              ),
                              SizedBox(
                                height: 10,
                              ),
                            ],
                          ),
                          const Icon(
                            Icons.arrow_forward_ios_rounded,
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  )),
            ],
          ),
        ),
      ),
    );
  }
}
