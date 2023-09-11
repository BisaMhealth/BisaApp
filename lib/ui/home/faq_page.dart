import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class FaqPage extends StatefulWidget {
  const FaqPage({Key? key}) : super(key: key);

  @override
  FaqPageState createState() => FaqPageState();
}

class FaqPageState extends State<FaqPage> {
  var faqs = [];
  @override
  void initState() {
    super.initState();
    faqs = [
      {
        "faq_id": 1,
        "faq_cat_id": 1,
        "question":
            "Question: Will a person with Type 2 diabetes under control end up with the need for insulin?",
        "answer":
            "As you may have read, Type 2 diabetes is a progressive disease. Will you require insulin? That all depends on individual factors that includes, among many other factors, weight, exercise, genetics, hormones and beta-cells, those cells that produce insulin in your pancreas. Research shows that managing your diabetes early in the disease process can have big payoffs in later years. Joining a support group for people with diabetes can be helpful in keeping you going in your health quest. Following up with your health care team regularly and keeping abreast on the new developments in diabetes management can also benefit you",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:14",
        "updated_at": null
      },
      {
        "faq_id": 2,
        "faq_cat_id": 1,
        "question": "Is there a genetic factor to strokes?",
        "answer":
            "Yes. There are genetic factors. There are some people that are born with certain genes that predispose them to stroke. One such condition would be CADASIL (cerebral autosomal-dominant arteriopathy with subcortical infarcts and leukoencephalopathy). If you are interested, I am sure you can learn more about this condition from the Web. Some people are born with genetic conditions that predispose them to clotting. This in turn may increase their stroke risk. Finally, if you have a strong family history of high blood pressure, diabetes, high cholesterol or any of the major modifiable risk factors for stroke, you may also be at higher risk because of this. However, these particular conditions are very much treatable and you certainly can do something about them to lower your risk.\n",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": null
      },
      {
        "faq_id": 3,
        "faq_cat_id": 1,
        "question":
            "Question: What medications are best for the treatment of asthma? What are their side effects?",
        "answer":
            "Albuterol is usually the primary \"rescue\" or short-term medicine that is used to help acute asthma symptoms, such as coughing or wheezing. When a patient needs to use albuterol to relieve daytime symptoms more than twice per week, however, it usually reflects the need to use daily \"controller\" or anti-inflammatory medications. Many people are concerned about possible side effects of inhaled steroids, which are the largest group of \"controller\" medications available. When used in low- to medium-doses, however, inhaled steroids are very safe, even used on a daily basis for years. They are much safer than either multiple courses of oral steroids OR uncontrolled/undertreated asthma symptoms.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:43:15"
      },
      {
        "faq_id": 4,
        "faq_cat_id": 1,
        "question": "Question: Is breast cancer inherited?",
        "answer":
            "Most women who get breast cancer do not have any family history of breast cancer. Just because a family member had breast cancer does not always mean that you will get breast cancer.We do know that there are some genes associated with a known increased risk of breast cancer. These are BRCA 1 (breast cancer 1, early onset human tumor suppressor gene) and BRCA 2 (breast cancer type 2, susceptibility protein). Only 10 percent of women with breast cancer have these inherited genes. These women usually get breast cancer at a young age and have multiple family members with breast or ovarian cancer.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:43:59"
      },
      {
        "faq_id": 5,
        "faq_cat_id": 1,
        "question": "What alternative therapies can be used to treat migraine?",
        "answer":
            "The most common non-medical treatment for headache is relaxation training. Many studies have demonstrated that relaxation training is equally as effective for treatment of migraine as medications. This training takes more time and effort than using a medication, but once learned, it is free, can be used whenever the patient wishes, and has no negative side effects.\nExercise has been shown to reduce headache risk and psychotherapy often helps patients learn to identify and manage headache-triggering emotional stress.\n",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:51:24"
      },
      {
        "faq_id": 6,
        "faq_cat_id": 1,
        "question": "How long does the flu last?\n",
        "answer":
            "This varies to some extent with the strain each year, and obviously goes on longer if complications develop. But the typical course of the flu is seven to ten days. While you're waiting for the virus to pass, prevent it from getting worse by drinking plenty of fluids, washing hands frequently, and eating vitamin D-fortified foods like orange juice and yogurt.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:52:16"
      },
      {
        "faq_id": 7,
        "faq_cat_id": 1,
        "question": "When do you ovulate?",
        "answer":
            "If you have a period once a month, you're ovulating once a month.The time of ovulation is usually in the middle of that cycle, approximately two weeks after the day of your last period.The average menstrual cycle is between 25 and 35 days, but if you have longer intervals between periods, every two months, that means you're only ovulating once every two months. If that's the case for you, an at-home ovulation test can help you pinpoint exactly when ovulation occurs. These tests typically have strips that can detect hormonal changes in the urine one to two days before ovulation. They can help you get a pretty reliable handle on the one or two days in your cycle that you're going to be ovulating, which is especially helpful if you're trying to get pregnant.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:53:10"
      },
      {
        "faq_id": 8,
        "faq_cat_id": 1,
        "question": "What do you recommend for premature ejaculation ?\n",
        "answer":
            "Premature ejaculation can have physical or psychological causes. So you must first consult a urologist who will look for a physical cause and if this is not the case then you can see a sexologist who can see with you the psychological aspect.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:53:55"
      },
      {
        "faq_id": 9,
        "faq_cat_id": 1,
        "question": "What can i do to lose weight?\n",
        "answer":
            "Weight depends on the balance between food intake and energy expenditure. Weight decreases when you lose more than you gain. For some it is easier to reduce intakes (diets: avoid high-calorie foods, ie sugar and fat in general. Drink a lot (water and not too cold!). easier to increase losses by maintaining the contributions: sport! (Cardio, endurance, degreasing ... regular and sustained.) Some can act on both aspects and that's even better!",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:54:41"
      },
      {
        "faq_id": 10,
        "faq_cat_id": 1,
        "question":
            "I very often suffer from bloating. What do you recommend ?",
        "answer":
            "The effective management of bloating depends on their cause. However, avoid any fermented product (cheese, curd ...), yeast (bread, cake ...). You should also drink water regularly. Play sports. You can also do probiotic cures. (See with a pharmacist). Well, I hope it will work, otherwise see a hepato-gastroenterologist anyway.",
        "created_by": "1",
        "created_at": "2020-04-27 10:46:45",
        "updated_at": "2020-04-27 12:55:26"
      },
      // {
      //   "faq_id": 11,
      //   "faq_cat_id": 2,
      //   "question": "Question: What is COVID-19?",
      //   "answer": "COVID-19 are a large family of viruses that are known to cause illness ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS) and Severe Acute Respiratory Syndrome (SARS).",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 12:56:49"
      // },
      // {
      //   "faq_id": 12,
      //   "faq_cat_id": 2,
      //   "question": "Question: What is a novel COVID-19?\n",
      //   "answer": "A novel COVID-19 is a new strain of COVID-19 that has not been previously identified in humans. ",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 12:57:32"
      // },
      // {
      //   "faq_id": 13,
      //   "faq_cat_id": 2,
      //   "question": "Can humans become infected with COVID-19 of animal source?",
      //   "answer": "Detailed investigations found that SARS-CoV was transmitted from civet cats to humans in China in 2002 and MERS-CoV from dromedary camels to humans in Saudi Arabia in 2012. Several known COVID-19 are circulating in animals that have not yet infected humans.  As surveillance improves around the world, more COVID-19 are likely to be identified.",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 12:58:20"
      // },
      // {
      //   "faq_id": 14,
      //   "faq_cat_id": 2,
      //   "question": "What are the symptoms of someone infected with COVID-19?\n",
      //   "answer": "It depends on the virus, but common signs include respiratory symptoms, fever, cough, shortness of breath, and breathing difficulties. In more severe cases, infection can cause pneumonia, severe acute respiratory syndrome, kidney failure and even death. ",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 12:59:05"
      // },
      // {
      //   "faq_id": 15,
      //   "faq_cat_id": 2,
      //   "question": "How does COVID-19 spread?",
      //   "answer": "People can catch COVID-19 from others who have the virus. The disease can spread from person to person through small droplets from the nose or mouth which are spread when a person with COVID-19 coughs or exhales. These droplets land on objects and surfaces around the person. Other people then catch COVID-19 by touching these objects or surfaces, then touching their eyes, nose or mouth. People can also catch COVID-19 if they breathe in droplets from a person with COVID-19 who coughs out or exhales droplets. This is why it is important to stay more than 1 meter (3 feet) away from a person who is sick.\nWHO is assessing ongoing research on the ways COVID-19 is spread and will continue to share updated findings.\n",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:00:17"
      // },
      // {
      //   "faq_id": 16,
      //   "faq_cat_id": 2,
      //   "question": "Can the virus that causes COVID-19 be transmitted through the air?\n",
      //   "answer": "Studies to date suggest that the virus that causes COVID-19 is mainly transmitted through contact with respiratory droplets rather than through the air.  See previous answer on “How does COVID-19 spread?”",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:01:16"
      // },
      // {
      //   "faq_id": 17,
      //   "faq_cat_id": 2,
      //   "question": "Can CoVID-19 be caught from a person who has no symptoms?\n",
      //   "answer": "The main way the disease spreads is through respiratory droplets expelled by someone who is coughing. The risk of catching COVID-19 from someone with no symptoms at all is very low. However, many people with COVID-19 experience only mild symptoms. This is particularly true at the early stages of the disease. It is therefore possible to catch COVID-19 from someone who has, for example, just a mild cough and does not feel ill.  WHO is assessing ongoing research on the period of transmission of COVID-19 and will continue to share updated findings. ",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:02:12"
      // },
      // {
      //   "faq_id": 18,
      //   "faq_cat_id": 2,
      //   "question": "Can I catch COVID-19 from the feces of someone with the disease?\n",
      //   "answer": "The risk of catching COVID-19 from the feces of an infected person appears to be low. While initial investigations suggest the virus may be present in feces in some cases, spread through this route is not a main feature of the outbreak. WHO is assessing ongoing research on the ways COVID-19 is spread and will continue to share new findings. Because this is a risk, however, it is another reason to clean hands regularly, after using the bathroom and before eating.",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:03:29"
      // },
      // {
      //   "faq_id": 19,
      //   "faq_cat_id": 2,
      //   "question": "Can COVID-19 be transmitted from person to person?\n",
      //   "answer": "Yes, some COVID-19 can be transmitted from person to person, usually after close contact with an infected patient, for example, in a household workplace, or health care centre.",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:07:31"
      // },
      // {
      //   "faq_id": 20,
      //   "faq_cat_id": 2,
      //   "question": "How long is the incubation period for COVID-19?",
      //   "answer": "The “incubation period” means the time between catching the virus and beginning to have symptoms of the disease. Most estimates of the incubation period for COVID-19 range from 1-14 days, most commonly around five days. These estimates will be updated as more data become available.\n",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:08:26"
      // },
      // {
      //   "faq_id": 21,
      //   "faq_cat_id": 2,
      //   "question": "Who is at risk of developing severe illness?\n",
      //   "answer": "While we are still learning about how COVID-2019 affects people, older persons and persons with pre-existing medical conditions (such as high blood pressure, heart disease, lung disease, cancer or diabetes)  appear to develop serious illness more often than others. ",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:08:58"
      // },
      // {
      //   "faq_id": 22,
      //   "faq_cat_id": 2,
      //   "question": "Are health workers at risk from a COVID-19?",
      //   "answer": "Yes, they can be, as health care workers come into contact with patients more often than the general public WHO recommends that health care workers consistently apply appropriate infection prevention and control measures.\n",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:10:08"
      // },
      // {
      //   "faq_id": 23,
      //   "faq_cat_id": 2,
      //   "question": "Question: Should I worry about COVID-19?\n",
      //   "answer": "Illness due to COVID-19 infection is generally mild, especially for children and young adults. However, it can cause serious illness: about 1 in every 5 people who catch it need hospital care. It is therefore quite normal for people to worry about how the COVID-19 outbreak will affect them and their loved ones.We can channel our concerns into actions to protect ourselves, our loved ones and our communities. First and foremost among these actions is regular and thorough hand-washing and good respiratory hygiene. Secondly, keep informed and follow the advice of the local health authorities including any restrictions put in place on travel, movement and gatherings.",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:10:56"
      // },
      // {
      //   "faq_id": 24,
      //   "faq_cat_id": 2,
      //   "question": "Question: What is the country doing to prevent the virus from entering the country?",
      //   "answer": "Intense surveillance for suspected severe acute respiratory infections to be picked and tested for confirmation.Public Health preparedness plans have been prepared and ready to be activated in the event of a pandemic in line with the International Health Regulations (2005).Risk communication activities have been planned and aspects of it has started such as granting radio and TV interviews and port education on the virus.\n",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:12:20"
      // },
      // {
      //   "faq_id": 25,
      //   "faq_cat_id": 2,
      //   "question": "Are there any medicines or therapies that can prevent or cure COVID-19?",
      //   "answer": " While some western, traditional or home remedies may provide comfort and alleviate symptoms of COVID-19, there is no evidence that current medicine can prevent or cure the disease. WHO does not recommend self-medication with any medicines, including antibiotics, as a prevention or cure for COVID-19. However, there are several ongoing clinical trials that include both western and traditional medicines. WHO will continue to provide updated information as soon as clinical findings are available.",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:13:19"
      // },
      // {
      //   "faq_id": 26,
      //   "faq_cat_id": 2,
      //   "question": "Is there a vaccine, drug or treatment for COVID-19?\n",
      //   "answer": "Not yet. To date, there is no vaccine and no specific antiviral medicine to prevent or treat COVID-2019. However, those affected should receive care to relieve symptoms. People with serious illness should be hospitalized. Most patients recover thanks to supportive care.\nPossible vaccines and some specific drug treatments are under investigation. They are being tested through clinical trials. WHO is coordinating efforts to develop vaccines and medicines to prevent and treat COVID-19.\nThe most effective ways to protect yourself and others against COVID-19 are to frequently clean your hands, cover your cough with the bend of elbow or tissue, and maintain a distance of at least 1 meter (3 feet) from people who are coughing or sneezing\n\n",
      //   "created_by": "1",
      //   "created_at": "2020-04-27 10:46:45",
      //   "updated_at": "2020-04-27 13:15:04"
      // }
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
          'Popular Questions',
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
          child: ExpansionPanelList(
            animationDuration: const Duration(milliseconds: 1000),
            expansionCallback: (int index, bool isExpanded) {
              if (kDebugMode) {
                print('before: ${faqs[index]['created_by']}');
              }
              setState(() {
                faqs[index]['created_by'] = !isExpanded ? '2' : '1';
              });
              if (kDebugMode) {
                print('after: ${faqs[index]['created_by']}');
              }
            },
            expandedHeaderPadding: const EdgeInsets.only(bottom: 1),
            children: faqs.map<ExpansionPanel>((e) {
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
          // child: Column(
          //   crossAxisAlignment: CrossAxisAlignment.start,
          //   children: [
          //     // SizedBox(height: 0.16.sh,),
          //     Column(
          //       crossAxisAlignment: CrossAxisAlignment.start,
          //       children: faqs.map((e){
          //         return InkWell(
          //           onTap: (){
          //             Navigator.push(
          //               context,
          //               PageAnimationTransition(type:PageAnimationTransitionType.rightToLeftWithFade,child: FaqDetails(content: e) )
          //             );
          //           },
          //           child: Padding(
          //             padding: const EdgeInsets.all(8.0),
          //             child: Text('${e['question']}',
          //               style: TextStyle(
          //                 color: Colors.black,
          //                 fontFamily: 'Lato',
          //                 fontSize: 18.sp,
          //                 fontWeight: FontWeight.w400
          //               ),
          //             ),
          //           ),
          //         );
          //       }).toList(),
          //     ),
          //   ],
          // ),
        ),
      ),
    );
  }
}
