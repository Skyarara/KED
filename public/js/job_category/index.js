function delete_data(id) {
    swal({
        title: "Menghapus Kategori Pekerjaan",
        text: "Apakah anda ingin menghapus kategori pekerjaan ini?",
        icon: "warning",
        buttons: true,
        // dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $("#modal-action").fadeIn("slow");
                $.ajax({
                    url: "/job_category/hapus",
                    type: "POST",
                    data: '_token=' + $("#_token").val() + '&' + 'id=' + id,
                    success: function (data) {
                        $("#modal-action").fadeOut("slow");
                        swal({
                            title: "Kategori Pekerjaan Terhapus",
                            text: "",
                            icon: "success",
                        })
                            .then(function () {
                                window.location.replace("/job_category")
                            });

                    },
                });
            } else { }
        });
}