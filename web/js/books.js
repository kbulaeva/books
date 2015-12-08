$(function () {
    $('.grid-view-action').parent().click(function () {
        $('#book-modal').modal('show').find('#book-modal-content').load($(this).attr('href'));
        
        return false;
    });
    $('.preview-image').parent().click(function (event) {
        $('#image-modal').modal('show').find('#image-modal-content').attr('src', $(event.target).attr('src'));
        
        return false;
    });
});