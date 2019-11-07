// フィールドが変更された場合に処理する関数
function fieldChanged() {
    var userId = getField("user_id");
    var password = getField("password");
    var disabled = true;

    if(userId.value.length > 0 && password.value.length > 0){
        disabled = false;
    }

    var login = getField("login");
    if(disabled){
        login.setAttribute("disabled", "disabled");
    }
    else{
        login.removeAttribute("disabled");
    }
}

// フィールドを取得する関数
function getField(fieldName){
    // ここで要素をIdごとに抽出するから，inputタグにidを追加した
    var field = document.getElementById(fieldName);
    if(field == undefined){
        throw new Error("Element was not found: " + fieldName);
    }
    return field;
}