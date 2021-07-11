// function to set cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
} 

// get or read cookie
function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }
 
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

(function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

(function($){
    $.fn.setFormData = function(data){
        let t = this;
        $.each(data, function(key, value) {  
            var ctrl = $(t).find('[name='+key+']');  
            switch(ctrl.prop("type")) { 
                case "radio": case "checkbox": case "select":   
                    ctrl.each(function() {
                        if($(this).attr('value') == value) $(this).attr("checked",value);
                    });   
                    break; 
                    case "select" :
                    // manipulate select?
                    ctrl.val(value); 
                    break;
                default:
                    ctrl.val(value); 
            }  
        });  
    }
  })(jQuery);