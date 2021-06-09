$( document ).ready(function() {

  function getAllQuestions(){
    if ( $.fn.dataTable.isDataTable( '.list-articles' ) ) {
          tab_page = $('.list-articles').DataTable();
          tab_page.destroy();
        }
      $('.list-articles').DataTable({
           processing: true,
           serverSide: true,
           "columnDefs": [
            { "searchable": false, "targets": 0 }
          ],
           "ordering": true,
           ajax: '/get-all-articles',
              columns: [
              {data: 'article_id', name: 'article_id'},

              {data: 'article_cat_id', name: 'article_cat_id'},
              {data: 'article_title', name: 'article_title'},
              {data: 'article_content', name: 'article_content'},
              //{data: 'details', name: 'details'}
          ]

         });
   }

  $('body').on('click', '.remove-article' ,function(e){

       let currentEle  =  $(this);
       id  = currentEle.data("articleid");
       let confirmDelete = confirm("Are you sure you want ?");

       if(confirmDelete){
           //Delete article
           axios.post('/remove-article', {
              article_id: id
          }).then(function (response){
            window.location.href = "/list-articles";
            console.log(response)
          })

         }

   });


});
