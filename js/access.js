// $(document).ready(function() {
    $.ajax({
        url:'../access.php',
        
        success:function(response) {
            var results = [];
            var data = JSON.parse(response);
            // console.log(response);
            for(var i = 0; i<data.length; i++) {
                results.push(data[i].fpage);
            }
            // console.log(results);
            //Access for Home Tab
            if(!(results.includes("1"))) {
               document.getElementById("dashboard_tab").style.display = 'none';
            } 
            if(!(results.includes("2"))) {
               document.getElementById("profile_tab").style.display = 'none';
            }
            if(!(results.includes("3"))) {
               document.getElementById("inbox_tab").style.display = 'none';
            }
            if(!(results.includes("4"))) {
               document.getElementById("notification_tab").style.display = 'none';
            }
            if(!(results.includes("1")) && !(results.includes("2")) && !(results.includes("3")) && !(results.includes("4"))) {
               document.getElementById("home_tab").style.display = 'none';
            }
            
            //Access for Undergraduate
            if(!(results.includes("5"))) {
               document.getElementById("certification_tab").style.display = 'none';
            } 
            if(!(results.includes("6"))) {
               document.getElementById("ug_course_tab").style.display = 'none';
            }
            if(!(results.includes("7"))) {
               document.getElementById("ug_enrollment_tab").style.display = 'none';
            }
            if(!(results.includes("8"))) {
               document.getElementById("ug_programme_tab").style.display = 'none';
            }
            if(!(results.includes("9"))) {
               document.getElementById("ug_result_tab").style.display = 'none';
            }
            if(!(results.includes("5")) && !(results.includes("6")) && !(results.includes("7")) && !(results.includes("8")) && !(results.includes("9"))) {
               document.getElementById("undergraduate_tab").style.display = 'none';
            }
            
            //Access for Postgraduate
            if(!(results.includes("30"))) {
               document.getElementById("pg_certification_tab").style.display = 'none';
            }
            if(!(results.includes("10"))) {
               document.getElementById("pg_course_tab").style.display = 'none';
            } 
            if(!(results.includes("11"))) {
               document.getElementById("pg_enrollment_tab").style.display = 'none';
            }
            if(!(results.includes("12"))) {
               document.getElementById("pg_programme_tab").style.display = 'none';
            }
            if(!(results.includes("13"))) {
               document.getElementById("pg_result_tab").style.display = 'none';
            }
            if(!(results.includes("10")) && !(results.includes("11")) && !(results.includes("12")) && !(results.includes("12"))) {
               document.getElementById("postgraduate_tab").style.display = 'none';
            }

            //Services
            if(!(results.includes("14"))) {
               document.getElementById("ug_services_tab").style.display = 'none';
            } 
            if(!(results.includes("15"))) {
               document.getElementById("pg_services_tab").style.display = 'none';
            }
            if(!(results.includes("16"))) {
               document.getElementById("certificate_tab").style.display = 'none';
            }
            if(!(results.includes("17"))) {
               document.getElementById("signatory_tab").style.display = 'none';
            }
            if(!(results.includes("18"))) {
               document.getElementById("task_tab").style.display = 'none';
            }
            if(!(results.includes("19"))) {
               document.getElementById("request_tab").style.display = 'none';
            }
            if(!(results.includes("14")) && !(results.includes("15")) && !(results.includes("16"))  && !(results.includes("17")) && !(results.includes("18")) && !(results.includes("19"))) {
               document.getElementById("services_tab").style.display = 'none';
            }

            //Analytics
            if(!(results.includes("20"))) {
               document.getElementById("general_tab").style.display = 'none';
            } 
            if(!(results.includes("21"))) {
               document.getElementById("ncte_tab").style.display = 'none';
            }
            if(!(results.includes("20")) && !(results.includes("21"))) {
               document.getElementById("analytics_tab").style.display = 'none';
            }
            
            //Access for Settings Tab
            if(!(results.includes("22"))) {
               document.getElementById("campus_tab").style.display = 'none';
            } 
            if(!(results.includes("23"))) {
               document.getElementById("course_tab").style.display = 'none';
            }
            if(!(results.includes("24"))) {
               document.getElementById("department_tab").style.display = 'none';
            }
            if(!(results.includes("25"))) {
               document.getElementById("programme_tab").style.display = 'none';
            }
            if(!(results.includes("26"))) {
               document.getElementById("upload_tab").style.display = 'none';
            } 
            if(!(results.includes("27"))) {
               document.getElementById("edit_tab").style.display = 'none';
            }
            if(!(results.includes("28"))) {
               document.getElementById("users_tab").style.display = 'none';
            }
            if(!(results.includes("29"))) {
               document.getElementById("log_tab").style.display = 'none';
            }
            if(!(results.includes("31"))) {
               document.getElementById("uni_halls").style.display = 'none';
            }
            if(!(results.includes("32"))) {
               document.getElementById("gen_edit").style.display = 'none';
            }
            if(!(results.includes("22")) && !(results.includes("23")) && !(results.includes("24")) && !(results.includes("25")) && !(results.includes("26")) && !(results.includes("27")) && !(results.includes("28")) && !(results.includes("29")) && !(results.includes("31")) && !(results.includes("32"))) {
               document.getElementById("settings_tab").style.display = 'none';
            }
        }
    })
// })