function articalOk() {
    var artical_title = document.getElementById('artical_title').value;
    var artical_comment = document.getElementById('artical_comment').value;
    var artical_columns = document.getElementsByName("column_id");
    var column_id;
    for (var i = 0; i < artical_columns.length; i++) {
        if (artical_columns[i].checked) {
            column_id = artical_columns[i].value
        }
    }

    var postData = {
        "artical_title": artical_title,
        "artical_comment": artical_comment,
        "column_id": column_id,
    };

    postData = (function (obj) { // 转成post需要的字符串.
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    var xhr = new XMLHttpRequest();
    //接收响应信息
    xhr.onreadystatechange = function () {
        // alert(xhr.readyState);
        if (xhr.readyState == 4) {
            // alert(xhr.responseText);
            var info = eval('(' + xhr.responseText + ')');
            alert(info.message);
            if (info.errorNo == 0) {
                //添加成功，跳转到添加文章首页
                window.location.href = "artical.php";
            } else {
                //添加失败，提示信息
                alert(info.message);
            }
        }
    }

    xhr.open("post", "./addArtical.php", true);
    //转变成xml格式
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(postData);

}

function upArticalOk() {
    // alert(123)
    //数据的收集，并将数据修改成post提交的数据格式
    var artical_title = document.getElementById('artical_title').value;
    var artical_comment = document.getElementById('artical_comment').value;
    var artical_columns = document.getElementsByName("column_id");
    var artical_id = document.getElementById("artical_id").value;
    var column_id;
    for (var i = 0; i < artical_columns.length; i++) {
        if (artical_columns[i].checked) {
            column_id = artical_columns[i].value
        }
    }

    var postData = {
        "artical_id": artical_id,
        "artical_title": artical_title,
        "artical_comment": artical_comment,
        "column_id": column_id,
        "method": "updateOP"
    }

    postData = (function (obj) { // 转成post需要的字符串.
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);
    // alert(postData);
    //提交到数据库，并对响应结果进行相应的处理
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState == 4) {
            // alert(xhr.responseText);
            var info = eval('(' + xhr.responseText + ')');
            // alert(info.message);
            if (info.errorNo == 0) {
                //添加成功，跳转到添加文章首页
                alert(info.message);
                window.location.href = "../artical.php";
            } else {
                //添加失败，提示信息
                alert(info.message);
            }
        }
    }
    xhr.open("post",'../upartical2.php',true);
    //转变成xml格式
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(postData);


}
