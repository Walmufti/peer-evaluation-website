


function Login() {
    //only show stu inpout for students; only show pro input for professors
    //var y = document.forms["logIn"].elements["Person"].value;

    var Slog = document.getElementById("stu");
    var Plog = document.getElementById("pro");

    // if (y == "S") {
    //     Slog.style.display = "block";
    //     Plog.style.display = "none";
    // } else if (y == "P") {
    //     Slog.style.display = "none";
    //     Plog.style.display = "block";
    // }
}


function stuShow() {

    var Slog = document.getElementById("stu");
    var Plog = document.getElementById("pro");
    Slog.style.display = "block";
    Plog.style.display = "none";

}


function profShow() {
    var Slog = document.getElementById("stu");
    var Plog = document.getElementById("pro");
    Slog.style.display = "none";
    Plog.style.display = "block";

}


function checkForm() {
    //check that user has selected Student or Professor before submitting
    //keep track if any error
    var someError = false;

    //check if Student or Professor was selected
    var Check = document.forms["logIn"].elements["Person"];
    someError = checkFO(Check);

    //if error was found, give user message and prevent submitting form
    if (someError == true) {
        event.preventDefault(); //prevent "submit" defult event

        //pop up error message
        alert("Please select Student or Professor");

    }
}