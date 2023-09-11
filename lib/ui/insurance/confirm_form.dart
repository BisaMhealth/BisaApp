import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/ui/widgets/custom_text_form.dart';
import 'package:bisa_app/utils/validator.dart';
import 'package:flutter/material.dart';

class ConfirmForm extends StatefulWidget {
  const ConfirmForm({Key? key}) : super(key: key);

  @override
  ConfirmFormState createState() => ConfirmFormState();
}

class ConfirmFormState extends State<ConfirmForm> {
  final dobController = TextEditingController();
  final emailController = TextEditingController();
  final fnameController = TextEditingController();
  final pobController = TextEditingController();
  final phoneController = TextEditingController();
  final addressController = TextEditingController();
  final occupationController = TextEditingController();

  final dobFocusNode = FocusNode();
  final emailFocusNode = FocusNode();
  final fnameFocusNode = FocusNode();
  final pobFocusNode = FocusNode();
  final phoneFocusNode = FocusNode();
  final addressFocusNode = FocusNode();
  final occupationFocusNode = FocusNode();

  final bool _saving = false;
  @override
  Widget build(BuildContext context) {
    var fieldWidth = MediaQuery.of(context).size.width - 40;
    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios),
          onPressed: () {},
        ),
        title: const Text(
          'Complete the form below',
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
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              const SizedBox(
                height: 20,
              ),
              FadeAnimation(
                1.0,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: fnameController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: fnameFocusNode,
                      fieldHintText: "Enter fullname",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                1.2,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: dobController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: dobFocusNode,
                      fieldHintText: "Date of Birth",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                1.4,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: pobController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: pobFocusNode,
                      fieldHintText: "Place of Birth",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                1.6,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: addressController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: addressFocusNode,
                      fieldHintText: "Resident Address",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                1.8,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: occupationController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: occupationFocusNode,
                      fieldHintText: "Occupation",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                2.0,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: phoneController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: phoneFocusNode,
                      fieldHintText: "Phone Number",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 10,
              ),
              FadeAnimation(
                2.1,
                -30,
                0,
                Container(
                  width: fieldWidth,
                  height: 50,
                  decoration: BoxDecoration(
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(109, 108, 108, .2),
                            blurRadius: 20,
                            offset: Offset(0, 4)),
                      ],
                      borderRadius: BorderRadius.circular(30),
                      color: Colors.white),
                  child: CustomTextField(
                      isEnabled: !_saving,
                      fieldController: emailController,
                      fieldValidator: Validator.textValidator,
                      currentFocus: emailFocusNode,
                      fieldHintText: "Email if applicable",
                      fieldTextInputAction: TextInputAction.next),
                ),
              ),
              const SizedBox(
                height: 20,
              ),
              const FadeAnimation(
                  2.2,
                  -30,
                  0,
                  Text(
                    'You have chosen to subscribe to Hybasic Premium.',
                    style: TextStyle(
                        fontFamily: 'Lato',
                        fontWeight: FontWeight.w300,
                        fontSize: 13,
                        color: Color.fromRGBO(157, 154, 154, 1)),
                  )),
              const SizedBox(
                height: 20,
              ),
              FadeAnimation(
                2.3,
                -30,
                0,
                SizedBox(
                  width: MediaQuery.of(context).size.width - 20,
                  child: Center(
                    child: InkWell(
                      onTap: () {
                        // Navigator.push(
                        //   context,
                        //   PageAnimationTransition(pageAnimationType: rightToLeftWithFade,child: InterestPage())
                        // );
                      },
                      child: Container(
                        width: 180,
                        height: 40,
                        decoration: BoxDecoration(
                            color: const Color.fromRGBO(142, 211, 55, 1),
                            borderRadius: BorderRadius.circular(50),
                            boxShadow: const [
                              BoxShadow(
                                  color: Color.fromRGBO(0, 0, 0, .25),
                                  blurRadius: 20,
                                  offset: Offset(0, 10))
                            ]),
                        child: const Center(
                          child: Text(
                            'Confirm & Submit',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Colors.white),
                          ),
                        ),
                      ),
                    ),
                  ),
                ),
              ),
              const SizedBox(
                height: 20,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
