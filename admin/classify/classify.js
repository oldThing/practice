//增加操作
function addClassifyOK() {
    var column_name = document.getElementById("column_name").value;
    var postData = {
        "method": 'addColumn',
        "column_name": column_name
    }

    var postData = (function (obj) {
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    // console.log(postData);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log(xhr.responseText);
            var info = eval('(' + xhr.responseText + ')');
            // console.log(info);
            if (info.errorNo == 0) {
                // window.setTimeout("window.location='classify.php'", 1000);
                alert(info.message);
                window.location.href = "classify.php";
                // alert(info.errorNo);
            } else {
                alert(info.message);
            }
        }
    }
    xhr.open('post', './addClassify.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(postData);
}

//修改操作
function updateClassifyOK() {
    var column_id = document.getElementById("column_id").value;
    var column_name = document.getElementById("up_column_name").value;
    // alert(column_name);
    var postData = {
        "method": "upColumn",
        "column_id": column_id,
        "column_name": column_name
    }
    var postData = (function (obj) {
        var str = "";
        for (var prop in obj) {
            str += prop + "=" + obj[prop] + "&"
        }
        return str;
    })(postData);

    //ajax提交
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            var info = eval('(' + xhr.responseText + ')');
            // console.log(info);
            if (info.errorNo == 0) {
                // window.setTimeout("window.location='classify.php'", 1000);
                alert(info.message);
                window.location.href = "../classify.php";
                // alert(info.errorNo);
            } else {
                alert(info.message);
            }
        }
    }
    xhr.open("post", "../upClassify.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(postData);
}


