<?php

session_start();

require 'dbh.inc.php';

if (isset($_POST['course-import'])) {


    if ($_FILES["fileToUpload"]["name"] == "") { //If file is not selected, use single name option
        $courseName = $_POST["coursename"];
        $termName = $_POST["termnum"];
        $courseID = "";
        $termID = "";



        //convert course number to id in database
        $sql = "SELECT id FROM course WHERE course_number = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../professor_portal.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $courseName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $courseID = $row['id'];
            }
            //convert term to id from database
            $sql = "SELECT id FROM term WHERE name = ?";


            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../professor_portal.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $termName);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                //checks if result was recieved
                //stores in array
                if ($row = mysqli_fetch_assoc($result)) {
                    $termID = $row['id'];
                }
                if ($termID != "" && $courseID != "") {
                    //insert into the professor_course table (assign all information for that specific "CRN")
                    $sql = "INSERT into professor_course (professor_id,course_id,term_id) VALUES (?,?,?)";
                    $result = mysqli_stmt_get_result($stmt);

                    //logged in professor ID
                    $professor_ID = $_SESSION['professor_id'];

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../index.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "iii", $professor_ID, $courseID, $termID);
                        mysqli_stmt_execute($stmt);

                        unset($_SESSION['course_info']);


					//get course information for all courses that the professor is an instructor for
					$sql = "SELECT  professor_course.id, term_id, course_name, course_number, course_id, name, start_date, end_date FROM professor_course JOIN course AS c ON c.id=professor_course.course_id JOIN term AS t ON t.id=professor_course.term_id WHERE professor_id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						//get all courses professor is a part of based on professor id
						mysqli_stmt_bind_param($stmt, "i",  $professor_ID);
						mysqli_stmt_execute($stmt);

						//grabs the result for the stmt
						$result = mysqli_stmt_get_result($stmt);

						//increment for course_info session variable
						$i = 0;

						//store course information in a nested array
						while ($row = $result->fetch_assoc()) {
							$_SESSION['course_info'][$i] = array($row['id'], $row['course_id'], $row['course_name'], $row['course_number'], $row['name']);
                            echo "entered";
							$i++;
						}
                        var_dump($_SESSION);
						header("Location: ../professor_portal.php?result=courseadded");
					}




                        
                    }
                } else {
                    header("Location: ../professor_portal.php?error=invaliddata");
                }
            }
        }
    } else {

        $target_dir = "../csv/";
        $fileName = 'd' . date("Y-m-d") . 't' . date("h-i-s") . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: ../professor_portal.php?error=fileservererror");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "csv") {
            header("Location: ../professor_portal.php?error=notcsv");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: ../professor_portal.php?error=servererror");
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                //convert csv file to array
                $csv = array_map('str_getcsv', file('../csv/' . $fileName));
                //create course and term variables
                $courseID = "";
                $termID = "";

                //set up total number of courses imported and variable for if both term and course are valid
                $imported = array(0, 0);
                $total = 0;
                //for each row in the csv file
                foreach ($csv as &$course) {
                    //convert course number to id in database
                    //$course[0] is course number, $course[1] is term name
                    $sql = "SELECT id FROM course WHERE course_number = ?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../professor_portal.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $course[0]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            $courseID = $row['id'];
                            if ($courseID != "") {
                                $imported[0] = 1;
                            } else {
                                $imported[0] = 0;
                            }
                        }
                        //convert term to id from database
                        $sql = "SELECT id FROM term WHERE name = ?";


                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../professor_portal.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $course[1]);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            //checks if result was recieved
                            //stores in array
                            if ($row = mysqli_fetch_assoc($result)) {
                                $termID = $row['id'];
                                if ($termID != "") {
                                    $imported[1] = 1;
                                } else {
                                    $imported[1] = 0;
                                }
                            }

                            if ($imported[0] == 1 && $imported[1] == 1) {
                                $total++; //get total number of courses imported
                            }
                            echo $total;

                            //insert into the professor_course table (assign all information for that specific "CRN")
                            $sql = "INSERT into professor_course (professor_id,course_id,term_id) VALUES (?,?,?)";
                            $result = mysqli_stmt_get_result($stmt);

                            //logged in professor ID
                            $professor_ID = $_SESSION['professor_id'];

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../index.php?error=sqlerror");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "iii", $professor_ID, $courseID, $termID);
                                mysqli_stmt_execute($stmt);
                            }
                        }
                    }
                }


					//get course information for all courses that the professor is an instructor for
					$sql = "SELECT  professor_course.id, term_id, course_name, course_number, course_id, name, start_date, end_date FROM professor_course JOIN course AS c ON c.id=professor_course.course_id JOIN term AS t ON t.id=professor_course.term_id WHERE professor_id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../index.php?error=sqlerror");
						exit();
					} else {
						//get all courses professor is a part of based on professor id
						mysqli_stmt_bind_param($stmt, "i", $row['id']);
						mysqli_stmt_execute($stmt);

						//grabs the result for the stmt
						$result = mysqli_stmt_get_result($stmt);

						//increment for course_info session variable
						$i = 0;

						//store course information in a nested array
						while ($row = $result->fetch_assoc()) {
							$_SESSION['course_info'][$i] = array($row['id'], $row['course_id'], $row['course_name'], $row['course_number'], $row['name']);
							$i++;
						}

						header("Location: ../professor_portal.php?result=coursescreated");
					}




                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} 

else if (isset($_POST['student-import'])) {



    if ($_FILES["fileToUpload"]["name"] == "") { //If file is not selected, use single name option

        $professorCourseID = $_POST['CourseSelect'];
        $fName = $_POST['studentfname'];
        $lName = $_POST['studentlname'];
        $studentID = "";

        //convert course number to id in database
        $sql = "SELECT id FROM student WHERE first_name = ? AND last_name = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../professor_portal.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $fName, $lName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $studentID = $row['id'];
            }

            if($studentID != ""){
            //insert the student into the course
            $sql = "INSERT into student_course (student_id, prof_course_id) VALUES (?,?)";
            $result = mysqli_stmt_get_result($stmt);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../professor_portal.php?error=sqlerror");
                exit();
            } 
            else {
                mysqli_stmt_bind_param($stmt, "ii", $studentID, $professorCourseID);
                mysqli_stmt_execute($stmt);
                header("Location: ../professor_portal.php?result=studentadded");
            }
        }
        else{
            header("Location: ../professor_portal.php?error=invalidname");
        }

        }
    } else {

        $target_dir = "../csv/";
        $fileName = 'd' . date("Y-m-d") . 't' . date("h-i-s") . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: ../professor_portal.php?error=fileservererror");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "csv") {
            header("Location: ../professor_portal.php?error=notcsv");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: ../professor_portal.php?error=servererror");
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";

                //convert csv into an array
                $csv = array_map('str_getcsv', file('../csv/' . $fileName));
                $studentID = "";
                //for each student in the uploaded csv file
                foreach ($csv as &$student) {
                    //get the student id from the first name and last name
                    $sql = "SELECT id FROM student WHERE first_name = ? AND last_name = ?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../professor_portal.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $student[0], $student[1]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);


                        if ($row = mysqli_fetch_assoc($result)) {
                            $studentID = $row['id'];
                        }

                        $professorCourseID = $_POST['CourseSelect'];

                        //insert the student into the course
                        $sql = "INSERT into student_course (student_id, prof_course_id) VALUES (?,?)";
                        $result = mysqli_stmt_get_result($stmt);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../professor_portal.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "ii", $studentID, $professorCourseID);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../professor_portal.php?result=studentscreated");
                        }
                    }
                }
                header("Location: ../professor_portal.php?result=studentscreated");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
