function delete_data(id, Id) {
    swal({
        title: "Menghapus Data",
        text: "Apakah anda ingin menghapus data ini",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = '/daily_activity/detail/' + id + '/delete/' + Id;
            } else { }
        });
}

$(".station").click(function () {
    $('#option').html('Station ');
    $('#search_input').find('#date').hide();
    $('#search_input').find('#station').removeAttr("hidden");
    $('#search_input').find('#station').show();
});

$(".date").click(function () {
    $('#option').html('Tanggal ');
    $('#search_input').find('#station').hide();
    $('#search_input').find('#date').removeAttr("hidden");
    $('#search_input').find('#date').show();
});