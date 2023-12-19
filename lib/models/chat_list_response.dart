///
/// Code generated by jsonToDartModel https://ashamp.github.io/jsonToDartModel/
///
class ChatListResponseDataLastresponse {
/*
{
  "id": 1,
  "question_id": 3,
  "response": "l am feeling pains",
  "asked_on": "2021-09-15 14:38:30",
  "responded_by": 1,
  "patient_id": 1,
  "doctor_id": 4,
  "media_type": "Image",
  "has_file": 1,
  "media_url": "https://res.cloudinary.com/dzh1cgxjd/image/upload/v1631716713/xkmkalcl4zv7wolrzwzl.jpg",
  "mask": "94675d82-8926-484f-b934-cd401348fbc7",
  "created_at": "2021-09-15T14:38:34.000000Z",
  "updated_at": "2021-09-15T14:38:34.000000Z",
  "read_status": 0
} 
*/

  int? id;
  int? questionId;
  String? response;
  String? askedOn;
  int? respondedBy;
  int? patientId;
  int? doctorId;
  String? mediaType;
  int? hasFile;
  String? mediaUrl;
  String? mask;
  String? createdAt;
  String? updatedAt;
  int? readStatus;

  ChatListResponseDataLastresponse({
    this.id,
    this.questionId,
    this.response,
    this.askedOn,
    this.respondedBy,
    this.patientId,
    this.doctorId,
    this.mediaType,
    this.hasFile,
    this.mediaUrl,
    this.mask,
    this.createdAt,
    this.updatedAt,
    this.readStatus,
  });
  ChatListResponseDataLastresponse.fromJson(Map<String, dynamic> json) {
    id = json["id"]?.toInt();
    questionId = json["question_id"]?.toInt();
    response = json["response"]?.toString();
    askedOn = json["asked_on"]?.toString();
    respondedBy = json["responded_by"]?.toInt();
    patientId = json["patient_id"]?.toInt();
    doctorId = json["doctor_id"]?.toInt();
    mediaType = json["media_type"]?.toString();
    hasFile = json["has_file"]?.toInt();
    mediaUrl = json["media_url"]?.toString();
    mask = json["mask"]?.toString();
    createdAt = json["created_at"]?.toString();
    updatedAt = json["updated_at"]?.toString();
    readStatus = json["read_status"]?.toInt();
  }
  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data["id"] = id;
    data["question_id"] = questionId;
    data["response"] = response;
    data["asked_on"] = askedOn;
    data["responded_by"] = respondedBy;
    data["patient_id"] = patientId;
    data["doctor_id"] = doctorId;
    data["media_type"] = mediaType;
    data["has_file"] = hasFile;
    data["media_url"] = mediaUrl;
    data["mask"] = mask;
    data["created_at"] = createdAt;
    data["updated_at"] = updatedAt;
    data["read_status"] = readStatus;
    return data;
  }
}

class ChatListResponseData {
/*
{
  "id": 3,
  "patient_id": 7,
  "doctor_id": 2,
  "asked_on": "2021-09-15 16:37:17",
  "responded_on": "2021-09-15 16:17:17",
  "question": "hello Doc",
  "question_category_id": 1,
  "state": 0,
  "read_status": 0,
  "media_type": "none",
  "has_file": 0,
  "media_url": "https://cloundinary",
  "mask": "946787f8-e632-4745-b811-c7914e09ce0a",
  "created_at": "2021-09-15T16:37:17.000000Z",
  "updated_at": "2021-09-15T16:37:17.000000Z",
  "lastresponse": {
    "id": 1,
    "question_id": 3,
    "response": "l am feeling pains",
    "asked_on": "2021-09-15 14:38:30",
    "responded_by": 1,
    "patient_id": 1,
    "doctor_id": 4,
    "media_type": "Image",
    "has_file": 1,
    "media_url": "https://res.cloudinary.com/dzh1cgxjd/image/upload/v1631716713/xkmkalcl4zv7wolrzwzl.jpg",
    "mask": "94675d82-8926-484f-b934-cd401348fbc7",
    "created_at": "2021-09-15T14:38:34.000000Z",
    "updated_at": "2021-09-15T14:38:34.000000Z",
    "read_status": 0
  }
} 
*/

  int? id;
  int? patientId;
  int? doctorId;
  String? askedOn;
  String? respondedOn;
  String? question;
  int? questionCategoryId;
  String? category;
  int? state;
  int? readStatus;
  String? mediaType;
  int? hasFile;
  String? mediaUrl;
  String? mask;
  String? createdAt;
  String? updatedAt;
  ChatListResponseDataLastresponse? lastresponse;

  ChatListResponseData({
    this.id,
    this.patientId,
    this.doctorId,
    this.askedOn,
    this.respondedOn,
    this.question,
    this.questionCategoryId,
    this.category,
    this.state,
    this.readStatus,
    this.mediaType,
    this.hasFile,
    this.mediaUrl,
    this.mask,
    this.createdAt,
    this.updatedAt,
    this.lastresponse,
  });
  ChatListResponseData.fromJson(Map<String, dynamic> json) {
    id = json["id"]?.toInt();
    patientId = json["patient_id"]?.toInt();
    doctorId = json["doctor_id"]?.toInt();
    askedOn = json["asked_on"]?.toString();
    respondedOn = json["responded_on"]?.toString();
    question = json["question"]?.toString();
    questionCategoryId = json["question_category_id"]?.toInt();
    category = json["category"]?.toString();
    state = json["state"]?.toInt();
    readStatus = json["read_status"]?.toInt();
    mediaType = json["media_type"]?.toString();
    hasFile = json["has_file"]?.toInt();
    mediaUrl = json["media_url"]?.toString();
    mask = json["mask"]?.toString();
    createdAt = json["created_at"]?.toString();
    updatedAt = json["updated_at"]?.toString();
    lastresponse = (json["lastresponse"] != null)
        ? ChatListResponseDataLastresponse.fromJson(json["lastresponse"])
        : null;
  }
  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data["id"] = id;
    data["patient_id"] = patientId;
    data["doctor_id"] = doctorId;
    data["asked_on"] = askedOn;
    data["responded_on"] = respondedOn;
    data["question"] = question;
    data["question_category_id"] = questionCategoryId;
    data["category"] = category;
    data["state"] = state;
    data["read_status"] = readStatus;
    data["media_type"] = mediaType;
    data["has_file"] = hasFile;
    data["media_url"] = mediaUrl;
    data["mask"] = mask;
    data["created_at"] = createdAt;
    data["updated_at"] = updatedAt;
    if (lastresponse != null) {
      data["lastresponse"] = lastresponse!.toJson();
    }
    return data;
  }
}

class ChatListResponse {
/*
{
  "code": 200,
  "status": "success",
  "message": "",
  "data": [
    {
      "id": 3,
      "patient_id": 7,
      "doctor_id": 2,
      "asked_on": "2021-09-15 16:37:17",
      "responded_on": "2021-09-15 16:17:17",
      "question": "hello Doc",
      "question_category_id": 1,
      "state": 0,
      "read_status": 0,
      "media_type": "none",
      "has_file": 0,
      "media_url": "https://cloundinary",
      "mask": "946787f8-e632-4745-b811-c7914e09ce0a",
      "created_at": "2021-09-15T16:37:17.000000Z",
      "updated_at": "2021-09-15T16:37:17.000000Z",
      "lastresponse": {
        "id": 1,
        "question_id": 3,
        "response": "l am feeling pains",
        "asked_on": "2021-09-15 14:38:30",
        "responded_by": 1,
        "patient_id": 1,
        "doctor_id": 4,
        "media_type": "Image",
        "has_file": 1,
        "media_url": "https://res.cloudinary.com/dzh1cgxjd/image/upload/v1631716713/xkmkalcl4zv7wolrzwzl.jpg",
        "mask": "94675d82-8926-484f-b934-cd401348fbc7",
        "created_at": "2021-09-15T14:38:34.000000Z",
        "updated_at": "2021-09-15T14:38:34.000000Z",
        "read_status": 0
      }
    }
  ]
} 
*/

  int? code;
  String? status;
  String? message;
  List<ChatListResponseData?>? data;

  ChatListResponse({
    this.code,
    this.status,
    this.message,
    this.data,
  });
  ChatListResponse.fromJson(Map<String, dynamic> json) {
    code = json["code"]?.toInt();
    status = json["status"]?.toString();
    message = json["message"]?.toString();
    if (json["data"] != null) {
      final v = json["data"];
      final arr0 = <ChatListResponseData>[];
      v.forEach((v) {
        arr0.add(ChatListResponseData.fromJson(v));
      });
      data = arr0;
    }
  }
  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data["code"] = code;
    data["status"] = status;
    data["message"] = message;
    if (this.data != null) {
      final v = this.data;
      final arr0 = [];
      for (var vi in v!) {
        arr0.add(vi!.toJson());
      }
      data["data"] = arr0;
    }
    return data;
  }
}