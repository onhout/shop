/**
 * Created by pl on 6/26/15.
 */
$(function(){
    $('#myModal').on('show.bs.modal', function (event) {
        console.log(data);
        var link = $(event.relatedTarget);
        var id = link.data('id');
        var modal = $(this);
        modal.find('.modal-title').text(data[id]['name']);
        var images = data[id]['image_link'].slice(0, -2).split(', ');
        var htmlString = '';
        for(var i=0; i<images.length; i++){
            htmlString += '<img src="../../'+images[i]+'" height="200px"></img>'
        }
        htmlString += '<p>'+data[id]['description']+'</p>';
        modal.find('.modal-body').html(htmlString);

    })
});