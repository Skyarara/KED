(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

  $('.form-destroy [type="submit"]').on('click', function (e) {
      e.preventDefault();

      var el = $(this).closest('form');

      swal({
        title: "Hapus Data!",
        text: "Apakah Anda Ingin Menghapus Data Ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          return $(el).submit();
        }
      });

      return false;
  });

})(window);