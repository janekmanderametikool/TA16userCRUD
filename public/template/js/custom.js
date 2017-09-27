var mainUrl = "http://ubuntu.ametikool.ee/~janek/TA16/programmeerimine/user-crud/public/";
$("#s").keyup(function (event) {

    var s = event.currentTarget.value;

    if (s.length > 2) {
        $.ajax({
            method: "POST",
            url: mainUrl + "querys/search.php",
            data: { s: s }
        }).done(function( data ) {
            $("#search-results").html(data);
        });
    }
});

$(".change_language").click(function (e) {

    e.preventDefault();

    var language = $(this).data("language");

    $.ajax({
        method: "POST",
        url: mainUrl + "querys/change-language.php",
        data: { language: language }
    }).done(function() {
        location.reload();
    });
});