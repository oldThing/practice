/**
 * 登录操作
 * @constructor
 */
function OK() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    //AJAX提交
    //1.创建对象
    var xhr = new XMLHttpRequest();

    //4.接收响应数据
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4){
            var info = eval('('+xhr.responseText+')');     //将json对象转化为object对象
            // console.log(text);
            if(info.errorNo == 0){             //如果登录成功，跳转到首页
                //跳转到首页路径
                location.href = "./index.html";
            } else {
                alert(info.message);
            }
        }
    }

    var postData = {
        "username": username,
        "password": password
    }

    var postData = (function(obj){ // 转成post需要的字符串.
        var str = "";
        for(var prop in obj){
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    //2.创建一个连接
    xhr.open("post",'./doLogin.php/?username='+username+'&password='+password);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //3.发送请求
    xhr.send(postData);
}
