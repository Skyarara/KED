$(document).ready(function () {
    $('#role').select();
});

function delete_data(id) {
    swal({
        title: "Menghapus User",
        text: "Apakah anda ingin menghapus user ini?",
        icon: "warning",
        buttons: true,
        // dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $("#modal-action").fadeIn("slow");
                $.ajax({
                    url: "/user/hapus",
                    type: "POST",
                    data: '_token=' + $("#_token").val() + '&' + 'id=' + id,
                    success: function (data) {
                        if(data == 0){
                            $("#modal-action").fadeOut("slow");
                            swal({
                                title: "Tidak dapat menghapus user!",
                                text: "Anda sedang menggunakannya sekarang",
                                icon: "error",
                            })
                          } else {
                            $("#modal-action").fadeOut("slow");
                            document.getElementById('body-t');
                            swal({
                                title: "User Terhapus",
                                text: "",
                                icon: "success",
                            })
                            .then(function(){ 
                              location.reload();
                              }
                              );
                          }            
                        }
                });
            } else { }
        });
}

// Set Filter
function setFilter(data)
{
    $("#option").text(data);
}

// === Function for filter can be entered ==== //
// Get the input field
var input = document.getElementById("search");
// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("btn-search").click();
  }
});
// ====              |||                  ==== //


// Execute btn-search
$("#btn-search").on('click', function() {
   window.location.href = "user?search=" + $("#search").val() + "&filter=" + $("#option").text();
});