function check_form(){
    if(document.form.option.value == "Add Notes"){
        if(document.form.notes.value == ""){
            alert("Error : Notes shouldn't be EMPTY while adding notes.");
            return false;
        }
        return true;
    }
    else if(document.form.option.value == "Delete Notes"){
        if(document.form.day.value == ""){
            alert("Error : Day is required to DELETE that day notes.");
            return false;
        }
        return true;
    }
    else{
        if(document.form.notes.value == ""){
            alert("Error : Notes shouldn't be EMPTY while updating notes.");
            return false;
        }
        if(document.form.day.value == ""){
            alert("Error : Day is required to update that day notes.");
            return false;
        }
        return true;
    }
    return true;
}