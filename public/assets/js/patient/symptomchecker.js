const app = new Vue({
el:'#approot',
data() {
return {
  step:1,
  registration:{
    temprature:null,
    weight:null,
    chestpain:null,
    chestpain:null,
    sorethroat:null,
    flu_like_symptoms:0,
    tiredness:'XL'
  },
  counter:0,
}
},
methods:{
prev() {
  this.step--;
},
next() {
  this.step++;
},
increamentCounter(){
  if(this.counter == 10){
    return false;
  }else{
    this.counter++;
    console.log(this.counter)
  }
},
decreamentCounter(){
  if(this.counter == 0){
    return false;
  }else{
    this.counter--;
  }
},
submit() {
  // loadProgressBar();
  // axios.post('/user/replyquestion', {
  //     userId: responder,
  //     questionId: questionId,
  //     answersProvided: questionContent,
  //     responderType: 'user',
  //     patientId:''
  // })
  // .then(function (response) {
  //     if(response.data.success == true){
  //         toastr.success('Message Sent');
  //         $('#question-content').val(' ');
  //         //fetchQusetionResponse(responder,questionId);
  //
  //     }else{
  //         toastr.error('Unable to send message. Please try again later');
  //     }
  //
  // })
  // .catch(function (error) {
  //     //toastr.error('Error sending message')
  // });
  let probabilty= this.counter
   if(probabilty == 0){
     toastr.info('Wow you are doing very great');
     return false;
   }
   switch (true) {
     case probabilty < 5:
         toastr.info('A Bisa Doctor will call you shortly');
       break;

     case probabilty == 6:
           toastr.info('Your answers indicates that your condition is gradually improving');
       break;

     case probabilty >= 7:
             toastr.info('You are doing really well');
       break;


     default:
         // toastr.info('Please provide answers to the quesstions listed');
         break;

   }


}
}
});
