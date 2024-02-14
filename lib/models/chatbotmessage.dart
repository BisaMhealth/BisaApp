


class chatbotmessages{
  String message;
  bool isSender;

  chatbotmessages({
    required this.message, 
    required this.isSender
    });

factory chatbotmessages.fromJson(Map<String, dynamic> json) {
    return chatbotmessages(
      message: json['message'],
      isSender: json['isSender']
    );
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['message'] = message;
    data['isSender'] = isSender;
    return data;
  }

  
}