function fieldChanged(){
    var taskName = getField("task_name");
    var inputDue = getField("input_due");
    var disabled = true;

    if(taskName.value.length > 0 && inputDue.value.length > 0){
        disabled = false;
    }

    var regist = getField("add_send");
    if(disabled){
        regist.setAttribute("disabled", "disabled");
    }
    else{
        regist.removeAttribute("disabled");
    }
}

function getField(fieldName){
    var field = document.getElementById(fieldName);
    if(field == undefined){
        throw new Error("Element was not found: " + fieldName);
    }
    return field;
}
