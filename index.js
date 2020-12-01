function check_getNote_form(){
    if(document.getNote.courseNo.value == "") 
    {
        alert("Error : Course Number should not be empty for fetching Notes");
        return false;
    }
    return true;
}

function check_edit_form(){
    if(document.edit.option.value == "Add Course"){
        if(document.edit.courseNo.value==""){
            alert("Error : Empty field");
            return false;
        }
        if(document.edit.courseTitle.value == ""){
            alert("Error : Empty field");
            return false;
        }
    }

    if(document.edit.option.value == "Delete Course"){
        if(document.edit.courseNo.value == ""){
            alert("Error : Empty Course Number field");
            return false;
        }
        return confirm("WARNING : Deleting A Course Means 'Deleting Notes' Of The Course ");
    }

    if(document.edit.option.value=="Update Title"){
        if(document.edit.courseNo.value==""){
            alert("Error : Empty Course Number field");
            return false;
        }
    }
    return true;
}
