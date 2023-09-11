import 'package:flutter/material.dart';

class PlanCard extends StatelessWidget {
  final String image, title, desc;
  final Color color;
  const PlanCard(
      {Key? key,
      required this.image,
      required this.title,
      required this.desc,
      required this.color})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(6.0),
      child: Card(
        color: Colors.white,
        elevation: 5,
        child: Row(
          children: [
            Image.asset('assets/imgs/$image'),
            Expanded(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  // mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      title,
                      style: TextStyle(
                          fontFamily: 'Lato',
                          fontWeight: FontWeight.w400,
                          fontSize: 23,
                          color: color),
                    ),
                    const SizedBox(height: 10),
                    Text(
                      desc,
                      style: const TextStyle(
                          fontFamily: 'Lato',
                          fontWeight: FontWeight.w400,
                          fontSize: 14,
                          color: Colors.black),
                      maxLines: 4,
                      overflow: TextOverflow.clip,
                    ),
                    const SizedBox(height: 10),
                    Row(
                      children: [
                        const Spacer(),
                        Container(
                          width: 110,
                          height: 40,
                          decoration: BoxDecoration(
                            color: color,
                            borderRadius: BorderRadius.circular(50),
                          ),
                          child: const Center(
                            child: Text(
                              'Purchase',
                              style: TextStyle(
                                  fontFamily: 'Lato',
                                  fontSize: 15,
                                  fontWeight: FontWeight.w600,
                                  color: Colors.white),
                            ),
                          ),
                        ),
                      ],
                    )
                  ],
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
