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