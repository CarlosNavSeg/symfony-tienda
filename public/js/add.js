(function(){
    const infoBook = $("#infobook");
    $("a.open-info-book").click(function(event) {
      event.preventDefault();
      let id = $( this ).attr('id');
      const href = `/api/show/${id}`;
      $.get( href, function(data) {
        $( infoBook ).find( "#bookTitle" ).text(data.title);
        $( infoBook ).find( "#bookPrice" ).text(data.price);
        $( infoBook ).find( "#bookAuthor" ).text(data.author);
        $( infoBook).find( "#bookPhoto").attr("src", "/img/" + data.photo)
        $( infoBook).find( "#bookPrice").text(data.price)
        $( infoBook ).find( "#bookpublishingHouse" ).text(data.publishing_house);
        infoBook.modal('show');
      })
    });
    $(".closeInfoBook").click(function (e) {
      infoBook.modal('hide');
    });
})();