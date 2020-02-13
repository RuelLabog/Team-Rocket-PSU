//ajax

      // $('#add_data').click(function(){
      //     $('#modal-default').modal('show');
      //     $('#item_form')[0].reset();
      //     $('#button_action').val('insert');
      //     $('#action').val('Add');
      // });

      // $('#item_form').on('submit', function(event){
      //     event.preventDefault();
      //     var form_data = $(this).serialize();
      //     $.ajax({
      //         url:"{{ route('items.insert') }}",
      //         method:"POST",
      //         data:form_data,
      //         dataType:"json",

      //     });
      // });




      function itemEdit(){
      var url =  "editItem";
      var eItemDesc = $('#eItemDesc').val();
      var catid= $('#eCatName').val();
        $.ajax({
          type: 'POST',
          url: url,
          data: {
                  '_token': $('input[name=_token').val(),
                  'eItemID':$('input[name=eItemID').val(),
                  'eItemname':$('input[name=eItemname').val(),
                  'eItemDesc': eItemDesc,
                  'eQuantity':$('input[name=eQuantity').val(),
                  'catid':catid
                  },
          beforeSend:function(){
              $('#itemEditBtn').text('Updating...');
          },
          success: function (response){
              setTimeout(function(){
                  $('#modal-edit-items').modal('hide');
                  $('#items_table').DataTable().ajax.reload();
                  $('#itemEditBtn').text('Save Changes');
              }, 2000);
          }
      });
  }





  function itemAdd(){
      var url =  "addItem";
      var itemdesc = $('#itemdesc').val();
      var catid=$('#catid').val();
      alert(catid);
      $.ajax({
          type: 'POST',
          url: url,
          data: {
                  '_token': $('input[name=_token').val(),
                  'itemname':$('input[name=itemname').val(),
                  'quantity':$('input[name=quantity').val(),
                  'catid':catid,
                  'itemdesc': itemdesc
                  },
          beforeSend:function(){
              $('#itemAddBtn').text('Inserting...');
          },
          success: function (response){
              setTimeout(function(){
                  $('#modal-default').modal('hide');
                  $('#items_table').DataTable().ajax.reload();
                  $('#itemAddBtn').text('Save Changes');
              }, 2000);
          }
      });
  }


  function itemDelete(){
      var id = $('#dItemID').val();
      alert(id)
        $.ajax({
          type: 'POST',
          url: 'softdelitem',
          data: {'_token': $('input[name=_token').val(),
                  'dItemID': id
              },
          beforeSend:function(){
              $('#itemDelBtn').text('Deleting...');
          },
          success: function (response){
              setTimeout(function(){
                  $('#modal-delete-items').modal('hide');
                  $('#items_table').DataTable().ajax.reload();
                  $('#itemDelBtn').text('Delete');
              }, 2000);
          }
      });
  }
