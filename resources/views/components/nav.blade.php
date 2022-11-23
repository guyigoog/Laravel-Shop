<aside class="side-nav">
    <div class="row cart-title">
        <div class="col X">
            <a href=""><svg width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                    <path fill="currentColor"
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8L2.146 2.854Z" />
                </svg></a>
        </div>
        <div class="col">
            <h5>סל המוצרים</h5>
        </div>
    </div>
    <div class="row cart">
        <div class="cart-nav">
            <table class="table">
                <thead>
                    <tr>
                        <td></td>
                        <td>סיכום</td>
                        <td>שם המוצר</td>
                        <td>יחידות</td>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cart items will append here -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="nav-footer">
        <div class="row nav-row">
            <div class="col">
                <div class="cart-total maam">
                </div>
            </div>
            <div class="col">
                <span class="cart-details">מע"מ 17%</span>
            </div>
        </div>
        <div class="row nav-row">
            <div class="col">
                <div class="cart-total final-price">
                    <!-- Cart details will append here -->
                </div>
            </div>
            <div class="col">
                <span class="cart-details">סה"כ</span>
                <!-- Cart details will append here -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Calling the function to get the cart details
            fetch_cart_data();
          // Fetching the cart data
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
</aside>
