function showModal(){
  $('#product-Modal').modal('show');
}


$(document).ready(function(){
  //ajax Setup
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


    $('body').on('click','#showProduct',function(e){
      e.preventDefault();
      var id =  $(this).data('id');
      var url = "show/product/"+id;
      // alert(url);
      $.ajax({
        url: url,
        method: 'get',
        dataType: 'json',
        success: function(result){
          // console.log(result.data.product_quantity);
          $('#product-Modal').modal('show');
          $('#product_name').text(result.data.product_name);
          $('#price').text(result.data.product_price);
          $('#short_description').text(result.data.product_short_description);
          $('#category_name').text(result.category_name);

          var html2 = "<input type='hidden' value='"+result.data.id+"' name='product_id'/>"
          $('#product_id').html(html2);
          var html = "<img src='http://127.0.0.1:8000/uploads/product_images/"+result.data.product_thumbnail_picture+"' alt='pictre'>";
          $('#thumbnail_picture').html(html);
          var quantity = result.data.product_quantity;
          if (quantity) {
            $("#quantity").html("");
            $("#addButton").html("<input class='btn btn-danger' type='submit' value='Add To Cart' />");
          }
          else {
            $("#quantity").html("<strong>This Product Is Out Of Stock</strong>");
          }
        }
      });
    });
});
