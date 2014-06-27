/**
 * Common libs
 *
 */
function getRoomById($id) {
	var _i;
	for ( _i in calcRoomList ){   
            if ( calcRoomList[_i].getId() == $id ){
                    return calcRoomList[_i];
            }
        }
	return false;
}
function getRoomByType($id) {
	var _i;
	for ( _i in calcRoomList ){   
            if ( calcRoomList[_i].getId() == $id ){
                    return calcRoomList[_i].getType();
            }
        }
	return false;
}
function getRoomId($type) {
	var _i;
	for ( _i in calcRoomList ){   
            if ( calcRoomList[_i].getType() == $type ){
                    return calcRoomList[_i].getId();
            }
        }
	return false;
}


function formatPrice($price, $currecy) {
	var _price = number_format($price, 2, ".", " ");
	var _currency = $currecy || " руб."
	return _price + _currency;
}
function number_format (number, decimals, dec_point, thousands_sep) {
	// Formats a number with grouped thousands  
	// 
	// version: 1109.2015
	// discuss at: http://phpjs.org/functions/number_format
	// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +     bugfix by: Michael White (http://getsprink.com)
	// +     bugfix by: Benjamin Lupton
	// +     bugfix by: Allan Jensen (http://www.winternet.no)
	// +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	// +     bugfix by: Howard Yeend
	// +    revised by: Luke Smith (http://lucassmith.name)
	// +     bugfix by: Diogo Resende
	// +     bugfix by: Rival
	// +      input by: Kheang Hok Chin (http://www.distantia.ca/)
	// +   improved by: davook
	// +   improved by: Brett Zamir (http://brett-zamir.me)
	// +      input by: Jay Klehr
	// +   improved by: Brett Zamir (http://brett-zamir.me)
	// +      input by: Amir Habibi (http://www.residence-mixte.com/)
	// +     bugfix by: Brett Zamir (http://brett-zamir.me)
	// +   improved by: Theriault
	// +      input by: Amirouche
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// *     example 1: number_format(1234.56);
	// *     returns 1: '1,235'
	// *     example 2: number_format(1234.56, 2, ',', ' ');
	// *     returns 2: '1 234,56'
	// *     example 3: number_format(1234.5678, 2, '.', '');
	// *     returns 3: '1234.57'
	// *     example 4: number_format(67, 2, ',', '.');
	// *     returns 4: '67,00'
	// *     example 5: number_format(1000);
	// *     returns 5: '1,000'
	// *     example 6: number_format(67.311, 2);
	// *     returns 6: '67.31'
	// *     example 7: number_format(1000.55, 1);
	// *     returns 7: '1,000.6'
	// *     example 8: number_format(67000, 5, ',', '.');
	// *     returns 8: '67.000,00000'
	// *     example 9: number_format(0.9, 0);
	// *     returns 9: '1'
	// *    example 10: number_format('1.20', 2);
	// *    returns 10: '1.20'
	// *    example 11: number_format('1.20', 4);
	// *    returns 11: '1.2000'
	// *    example 12: number_format('1.2000', 3);
	// *    returns 12: '1.200'
	// *    example 13: number_format('1 000,50', 2, '.', ' ');
	// *    returns 13: '100 050.00'
	// Strip all characters but numerical ones.
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}

function intval (mixed_var, base) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: stensi
	// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   input by: Matteo
	// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
	// +   bugfixed by: Rafał Kukawski (http://kukawski.pl)
	// *     example 1: intval('Kevin van Zonneveld');
	// *     returns 1: 0
	// *     example 2: intval(4.2);
	// *     returns 2: 4
	// *     example 3: intval(42, 8);
	// *     returns 3: 42
	// *     example 4: intval('09');
	// *     returns 4: 9
	// *     example 5: intval('1e', 16);
	// *     returns 5: 30
	var tmp;

	var type = typeof(mixed_var);

	if (type === 'boolean') {
	return +mixed_var;
	} else if (type === 'string') {
	tmp = parseInt(mixed_var, base || 10);
	return (isNaN(tmp) || !isFinite(tmp)) ? 0 : tmp;
	} else if (type === 'number' && isFinite(mixed_var)) {
	return mixed_var | 0;
	} else {
	return 0;
	}
}

function floatval (mixed_var) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: stensi
	// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   input by: Matteo
	// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
	// +   bugfixed by: Rafał Kukawski (http://kukawski.pl)
	// *     example 1: intval('Kevin van Zonneveld');
	// *     returns 1: 0
	// *     example 2: intval(4.2);
	// *     returns 2: 4
	// *     example 3: intval(42, 8);
	// *     returns 3: 42
	// *     example 4: intval('09');
	// *     returns 4: 9
	// *     example 5: intval('1e', 16);
	// *     returns 5: 30
	var tmp;

	var type = typeof(mixed_var);

	if (type === 'boolean') {
	return +mixed_var;
	} else if (type === 'string') {
	tmp = parseFloat(mixed_var);
	return (isNaN(tmp) || !isFinite(tmp)) ? 0 : tmp;
	} else if (type === 'number' && isFinite(mixed_var)) {
	return mixed_var | 0;
	} else {
	return 0;
	}
}

function trim (str, charlist) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: mdsjack (http://www.mdsjack.bo.it)
	// +   improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
	// +      input by: Erkekjetter
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +      input by: DxGx
	// +   improved by: Steven Levithan (http://blog.stevenlevithan.com)
	// +    tweaked by: Jack
	// +   bugfixed by: Onno Marsman
	// *     example 1: trim('    Kevin van Zonneveld    ');
	// *     returns 1: 'Kevin van Zonneveld'
	// *     example 2: trim('Hello World', 'Hdle');
	// *     returns 2: 'o Wor'
	// *     example 3: trim(16, 1);
	// *     returns 3: 6
	var whitespace, l = 0,
	i = 0;
	str += '';

	if (!charlist) {
	// default list
	whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
	} else {
	// preg_quote custom list
	charlist += '';
	whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
	}

	l = str.length;
	for (i = 0; i < l; i++) {
	if (whitespace.indexOf(str.charAt(i)) === -1) {
		str = str.substring(i);
		break;
	}
	}

	l = str.length;
	for (i = l - 1; i >= 0; i--) {
	if (whitespace.indexOf(str.charAt(i)) === -1) {
		str = str.substring(0, i + 1);
		break;
	}
	}

	return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}
function change_country(obj, pref) {
    var table_country = obj;
    if(pref == undefined)pref = '';
    
    var id_region = 'table_'+table_country.value+pref;
    
    var len_options = table_country.length;
    
    for(var i = 0; i < len_options; i++) {
        var id_element_none = 'table_'+table_country.options[i].value+pref;
        document.getElementById(id_element_none).style.display = 'none';
        $("#"+id_element_none).removeAttr('name');
        change_region(document.getElementById(id_element_none));
    }
    document.getElementById(id_region).style.display = 'block';
    $("#"+id_region).attr('name', 'region');
    change_region(document.getElementById(id_region));
}
function change_region(obj) {
   
    var id = $(obj).find('option:selected')[0].id;
    if(!id)id = obj.options[0].id;
    
    var table_country = obj;
    var id_region = 'region_'+id;
    var len_options = obj.length;

    for(var i = 0; i < len_options; i++) {
        var id_element_none = 'region_'+table_country.options[i].id;
        document.getElementById(id_element_none).style.display = 'none';
        $("#"+id_element_none).removeAttr('name');
    }
    if(obj.style.display == 'block'){
        document.getElementById(id_region).style.display = 'block';
        $("#"+id_region).attr('name', 'city');
    }
   udate_worck();
}
function change_city(obj) {
    udate_worck();
}
function udate_worck() {
    calcPhoto.empty();
    
   var workM = calcRemontType.getTableInstallation();
   var workD = calcRemontType.getTableDismantling();
   workM.init();
   workD.init();
   workM.update();
   workD.update();
}
function declOfNum(n, text_forms) {
    n      = Math.abs(n) % 100;
    var n1 = n % 10;
    if (n > 10 && n < 20) {
        return text_forms[2];
    }
    if (n1 > 1 && n1 < 5) {
        return text_forms[1];
    }
    if (n1 == 1) {
        return text_forms[0];
    }
    return text_forms[2];
}
function escapeHtml(unsafe) {
  return unsafe
      .replace(/&(?!amp;)/g, "&amp;")
      .replace(/<(?!lt;)/g, "&lt;")
      .replace(/>(?!gt;)/g, "&gt;")
      .replace(/"(?!quot;)/g, "&quot;")
      .replace(/'(?!#039;)/g, "&#039;");
}
