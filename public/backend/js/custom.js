
// modal xác nhận xóa phần admin/category
$('#deleteCate').on('show.bs.modal',function(event){
      
      var button = $(event.relatedTarget);
      var cate_id = button.data('catid');
      var modal = $(this);

      modal.find(".modal-body #cate_id").val(cate_id);
      console.log(cate_id);
});

