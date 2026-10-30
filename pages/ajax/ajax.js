$(document).ready(function () {
    $('#faculte').change(function () {
        var faculte_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_departement.php",
            method: "POST",
            data: {faculteID: faculte_id},
            dataType: "text",
            success: function (data) {
                $('#departement').html(data);
            }
        });
    });
    $('#faculte2').change(function () {
        var faculte2_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_departement2.php",
            method: "POST",
            data: {faculte2ID: faculte2_id},
            dataType: "text",
            success: function (data) {
                $('#departement2').html(data);
            }
        });
    });
    $('#departement').change(function () {
        var departement_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_optioner.php",
            method: "POST",
            data: {departementID: departement_id},
            dataType: "text",
            success: function (data) {
                $('#optioner').html(data);
            }
        });
    });
    $('#departement2').change(function () {
        var departement2_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_optioner2.php",
            method: "POST",
            data: {departement2ID: departement2_id},
            dataType: "text",
            success: function (data) {
                $('#optioner2').html(data);
            }
        });
    });
    $('#optioner').change(function () {
        var option_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_promotion.php",
            method: "POST",
            data: {optionID: option_id},
            dataType: "text",
            success: function (data) {
                $('#promotion').html(data);
            }
        });
    });
    $('#optioner2').change(function () {
        var option2_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_promotion2.php",
            method: "POST",
            data: {option2ID: option2_id},
            dataType: "text",
            success: function (data) {
                $('#promotion2').html(data);
            }
        });
    });
    $('#province').change(function () {
        var province_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_territoires.php",
            method: "POST",
            data: {provinceID: province_id},
            dataType: "text",
            success: function (data) {
                $('#territoire').html(data);
            }
        });
    });
    $('#territoire').change(function () {
        var territoire_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_secteurs.php",
            method: "POST",
            data: {territoireID: territoire_id},
            dataType: "text",
            success: function (data) {
                $('#secteur').html(data);
            }
        });
    });
    $('#cours').change(function () {
        var prof_id = $(this).val();
        $.ajax({
            url: "ajax/ajax_prof.php",
            method: "POST",
            data: {profID: prof_id},
            dataType: "text",
            success: function (data) {
                $('#prof').html(data);
            }
        });
    });
});