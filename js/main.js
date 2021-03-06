function formatNumber(number, decimals, dec_point, thousands_sep){

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

function number_decimals_format(amount,format = null){
      let decimals_array = "",
          quantity = 2
      amount = amount.toString()

      if(amount.indexOf(',') !== -1){  
        decimals_array = amount.split(',')
      }else if(amount.indexOf('.') !== -1){
        decimals_array = amount.split('.')
      }

      if(decimals_array.length > 1){
        if(parseInt(decimals_array[1].length) > 2 && parseInt(decimals_array[1].length) <= 6){
          quantity = parseInt(decimals_array[1].length)
        }else if(parseInt(decimals_array[1].length) > 6){ 
          quantity = 6
        }else if(parseInt(decimals_array[1].length) < 2){
          quantity = 2
        }
      }

      
      if(!format){
        return quantity
      }else{
        return formatNumber(amount,quantity,',','.')
      }
}