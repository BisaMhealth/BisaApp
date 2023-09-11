import 'package:flutter/material.dart';

class ChooseProviderScreen extends StatelessWidget {
  const ChooseProviderScreen({Key? key}) : super(key: key);

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
          'Choose A Plan',
          style: TextStyle(
              fontFamily: 'Lato',
              fontWeight: FontWeight.w700,
              fontSize: 25,
              color: Color.fromRGBO(30, 29, 29, 0.98)),
        ),
      ),
      body: SingleChildScrollView(
        child: Wrap(
          children: [
            Padding(
              padding: const EdgeInsets.only(
                  left: 25.0, top: 10, bottom: 10, right: 10),
              child: Card(
                elevation: 20,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.38,
                  height: 150,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset('assets/imgs/manager1.png'),
                      const SizedBox(
                        height: 15,
                      ),
                      const Text(
                        'Individal',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18,
                            fontWeight: FontWeight.w400,
                            color: Color.fromRGBO(84, 77, 77, 0.8)),
                      )
                    ],
                  ),
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(
                  right: 5.0, top: 10, bottom: 10, left: 15),
              child: Card(
                elevation: 20,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.38,
                  height: 150,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset('assets/imgs/family1.png'),
                      const SizedBox(
                        height: 15,
                      ),
                      const Text(
                        'Families',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18,
                            fontWeight: FontWeight.w400,
                            color: Color.fromRGBO(84, 77, 77, 0.8)),
                      )
                    ],
                  ),
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(
                  left: 25.0, top: 10, bottom: 10, right: 10),
              child: Card(
                elevation: 20,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.38,
                  height: 150,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset('assets/imgs/couple1.png'),
                      const SizedBox(
                        height: 15,
                      ),
                      const Text(
                        'Senior Citizens',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18,
                            fontWeight: FontWeight.w400,
                            color: Color.fromRGBO(84, 77, 77, 0.8)),
                        textAlign: TextAlign.center,
                      )
                    ],
                  ),
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(
                  right: 5.0, top: 10, bottom: 10, left: 15),
              child: Card(
                elevation: 20,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.38,
                  height: 150,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset('assets/imgs/pregnant1.png'),
                      const SizedBox(
                        height: 15,
                      ),
                      const Text(
                        'Pregnant Women',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18,
                            fontWeight: FontWeight.w400,
                            color: Color.fromRGBO(84, 77, 77, 0.8)),
                      )
                    ],
                  ),
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(
                  left: 25.0, top: 10, bottom: 10, right: 10),
              child: Card(
                elevation: 20,
                child: SizedBox(
                  width: MediaQuery.of(context).size.width * 0.38,
                  height: 150,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Image.asset('assets/imgs/store1.png'),
                      const SizedBox(
                        height: 15,
                      ),
                      const Text(
                        'S.M.Es',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontSize: 18,
                            fontWeight: FontWeight.w400,
                            color: Color.fromRGBO(84, 77, 77, 0.8)),
                      )
                    ],
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
