$( document ).ready(function() {


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
           ajax: '/questions/view/covid-19',
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




});
