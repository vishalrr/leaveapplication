
function validFname()
{
   var name = /^[A-Za-z]+$/;
   var fname= document.user.name.value;
   if(!name.test(fname))
   {
      document.getElementById("name").focus();;
        document.getElementById("fname").innerHTML = " * Please Enter only Alphabets";
     
   }
  else{
      
      document.getElementById("fname").innerHTML = " ";
      
    } 
  
  
}

function validDesig()
{
   var name = /^[A-Za-z]+$/;
   var desname= document.user.designation.value;
   if(!name.test(desname))
   {
      document.getElementById("designation").focus();;
        document.getElementById("desig").innerHTML = " * Please Enter only Alphabets";
     
   }
  else{
      
      document.getElementById("desig").innerHTML = " ";
      
    } 
  
  
}


function validrepo()
{
   var name = /^[A-Za-z]+$/;
   var repname= document.user.reporting_person.value;
   if(!name.test(repname))
   {
      document.getElementById("reporting_person").focus();;
        document.getElementById("lead").innerHTML = " * Please Enter only Alphabets";
     
   }
  else{
      
      document.getElementById("lead").innerHTML = " ";
      
    } 
  
  
}


function validDays()
{
 var reg = /^\d+$/;
  var  selct_day = document.user.days.value;
   if(!reg.test(selct_day))
   {
      document.getElementById("days").focus();;
        document.getElementById("lday").innerHTML = " * Please Enter only numbers";
     
   }
  else{
      
      document.getElementById("lday").innerHTML = " ";
      
    } 
}


function validLeaves()
{
 var reg = /^\d+$/;
  var  selct_leave = document.user.leaves_availed.value;
   if(!reg.test(selct_leave))
   {
      document.getElementById("leaves_availed").focus();;
        document.getElementById("lavail").innerHTML = " * Please Enter only numbers";
     
   }
  else{
      
      document.getElementById("lavail").innerHTML = " ";
      
    } 
}

function validTime()
{
 var timef = / [+-]?([0-9]*[:])?[0-9]+/ ;
  var  selct_time = document.user.time.value;
   if(!reg.test(selct_time))
   {
      document.getElementById("time").focus();;
        document.getElementById("ltime").innerHTML = " * Please Enter only numbers";
     
   }
  else{
      
      document.getElementById("ltime").innerHTML = " ";
      
    } 
}





function validateFunction(){
var timef =/ [+-]?([0-9]*[.])?[0-9]+ /;

  
 var reg = /^\d+$/;
   var name = /^[A-Za-z]+$/;
   var fname= document.user.name.value;
  var pers_desg= document.user.designation.value;
  var  pers_repoting= document.user.reporting_person.value;
  var  sel_date = document.user.datepicker.value;
   var sel_time = document.user.time.value;
  var  sel_day = document.user.days.value;
   var taken_leave = document.user.leaves_availed.value;





if(fname== "" && pers_desg== "" && pers_repoting== "" && sel_date== "" && sel_time=="" && sel_day=="" && taken_leave=="" )
{



document.getElementById("fname").innerHTML = " Enter your Full name";
document.getElementById("desig").innerHTML = " * Enter your Designation";
document.getElementById("lead").innerHTML = " * Enter your reporting person name";
document.getElementById("ldate").innerHTML = " * Please Choose your desired date";
document.getElementById("ltime").innerHTML = " *  Please Choose your desired time";
document.getElementById("lday").innerHTML = " * Please enter the number of days ";
document.getElementById("lavail").innerHTML = " * Please enter number of leaves availed ";


  return false;

}


if(fname==""){
      document.getElementById("name").focus();
    document.getElementById("msg_fname").innerHTML = " * Enter your Full Name";
      return false;
      }else if(!name.test(fname)){
        document.getElementById("name").focus();;
        document.getElementById("fname").innerHTML = " * Please Enter only Alphabets";
        return false;
      }
      else{
      document.getElementById("fname").innerHTML = " ";
      }



if(pers_desg==""){
      document.getElementById("designation").focus();
    document.getElementById("desig").innerHTML = " * Enter your Designation";
      return false;
      }else if(!name.test(pers_desg)){
        document.getElementById("]designation").focus();;
        document.getElementById("desig").innerHTML = " * Please Enter only Alphabets ";
        return false;
      }
      else{
      document.getElementById("desig").innerHTML = " ";
      }

if(pers_repoting==""){
        document.getElementById("lead").innerHTML = " * Please Enter your reporting person name";
        document.getElementById("reporting_person").focus();
      
      return false;
    }
     else if(!name.test(pers_repoting)){
        document.getElementById("reporting_person").focus();;
        document.getElementById("lead").innerHTML = " * Please Enter only Alphabets";
        return false;
      }
      else{
      document.getElementById("lead").innerHTML = " ";
      }

if(sel_day==""){

  document.getElementById("days").focus();
   document.getElementById("lday").innerHTML = " * Please enter the number of days ";
      return false;
      }else if(!reg.test(sel_day)){
        document.getElementById("").focus();;
        document.getElementById("lday").innerHTML = " * Please Enter only numbers";
        return false;
      }
      else{
      document.getElementById("lday").innerHTML = " ";
}


if(taken_leave==""){

  document.getElementById("leaves_availed").focus();
   document.getElementById("lavail").innerHTML = " * Please enter number of leaves availed ";
      return false;
      }else if(!reg.test(taken_leave)){
        document.getElementById("").focus();;
        document.getElementById("lavail").innerHTML = " * Please Enter only numbers";
        return false;
      }
      else{
      document.getElementById("lavail").innerHTML = " ";
}

if(sel_time==""){

  document.getElementById("time").focus();
   document.getElementById("ltime").innerHTML = " * Please enter number of leaves availed ";
      return false;
      }else if(!timef.test(sel_time)){
        document.getElementById("").focus();;
        document.getElementById("ltime").innerHTML = " * Please Enter only numbers";
        return false;
      }
      else{
      document.getElementById("ltime").innerHTML = " ";
}



}

       







