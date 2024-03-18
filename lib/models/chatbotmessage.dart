


class chatbotmessages{
  String message;
  bool isSender;
  DateTime? date;

  chatbotmessages({
    required this.message, 
    required this.isSender,
    this.date,
    });

factory chatbotmessages.fromJson(Map<String, dynamic> json) {
    return chatbotmessages(
      message: json['message'],
      isSender: json['isSender'],
      date: json['date']
    );
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['message'] = message;
    data['isSender'] = isSender;
    data['date'] = date;
    return data;
  }

  
}