import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

class Meditation_Card extends StatelessWidget {
  final String title;
  final String image;
  final Color color;
  const Meditation_Card({super.key,required this.title, required this.image,required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(right: 5),
      //color: color,
      padding: const EdgeInsets.only(top:20),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(15),
        color: color
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Container(
            height: 120,
            width: 150,
            decoration: BoxDecoration(
               borderRadius: BorderRadius.circular(15),
              color: color,
              image: DecorationImage(
                image: AssetImage(image),
                fit: BoxFit.cover
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
                color: Colors.white,
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