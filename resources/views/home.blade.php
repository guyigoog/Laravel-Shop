@extends('layouts.master')
<main>
    <header>
        <div class="row row-cols-1">
            <div class="home-head">
                <h3>קופה <svg width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M64 0C46.3 0 32 14.3 32 32v64c0 17.7 14.3 32 32 32h80v32H87c-31.6 0-58.5 23.1-63.3 54.4L1.1 364.1c-.7 4.7-1.1 9.5-1.1 14.3V448c0 35.3 28.7 64 64 64h384c35.3 0 64-28.7 64-64v-69.6c0-4.8-.4-9.6-1.1-14.4l-22.7-149.6c-4.7-31.3-31.6-54.4-63.2-54.4H208v-32h80c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H64zm32 48h160c8.8 0 16 7.2 16 16s-7.2 16-16 16H96c-8.8 0-16-7.2-16-16s7.2-16 16-16zM64 432c0-8.8 7.2-16 16-16h352c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm48-216c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm72 24c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm120-56c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24zm120-56c0-13.3 10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24zm-24 56c13.3 0 24 10.7 24 24s-10.7 24-24 24s-24-10.7-24-24s10.7-24 24-24z" />
                    </svg></h3>
            </div>
            <div class="page-selector">
                <a href="{{ route('home') }}" class="active">מוצרים</a>
                &nbsp;
                &nbsp;
                <a href="{{ route('favorites') }}"> מועדפים </a>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="products-box">
            <div class="prod-row row row-cols-1 row-cols-md-6 g-4">
                <!-- Products will append here -->

            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script>
            $(document).ready(function() {
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                fetch_data(); // Fetch products from database
                //Function to fetch products from database
                function fetch_data() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('jsonhome') }}",
                        dataType: "json",
                        success: function(response) {
                            console.log(response.products); 
                            $('.prod-row').html(""); // Empty the products box
                            $.each(response.products, function(key, item) { // Loop through the products
                                var id = item.id; // Get the product id
                                if (item.favorite == 1) { // Check if the product is favorite
                                    // Append the product to the products box
                                    $('.prod-row').append('<div class="prod-card col">\
                        <div class="card h-100">\
                          <button class="fav" value="' + item.id + '" >\
                                <svg class="fav-on" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path fill="currentColor" d="M34 16.78a2.22 2.22 0 0 0-1.29-4l-9-.34a.23.23 0 0 1-.2-.15l-3.11-8.4a2.22 2.22 0 0 0-4.17 0l-3.1 8.43a.23.23 0 0 1-.2.15l-9 .34a2.22 2.22 0 0 0-1.29 4l7.06 5.55a.23.23 0 0 1 .08.24l-2.43 8.61a2.22 2.22 0 0 0 3.38 2.45l7.46-5a.22.22 0 0 1 .25 0l7.46 5a2.2 2.2 0 0 0 2.55 0a2.2 2.2 0 0 0 .83-2.4l-2.45-8.64a.22.22 0 0 1 .08-.24Z" class="clr-i-solid clr-i-solid-path-1"/><path fill="none" d="M0 0h36v36H0z"/></svg>\
                            </button>\
                        <form enctype="multipart/form-data">\
                          @csrf\
                          <input type="hidden" value="' + item.id + '" name="id">\
                          <input type="hidden" value="' + item.name + '" name="name">\
                          <input type="hidden" value="' + item.price + '" name="price">\
                          <input type="hidden" value="' + item.discount + '" name="discount">\
                          <input type="hidden" value="1" name="quantity">\
                          <button class="card-button" type="button">\
                            <div class="card-body">\
                              <h5 class="card-title">' + item.name + '</h5>\
                              <p class="card-text">₪' + item.price + '</p>\
                              <p></p>\
                            </div></button></form></div></div>');
                                } else { // If the product is not favorite
                                    // Append the product to the products box
                                    $('.prod-row').append('<div class="prod-card col">\
                        <div class="card h-100">\
                          <button class="fav" value="' + item.id + '">\
                                <svg width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path fill="currentColor" d="M27.19 34a2.22 2.22 0 0 1-1.24-.38l-7.46-5a.22.22 0 0 0-.25 0l-7.46 5a2.22 2.22 0 0 1-3.38-2.41l2.45-8.64a.23.23 0 0 0-.08-.24l-7.06-5.55a2.22 2.22 0 0 1 1.29-4l9-.34a.23.23 0 0 0 .2-.15l3.1-8.43a2.22 2.22 0 0 1 4.17 0l3.1 8.43a.23.23 0 0 0 .2.15l9 .34a2.22 2.22 0 0 1 1.29 4L27 22.33a.22.22 0 0 0-.08.24l2.45 8.64A2.23 2.23 0 0 1 27.19 34Zm-8.82-7.42a2.21 2.21 0 0 1 1.23.42l7.46 5a.22.22 0 0 0 .34-.25l-2.45-8.64a2.21 2.21 0 0 1 .77-2.35l7.06-5.55a.22.22 0 0 0-.13-.4l-9-.34a2.22 2.22 0 0 1-2-1.46l-3.1-8.43a.22.22 0 0 0-.42 0L15.06 13a2.22 2.22 0 0 1-2 1.46l-9 .34a.22.22 0 0 0-.13.4L11 20.76a2.22 2.22 0 0 1 .77 2.35l-2.44 8.64a.21.21 0 0 0 .08.24a.2.2 0 0 0 .26 0l7.46-5a2.22 2.22 0 0 1 1.23-.37Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="none" d="M0 0h36v36H0z"/></svg>\
                            </button>\
                        <form enctype="multipart/form-data">\
                          @csrf\
                          <input type="hidden" value="' + item.id + '" name="id">\
                          <input type="hidden" value="' + item.name + '" name="name">\
                          <input type="hidden" value="' + item.price + '" name="price">\
                          <input type="hidden" value="' + item.discount + '" name="discount">\
                          <input type="hidden" value="1" name="quantity">\
                          <button class="card-button" type="button">\
                            <div class="card-body">\
                              <h5 class="card-title">' + item.name + '</h5>\
                              <p class="card-text">₪' + item.price + '</p>\
                              <p></p>\
                            </div></button></form></div></div>');
                                }

                            });
                            //Handle the add to cart button
                            $('.card-button').click(function() {
                                console.log("clicked");
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('cart.store') }}", 
                                    data: $(this).parent().serialize(), // serializes the form's elements.
                                    success: function(data) { 
                                        console.log(data);
                                        fetch_cart_data(); // Fetch the cart data again
                                    }
                                })
                            });
                            //Handle the favorite button
                            $('.fav').click(function() {
                                console.log(this)
                                var id = $(this).val(); // Get the product id
                                console.log(id);
                                $.post("/favorites/" + id, function(data) { //Sending the id of the product to the favorite route
                                  console.log('Im clicked');
                                  fetch_data(); // Fetch the products data again
                                });
                            });
                        }


                    })
                    
                }

            //Function to fetch the cart data    
            function fetch_cart_data() {
          $.ajax({
              type: "GET",
              url: "{{ route('cart.list') }}",
              dataType: "json",
              success: function(response) {
                  $('tbody').html("");
                  var obj = response.cart;
                  var arr = Object.keys(obj).map(function(key) {
                      return obj[key];
                  });
                  console.log(arr);
                  var total = 0; // The total price of the cart
                  var prod_price = 0; // The price of the product
                  $.each(arr, function(key, item) { // Looping through the cart items
                      if (item.attributes.discount > 0) { // If the product has a discount
                          total += ((100 - item.attributes.discount) * item.price / 100) * item.quantity; // Calculating the total price
                          prod_price = ((100 - item.attributes.discount) * item.price / 100); // Calculating the product price
                          if(prod_price % 1 != 0){ // If the product price is not an integer
                              prod_price = prod_price.toFixed(2); // Round the price to 2 decimal places
                          }
                          // Appending the cart items to the table
                          $('tbody').append('<tr>\
                      <td class="prod-delete">\
                              <input type="hidden" value="' + item.id + '" name="id" id="id">\
                              <button class="prod-delete" style="border: none" value="' + item.id + '"><svg width="0.92em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1408 1536"><path fill="currentColor" d="M512 608v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm256 0v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm256 0v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm128 724V384H256v948q0 22 7 40.5t14.5 27t10.5 8.5h832q3 0 10.5-8.5t14.5-27t7-40.5zM480 256h448l-48-117q-7-9-17-11H546q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5H288q-66 0-113-58.5T128 1336V384H32q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg></button>\
                      </td>\
                      <td>\
                          <span class="prod-total">₪' + prod_price * item.quantity + '</span><br><span class="price-before">₪' +
                              item.price * item.quantity + '</span>\
                      </td>\
                      <td>\
                          <span class="prod-details"><span class="prod-title">' + item.name +
                              '</span><br><span class="prod-price">₪' + (100 - item
                                  .attributes.discount) * item.price / 100 +
                              '  </span><span class="prod-discount">' + item
                              .attributes.discount + '% הנחה </span></span>\
                      </td>\
                      <td class="prod-quantity-table"><span class="prod-quantity">' + item.quantity + '</span></td>\
                  </tr>');
                      } else { // If the product doesn't have a discount
                          total += item.price * item.quantity; // Calculating the total price
                          // Appending the cart items to the table
                          $('tbody').append('<tr>\
                      <td class="prod-delete">\
                              <input type="hidden" value="' + item.id + '" name="id" id="id">\
                              <button class="prod-delete" style="border: none" value="' + item.id + '"><svg width="0.92em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1408 1536"><path fill="currentColor" d="M512 608v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm256 0v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm256 0v576q0 14-9 23t-23 9h-64q-14 0-23-9t-9-23V608q0-14 9-23t23-9h64q14 0 23 9t9 23zm128 724V384H256v948q0 22 7 40.5t14.5 27t10.5 8.5h832q3 0 10.5-8.5t14.5-27t7-40.5zM480 256h448l-48-117q-7-9-17-11H546q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5H288q-66 0-113-58.5T128 1336V384H32q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg></button>\
                      </td>\
                      <td><span class="prod-total">₪' + item.price * item.quantity + '</span></td>\
                      <td><span class="prod-details"><span class="prod-title">' + item.name +
                              '</span><br><span class="prod-price">₪' + item.price + '  </span><span class="prod-discount"></span></span></td>\
                      <td class="prod-quantity-table"><span class="prod-quantity">' + item.quantity + '</span></td>\
                  </tr>');
                      }
                  });
                  // appending the total price details to the table
                  $('.maam').html("");
                  $('.maam').append('<span class="cart-details">₪'+(total*0.17).toFixed(2)+'</span>');
                  $('.final-price').html("");
                  $('.final-price').append('<span class="cart-details">₪'+total+'</span>');

                  //handling the delete button
                  $('.prod-delete').click(function() {
                      var id = $(this).val(); // getting the id of the product to delete
                      $.post("/remove/" + id, function(data) { // sending a post request to the remove route
                          console.log(id);
                          fetch_cart_data(); // fetching the cart data again
                      });
                  });
                  

              }
          })
      }


            });
        </script>
    @endsection('scripts')

</main>
