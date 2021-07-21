// function to set cookie
function setCookie(cname, cvalue, exdays) {
   var d = new Date();
   d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
   var expires = "expires=" + d.toUTCString();
   document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// get or read cookie
function getCookie(cname) {
   var name = cname + "=";
   var decodedCookie = decodeURIComponent(document.cookie);
   var ca = decodedCookie.split(';');
   for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
         c = c.substring(1);
      }

      if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
      }
   }
   return "";
}

(function($) {
   $.fn.serializeFormJSON = function() {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
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

(function($) {
   $.fn.setFormDataFromJSON = function(data) {
      let t = this;
      $.each(data, function(key, value) {
         var ctrl = $(t).find('[name=' + key + ']');
         switch (ctrl.prop("type")) {
            case "radio":
            case "checkbox":
            case "select":
               ctrl.each(function() {
                  if ($(this).attr('value') == value) $(this).attr("checked", value);
               });
               break;
            case "select":
               // manipulate select?
               ctrl.val(value);
               break;
            default:
               ctrl.val(value);
         }
      });
   }
})(jQuery);

function calculateBusinessDays(firstDate, secondDate) {
   // EDIT : use of startOf
   let day1 = moment(firstDate).startOf('day');
   let day2 = moment(secondDate).startOf('day');
   // EDIT : start at 1
   let adjust = 1;

   if ((day1.dayOfYear() === day2.dayOfYear()) && (day1.year() === day2.year())) {
      return 1;
   }

   if (day2.isBefore(day1)) {
      const temp = day1;
      day1 = day2;
      day2 = temp;
   }
   // Don't include last date as the caller always call
   // excluding last day
   day2 = day2.subtract(1, 'days');


   //Check if first date starts on weekends
   if (day1.day() === 6) { //Saturday
      //Move date to next week monday
      day1.day(8);
   } else if (day1.day() === 0) { //Sunday
      //Move date to current week monday
      day1.day(1);
   }

   //Check if second date starts on weekends
   if (day2.day() === 6) { //Saturday
      //Move date to current week friday
      day2.day(5);
   } else if (day2.day() === 0) { //Sunday
      //Move date to previous week friday
      day2.day(-2);
   }

   const day1Week = day1.week();
   let day2Week = day2.week();

   //Check if two dates are in different week of the year
   if (day1Week !== day2Week) {
      //Check if second date's year is different from first date's year
      if (day2Week < day1Week) {
         day2Week += day1Week;
      }
      //Calculate adjust value to be substracted from difference between two dates
      // EDIT: add rather than assign (+= rather than =)
      adjust += -2 * (day2Week - day1Week);
   }

   return day2.diff(day1, 'days') + adjust;
}