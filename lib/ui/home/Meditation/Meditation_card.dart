import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

class Meditation_Card extends StatelessWidget {
  final String title;
  final String image;
  const Meditation_Card({super.key,required this.title, required this.image});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(right: 5),
      child: Column(
        children: [
          Container(
            height: 120,
            width: 120,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(20),
              color: Color.fromARGB(255, 201, 138, 214),
              image: DecorationImage(
                image: AssetImage(image),
                fit: BoxFit.contain
              )
            ),
            // child: SvgPicture.asset(
            //   image,
            //   fit: BoxFit.cover,
            //   ),
            child:Padding(
              padding: const EdgeInsets.only(
                top: 70,
                left: 5
              ),
              child: Text(
              title, 
              style: const TextStyle(
              fontFamily: 'Poppins',
              fontSize: 18,
              fontWeight: FontWeight.w600
                        ),
              textAlign: TextAlign.center,
                        ),
            ) ,
          ),
          const SizedBox(height: 10,),
          
        ],
      ),
    );
  }
}