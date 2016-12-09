$(document).ready(function(){

//Function Definitions
function getDropdowns(){
$('.people_id_list').append(function(){
    $.ajax({
      type: 'GET',
      url: 'api/people',
      dataType: 'json',
      success: function(data){
        $('.people_id_list').empty();
        $.each(data, function(n, elem){
          var id = data[n]["id"];
          var fname = data[n]["firstname"];
          var lname = data[n]["lastname"];
          $('.people_id_list').append("<option value='"+id+"' name='"+id+"' id='"+fname+"'>"+fname+ " "+lname+"</option>");
        });
      },
      error: function(data){
        console.log(error);
      }
});
});

$('.people_id_list_add').append(function(){
    $.ajax({
      type: 'GET',
      url: 'api/people',
      dataType: 'json',
      success: function(data){
        $('.people_id_list_add').empty();
        $.each(data, function(n, elem){
          var id = data[n]["id"];
          var fname = data[n]["firstname"];
          var lname = data[n]["lastname"];
          $('.people_id_list_add').append("<option value='"+id+"' name='"+id+"' id='"+fname+"'>"+fname+ " "+lname+"</option>");
      });
    },
      error: function(data){
        console.log('error');
    }
});
});

};

function displayHide(){
  $('#display_success').hide();
}

function displayShow(item){
  $('#display_success').show(function(){
      $('#display_success').empty().fadeIn().append("<div class='alert alert-success'><h6>A new "+item+" has been added</h6></div>").fadeOut(2000);
  });
}

function displayData(){
var user_id = $('.people_id_list').val();
var user_num = user_id;
$.ajax({
  type: 'GET',
  dataType: 'json',
  url: 'api/people/'+user_num,
  success: function(data){
    $('.display_info').empty();
    $('.display_visits').empty();
    var fname = data[0]["firstname"];
    var lname = data[0]["lastname"];
    var food = data[0]["fav food"];
    $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> likes to eat <code>"+food+"</code></h6>");
  }
});
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'api/visits/'+user_num,
    success: function(data){
      $('.display_visits').append("<table class='table table-bordered' id='table_visits'></table>");
      $('#table_visits').append("<tr><th>First</th><th>Last</th><th>State</th><th>Date</th></tr>");
    $.each(data, function(n, elem){
    var date = data[n]["date"];
    var state = data[n]["state"];
    $('#table_visits').append("<tr><td><code>This</code></td><td><code>Person</code></td><td> has visited <code>"+state+"</code></td> on <td><code>"+date+"</code></td></tr>");
  });
  }
  //});
  /*else{
    $.ajax({
      type: 'GET',
      url: 'API/people/'+user_id,
      success: function(response){
        $('.display_info').empty();
        $('.display_visits').empty();
        var fname = response[0]['first_name'];
        var lname = response[0]['last_name'];
        var food = response[0]['fav_food'];
        $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> likes to eat <code>"+food+"</code></h6>");
        $('.display_info').append("<h6><code>"+fname+" "+lname+"</code> has never traveled. </h6>");
      }
  });
}*/
});
}

function displayStates(){
  $.ajax({
    type: 'GET',
    url: 'api/states',
    dataType: 'json',
    success: function(data){
      $('.state_id_list').empty();
      $.each(data, function(n, elem){
        var s_id = data[n]["id"];
        var s_abb = data[n]["stateabb"];
        var s_name = data[n]["statename"];
        $('.state_id_list').append("<option value='"+s_id+"'' name='"+s_id+"'>"+s_abb+ " - "+s_name+"</option>");
      });
    }
});
}

//Initial Function Calls
getDropdowns();
displayHide();
displayData();


//Populate Person Information
$('.people_id_list').change(function(){
  displayData();
});

//Populate States
$('.state_id_list').append(function(){
  displayStates();
});


//Add Visit
$('.visit_btn').click(function(event){
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'api/visits',
      data: $('.visit_form').serialize(),
      success: function(){
        getDropdowns();
        displayShow("visit");
        displayData();
      }
});
});

//Add Person
$('.person_btn').click(function(event){
      event.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'api/people',
        data: $('.person_frm').serialize(),
        success: function(){
          getDropdowns();
          displayShow("person");
          displayData();
      }
});
});
});
