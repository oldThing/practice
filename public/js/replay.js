/**
 * Created by pc on 2017/3/14.
 */
function replayOK() {
    var replayMessage = document.getElementById('replayMessage').value;
    var messageID = document.getElementById('message_id').value;
    // console.log(replayMessage);
    //进行数据的采集，并进行ajax提交
    var xhr = new XMLHttpRequest();
    var postData = {
        "replay": replayMessage,
        "message_id": messageID
    }

    var postData = (function (obj) { // 转成post需要的字符串.
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    xhr.onreadystatechange = function () {
        // alert(xhr.readyState);
        if (xhr.readyState == "4") {
            //接收到响应结果的数据
            // alert(xhr.responseText);
            var info = eval('(' + xhr.responseText + ')');
            // alert(info.message);
            if(info.errorNo == 0){             //如果登录成功，跳转到首页
                //跳转到首页路径
                alert(info.message);
                location.href = "index.php?p=admin&c=Message&a=show";
            } else {
                alert(info.message);
            }
        }
    }
    // console.log(messageID);

    xhr.open("post", "index.php?p=admin&c=Message&a=replay");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(postData)
}
