// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

// $(function() {
//   $('#datetimepicker1').datetimepicker();
// });

// custom js demo Scroll vertical
$(document).ready(function() {
  $('#dataTableKurang').DataTable( {
      "scrollY":        "200px",
      "scrollCollapse": true,
      "paging":         false,
      "searching": false
  } );
} );