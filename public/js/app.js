(function(){
    const infoBook = $("#infobook");
    $( "a.open-info-book" ).click(function(event) {
      event.preventDefault();
      const id = $( this ).attr('data-id');
      const href = `/api/show/${id}`;
      $.get( href, function(data) {
        $( infoBook ).find( "#bookTitle" ).text(data.title);
        $( infoBook ).find( "#bookPrice" ).text(data.price);
        $( infoBook ).find( "#bookAuthor" ).text(data.author);
        $( infoBook ).find( "#bookpublishingHouse" ).text(data.publishing_house);
        $( infoBook ).find( "#bookImage" ).attr("src", "/img/" + data.photo);
        infoBook.modal('show');
      })
    });
    $(".closeInfoBook").click(function (e) {
      infoBook.modal('hide');
    });
})();