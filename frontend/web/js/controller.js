
var baseUrl = window.location.pathname + "?r=";

function create(p_action) {
  $('#hidden-content').load(baseUrl + p_action, function() {
    $("#create-modal").modal("show");
  })
}

function update(p_url) {
  $('#hidden-content').load(p_url, function() {
    $("#update-modal").modal("show");
  })
}

function view(p_url) {
  $('#hidden-content').load(p_url, function() {
    $("#view-modal").modal("show");
  })
}
