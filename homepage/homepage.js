    //取cookies
    function getCookie(name){
      let arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
      if (arr != null) return unescape(arr[2]);
      return null;
    }
    //刪除cookie
    function delCookie(name){
      var exp = new Date();
      exp.setTime(exp.getTime() - 1);
      var cval = getCookie(name);
      if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString() + "; path=/";
    }
    var btn = document.getElementById("logOut");
    btn.addEventListener('click', function(){
      delCookie("username");
      window.location = "../login/login.php";
    },false);
