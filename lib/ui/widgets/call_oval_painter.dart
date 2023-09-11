import 'dart:ui' as ui;

//Add this CustomPaint widget to the Widget Tree

//Copy this CustomPainter code to the Bottom of the File
import 'package:flutter/material.dart';

class CallOvalPainter extends CustomPainter {
    @override
    void paint(Canvas canvas, Size size) {
            
Path path_0 = Path();
    path_0.moveTo(size.width*0.7319482,size.height*0.4233196);
    path_0.cubicTo(size.width*0.8479718,size.height*0.3917722,size.width*0.9570091,size.height*0.3546139,size.width*0.9996636,size.height*0.3055614);
    path_0.lineTo(size.width*1.072727,size.height*0.2215190);
    path_0.lineTo(size.width*1.072727,size.height*0.8417722);
    path_0.lineTo(size.width*1.004500,size.height*0.7648323);
    path_0.cubicTo(size.width*0.9590182,size.height*0.7135411,size.width*0.8401645,size.height*0.6759525,size.width*0.7180091,size.height*0.6431899);
    path_0.cubicTo(size.width*0.4833791,size.height*0.5802595,size.width*0.4880264,size.height*0.4896456,size.width*0.7319482,size.height*0.4233196);
    path_0.close();

Paint paint0Fill = Paint()..style=PaintingStyle.fill;
paint0Fill.color = Colors.white;
canvas.drawPath(path_0,paint0Fill);

Path path_1 = Path();
    path_1.moveTo(size.width*0.8000000,size.height*0.5917722);
    path_1.cubicTo(size.width*0.7778409,size.height*0.5917722,size.width*0.7566409,size.height*0.5902690,size.width*0.7363991,size.height*0.5872658);
    path_1.cubicTo(size.width*0.7161573,size.height*0.5842627,size.width*0.6987391,size.height*0.5802215,size.width*0.6841445,size.height*0.5751392);
    path_1.cubicTo(size.width*0.6695491,size.height*0.5700601,size.width*0.6579364,size.height*0.5639968,size.width*0.6493073,size.height*0.5569494);
    path_1.cubicTo(size.width*0.6406782,size.height*0.5499051,size.width*0.6363636,size.height*0.5425253,size.width*0.6363636,size.height*0.5348101);
    path_1.cubicTo(size.width*0.6363636,size.height*0.5270949,size.width*0.6406782,size.height*0.5197152,size.width*0.6493073,size.height*0.5126709);
    path_1.cubicTo(size.width*0.6579364,size.height*0.5056234,size.width*0.6695491,size.height*0.4995601,size.width*0.6841445,size.height*0.4944810);
    path_1.cubicTo(size.width*0.6987391,size.height*0.4893987,size.width*0.7161573,size.height*0.4853576,size.width*0.7363991,size.height*0.4823544);
    path_1.cubicTo(size.width*0.7566409,size.height*0.4793513,size.width*0.7778409,size.height*0.4778481,size.width*0.8000000,size.height*0.4778481);
    path_1.cubicTo(size.width*0.8221591,size.height*0.4778481,size.width*0.8433591,size.height*0.4793513,size.width*0.8636009,size.height*0.4823544);
    path_1.cubicTo(size.width*0.8838427,size.height*0.4853576,size.width*0.9012609,size.height*0.4893987,size.width*0.9158545,size.height*0.4944810);
    path_1.cubicTo(size.width*0.9304545,size.height*0.4995601,size.width*0.9420636,size.height*0.5056234,size.width*0.9506909,size.height*0.5126709);
    path_1.cubicTo(size.width*0.9593182,size.height*0.5197152,size.width*0.9636364,size.height*0.5270949,size.width*0.9636364,size.height*0.5348101);
    path_1.cubicTo(size.width*0.9636364,size.height*0.5425253,size.width*0.9593182,size.height*0.5499051,size.width*0.9506909,size.height*0.5569494);
    path_1.cubicTo(size.width*0.9420636,size.height*0.5639968,size.width*0.9304545,size.height*0.5700601,size.width*0.9158545,size.height*0.5751392);
    path_1.cubicTo(size.width*0.9012609,size.height*0.5802215,size.width*0.8838427,size.height*0.5842627,size.width*0.8636009,size.height*0.5872658);
    path_1.cubicTo(size.width*0.8433591,size.height*0.5902690,size.width*0.8221591,size.height*0.5917722,size.width*0.8000000,size.height*0.5917722);
    path_1.close();
    path_1.moveTo(size.width*0.8818182,size.height*0.5098892);
    path_1.cubicTo(size.width*0.8818182,size.height*0.5089241,size.width*0.8808064,size.height*0.5080918,size.width*0.8787818,size.height*0.5073861);
    path_1.cubicTo(size.width*0.8767582,size.height*0.5066804,size.width*0.8743609,size.height*0.5063291,size.width*0.8715909,size.height*0.5063291);
    path_1.lineTo(size.width*0.8102273,size.height*0.5063291);
    path_1.cubicTo(size.width*0.8074573,size.height*0.5063291,size.width*0.8050600,size.height*0.5066804,size.width*0.8030364,size.height*0.5073861);
    path_1.cubicTo(size.width*0.8010118,size.height*0.5080918,size.width*0.8000000,size.height*0.5089241,size.width*0.8000000,size.height*0.5098892);
    path_1.cubicTo(size.width*0.8000000,size.height*0.5108544,size.width*0.8010118,size.height*0.5116867,size.width*0.8030364,size.height*0.5123924);
    path_1.cubicTo(size.width*0.8050600,size.height*0.5130981,size.width*0.8074573,size.height*0.5134494,size.width*0.8102273,size.height*0.5134494);
    path_1.lineTo(size.width*0.8453836,size.height*0.5134494);
    path_1.lineTo(size.width*0.8031964,size.height*0.5281361);
    path_1.cubicTo(size.width*0.8010655,size.height*0.5288766,size.width*0.8000000,size.height*0.5298038,size.width*0.8000000,size.height*0.5309177);
    path_1.cubicTo(size.width*0.8000000,size.height*0.5320285,size.width*0.8011182,size.height*0.5329557,size.width*0.8033555,size.height*0.5336962);
    path_1.cubicTo(size.width*0.8055927,size.height*0.5344399,size.width*0.8082564,size.height*0.5348101,size.width*0.8113455,size.height*0.5348101);
    path_1.cubicTo(size.width*0.8144355,size.height*0.5348101,size.width*0.8170455,size.height*0.5344399,size.width*0.8191764,size.height*0.5336962);
    path_1.lineTo(size.width*0.8613636,size.height*0.5190127);
    path_1.lineTo(size.width*0.8613636,size.height*0.5312500);
    path_1.cubicTo(size.width*0.8613636,size.height*0.5322152,size.width*0.8623755,size.height*0.5330475,size.width*0.8644000,size.height*0.5337532);
    path_1.cubicTo(size.width*0.8664236,size.height*0.5344589,size.width*0.8688209,size.height*0.5348101,size.width*0.8715909,size.height*0.5348101);
    path_1.cubicTo(size.width*0.8743609,size.height*0.5348101,size.width*0.8767582,size.height*0.5344589,size.width*0.8787818,size.height*0.5337532);
    path_1.cubicTo(size.width*0.8808064,size.height*0.5330475,size.width*0.8818182,size.height*0.5322152,size.width*0.8818182,size.height*0.5312500);
    path_1.lineTo(size.width*0.8818182,size.height*0.5098892);
    path_1.close();
    path_1.moveTo(size.width*0.8818182,size.height*0.5490506);
    path_1.lineTo(size.width*0.8409091,size.height*0.5490506);
    path_1.lineTo(size.width*0.8204545,size.height*0.5561709);
    path_1.cubicTo(size.width*0.8068182,size.height*0.5549114,size.width*0.7906782,size.height*0.5510158,size.width*0.7720345,size.height*0.5444905);
    path_1.cubicTo(size.width*0.7533909,size.height*0.5379620,size.width*0.7422582,size.height*0.5323639,size.width*0.7386364,size.height*0.5276899);
    path_1.lineTo(size.width*0.7590909,size.height*0.5205696);
    path_1.lineTo(size.width*0.7590909,size.height*0.5063291);
    path_1.cubicTo(size.width*0.7539773,size.height*0.5038070,size.width*0.7484373,size.height*0.5018418,size.width*0.7424718,size.height*0.5004335);
    path_1.cubicTo(size.width*0.7365055,size.height*0.4990222,size.width*0.7320309,size.height*0.4988386,size.width*0.7290482,size.height*0.4998766);
    path_1.lineTo(size.width*0.7076345,size.height*0.5073291);
    path_1.cubicTo(size.width*0.6959164,size.height*0.5114082,size.width*0.6942118,size.height*0.5178259,size.width*0.7025209,size.height*0.5265759);
    path_1.cubicTo(size.width*0.7108309,size.height*0.5353291,size.width*0.7268109,size.height*0.5438228,size.width*0.7504618,size.height*0.5520538);
    path_1.cubicTo(size.width*0.7741118,size.height*0.5602880,size.width*0.7985082,size.height*0.5658513,size.width*0.8236509,size.height*0.5687437);
    path_1.cubicTo(size.width*0.8487927,size.height*0.5716361,size.width*0.8672227,size.height*0.5710411,size.width*0.8789418,size.height*0.5669620);
    path_1.lineTo(size.width*0.9003555,size.height*0.5595095);
    path_1.cubicTo(size.width*0.9033382,size.height*0.5584715,size.width*0.9028591,size.height*0.5567658,size.width*0.8989173,size.height*0.5543924);
    path_1.cubicTo(size.width*0.8949755,size.height*0.5520158,size.width*0.8892755,size.height*0.5502373,size.width*0.8818182,size.height*0.5490506);
    path_1.close();

Paint paint1Fill = Paint()..style=PaintingStyle.fill;
paint1Fill.shader = ui.Gradient.linear(Offset(size.width*0.8000000,size.height*0.4778481), Offset(size.width*0.8000000,size.height*0.5917722), [const Color(0xff57C389).withOpacity(1),const Color(0xff78DE7B).withOpacity(1),const Color(0xff8BE26D).withOpacity(1)], [0,0.421875,1]);
canvas.drawPath(path_1,paint1Fill);

}

@override
bool shouldRepaint(covariant CustomPainter oldDelegate) {
    return true;
}
}