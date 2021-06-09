$( document ).ready(function() {

 function fetchAllUsersQustions(){
   if ( $.fn.dataTable.isDataTable( '.list-all-questions' ) ) {
         tab_page = $('.list-all-questions').DataTable();
         tab_page.destroy();
       }
     $('.list-all-questions').DataTable({
          processing: true,
          serverSide: true,
          "columnDefs": [
           { "searchable": false, "targets": 0 }
         ],
          "ordering": true,
          ajax: '/doctor/fetch-all-questions',
             columns: [
             {data: 'fullname', name: 'fullname'},
             {data: 'question_content', name: 'question_content'},
             {data: 'answered', name: 'answered'},
             {data: 'updated_at', name: 'updated_at'},
             {data: 'details', name: 'details'}
         ]

        });
      }
  fetchAllUsersQustions();



  function fetchWorkflowItemsByUser(){
    if ( $.fn.dataTable.isDataTable( '.workflow-items' ) ) {
          tab_page = $('.workflow-items').DataTable();
          tab_page.destroy();
        }
      $('.workflow-items').DataTable({
           processing: true,
           serverSide: true,
           "columnDefs": [
            { "searchable": false, "targets": 0 }
          ],
           "ordering": true,
           ajax: '/doctor/work-flow-items',
              columns: [
              {data: 'fullname', name: 'fullname'},
              //{data: 'username', name: 'username'},
              {data: 'question_content', name: 'question_content'},
              {data: 'answered', name: 'answered'},
              {data: 'updated_at', name: 'updated_at'},
              {data: 'details', name: 'details'}
          ]

         });
   }
   fetchWorkflowItemsByUser();

   $('.close-current-question').on('click',function(){
     loadProgressBar();
     let questionId = $('#ques-id').val();
      axios.post('/close-question', {
         questionId: questionId
     }).then(function (response) {
       console.log(response)
           if(response.data ==  '200'){

             location.reload();

           }else{
               toastr.error('Unable to closed this question. Please check if questions  have been duely responded to');
           }
       })
   });


});
