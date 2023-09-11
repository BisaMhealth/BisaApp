import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class BasicInfo extends StatefulWidget {
  const BasicInfo({Key? key}) : super(key: key);

  @override
  State<BasicInfo> createState() => _BasicInfoState();
}

class _BasicInfoState extends State<BasicInfo> {
  var info = [];
  @override
  void initState() {
    super.initState();

    info = [
      {
        "created_by": "1",
        "question": "WHAT YOU NEED TO KNOW  ABOUT COVID-19 VACCINE",
        "answer":
            "Following the global emergence and the  continued surge of COVID-19 cases, the  global community stepped up efforts  towards the search for vaccine as part of  the response strategy to contain the  pandemic, protect health care systems and save lives and the economy. As COVID-19 vaccine becomes available, the Ghana Health Service has developed strategies and plans to effectively and efficiently roll out a vaccination campaign against COVID-19."
      },
      {
        "created_by": "1",
        "question": "What is COVID-19?",
        "answer":
            "COVID-19 is a disease caused by a new strain of corona virus known as SARS-CoV-2. The disease can be fatal  especially for older people and those with pre-existing health conditions such  as high blood pressure, asthma, cancer, heart problems or diabetes.",
      },
      {
        "created_by": "1",
        "question": "How is COVID-19 spread or transmitted?",
        "answer":
            "COVID-19 can be transmitted or passed from person to person when droplets containing the virus discharged from an infected patient are inhaled by another. It can also be spread by contact from touching contaminated surfaces and  subsequently touching the face (mouth, eyes and nose) with contaminated hands."
      },
      {
        "created_by": "1",
        "question": "Who is at risk of getting COVID-19?",
        "answer":
            "Everybody is at risk of getting COVID-19. But older persons or adults, people with underlying health condition such as asthma, diabetes, hypertension, TB, HIV/AIDS or compromised immune systems, are most at risk of COVID-19."
      },
      {
        "created_by": "1",
        "question": "What are the symptoms of COVID-19?",
        "answer":
            "The common signs and symptoms  include:\n• Fever (high body temperature)\n• Cough \n• Sore throat \n• Loss of sense of taste and smell  (Anosmia) \n• Breathing difficulties.\nIn more severe cases, infection can result  in pneumonia, severe acute respiratory  syndrome, kidney failure, which can lead  to death."
      },
      {
        "created_by": "1",
        "question": "Why should I get vaccinated against COVID-19?",
        "answer":
            "Without vaccines, we are all at risk of  serious illness and disability from COVID-19 complications such as pneumonia, kidney and lung problem. Many of these diseases can be life-threatening.\n Two key reasons to get vaccinated against COVID-19: to protect ourselves and to protect those around us."
      },
      {
        "created_by": "1",
        "question": "What are the benefits of COVID-19 Vaccine?",
        "answer":
            "COVID-19 is easily transmitted and can lead to serious illness and death, even for people who are young and healthy. The Vaccine for COVID-19 builds your body’s natural defenses – the immune system – to recognize and fight off the virus that causes COVID-19 disease. The vaccine gives you additional protection against COVID-19 disease."
      },
      {
        "created_by": "1",
        "question": "How is COVID-19 Vaccine given?",
        "answer":
            "In Ghana the COVID-19 vaccine is given as an injection on the left upper arm by a trained health worker. A new needle and syringe is used for every person and thereafter, destroyed"
      },
      {
        "created_by": "1",
        "question": "What should I do before and after vaccination?",
        "answer":
            "• Take along any national ID card and  ensure you eat before going for the  vaccine\n• Wear your face masks and observe physical distancing at the vaccination sites\n• Wait patiently for 10 to 15 minutes after vaccination before leaving the vaccination site\n• Seek for information concerning your vaccination from the health worker\n• If there is any adverse event after vaccination, report to the nearest health facility\n• Advocate for other family members to  get vaccinated"
      },
      {
        "created_by": "1",
        "question": "Who will be vaccinated with COVID-19 Vaccine?",
        "answer":
            "The vaccine will be given to all persons 16 years or 18 years and above, depending on the type of vaccine: AstraZeneca, Sputnik V, Johnson & Johnson & Moderna – 18 years and above Pfizer – 16 years and above"
      },
      {
        "created_by": "1",
        "question": "Who should not receive COVID-19 Vaccine?",
        "answer":
            "• Pregnant women (unless the benefit far outweighs the potential risks.)\n• Children below 16 and 18 years depending on the type of vaccine. The restrictions may change when enough safety data become available"
      },
      {
        "created_by": "1",
        "question": "Where does COVID-19 vaccination take place?",
        "answer":
            "• This will be in health facilities, designated clinics, and outreach points in districts and communities."
      },
      {
        "created_by": "1",
        "question": "What should be done in case of any adverse event?",
        "answer":
            "If anyone has any side effect after vaccination, report to the nearest health facility."
      },
      {
        "created_by": "1",
        "question": "What should you do to prevent COVID-19?",
        "answer":
            "• Wear face masks to cover your nose, mouth, and chin\n• Wash your hands with soap under running water regularly\n• Observe physical distancing protocol (of at least 1 meter apart from the nearest person)\n• Observe coughing and sneezing etiquette\n• Get vaccinated against COVID-19."
      },
      {
        "created_by": "1",
        "question": "Facts to remember:",
        "answer":
            "• The vaccination will be given to all persons 16 years or 18 years and above, depending on the type of vaccine, except  pregnant women\n• The COVD-19 is safe, effective and free. It will give you additional protection\n• Vaccination will take place in health centers and a number of immunization posts set up in schools, markets, churches, bus stations and neighbourhoods across the nation to immunize all eligible people.\n• If you have any side effect after vaccination, report to the nearest health facility. If you do not need medical care, you should still report to the health facility. You can also report using the Med Safety App which is freely available on Google Play and App Store\n• Take along your COVID-19 vaccination card and any National ID card. Ensure you eat before going for your vaccination \n• Remember, COVID-19 vaccine is in addition to the existing protocols\n• Continue to wear face mask, frequently wash hands with soap under running water, use alcohol-based hand sanitizer and ensure physical distancing."
      },
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        leading: const BackButton(
          color: Colors.black,
        ),
        title: Text(
          'Basic Information',
          style: TextStyle(
              fontWeight: FontWeight.w700,
              fontFamily: 'Lato',
              fontSize: 27.sp,
              color: const Color.fromRGBO(85, 80, 80, 0.98)),
        ),
        elevation: 0,
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            children: [
              ExpansionPanelList(
                animationDuration: const Duration(milliseconds: 1000),
                expansionCallback: (int index, bool isExpanded) {
                  if (kDebugMode) {
                    print('before: ${info[index]['created_by']}');
                  }
                  setState(() {
                    info[index]['created_by'] = !isExpanded ? '2' : '1';
                  });
                  if (kDebugMode) {
                    print('after: ${info[index]['created_by']}');
                  }
                },
                expandedHeaderPadding: const EdgeInsets.only(bottom: 1),
                children: info.map<ExpansionPanel>((e) {
                  return ExpansionPanel(
                      headerBuilder: (BuildContext context, bool isExpanded) {
                        return Padding(
                          padding: const EdgeInsets.all(8.0),
                          child: Text(
                            '${e['question']}',
                            style: const TextStyle(
                                fontFamily: "Lato",
                                fontWeight: FontWeight.w700,
                                fontSize: 18),
                            overflow: TextOverflow.visible,
                            textDirection: TextDirection.ltr,
                          ),
                        );
                      },
                      canTapOnHeader: true,
                      body: Padding(
                        padding: const EdgeInsets.all(15.0),
                        child: Text(
                          '${e['answer']}',
                          style: TextStyle(
                              color: Colors.black54,
                              fontFamily: 'Lato',
                              fontSize: 18.sp,
                              fontWeight: FontWeight.w400),
                        ),
                      ),
                      isExpanded: e['created_by'] == '1' ? false : true
                      // isExpanded: e['created_by'] == '1'? false: true
                      );
                }).toList(),
              ),
              const SizedBox(
                height: 22,
              ),
              Text(
                "Remember, Ghana needs you. Stop the  spread, get vaccinated against COVID-19  for additional protection.",
                textAlign: TextAlign.center,
                style: TextStyle(
                    fontFamily: 'Lato',
                    fontStyle: FontStyle.italic,
                    fontSize: 20.sp),
              ),
              const SizedBox(
                height: 18,
              ),
              Text(
                "Designed and produced by Health Promotion Division Ghana Health Service",
                textAlign: TextAlign.center,
                style: TextStyle(
                    fontFamily: 'Lato',
                    fontStyle: FontStyle.normal,
                    fontSize: 20.sp,
                    color: Colors.lightGreen),
              ),
              const SizedBox(
                height: 10,
              ),
            ],
          ),
        ),
      ),
    );
  }
}
