function jsTxt(str) {

    var strArray = str.split('-');

    for (var i = 0; i < strArray.length; i++) {

        strArray[i] = strArray[i][0].toUpperCase() + strArray[i].substring(1);	
    }

    str = strArray.join(' ');

    return str;
}
