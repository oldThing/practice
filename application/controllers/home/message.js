function showOK(num, ip) {
    var message = document.getElementById("message").value;
    var artical_id = document.getElementById("artical_id").value;
    var ip = document.getElementById("ip").value;
//        alert(message);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            // alert(xhr.responseText);
            var info = eval('(' + xhr.responseText + ')');
            alert(info.message);
            window.location.href = "../show.php/?artical_id=" + artical_id;
        }
    }
    var postData = {
        "message": message,
        "artical_id": artical_id,
        "ip": ip
    }
    var postData = (function (obj) { // 转成post需要的字符串.
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    xhr.open("post", '../message.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //3.发送请求
    xhr.send(postData);
}


