$(document).ready(function() {
    $('#table-1').DataTable();
} );

$(document).ready(function() {
    $('#table-4').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
} );

$(document).ready(function() {
    $('#table-3').DataTable();
} );

$(document).ready(function() {
    $('#table-2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
} );