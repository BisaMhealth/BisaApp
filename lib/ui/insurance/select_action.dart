import 'package:bisa_app/animation/fade_animation.dart';
import 'package:flutter/material.dart';

class SelectActionInsurance extends StatelessWidget {
  const SelectActionInsurance({Key? key}) : super(key: key);

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
          'Insurance',
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
                      height: 80,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(63, 166, 198, 1),
                              Color.fromRGBO(177, 61, 187, 0.34),
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
                          Image.asset('assets/imgs/documents1.png'),
                          const Text(
                            'Apply for an insurance',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w700,
                                fontSize: 17,
                                color: Color.fromRGBO(255, 255, 255, 0.98)),
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
                      height: 80,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(63, 166, 198, 1),
                              Color.fromRGBO(177, 61, 187, 0.34),
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
                          Image.asset('assets/imgs/customer-service1.png'),
                          const Text(
                            'Chat with an expert',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w700,
                                color: Color.fromRGBO(255, 255, 255, 0.98),
                                fontSize: 17),
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
                      height: 80,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(63, 166, 198, 1),
                              Color.fromRGBO(177, 61, 187, 0.34),
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
                          Image.asset('assets/imgs/business-and-finance1.png'),
                          const Text(
                            'Renew your insurance',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w700,
                                color: Color.fromRGBO(255, 255, 255, 0.98),
                                fontSize: 17),
                          ),
                          const Icon(
                            Icons.arrow_forward_ios_rounded,
                            color: Colors.white,
                          )
                        ],
                      ),
                    ),
                  )),
              const SizedBox(
                height: 80,
              ),
              FadeAnimation(
                  1.8,
                  -30,
                  0,
                  Padding(
                    padding: const EdgeInsets.all(6.0),
                    child: SizedBox(
                      width: MediaQuery.of(context).size.width - 25,
                      child: const Text(
                        'Not sure about Health Insurance?',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontWeight: FontWeight.w500,
                            color: Color.fromRGBO(0, 0, 0, 1),
                            fontSize: 19),
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
                      height: 80,
                      decoration: BoxDecoration(
                          gradient: const LinearGradient(
                            colors: [
                              Color.fromRGBO(63, 166, 198, 1),
                              Color.fromRGBO(177, 61, 187, 0.34),
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
                          Image.asset('assets/imgs/conversation1.png'),
                          const Text(
                            'Check our FAQs section',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w700,
                                color: Color.fromRGBO(255, 255, 255, 0.98),
                                fontSize: 17),
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
