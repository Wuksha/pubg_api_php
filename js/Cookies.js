    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                var y = c.substring(name.length, c.length);
                var array = y.split(',');
                return array;
            }
        }
        return "";
    }
    
    function checkCookie() {
        var myCookie = getCookie("Zone");
        if (myCookie == "") {
            setCookie("Zone", Intl.DateTimeFormat().resolvedOptions().timeZone);
        } 
    }

    checkCookie();