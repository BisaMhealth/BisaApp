
import 'package:flutter/material.dart';

class WaterQuantity extends StatelessWidget {
  final quantity;
  final image;
  const WaterQuantity({super.key,this.quantity,this.image});

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        children: [
          Container(
            width: 70,
            height: 70,
            decoration: BoxDecoration(
              image: DecorationImage(
                image: AssetImage(image),
                fit: BoxFit.fill
              )
            )
          ),
          Text(
            "$quantity ml",
            style: const TextStyle(
            color: Colors.black,
            fontSize: 15,
            fontWeight: FontWeight.bold
          ),),
        ],
      ),
    );
  }
}