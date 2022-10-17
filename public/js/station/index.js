function delete_data(id) {
    swal({
        title: "Menghapus Station",
        text: "Apakah anda ingin menghapus Station ini?",
        icon: "warning",
        buttons: true,
        // dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $("#modal-action").fadeIn("slow");
                $.ajax({
                    url: "/station/hapus",
                    type: "POST",
                    data: '_token=' + $("#_token").val() + '&' + 'id=' + id,
                    success: function (data) {
                        $("#modal-action").fadeOut("slow");
                        swal({
                            title: "Station Terhapus",
                            text: "",
                            icon: "success",
                        })
                            .then(function () {
                                window.location.replace("/station")
                            });

                    },
                });
            } else { }
        });
}