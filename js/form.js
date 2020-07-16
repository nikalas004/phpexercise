function warningGarbage () {
    var warningBoxes = ['name', 'email'];

    warningBoxes.forEach(function(warnigBox) {
        $("." + warnigBox + "-warning").hide();
    });
}