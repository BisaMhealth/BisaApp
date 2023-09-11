class CurrentUser {
  String? fname;
  String? lname;
  String? email;
  int? id;
  String? phone;
  String? region;
  String? city;
  dynamic gender;
  String? token;
  int? regionId;
  dynamic cityId;
  CurrentUser(
      {this.fname,
      this.lname,
      this.email,
      this.id,
      this.phone,
      this.token,
      this.gender,
      this.city,
      this.region,
      this.regionId,
      this.cityId});
}
