(function(){
    const cartmodal = $("#cartmodal");
    $("a.open-cart-items").click(function(event) {
      event.preventDefault();
      let id = $( this ).attr('id');
      const href = `/api/show/${id}`;
      $.get( href, function(data) {
        $( cartmodal ).find( "#bookTitle" ).text(data.title);
        $( cartmodal).find( "#bookPhoto").attr("src", "/img/" + data.photo)
        $( cartmodal).find( "#bookPrice").text(data.price)
        cartmodal.modal('show');
      })
    });
    $(".closecartmodal").click(function (e) {
      cartmodal.modal('hide');
    });
})();