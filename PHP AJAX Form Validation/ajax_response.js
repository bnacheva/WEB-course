$(document).ready(function ($) {
    $("#studentForm").submit(function () {
        var dataPage = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "students.php",
            data: dataPage,
            dataType: "JSON",
            success: function (dataPage) {
                if (dataPage['error_msg']) {
                    $("#errors").html('<div class="notification_error">' + dataPage['error_msg'] + '</div>');
                }
                else {
                    result = '<div class="notification_ok">Списък със студенти и техните оценки, сортиран в низходящ ред по оценка и във възходящ ред по факултетен номер на студент:</div>';
                    $("#errors").hide();
                    $("#table").show();
                    $("#table").html(insertInTable(dataPage));
                    $("#result").html(result);
                }
            }
        });
        return false;
    });
});

function insertInTable(dataPage) {
    var table = document.getElementById("table");
    $("#table").find("tr:not(:first)").remove();
    for (var value in dataPage) {
        if (dataPage.hasOwnProperty(value)) {
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = JSON.stringify(dataPage[value]['name']).replace(/["]/g, "");
            cell2.innerHTML = JSON.stringify(dataPage[value]['fn']).replace(/["]/g, "");
            cell3.innerHTML = JSON.stringify(dataPage[value]['mark']).replace(/["]/g, "");
        }
    }
}