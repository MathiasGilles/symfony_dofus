$(document).ready(function() {
  $("#example").DataTable();
});

function confirmSupr(name, route) {
  let confirm = window.confirm("Voulez vous supprimer " + name + "?");
  if (confirm == true) {
    window.location = route;
  }
}
